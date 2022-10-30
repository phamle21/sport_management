import React from 'react';
import Swal from 'sweetalert2';
import { Link as RouterLink, useParams } from 'react-router-dom';
import { useRecoilState, useSetRecoilState, useRecoilValue } from 'recoil';
import axios from 'axios';
import $ from 'jquery';

// material
import { styled, useTheme } from '@mui/styles';
import {
    Box,
    Chip,
    Grid,
    Paper,
    Radio,
    Stack,
    Button,
    Select,
    MenuItem,
    FormLabel,
    TextField,
    Container,
    InputLabel,
    Typography,
    RadioGroup,
    FormControl,
    OutlinedInput,
    FormControlLabel,
    CircularProgress,
} from '@mui/material';
import AvatarEdit from "react-avatar-edit";
import Page from '../../../components/Page';
import Iconify from '../../../components/Iconify';
import apiBase from '../../../app/axios/apiBase';
import {
    roleState,
    UserEditState,
    userListState,
    userListByTypeState,
    statusModelNewUserState,
} from '../../../app/recoil/store';
import { API_URL } from '../../../constant/api_constant';
// ----------------------------------------------------------------------

const Item = styled(Paper)(({ theme }) => ({
    backgroundColor: theme.palette.mode === 'dark' ? '#1A2027' : '#fff',
    ...theme.typography.body2,
    padding: theme.spacing(1),
    textAlign: 'center',
    color: theme.palette.text.secondary,
}));

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

export default function EditUser() {

    const params = useParams();

    const theme = useTheme();

    const [roleID, setRoleID] = React.useState([]);

    const [roles, setRoles] = useRecoilState(roleState);

    const [checkSubmit, setCheckSubmit] = React.useState(true);

    const [regions, setRegions] = React.useState([]);

    const [selectRegion, setSelectRegion] = React.useState();

    const [districts, setDistricts] = React.useState([]);

    const [selectDistrict, setSelectDistrict] = React.useState();

    const [wards, setWards] = React.useState([]);

    const [address, setAddress] = React.useState();

    const [srcAvatar, setSrcAvatar] = React.useState();

    const [preview, setPreview] = React.useState();

    const setModelClose = useSetRecoilState(statusModelNewUserState)

    const [userListByType, setUserListByType] = useRecoilState(userListByTypeState)

    const [valuePass, setValuePass] = React.useState('');

    const [errPhone, setErrPhone] = React.useState('');

    const [errEmail, setErrEmail] = React.useState('');

    const [errPass, setErrPass] = React.useState(`Bỏ qua nếu bạn không muốn thay đổi.`);

    const [errRePass, setErrRePass] = React.useState('');

    const [newPass, setNewPass] = React.useState('');

    const [changePass, setChangePass] = React.useState(false);

    const [openLoadingSubmit, setOpenLoadingSubmit] = React.useState(false);

    const [userEdit, setUserEdit] = useRecoilState(UserEditState);

    const [userList, setUserList] = useRecoilState(userListState);

    const [statusUser, setStatusUser] = React.useState();

    const updateValueForForm = (object) => {
        Object.keys(object).forEach((key) => {
            if (key !== 'roles') {
                $(`#frmEditUser input[name="${key}"]`).val(object[key]).trigger("change")
            }
        });
    }
    React.useEffect(() => {
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
    }, []);

    React.useEffect(() => {
        if (userEdit.length < 1) {
            apiBase.get(`/users/${params.id}`).then(res => {
                if (res.data.status === 'success') {
                    setUserEdit(res.data.data)

                    const arrRoleIDTemp = res.data.data.roles.map(role => role.id);
                    setRoleID(arrRoleIDTemp);

                    setStatusUser(res.data.data.status);

                    updateValueForForm(res.data.data);
                }
            }).catch(err => {
                console.log('err: ', err)
            })
        } else {
            const arrRoleIDTemp = userEdit.roles.map(role => role.id);
            setRoleID(arrRoleIDTemp);

            setStatusUser(userEdit.status);
            updateValueForForm(userEdit)
        }



        axios.get('https://api.tiki.vn/directory/v1/countries/VN/regions/')
            .then(res => {
                setRegions(res.data.data);
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

    const onSubmitEditUser = (e) => {
        e.preventDefault()
        // console.log(roleID);
        const { name, gender, password, email, phone, address } = e.target.elements

        const formData = {
            name: name.value,
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

        if (preview.length > 0) {
            formData.avatar = preview;
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
        } else {
            setErrPhone('');
            setCheckSubmit(true)
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
        } else {
            setErrEmail('');
            setCheckSubmit(true)
        }
    }

    React.useEffect(() => {
        if (!changePass) {
            setErrPass(`Bỏ qua nếu bạn không muốn thay đổi.`);
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

    // GET REGION
    const handleChangeRegion = (e) => {
        setSelectRegion(e.target.value);

        setDistricts([]);
        setWards([]);

        setSelectDistrict(null);

        axios.get(`https://api.tiki.vn/directory/v1/countries/VN/regions/${e.target.value}/districts/`)
            .then(res => {
                setDistricts(res.data.data);
            }).catch(err => {
                console.log(`err: ${err}`);
            })
    }

    // GET DISTRICTS
    const handleChangeDistrict = (e) => {
        setSelectDistrict(e.target.value)
        setWards([]);

        axios.get(`https://api.tiki.vn/directory/v1/countries/VN/regions/${selectRegion}/districts/${e.target.value}/wards`)
            .then(res => {
                setWards(res.data.data);
            }).catch(err => {
                console.log(`err: ${err}`);
            })
    }

    const onBeforeFileLoad = (e) => {
        if (e.target.files[0].size > 1000 * 2000) {
            alert("Tệp quá lớn vui lòng tải tệp khác!");
            e.target.value = "";
        };
    }

    return (
        <Page title="User">

            <Container>
                <Stack direction="row" alignItems="center" justifyContent="space-between" mb={5}>
                    <Typography variant="h4" gutterBottom>
                        Chỉnh sửa người dùng
                    </Typography>
                    <Button variant="contained" component={RouterLink} to="../users" startIcon={<Iconify icon="topcoat:back" />}>
                        Danh sách người dùng
                    </Button>
                </Stack>

                <Box sx={{ flexGrow: 1 }}>
                    <form onSubmit={onSubmitEditUser} id="frmEditUser">
                        <Grid container spacing={4}>
                            <Grid item xs={4} >
                                <Grid item xs={12} mb={4}>
                                    {preview
                                        ?
                                        <Item sx={{ boxShadow: 4 }}>
                                            <Grid item xs={12} mb={3} mt={2} display="flex" justifyContent="center" alignItems="center">
                                                <img className="border-2 border-sky-500 rounded-full" style={{ minWidth: 150, maxWidth: 150 }} src={preview} alt="Avatar" />
                                            </Grid>
                                            <span id="upload-avatar">Loại file được phép:<br /> *.jpeg, *.jpg, *.png, *.gif</span>
                                            <Grid>
                                                <Typography mt={2} variant="h6">
                                                    Ảnh đại diện
                                                </Typography>
                                            </Grid>
                                        </Item>
                                        :
                                        <Item sx={{ boxShadow: 4 }}>
                                            <Grid item xs={12} mb={3} mt={2} display="flex" justifyContent="center" alignItems="center">
                                                <img className="border-2 border-sky-500 rounded-full" style={{ minWidth: 150, maxWidth: 150 }} src={userEdit.avatar ? userEdit.avatar : `${API_URL}/images/system/loading.gif`} alt="Avatar" />
                                            </Grid>
                                            <span id="upload-avatar">Loại file được phép:<br /> *.jpeg, *.jpg, *.png, *.gif</span>
                                            <Grid>
                                                <Typography mt={2} variant="h6">
                                                    Ảnh đại diện
                                                </Typography>
                                            </Grid>
                                        </Item>
                                    }
                                </Grid>

                                <Grid item xs={12} mt={preview ? 4 : 0}>
                                    <Item sx={{ boxShadow: 4 }} mt={3}>
                                        <Grid item xs={12} mb={3} mt={2} display="flex" justifyContent="center" alignItems="center">
                                            <AvatarEdit
                                                width={200}
                                                height={200}
                                                onCrop={(view) => setPreview(view)}
                                                onClose={() => setPreview(null)}
                                                onBeforeFileLoad={onBeforeFileLoad}
                                                src={srcAvatar}
                                            />
                                        </Grid>
                                        {preview ?
                                            <Grid>
                                                <Typography mt={2} variant="h6">
                                                    Chỉnh sửa ảnh
                                                </Typography>
                                            </Grid>
                                            :
                                            <Grid>
                                                <span id="upload-avatar">Loại file được phép:<br /> *.jpeg, *.jpg, *.png, *.gif</span>
                                                <Typography mt={2} variant="h6">
                                                    Ảnh đại diện
                                                </Typography>
                                            </Grid>
                                        }
                                    </Item>
                                </Grid>
                            </Grid>

                            <Grid item xs={8}>
                                <Item sx={{ boxShadow: 4 }}>


                                    {/* Full name & Gender */}
                                    <Grid container spacing={1}>
                                        <Grid item xs={6}>
                                            <Item>
                                                <TextField
                                                    variant="outlined"
                                                    margin="normal"
                                                    required
                                                    fullWidth
                                                    id="fullname"
                                                    label="Họ và tên"
                                                    name="name"
                                                    autoComplete="fullname"
                                                    defaultValue={` `}
                                                />
                                            </Item>
                                        </Grid>
                                        <Grid item xs={6}>
                                            <Item>
                                                <FormControl sx={{ mt: 2, width: '100%' }} required>
                                                    <InputLabel id="select-gender">Giới tính</InputLabel>
                                                    <Select
                                                        labelId="select-gender"
                                                        id="select-gender"
                                                        label="Giới tính"
                                                        name="gender"
                                                        defaultValue={userEdit.gender ? userEdit.gender : "Male"}
                                                    >
                                                        <MenuItem value={'Male'}>Male</MenuItem>
                                                        <MenuItem value={'Female'}>Female</MenuItem>
                                                    </Select>
                                                </FormControl>
                                            </Item>
                                        </Grid>
                                    </Grid>

                                    {/* Address */}
                                    <Grid container spacing={0}>
                                        <Grid item xs={4}>
                                            <Item>
                                                <FormControl sx={{ mt: 2, width: '100%' }}>
                                                    <InputLabel id="select-gender">Tỉnh / Thành phố</InputLabel>
                                                    <Select
                                                        labelId="select-gender"
                                                        id="select-gender"
                                                        label="Tỉnh / Thành phố"
                                                        onChange={handleChangeRegion}
                                                        defaultValue={`Tỉnh / Thành phố`}
                                                    >
                                                        <MenuItem value="Tỉnh / Thành phố" disabled >Tỉnh / Thành phố</MenuItem>
                                                        {regions.length > 0 ? regions.map((region) => (
                                                            <MenuItem
                                                                key={region.id}
                                                                value={region.id}
                                                                onClick={() => setAddress(region.name)}
                                                            >
                                                                {region.name}
                                                            </MenuItem>
                                                        ))
                                                            : <MenuItem >Đang tải...</MenuItem>
                                                        }
                                                    </Select>
                                                </FormControl>
                                            </Item>
                                        </Grid>
                                        <Grid item xs={4}>
                                            <Item>
                                                <FormControl sx={{ mt: 2, width: '100%' }}>
                                                    <InputLabel id="select-gender">Quận / Huyện</InputLabel>
                                                    <Select
                                                        labelId="select-gender"
                                                        id="select-gender"
                                                        label="Quận / Huyện"
                                                        onChange={handleChangeDistrict}
                                                        defaultValue={`Quận / Huyện`}
                                                    >
                                                        <MenuItem value="Quận / Huyện" disabled >Quận / Huyện</MenuItem>
                                                        {districts.length > 0 ? districts.map((district) => (
                                                            <MenuItem
                                                                key={district.id}
                                                                value={district.id}
                                                                onClick={() => setAddress(`${district.name}, ${address}`)}
                                                            >
                                                                {district.name}
                                                            </MenuItem>
                                                        ))
                                                            : <MenuItem >Đang tải...</MenuItem>
                                                        }
                                                    </Select>
                                                </FormControl>
                                            </Item>
                                        </Grid>
                                        <Grid item xs={4}>
                                            <Item>
                                                <FormControl sx={{ mt: 2, width: '100%' }}>
                                                    <InputLabel id="select-gender">Xã / Phường</InputLabel>
                                                    <Select
                                                        labelId="select-gender"
                                                        id="select-gender"
                                                        label="Xã / Phường"
                                                        defaultValue={`Xã / Phường`}
                                                    >
                                                        <MenuItem value="Xã / Phường" disabled >Xã / Phường</MenuItem>

                                                        {wards.length > 0 ? wards.map((ward) => (
                                                            <MenuItem
                                                                key={ward.id}
                                                                value={ward.id}
                                                                onClick={() => setAddress(`${ward.name}, ${address}`)}
                                                            >
                                                                {ward.name}
                                                            </MenuItem>
                                                        ))
                                                            : <MenuItem >Đang tải...</MenuItem>
                                                        }
                                                    </Select>
                                                </FormControl>
                                            </Item>
                                        </Grid>
                                    </Grid>
                                    <Grid container spacing={0}>
                                        <Grid item xs={12}>
                                            <Item>
                                                <TextField
                                                    variant="outlined"
                                                    margin="normal"
                                                    required
                                                    fullWidth
                                                    id="address"
                                                    label="Địa chỉ"
                                                    name="address"
                                                    value={address}
                                                    defaultValue={` `}
                                                    onChange={(e) => setAddress(e.target.value)}
                                                />
                                            </Item>
                                        </Grid>
                                    </Grid>

                                    {/* Role */}
                                    <Grid container spacing={1}>
                                        <Grid item xs={12}>
                                            <Item>
                                                <FormControl sx={{ mt: 1, width: '100%' }} required>
                                                    <InputLabel id="user-roles">Loại người dùng</InputLabel>
                                                    <Select
                                                        labelId="user-roles"
                                                        id="demo-multiple-chip"
                                                        multiple
                                                        required
                                                        value={roleID}
                                                        onChange={handleChange}
                                                        input={<OutlinedInput id="user-roles" label="Chip" />}
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
                                            </Item>
                                        </Grid>
                                    </Grid>

                                    {/* Phone & Email */}
                                    <Grid container spacing={1}>
                                        <Grid item xs={6}>
                                            <Item>
                                                <TextField
                                                    variant="outlined"
                                                    margin="normal"
                                                    required
                                                    fullWidth
                                                    id="phone"
                                                    label="Số điện thoại"
                                                    name="phone"
                                                    autoComplete="current-phone"
                                                    defaultValue={` `}
                                                    helperText={errPhone}
                                                    error={!(errPhone === '')}
                                                    onChange={(e) => checkPhoneField(e.target.value)}
                                                    inputProps={{
                                                        maxLength: 12,
                                                    }}
                                                />
                                            </Item>
                                        </Grid>
                                        <Grid item xs={6}>
                                            <Item>
                                                <TextField
                                                    variant="outlined"
                                                    margin="normal"
                                                    required
                                                    fullWidth
                                                    id="email"
                                                    label="Địa chỉ email"
                                                    name="email"
                                                    autoComplete="current-email"
                                                    defaultValue={` `}
                                                    helperText={errEmail}
                                                    error={!(errEmail === '')}
                                                    onChange={(e) => checkEmailField(e.target.value)}
                                                />
                                            </Item>
                                        </Grid>
                                    </Grid>

                                    {/* Password */}
                                    <Grid container spacing={1}>
                                        <Grid item xs={6}>
                                            <Item>
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
                                                    autoComplete="current-password"
                                                    helperText={errPass}
                                                    onChange={(e) => handleChangePass(e.target.value)}
                                                    error={(errPass !== '' && changePass)}
                                                />
                                            </Item>
                                        </Grid>
                                        <Grid item xs={6}>
                                            <Item>
                                                <TextField
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
                                            </Item>
                                        </Grid>
                                    </Grid>


                                    <Grid display="flex" justifyContent="flex-end" alignItems="center">
                                        <Button
                                            type="submit"
                                            fullWidth
                                            variant="contained"
                                            color="primary"
                                            sx={{ m: 3, pl: 2, pr: 2 }}
                                        >
                                            {openLoadingSubmit ? (
                                                <CircularProgress color="success" />
                                            ) : (
                                                'Lưu các thay đổi'
                                            )}

                                        </Button>
                                    </Grid>
                                </Item>
                            </Grid>
                        </Grid>
                    </form>
                </Box>
            </Container>
        </Page >
    );
}
