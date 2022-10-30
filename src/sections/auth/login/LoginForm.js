import * as Yup from 'yup';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useSetRecoilState } from 'recoil';
// form
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
// @mui
import { Link, Stack, IconButton, InputAdornment } from '@mui/material';
import { LoadingButton } from '@mui/lab';
// components
import LoadingScreen from "react-loading-screen";
import Swal from 'sweetalert2';
import Iconify from '../../../components/Iconify';
import { FormProvider, RHFTextField, RHFCheckbox } from '../../../components/hook-form';
import apiBase from '../../../app/axios/apiBase';
import spinner from '../../../assets/system/loading.gif';
import { accountState, tokenState } from '../../../app/recoil/store';
// ----------------------------------------------------------------------

export default function LoginForm() {
  const navigate = useNavigate();

  const [showPassword, setShowPassword] = useState(false);

  const LoginSchema = Yup.object().shape({
    username: Yup.string().required('Email/Phone number is required'),
    password: Yup.string().required('Password is required'),
  });

  const defaultValues = {
    username: '',
    password: '',
    remember: true,
  };

  const methods = useForm({
    resolver: yupResolver(LoginSchema),
    defaultValues,
  });

  const {
    handleSubmit,
    formState: { isSubmitting },
  } = methods;

  const [isLoading, setIsLoading] = useState(false);

  const setAccount = useSetRecoilState(accountState);
  const setToken = useSetRecoilState(tokenState);

  const onSubmit = async () => {
    console.clear()

    localStorage.removeItem('accessToken_STM')

    console.disableYellowBox = true;

    setIsLoading(true);

    let formData = {};

    if (methods.getValues().username.includes("@")) {
      formData = {
        email: methods.getValues().username,
        password: methods.getValues().password,
        remember: methods.getValues().remember
      }
    } else {
      formData = {
        phone: methods.getValues().username,
        password: methods.getValues().password,
        remember: methods.getValues().remember
      }
    }
    
    apiBase.post('/login', JSON.stringify(formData))
      .then(res => {
        if (res.data.status === "error") {
          Swal.fire(
            'Error',
            res.data.message,
            'error'
          )
        } else {
          // Set token
          localStorage.setItem('accessToken_STM', res.data.authorisation.token)
          setToken(res.data.authorisation.token);
          // Set data User 
          setAccount(res.data.user);
          // Direct 
          navigate('/admin', { replace: true });
        }
        setIsLoading(false);
      })
      .catch(err => {
        console.log(err);
        Swal.fire(
          'Error',
          'Xin lỗi, hệ thông đang xảy ra sự cố, vui lòng quay lại sau ít phút',
          'error'
        )
        setIsLoading(false);
      });
  };
  
  return (
    <>
      <FormProvider methods={methods} onSubmit={handleSubmit(onSubmit)}>
        <Stack spacing={3}>

          <RHFTextField name="username" label="Địa chỉ Email / Số điện thoại" />

          <RHFTextField
            name="password"
            label="Mật khẩu"
            type={showPassword ? 'text' : 'password'}
            InputProps={{
              endAdornment: (
                <InputAdornment position="end">
                  <IconButton onClick={() => setShowPassword(!showPassword)} edge="end">
                    <Iconify icon={showPassword ? 'eva:eye-fill' : 'eva:eye-off-fill'} />
                  </IconButton>
                </InputAdornment>
              ),
            }}
          />
        </Stack>

        <Stack direction="row" alignItems="center" justifyContent="space-between" sx={{ my: 2 }}>
          <RHFCheckbox name="remember" label="Ghi nhớ đăng nhập" />
          <Link variant="subtitle2" underline="hover">
            Quên mật khẩu ?
          </Link>
        </Stack>

        <LoadingButton fullWidth size="large" type="submit" variant="contained" loading={isLoading}>
          Đăng nhập
        </LoadingButton>
      </FormProvider>
    </>
  );
}
