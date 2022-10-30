import React from 'react';
import { Outlet, useNavigate } from 'react-router-dom';
import { useRecoilValue, useSetRecoilState } from 'recoil';
import Swal from 'sweetalert2';
import axios from 'axios';
// material
import { styled } from '@mui/material/styles';
// components
import Logo from '../components/Logo';
import { accountState } from '../app/recoil/store';
import { API_URL } from "../constant/api_constant";

// ----------------------------------------------------------------------

const HeaderStyle = styled('header')(({ theme }) => ({
  top: 0,
  left: 0,
  lineHeight: 0,
  width: '100%',
  position: 'absolute',
  padding: theme.spacing(3, 3, 0),
  [theme.breakpoints.up('sm')]: {
    padding: theme.spacing(5, 5, 0),
  },
}));

// ----------------------------------------------------------------------

export default function LogoOnlyLayout() {
  const navigate = useNavigate();

  const account = useRecoilValue(accountState);

  const urlAdminLogin = `${window.location.origin}/admin/login`;

  const setAccount = useSetRecoilState(accountState);

  const token = localStorage.getItem('accessToken_STM');

  React.useEffect(() => {
    // Check login
    if (window.location.href !== urlAdminLogin) {
      if (token === null) {
        localStorage.removeItem('accessToken_STM');
        setAccount(null)
        navigate('/admin/login', { replace: true });
      } else {
        axios.post(`${API_URL}/api/me`, '', {
          headers: {
            "Accept": 'application/json',
            "Content-Type": 'application/json',
            "Authorization": `Bearer ${token}`
          }
        }).then(res => {

          if (res.data.status === 'expired') {
            Swal.fire('Error!', res.data.msg, 'error');
            localStorage.removeItem('accessToken_STM');
            navigate('/admin/login', { replace: true });
          } else {
            setAccount(res.data.data);
          }

        }).catch(err => {
          if (err.response.statusText === "Unauthorized") {
            Swal.fire('Error!', 'Phiên đăng nhập của bạn hết hạn, vui lòng đăng nhập lại!', 'error');
            localStorage.removeItem('accessToken_STM');
            navigate('/admin/login', { replace: true });
          }
        })
      }
    }
  }, [])

  return (
    <>
      <HeaderStyle>
        <Logo />
      </HeaderStyle>
      <Outlet />
    </>
  );
}
