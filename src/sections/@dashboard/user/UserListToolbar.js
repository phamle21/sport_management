import React from 'react';
import PropTypes from 'prop-types';
import { useRecoilValue, useSetRecoilState } from 'recoil';

// material
import { styled } from '@mui/material/styles';
import {
  Menu,
  Toolbar,
  Tooltip,
  MenuItem,
  Typography,
  IconButton,
  ListItemText,
  ListItemIcon,
  OutlinedInput,
  InputAdornment,
  CircularProgress,
} from '@mui/material';

import Swal from 'sweetalert2';
import { userListType, roleState, selectedUserState } from '../../../app/recoil/store';
// component
import Iconify from '../../../components/Iconify';
import apiBase from '../../../app/axios/apiBase';

// ----------------------------------------------------------------------

const RootStyle = styled(Toolbar)(({ theme }) => ({
  height: 96,
  display: 'flex',
  justifyContent: 'space-between',
  padding: theme.spacing(0, 1, 0, 3),
}));

const SearchStyle = styled(OutlinedInput)(({ theme }) => ({
  width: 240,
  transition: theme.transitions.create(['box-shadow', 'width'], {
    easing: theme.transitions.easing.easeInOut,
    duration: theme.transitions.duration.shorter,
  }),
  '&.Mui-focused': { width: 320, boxShadow: theme.customShadows.z8 },
  '& fieldset': {
    borderWidth: `1px !important`,
    borderColor: `${theme.palette.grey[500_32]} !important`,
  },
}));

// ----------------------------------------------------------------------

UserListToolbar.propTypes = {
  numSelected: PropTypes.number,
  filterName: PropTypes.string,
  onFilterName: PropTypes.func,
};

export default function UserListToolbar({ numSelected, filterName, onFilterName }) {
  const ref = React.useRef(null);

  const [isOpen, setIsOpen] = React.useState(false);

  const setUserType = useSetRecoilState(userListType);

  const roles = useRecoilValue(roleState);

  const selectedUser = useRecoilValue(selectedUserState);

  const handleFilterRole = (type) => {
    setUserType(type);
  }

  const handleDeteleUserList = () => {
    Swal.fire({
      title: 'Xóa tất cả?',
      html: 'Bạn có chắc muốn xóa tất cả mục được chọn?',
      showCancelButton: true,
      confirmButtonText: 'Xóa',
      cancelButtonText: 'Không, cảm ơn!',
      icon: 'warning',
      confirmButtonColor: 'red',
    }).then((result) => {
      if (result.isConfirmed) {
        apiBase.post(`/users/delete-all`,
          JSON.stringify({ user_id_list: selectedUser }))
          .then(res => {
            if (res.data.status === "success") {
              console.log(res.data);
            }
          })
      }
    })
  }

  return (
    <RootStyle
      sx={{
        ...(numSelected > 0 && {
          color: 'primary.main',
          bgcolor: 'primary.lighter',
        }),
      }}
    >
      {numSelected > 0 ? (
        <Typography component="div" variant="subtitle1">
          {numSelected} mục được chọn
        </Typography>
      ) : (
        <SearchStyle
          value={filterName}
          onChange={onFilterName}
          placeholder="Tìm kiếm người dùng..."
          startAdornment={
            <InputAdornment position="start">
              <Iconify icon="eva:search-fill" sx={{ color: 'text.disabled', width: 20, height: 20 }} />
            </InputAdornment>
          }
        />
      )}

      {numSelected > 0 ? (
        <Tooltip title="Xóa">
          <IconButton onClick={handleDeteleUserList}>
            <Iconify icon="eva:trash-2-fill" />
          </IconButton>
        </Tooltip>
      ) : (
        <>
          <Tooltip onClick={() => setIsOpen(true)} title="Filter list">
            <IconButton ref={ref}>
              <Iconify icon="ic:round-filter-list" />
            </IconButton>
          </Tooltip>

          <Menu
            open={isOpen}
            anchorEl={ref.current}
            onClose={() => setIsOpen(false)}
            PaperProps={{
              sx: { width: 200, maxWidth: '100%' },
            }}
            anchorOrigin={{ vertical: 'top', horizontal: 'right' }}
            transformOrigin={{ vertical: 'top', horizontal: 'right' }}

          >
            <Typography sx={{ m: 1, ml: 1.5 }} component="h6" variant="subtitle1">
              Lọc theo loại 
            </Typography>

            {
              roles.length > 0
                ?
                (<div>
                  <MenuItem sx={{ color: 'text.secondary' }}>
                    <ListItemIcon>
                      <Iconify icon="carbon:user-role" width={24} height={24} />
                    </ListItemIcon>
                    <ListItemText onClick={() => handleFilterRole('All')} primary={'All'} primaryTypographyProps={{ variant: 'body2' }} />
                  </MenuItem>
                  {
                    roles.map(role => (
                      <MenuItem key={role.id} sx={{ color: 'text.secondary' }}>
                        <ListItemIcon>
                          <Iconify icon="carbon:user-role" width={24} height={24} />
                        </ListItemIcon>
                        <ListItemText onClick={() => handleFilterRole(role.name)} primary={role.name} primaryTypographyProps={{ variant: 'body2' }} />
                      </MenuItem>
                    ))
                  }
                </div>

                )
                :
                <Typography sx={{ m: 1, ml: 1.5 }} component="h6">
                  <CircularProgress />
                </Typography>

            }

          </Menu>
        </>

      )}
    </RootStyle>
  );
}
