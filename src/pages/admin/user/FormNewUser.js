import React from 'react';
import Swal from 'sweetalert2';
import { useRecoilState, useSetRecoilState } from 'recoil';

// material
import { Theme, useTheme } from '@mui/material/styles';
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
} from '@mui/material';
import AvatarUploader from "react-avatar-uploader";
import apiBase from '../../../app/axios/apiBase';
import { statusModelNewUserState, userListByTypeState } from '../../../app/recoil/store';

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


const FormNewUser = () => {
    const theme = useTheme();

    const [roleID, setRoleID] = React.useState([]);

    const [roles, setRoles] = React.useState([]);

    const [checkSubmit, setCheckSubmit] = React.useState(true);

    const [errPhone, setErrPhone] = React.useState('');

    const [errEmail, setErrEmail] = React.useState('');

    const [errPass, setErrPass] = React.useState('');

    const [errRePass, setErrRePass] = React.useState('');

    const [newPass, setNewPass] = React.useState('');

    const setModelClose = useSetRecoilState(statusModelNewUserState)

    const [userListByType, setUserListByType] = useRecoilState(userListByTypeState)

    React.useEffect(() => {
        apiBase.get('/roles', {
            params: {
                type: 'All'
            }
        }).then(res => {
            setRoles(res.data.data);
        }).catch(err => {
            console.log(`err: ${err}`);
        })
    }, [])

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
            password: password.value,
            email: email.value,
            phone: phone.value,
            address: address.value,
        }
        if (checkSubmit) {
            let arrTemp = [];

            apiBase.post('/users', JSON.stringify(formData))
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
                        arrTemp = [...userListByType, res.data.data]
                        setUserListByType(arrTemp)
                    } else {
                        Swal.fire({
                            title: 'Error',
                            html: res.data.msg,
                            icon: 'error',
                        })
                    }
                })
                .catch(err => Swal.fire({
                    title: 'Error!',
                    html: err,
                    icon: 'error'
                }))
        } else {
            Swal.fire({
                title: 'STOP!',
                html: 'Please check all fields input!',
                icon: 'warning'
            })
        }

    }

    const checkPhoneField = (value) => {
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
                .catch(err => Swal.fire({
                    title: 'Error!',
                    html: err,
                    icon: 'error'
                }))

        }
    }

    const checkEmailField = (value) => {
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

    const handleChangePass = (value) => {
        if (value.length > 0) {
            setErrPass('');
        } else {
            setErrPass(`Password have 6 to 16 valid characters, it has at least a number, and at least a special character.`);
        }

        let checkInvalid = false;

        const regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;

        if (!regularExpression.test(value)) {
            setErrPass(`Password have 6 to 16 valid characters, it has at least a number, and at least a special character.`);
            setCheckSubmit(false);
            checkInvalid = true;
        }

        if (!checkInvalid) {
            setCheckSubmit(true)
            setNewPass(value)
        }
    }

    const handleChangeRePass = (value) => {
        if (newPass !== '') {
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
        }} >
            <FormControl sx={{
                display: 'flex',
                flexDirection: 'row',
                bgcolor: 'background.paper',
                borderRadius: 1,
                justifyContent: 'space-around'
            }} required>

                <AvatarUploader
                    defaultImg="https://sunagro.com.tr/wp-content/uploads/2020/01/image-placeholder-350x350-1.png"
                    size={150}
                    name="asd"
                    uploadURL="http://localhost:3000"
                    fileType={"image"}
                />

            </FormControl>
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
                    autoFocus
                    defaultValue={``}
                />

                <TextField
                    sx={{ mt: 2, ml: 3, width: '100%' }}
                    variant="outlined"
                    margin="normal"
                    required
                    fullWidth
                    name="address"
                    label="Address"
                    type="text"
                    id="Address"
                    defaultValue={``}
                    autoComplete="current-Address"
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
                <FormControl sx={{ mt: 2, ml: 3, width: '100%' }} required>
                    <FormLabel id="demo-row-radio-buttons-group-label">Gender</FormLabel>
                    <RadioGroup
                        row
                        aria-labelledby="demo-row-radio-buttons-group-label"
                        name="gender"
                        defaultValue="male"
                    >
                        <FormControlLabel value="male" control={<Radio required />} label="Male" />
                        <FormControlLabel value="female" control={<Radio required />} label="Female" />
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
                    name="phone"
                    label="Phone"
                    helperText={errPhone}
                    type="number"
                    defaultValue={``}
                    onChange={(e) => checkPhoneField(e.target.value)}
                    id="Phone"
                    autoComplete="current-Phone"
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
                    defaultValue={``}
                    onChange={(e) => checkEmailField(e.target.value)}
                    variant="outlined"
                    margin="normal"
                    required
                    fullWidth
                    name="email"
                    label="Email"
                    type="email"
                    id="Email"
                    autoComplete="current-Email"
                    sx={{
                        ml: 1.5,
                    }}
                />
            </Box>

            <TextField
                variant="outlined"
                margin="normal"
                required
                fullWidth
                name="password"
                label="Password"
                defaultValue={``}
                type="password"
                id="Password"
                autoComplete="current-password"
                helperText={errPass}
                onChange={(e) => handleChangePass(e.target.value)}
                error={(errPass !== '')}
            />
            <TextField
                variant="outlined"
                margin="normal"
                required
                fullWidth
                name="repassword"
                label="Confirm Password"
                defaultValue={``}
                helperText={errRePass}
                type="password"
                id="RePassword"
                autoComplete="current-repassword"
                onChange={(e) => handleChangeRePass(e.target.value)}
                error={(errRePass !== '')}
            />

            <Button
                type="submit"
                fullWidth
                variant="contained"
                color="primary"
                sx={{ mt: 4 }}
                backgroundColor="primary"
            >
                Add
            </Button>
        </form>
    )
}

export default FormNewUser;