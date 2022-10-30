import { filter } from 'lodash';
import { sentenceCase } from 'change-case';
import React from 'react';
import { Link as RouterLink } from 'react-router-dom';
import { useRecoilState, useRecoilValue } from 'recoil';
// material
import { makeStyles } from '@mui/styles';
import {
    Box,
    Card,
    Modal,
    Table,
    Stack,
    Avatar,
    Button,
    Checkbox,
    TableRow,
    TableBody,
    TableCell,
    Container,
    Typography,
    TableContainer,
    TablePagination,
    CircularProgress,
} from '@mui/material';

import FormNewUser from './FormNewUser';
import FormEditUser from './FormEditUser';

// components
import Page from '../../../components/Page';
import Label from '../../../components/Label';
import Scrollbar from '../../../components/Scrollbar';
import Iconify from '../../../components/Iconify';
import SearchNotFound from '../../../components/SearchNotFound';
import { UserListHead, UserListToolbar, UserMoreMenu } from '../../../sections/@dashboard/user';
// mock
import apiBase from '../../../app/axios/apiBase';
import { API_URL } from "../../../constant/api_constant";
import {
    userListType,
    userListState,
    userListByTypeState,
    statusModelNewUserState,
    statusModelEditUserState,
    roleState,
    selectedUserState,
    accountState,
} from '../../../app/recoil/store';

// ----------------------------------------------------------------------

const TABLE_HEAD = [
    { id: 'id', label: 'ID', alignRight: false },
    { id: 'name', label: 'Họ Tên', alignRight: false },
    { id: 'role', label: 'Loại người dùng', alignRight: false },
    { id: 'isVerified', label: 'Xác thực', alignRight: false },
    { id: 'status', label: 'Trạng thái', alignRight: false },
    { id: '' },
];

// ----------------------------------------------------------------------

function descendingComparator(a, b, orderBy) {
    if (b[orderBy] < a[orderBy]) {
        return -1;
    }
    if (b[orderBy] > a[orderBy]) {
        return 1;
    }
    return 0;
}

function getComparator(order, orderBy) {
    return order === 'desc'
        ? (a, b) => descendingComparator(a, b, orderBy)
        : (a, b) => -descendingComparator(a, b, orderBy);
}

function applySortFilter(array, comparator, query) {
    const stabilizedThis = array.map((el, index) => [el, index]);
    stabilizedThis.sort((a, b) => {
        const order = comparator(a[0], b[0]);
        if (order !== 0) return order;
        return a[1] - b[1];
    });
    if (query) {
        return filter(array, (_user) => _user.name.toLowerCase().indexOf(query.toLowerCase()) !== -1);
    }
    return stabilizedThis.map((el) => el[0]);
}

const useStyles = makeStyles((theme) => ({
    paper: {
        marginTop: theme.spacing(4),
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        paddingBottom: '0rem',
        marginBottom: '1rem',
    },
    avatar: {
        margin: theme.spacing(1),
        backgroundColor: theme.palette.secondary.main,
    },
    form: {
        width: '100%', // Fix IE 11 issue.
        marginTop: theme.spacing(1),
    },
    submit: {
        margin: theme.spacing(3, 0, 2),
    },
}));

export default function User() {
    const [page, setPage] = React.useState(0);

    const [order, setOrder] = React.useState('asc');

    const [selected, setSelected] = useRecoilState(selectedUserState);

    const [orderBy, setOrderBy] = React.useState('name');

    const [filterName, setFilterName] = React.useState('');

    const [rowsPerPage, setRowsPerPage] = React.useState(5);

    const [userList, setUserList] = useRecoilState(userListState);

    const [userListByType, setUserListByType] = useRecoilState(userListByTypeState);

    const userType = useRecoilValue(userListType);

    const [roles, setRoles] = useRecoilState(roleState);

    const [openLoading, setOpenLoading] = React.useState(false);

    const account = useRecoilValue(accountState)

    // ===========================================================================

    const handleRequestSort = (event, property) => {
        const isAsc = orderBy === property && order === 'asc';
        setOrder(isAsc ? 'desc' : 'asc');
        setOrderBy(property);
    };

    const handleSelectAllClick = (event) => {
        if (event.target.checked) {
            const newSelecteds = userListByType.map((n) => n.id);
            setSelected(newSelecteds);
            return;
        }
        setSelected([]);
    };

    const handleClick = (event, id) => {
        const selectedIndex = selected.indexOf(id);
        let newSelected = [];
        if (selectedIndex === -1) {
            newSelected = newSelected.concat(selected, id);
        } else if (selectedIndex === 0) {
            newSelected = newSelected.concat(selected.slice(1));
        } else if (selectedIndex === selected.length - 1) {
            newSelected = newSelected.concat(selected.slice(0, -1));
        } else if (selectedIndex > 0) {
            newSelected = newSelected.concat(selected.slice(0, selectedIndex), selected.slice(selectedIndex + 1));
        }
        setSelected(newSelected);
    };

    const handleChangePage = (event, newPage) => {
        setPage(newPage);
    };

    const handleChangeRowsPerPage = (event) => {
        setRowsPerPage(parseInt(event.target.value, 10));
        setPage(0);
    };

    const handleFilterByName = (event) => {
        setFilterName(event.target.value);
    };

    const emptyRows = page > 0 ? Math.max(0, (1 + page) * rowsPerPage - userListByType.length) : 0;

    const filteredUsers = applySortFilter(userListByType, getComparator(order, orderBy), filterName);

    const isUserNotFound = filteredUsers.length === 0;

    React.useEffect(() => {
        if (userList.length < 1) {
            setOpenLoading(true)
            apiBase.get("/users", {
                params: {
                    type: "All"
                }
            }).then(res => {
                setUserList(res.data.data);
                setUserListByType(res.data.data)
                setOpenLoading(false)
            });
        }
        if (roles.length < 1) {
            apiBase.get('/roles', {
                params: {
                    type: 'All'
                }
            }).then(res => {
                setRoles(res.data.data);
            }).catch(err => {
                console.log(`err: ${err}`);
            })
        }
    }, [])

    React.useEffect(() => {
        if (userType === "All") {
            setUserListByType(userList);
        } else {
            let arrTemp = [];

            if (userList.length > 0)
                userList.forEach(user => {
                    if (user.roles.length > 0) {
                        user.roles.forEach(role => {
                            if (role.name === userType) {
                                arrTemp = [...arrTemp, user]
                            }
                        })
                    }
                })

            setUserListByType(arrTemp)
        }
        setPage(0);

    }, [userType])

    // Style modal
    const style = {
        position: 'absolute',
        top: '50%',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        width: 'auto',
        maxWidth: '600px',
        bgcolor: 'background.paper',
        border: '0.5px solid green',
        boxShadow: 24,
        p: 3,
        pt: 0,
        borderRadius: '15px',
        color: '#1958ba',
        overflow: 'auto'
    };

    const [statusModelNewUser, setStatusModelNewUser] = useRecoilState(statusModelNewUserState)

    const [statusModelEditUser, setStatusModelEditUser] = useRecoilState(statusModelEditUserState)

    React.useEffect(() => {
        setStatusModelNewUser(statusModelNewUser);
    }, [statusModelNewUser])

    const handleCloseModal = () => setStatusModelNewUser(false);

    const btnNewUser = () => {
        setStatusModelNewUser(true)
    }

    const classes = useStyles();

    return (
        <Page title="User">

            <Container>
                <Stack direction="row" alignItems="center" justifyContent="space-between" mb={5}>
                    <Typography variant="h4" gutterBottom>
                        Quản lý người dùng
                    </Typography>
                    <Button variant="contained" component={RouterLink} to="create" startIcon={<Iconify icon="eva:plus-fill" />}>
                        Tạo người dùng mới
                    </Button>
                </Stack>

                <Card>
                    <UserListToolbar numSelected={selected.length} filterName={filterName} onFilterName={handleFilterByName} />

                    <Scrollbar>
                        <TableContainer sx={{ minWidth: 800 }}>
                            <Table>
                                <UserListHead
                                    order={order}
                                    orderBy={orderBy}
                                    headLabel={TABLE_HEAD}
                                    rowCount={userListByType.length}
                                    numSelected={selected.length}
                                    onRequestSort={handleRequestSort}
                                    onSelectAllClick={handleSelectAllClick}
                                />
                                <TableBody>
                                    {filteredUsers.slice(page * rowsPerPage, page * rowsPerPage + rowsPerPage).map((row) => {
                                        const { id, name, roles, status, avatar } = row;
                                        const isVerified = row.email_verified_at;
                                        const isItemSelected = selected.indexOf(id) !== -1;

                                        return (
                                            <TableRow
                                                sx={account.id === id ? { backgroundColor: '#a100ff29' } : {}}
                                                hover
                                                key={id}
                                                tabIndex={-1}
                                                role="checkbox"
                                                selected={isItemSelected}
                                                aria-checked={isItemSelected}
                                            >
                                                <TableCell padding="checkbox">
                                                    <Checkbox checked={isItemSelected} onChange={(event) => handleClick(event, id)} />
                                                </TableCell>
                                                <TableCell align="left">{id}</TableCell>
                                                <TableCell component="th" scope="row" padding="none">
                                                    <Stack direction="row" alignItems="center" spacing={2}>
                                                        <Avatar alt={name} src={avatar} />
                                                        <Typography variant="subtitle2" noWrap>
                                                            {name}
                                                        </Typography>
                                                    </Stack>
                                                </TableCell>
                                                <TableCell align="left">{roles.map((role) => `[${role.name}] `)}</TableCell>
                                                <TableCell align="left">{isVerified != null ? 'Yes' : 'No'}</TableCell>
                                                <TableCell align="left">
                                                    <Label variant="ghost" color={(status !== 'Active' && 'error') || 'success'}>
                                                        {sentenceCase(status)}
                                                    </Label>
                                                </TableCell>

                                                <TableCell align="right">
                                                    <UserMoreMenu user={row} userId={id} status={status} name={name} />
                                                </TableCell>
                                            </TableRow>
                                        );
                                    })}
                                    {emptyRows > 0 && (
                                        <TableRow style={{ height: 53 * emptyRows }}>
                                            <TableCell colSpan={6} />
                                        </TableRow>
                                    )}
                                </TableBody>
                                {openLoading && (
                                    <TableBody>
                                        <TableRow>
                                            <TableCell align="center" colSpan={6} sx={{ py: 3 }}>
                                                <CircularProgress />
                                            </TableCell>
                                        </TableRow>
                                    </TableBody>
                                )}

                                {isUserNotFound && !openLoading && (
                                    <TableBody>
                                        <TableRow>
                                            <TableCell align="center" colSpan={6} sx={{ py: 3 }}>
                                                <SearchNotFound searchQuery={filterName} />
                                            </TableCell>
                                        </TableRow>
                                    </TableBody>
                                )}

                            </Table>
                        </TableContainer>
                    </Scrollbar>

                    <TablePagination
                        rowsPerPageOptions={[5, 10, 25]}
                        component="div"
                        count={userListByType.length}
                        rowsPerPage={rowsPerPage}
                        page={page}
                        onPageChange={handleChangePage}
                        onRowsPerPageChange={handleChangeRowsPerPage}
                    />
                </Card>
            </Container>
        </Page >
    );
}
