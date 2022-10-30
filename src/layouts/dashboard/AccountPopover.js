import React, { useRef, useState } from 'react';
import { Link as RouterLink } from 'react-router-dom';
import { useRecoilValue, useResetRecoilState } from 'recoil';
import Swal from 'sweetalert2';
// @mui
import { alpha } from '@mui/material/styles';
import { Box, Divider, Typography, Stack, MenuItem, Avatar, IconButton } from '@mui/material';
// components
import MenuPopover from '../../components/MenuPopover';

import { API_URL } from "../../constant/api_constant";

import { accountState } from '../../app/recoil/store';

// ----------------------------------------------------------------------

const MENU_OPTIONS = [
  {
    label: 'Hồ sơ cá nhân',
    icon: 'eva:person-fill',
    linkTo: '#',
  },
];

// ----------------------------------------------------------------------

export default function AccountPopover() {

  const anchorRef = useRef(null);

  const [open, setOpen] = useState(null);

  const resetAccountState = useResetRecoilState(accountState);
  const handleOpen = (event) => {
    setOpen(event.currentTarget);
  };

  const handleClose = () => {
    setOpen(null);
  };

  const handleLogout = () => {
    Swal.fire({
      title: 'Bạn chắc chứ?',
      text: "Bạn muốn đăng xuất?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Đăng xuất!',
      cancelButtonText: 'Hủy',
    }).then((result) => {
      if (result.isConfirmed) {
        localStorage.removeItem('accessToken_STM');
        resetAccountState();
        window.location.href = `${window.location.origin}/admin/login`;
      }
    })

    handleClose();
  }

  const account = useRecoilValue(accountState);

  return (
    <>
      <IconButton
        ref={anchorRef}
        onClick={handleOpen}
        sx={{
          p: 0,
          ...(open && {
            '&:before': {
              zIndex: 1,
              content: "''",
              width: '100%',
              height: '100%',
              borderRadius: '50%',
              position: 'absolute',
              bgcolor: (theme) => alpha(theme.palette.grey[900], 0.8),
            },
          }),
        }}
      >
        <Avatar src={account.avatar} alt="photoURL" />
      </IconButton>

      <MenuPopover
        open={Boolean(open)}
        anchorEl={open}
        onClose={handleClose}
        sx={{
          p: 0,
          mt: 1.5,
          ml: 0.75,
          '& .MuiMenuItem-root': {
            typography: 'body2',
            borderRadius: 0.75,
          },
        }}
      >
        <Box sx={{ my: 1.5, px: 2.5 }}>
          <Typography variant="subtitle2" noWrap>
            {account.name}
          </Typography>
          <Typography variant="body2" sx={{ color: 'text.secondary' }} noWrap>
            {account.email}
          </Typography>
        </Box>

        <Divider sx={{ borderStyle: 'dashed' }} />

        <Stack sx={{ p: 1 }}>
          {MENU_OPTIONS.map((option) => (
            <MenuItem key={option.label} to={option.linkTo} component={RouterLink} onClick={handleClose}>
              {option.label}
            </MenuItem>
          ))}
        </Stack>

        <Divider sx={{ borderStyle: 'dashed' }} />

        <MenuItem onClick={handleLogout} sx={{ m: 1 }}>
          Đăng xuất
        </MenuItem>
      </MenuPopover>
    </>
  );
}
