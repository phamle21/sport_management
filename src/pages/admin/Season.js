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

import FormNewUser from './user/FormNewUser';
import FormEditUser from './user/FormEditUser';

// components
import Page from '../../components/Page';
import Scrollbar from '../../components/Scrollbar';
import Iconify from '../../components/Iconify';
import SearchNotFound from '../../components/SearchNotFound';
import { UserListHead, UserListToolbar, UserMoreMenu } from '../../sections/@dashboard/user';
import { SeasonListHead, SeasonListToolbar, SeasonMoreMenu } from '../../sections/@dashboard/season';
// mock
import apiBase from '../../app/axios/apiBase';
import {
    accountState,
    seasonListState,
    selectedSeasonState,
    statusModelNewUserState,
    statusModelEditUserState,
} from '../../app/recoil/store';

// ----------------------------------------------------------------------

const TABLE_HEAD = [
    { id: 'id', label: 'ID', alignRight: false },
    { id: 'name', label: 'Name', alignRight: false },
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

export default function Season() {
    const [page, setPage] = React.useState(0);

    const [order, setOrder] = React.useState('asc');

    const [selected, setSelected] = useRecoilState(selectedSeasonState);

    const [orderBy, setOrderBy] = React.useState('name');

    const [filterName, setFilterName] = React.useState('');

    const [rowsPerPage, setRowsPerPage] = React.useState(5);

    const [seasonList, setSeasonList] = useRecoilState(seasonListState);

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
            const newSelecteds = seasonList.map((n) => n.id);
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

    const emptyRows = page > 0 ? Math.max(0, (1 + page) * rowsPerPage - seasonList.length) : 0;

    const filteredList = applySortFilter(seasonList, getComparator(order, orderBy), filterName);

    const isUserNotFound = filteredList.length === 0;

    React.useEffect(() => {
        // if (seasonList.length < 1) {
        setOpenLoading(true)
        apiBase.get("/seasons").then(res => {
            setSeasonList(res.data.data);
            setOpenLoading(false)
        }).catch(err => console.log(err));
        // }
    }, [])

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

    // ======================= Modal =========================
    const [statusModelNewUser, setStatusModelNewUser] = useRecoilState(statusModelNewUserState)

    const [statusModelEditUser, setStatusModelEditUser] = useRecoilState(statusModelEditUserState)

    React.useEffect(() => {
        setStatusModelNewUser(statusModelNewUser);
    }, [statusModelNewUser])

    const handleCloseModal = () => setStatusModelNewUser(false);

    const btnNewSeason = () => {
        setStatusModelNewUser(true)
    }
    // ======================= /Modal =========================

    const classes = useStyles();

    return (
        <Page title="Seasons">

            <Modal
                open={statusModelNewUser}
                onClose={handleCloseModal}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
                    <Typography component="h1" variant="h3" className={classes.paper}>
                        New Season
                    </Typography>

                    <FormNewUser />

                </Box>
            </Modal>
            <Modal
                open={statusModelEditUser}
                onClose={() => setStatusModelEditUser(false)}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
                    <Typography component="h1" variant="h3" className={classes.paper}>
                        Edit Season
                    </Typography>

                    <FormEditUser />

                </Box>
            </Modal>

            <Container>
                <Stack direction="row" alignItems="center" justifyContent="space-between" mb={5}>
                    <Typography variant="h4" gutterBottom>
                        Seasons
                    </Typography>
                    <Button variant="contained" onClick={btnNewSeason} component={RouterLink} to="#" startIcon={<Iconify icon="eva:plus-fill" />}>
                        New season
                    </Button>
                </Stack>

                <Card>

                    <SeasonListToolbar numSelected={selected.length} filterName={filterName} onFilterName={handleFilterByName} />

                    <Scrollbar>
                        <TableContainer sx={{ minWidth: 800 }}>
                            <Table>
                                <UserListHead
                                    order={order}
                                    orderBy={orderBy}
                                    headLabel={TABLE_HEAD}
                                    rowCount={seasonList.length}
                                    numSelected={selected.length}
                                    onRequestSort={handleRequestSort}
                                    onSelectAllClick={handleSelectAllClick}
                                />
                                <TableBody>
                                    {filteredList.slice(page * rowsPerPage, page * rowsPerPage + rowsPerPage).map((row) => {
                                        const { id, name } = row;

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
                                                        <Typography variant="subtitle2" noWrap>
                                                            {name}
                                                        </Typography>
                                                    </Stack>
                                                </TableCell>

                                                <TableCell align="right">
                                                    <SeasonMoreMenu user={row} userId={id} name={name} />
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
                        count={seasonList.length}
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
