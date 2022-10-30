import React from 'react';
import Swal from 'sweetalert2';
import { useRecoilState, useRecoilValue, useSetRecoilState, } from 'recoil';

// material
import { useTheme } from '@mui/material/styles';
import {
    Box,
    Chip,
    Radio,
    Select,
    Button,
    MenuItem,
    FormLabel,
    TextField,
    InputLabel,
    RadioGroup,
    FormControl,
    OutlinedInput,
    FormControlLabel,
    CircularProgress,
    ToggleButtonGroup,
    ToggleButton,
} from '@mui/material';
import apiBase from '../../../app/axios/apiBase';
import { statusModelEditUserState, userListByTypeState, modelEdit, roleState, userListState } from '../../../app/recoil/store';

const ITEM_HEIGHT = 48;
const ITEM_PADDING_TOP = 8;
const MenuProps = {
    PaperProps: {
        style: {
            maxHeight: ITEM_HEIGHT * 4.5 + ITEM_PADDING_TOP,
        },
    },
};

function getStyles(name, roleID, theme) {
    return {
        fontWeight:
            roleID.indexOf(name) === -1
                ? theme.typography.fontWeightRegular
                : theme.typography.fontWeightMedium,
    };
}
// ================================================================================

const FormEditUser = () => {

    const theme = useTheme();

    const [roleID, setRoleID] = React.useState([]);

    const roles = useRecoilValue(roleState);

    const [checkSubmit, setCheckSubmit] = React.useState(true);

    const [valuePass, setValuePass] = React.useState('');

    const [errPhone, setErrPhone] = React.useState('');

    const [errEmail, setErrEmail] = React.useState('');

    const [errPass, setErrPass] = React.useState(`Leave it blank if you don't want to change it`);

    const [errRePass, setErrRePass] = React.useState('');

    const [newPass, setNewPass] = React.useState('');

    const [changePass, setChangePass] = React.useState(false);

    const [openLoadingSubmit, setOpenLoadingSubmit] = React.useState(false);

    const setModelClose = useSetRecoilState(statusModelEditUserState);

    const setUserListByType = useSetRecoilState(userListByTypeState);

    const userEdit = useRecoilValue(modelEdit);

    const [userList, setUserList] = useRecoilState(userListState);

    const [statusUser, setStatusUser] = React.useState(userEdit.status);

    React.useEffect(() => {
        const arrRoleIDTemp = userEdit.roles.map(role => role.id);
        setRoleID(arrRoleIDTemp)
    }, []);

    const handleChange = (event) => {
        const {
            target: { value },
        } = event;
        
        setRoleID(
            // On autofill we get a stringified value.
            typeof value === 'string' ? value.split(',') : value,
        );
    };

    const onSubmitNewUser = (e) => {
        e.preventDefault()
        // console.log(roleID);
        const { fullname, gender, password, email, phone, address } = e.target.elements

        const formData = {
            name: fullname.value,
            gender: gender.value,
            roles: roleID,
            email: email.value,
            phone: phone.value,
            address: address.value,
            status: statusUser,
        }

        if (password.value.length > 0) {
            formData.password = password.value;
        }

        if (checkSubmit) {

            setOpenLoadingSubmit(true);

            apiBase.patch(`/users/${userEdit.id}`, JSON.stringify(formData))
                .then(res => {
                    if (res.data.status === "success") {
                        Swal.fire({
                            title: 'Success',
                            html: res.data.msg,
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                setModelClose(false)
                            }
                        })
                        const arrTemp = JSON.parse(JSON.stringify(userList));

                        const objIndex = arrTemp.findIndex((obj => obj.id === userEdit.id));

                        arrTemp[objIndex] = res.data.data

                        setUserList(arrTemp)
                        setUserListByType(arrTemp)
                    } else {
                        Swal.fire({
                            title: 'Error',
                            html: res.data.msg,
                            icon: 'error',
                        })
                    }
                    setOpenLoadingSubmit(false);

                })
                .catch(err => {
                    Swal.fire({
                        title: 'Error!',
                        html: err,
                        icon: 'error'
                    })
                    setOpenLoadingSubmit(false);
                })
        } else {
            Swal.fire({
                title: 'STOP!',
                html: 'Please check all fields input!',
                icon: 'warning'
            })
        }

    }

    const checkPhoneField = (value) => {
        if (value !== userEdit.phone) {
            const data = {
                'type': 'phone',
                'value': value
            }

            let checkInvalid = false;

            if (!(/(84|0[3|5|7|8|9])+([0-9]{8})\b/g.test(value))) {
                setErrPhone('Invalid phone number.');
                setCheckSubmit(false);
                checkInvalid = true;
            }

            if (!checkInvalid) {
                apiBase.post('/users/check-account', JSON.stringify(data))
                    .then(res => {
                        if (res.data.status === "phone_exists") {
                            setErrPhone(res.data.msg)
                            setCheckSubmit(false)
                        } else {
                            setErrPhone('');
                            setCheckSubmit(true)
                        }

                    })
                    .catch(err => {
                        Swal.fire({
                            title: 'Error!',
                            html: err,
                            icon: 'error'
                        })
                    })
            }
        }
    }

    const checkEmailField = (value) => {
        if (value !== userEdit.email) {

            const data = {
                'type': 'email',
                'value': value
            }

            let checkInvalid = false;

            if (!(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[A-Za-z]+$/.test(value))) {
                setErrEmail('Invalid email address.');
                setCheckSubmit(false);
                checkInvalid = true;
            }

            if (!checkInvalid) {
                apiBase.post('/users/check-account', JSON.stringify(data))
                    .then(res => {
                        if (res.data.status === "email_exists") {
                            setErrEmail(res.data.msg)
                            setCheckSubmit(false)
                        } else {
                            setErrEmail('');
                            setCheckSubmit(true)
                        }

                    })
                    .catch(err => Swal.fire({
                        title: 'Error!',
                        html: err,
                        icon: 'error'
                    }))
            }
        }
    }

    React.useEffect(() => {
        if (!changePass) {
            setErrPass(`Leave it blank if you don't want to change it`);
            setErrRePass(``);
            setCheckSubmit(true);
        }
    }, [changePass])

    const handleChangePass = (value) => {
        setValuePass(value);
        if (value.length > 0) {
            setChangePass(true);
            setErrPass('');
        } else {
            setChangePass(false);
            setErrPass(`Leave it blank if you don't want to change it`);
            setCheckSubmit(true);
        }

        let checkInvalid = false;

        const regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;

        if (!regularExpression.test(value)) {
            setErrPass(`Password have 6 to 16 valid characters, it has at least a number, and at least a special character.`);
            setCheckSubmit(false);
            checkInvalid = true;
        }

        if (!checkInvalid) {
            setNewPass(value)
            setCheckSubmit(true);
        }
    }

    const handleChangeRePass = (value) => {
        if (changePass && newPass !== '') {
            if (newPass !== value) {
                setErrRePass('Confirmation password is incorrect.');
                setCheckSubmit(false);
            } else {
                setErrRePass('');
                setCheckSubmit(true);
            }
        }
    }

    return (
        <form onSubmit={onSubmitNewUser} id="frmNewUser" sx={{
            '& .MuiTextField-root': { m: 1, width: '25ch' },
        }}>

            <Box
                sx={{
                    display: 'flex',
                    flexDirection: 'row',
                    bgcolor: 'background.paper',
                    borderRadius: 1,
                    justifyContent: 'space-around'
                }}
            >
                <TextField
                    variant="outlined"
                    margin="normal"
                    required
                    fullWidth
                    id="fullname"
                    label="Full name"
                    name="fullname"
                    autoComplete="fullname"
                    defaultValue={userEdit.name}
                    autoFocus
                />

                <FormControl sx={{ mt: 0, ml: 3, width: '100%' }} required>
                    <FormLabel id="demo-row-radio-buttons-group-label" >Status</FormLabel>
                    <ToggleButtonGroup
                        sx={{ maxHeight: 40, width: '100%' }}
                        color="primary"
                        value={statusUser}
                        exclusive
                        onChange={(e) => setStatusUser(e.target.value)}
                        aria-label="Platform"
                    >
                        <ToggleButton value="Active">Active</ToggleButton>
                        <ToggleButton value="Inactive">Inactive</ToggleButton>
                    </ToggleButtonGroup>
                </FormControl>

            </Box>

            <TextField
                variant="outlined"
                margin="normal"
                required
                fullWidth
                name="address"
                label="Address"
                defaultValue={userEdit.address}
                type="text"
                id="Address"
                autoComplete="current-Address"
            />

            <Box
                sx={{
                    display: 'flex',
                    flexDirection: 'row',
                    bgcolor: 'background.paper',
                    borderRadius: 1,
                    justifyContent: 'space-around'
                }}
            >

                <FormControl sx={{ mt: 1, width: '100%' }} required>
                    <InputLabel id="demo-multiple-chip-label">Roles</InputLabel>
                    <Select
                        labelId="demo-multiple-chip-label"
                        id="demo-multiple-chip"
                        multiple
                        required
                        value={roleID}
                        onChange={handleChange}
                        input={<OutlinedInput id="select-multiple-chip" label="Chip" />}
                        renderValue={(selected) => (
                            <Box sx={{ display: 'flex', flexWrap: 'wrap', gap: 0.5 }}>
                                {selected.map((value) => (
                                    <Chip key={value} label={roles.find(item => item.id === value).name} />
                                ))}
                            </Box>
                        )}
                        MenuProps={MenuProps}
                    >
                        {roles.length > 0 ? roles.map((role) => (
                            <MenuItem
                                key={role.id}
                                value={role.id}
                                style={getStyles(role.name, roleID, theme)}
                            >
                                {role.name}
                            </MenuItem>
                        ))
                            : <MenuItem>Loading...</MenuItem>
                        }
                    </Select>
                </FormControl>

                <FormControl sx={{ mt: 1, ml: 3, width: '100%' }} required>
                    <FormLabel id="demo-row-radio-buttons-group-label">Gender</FormLabel>
                    <RadioGroup
                        row
                        aria-labelledby="demo-row-radio-buttons-group-label"
                        name="gender"
                        defaultValue={userEdit.gender}
                    >
                        <FormControlLabel value="Male" control={<Radio required />} label="Male" />
                        <FormControlLabel value="Female" control={<Radio required />} label="Female" />
                    </RadioGroup>
                </FormControl>
            </Box>

            <Box
                sx={{
                    display: 'flex',
                    flexDirection: 'row',
                    bgcolor: 'background.paper',
                    borderRadius: 1,
                    justifyContent: 'space-around'
                }}
            >
                <TextField
                    error={!(errPhone === '')}
                    variant="outlined"
                    margin="normal"
                    required
                    fullWidth
                    disabled
                    name="phone"
                    label="Phone"
                    helperText={errPhone}
                    type="number"
                    onChange={(e) => checkPhoneField(e.target.value)}
                    id="Phone"
                    autoComplete="current-Phone"
                    defaultValue={userEdit.phone}
                    sx={{
                        mr: 1.5,
                    }}
                    inputProps={{
                        maxLength: 12,
                    }}
                />
                <TextField
                    error={!(errEmail === '')}
                    helperText={errEmail}
                    onChange={(e) => checkEmailField(e.target.value)}
                    variant="outlined"
                    margin="normal"
                    required
                    fullWidth
                    disabled
                    name="email"
                    label="Email"
                    type="email"
                    id="Email"
                    autoComplete="current-Email"
                    defaultValue={userEdit.email}
                    sx={{
                        ml: 1.5,
                    }}
                />
            </Box>

            <Box
                sx={{
                    display: 'flex',
                    flexDirection: 'row',
                    bgcolor: 'background.paper',
                    borderRadius: 1,
                    justifyContent: 'space-around'
                }}
            >
                <TextField
                    variant="outlined"
                    margin="normal"
                    required={(changePass)}
                    fullWidth
                    name="password"
                    label="Password"
                    defaultValue={``}
                    type="password"
                    id="Password"
                    value={valuePass}
                    autoComplete={false}
                    helperText={errPass}
                    onChange={(e) => handleChangePass(e.target.value)}
                    error={(errPass !== '' && changePass)}
                />

                <TextField
                    sx={{ ml: 3 }}
                    variant="outlined"
                    margin="normal"
                    required={(changePass)}
                    fullWidth
                    name="repassword"
                    label="Confirm Password"
                    helperText={errRePass}
                    type="password"
                    id="RePassword"
                    autoComplete="current-repassword"
                    onChange={(e) => handleChangeRePass(e.target.value)}
                    disabled={!(changePass)}
                    error={(errRePass !== '')}
                />
            </Box>

            <Button
                type="submit"
                fullWidth
                variant="contained"
                color="primary"
                sx={{ mt: 4, pt: 1, pb: 1 }}
            >
                {openLoadingSubmit ? (
                    <CircularProgress color="success" />
                ) : (
                    'Save changes'
                )}

            </Button>
        </form>
    )
}

export default FormEditUser;