import React from 'react';
// material
import { Stack, Button, Divider, Typography } from '@mui/material';
import FacebookLogin from 'react-facebook-login';
// component
import Iconify from '../../components/Iconify';
// ----------------------------------------------------------------------

const responseFacebook = (response) => {
  console.log(response);
}

export default function AuthSocial() {
  const [test, setTest] = React.useState();
  const handleLoginFB = (event) => {
    event.preventDefault()
  }

  return (
    <>
      <Stack direction="row" spacing={2}>
        <Button fullWidth size="large" color="inherit" variant="outlined">
          <Iconify icon="eva:google-fill" color="#DF3E30" width={22} height={22} />
        </Button>

        <FacebookLogin
          appId="510862077526031"
          // autoLoad={true}
          fields="name,email,picture"
          callback={responseFacebook}
        />

        <Button fullWidth size="large" color="inherit" variant="outlined" onClick={handleLoginFB}>
          <Iconify icon="eva:facebook-fill" color="#1877F2" width={22} height={22} />
        </Button>
      </Stack>

      <Divider sx={{ my: 3 }}>
        <Typography variant="body2" sx={{ color: 'text.secondary' }}>
          OR
        </Typography>
      </Divider>
    </>
  );
}
