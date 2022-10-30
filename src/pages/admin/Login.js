import React from 'react';
import { Link as RouterLink, useNavigate } from 'react-router-dom';
import { useRecoilValue } from 'recoil';
// @mui
import { styled } from '@mui/material/styles';
import { Card, Link, Container, Typography } from '@mui/material';
// Sweet Alert 2
import Swal from 'sweetalert2';
// Store
import { tokenState } from '../../app/recoil/store';
// hooks
import useResponsive from '../../hooks/useResponsive';
// components
import Page from '../../components/Page';
import Logo from '../../components/Logo';
// sections
import { LoginForm } from '../../sections/auth/login';
import AuthSocial from '../../sections/auth/AuthSocial';

// ----------------------------------------------------------------------

const RootStyle = styled('div')(({ theme }) => ({
  [theme.breakpoints.up('md')]: {
    display: 'flex',
  },
}));

const HeaderStyle = styled('header')(({ theme }) => ({
  top: 0,
  zIndex: 9,
  lineHeight: 0,
  width: '100%',
  display: 'flex',
  alignItems: 'center',
  position: 'absolute',
  padding: theme.spacing(3),
  justifyContent: 'space-between',
  [theme.breakpoints.up('md')]: {
    alignItems: 'flex-start',
    padding: theme.spacing(7, 5, 0, 7),
  },
}));

const SectionStyle = styled(Card)(({ theme }) => ({
  width: '100%',
  maxWidth: 464,
  display: 'flex',
  flexDirection: 'column',
  justifyContent: 'center',
  margin: theme.spacing(2, 0, 2, 2),
}));

const ContentStyle = styled('div')(({ theme }) => ({
  maxWidth: 480,
  margin: 'auto',
  minHeight: '100vh',
  display: 'flex',
  justifyContent: 'center',
  flexDirection: 'column',
  padding: theme.spacing(12, 0),
}));

// ----------------------------------------------------------------------

export default function Login() {

  const navigate = useNavigate();

  const smUp = useResponsive('up', 'sm');

  const mdUp = useResponsive('up', 'md');

  const token = localStorage.getItem('accessToken_STM');

  React.useEffect(() => {
    if (token) {
      navigate('/admin', { replace: true });
      Swal.fire(
        'You are currently logged in',
        '',
        'warning'
      )
    }
  }, []);

  return (
    <Page title="Login">
      <RootStyle>
        <HeaderStyle>
          <Logo />

        </HeaderStyle>

        {mdUp && (
          <SectionStyle>
            <Typography variant="h3" sx={{ px: 5, mt: 10, mb: 5 }}>
              Chào mừng bạn đến với trang của Quản Trị Viên
            </Typography>
            <img src="/static/illustrations/illustration_login.png" alt="login" />
          </SectionStyle>
        )}

        <Container maxWidth="sm">
          <ContentStyle>
            <Typography variant="h4" gutterBottom>
              Đăng nhập
            </Typography>

            <Typography sx={{ color: 'text.secondary', mb: 5 }}>Vui lòng nhập thông tin đăng nhập bên dưới.</Typography>

            {/* <AuthSocial /> */}

            <LoginForm />

          </ContentStyle>
        </Container>
      </RootStyle>
    </Page>
  );
}
