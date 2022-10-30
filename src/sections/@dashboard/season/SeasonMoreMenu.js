import { useRef, useState } from 'react';
import PropTypes from 'prop-types';
import Swal from 'sweetalert2';
import { useRecoilState, useSetRecoilState } from 'recoil';
// material
import { Divider, MenuItem, IconButton, } from '@mui/material';
import apiBase from '../../../app/axios/apiBase';
import {
  modelEdit,
  userListState,
  userListByTypeState,
  statusModelEditUserState,
} from '../../../app/recoil/store';

// component
import Iconify from '../../../components/Iconify';
import MenuPopover from '../../../components/MenuPopover';

// ----------------------------------------------------------------------

export default function SeasonMoreMenu({ userId, status, name, user }) {
  const [open, setOpen] = useState(false);

  const [anchorEl, setAnchorEl] = useState(null);

  const [userList, setUserList] = useRecoilState(userListState);

  const setUserListByType = useSetRecoilState(userListByTypeState);

  const setStatusModelEditUser = useSetRecoilState(statusModelEditUserState);

  const setModelEditUser = useSetRecoilState(modelEdit);

  const handleOpenMenu = (event) => {
    setOpen(true);
    setAnchorEl(event.currentTarget);
  };

  const handleCloseMenu = () => {
    setOpen(false);
  };

  const handleEdit = () => {
    handleCloseMenu();
    setStatusModelEditUser(true);
    setModelEditUser(user)
  };

  const handleDelete = () => {
    handleCloseMenu();
    Swal.fire({
      title: 'Delete?',
      html: `Do you want delete "${name}"`,
      showCancelButton: true,
      confirmButtonText: 'Delete',
      cancelButtonText: 'No, thanks!',
      icon: 'warning',
      confirmButtonColor: 'red',
    }).then((result) => {
      if (result.isConfirmed) {
        apiBase.delete(`/users/${userId}`,
          JSON.stringify({ value: 'Active' }))
          .then(res => {
            if (res.data.status === "success") {
              const arrTemp = JSON.parse(JSON.stringify(userList));

              const objIndex = arrTemp.findIndex((obj => obj.id === userId));

              if (objIndex > -1) {
                arrTemp.splice(objIndex, 1);
              }

              Swal.fire('Delete!', `"${name}" has been deleted`, 'success')

              setUserList(arrTemp)
              setUserListByType(arrTemp)
            }
          })
      }
    })
  };

  const handleActive = () => {
    handleCloseMenu();
    Swal.fire({
      title: 'Active?',
      html: 'Do you want change status to Active?',
      showCancelButton: true,
      confirmButtonText: 'Active',
      icon: 'question',
      confirmButtonColor: 'green',
    }).then((result) => {
      if (result.isConfirmed) {
        apiBase.post(`/users/update/${userId}/status`,
          JSON.stringify({ value: 'Active' }))
          .then(res => {
            if (res.data.status === "success") {
              const arrTemp = JSON.parse(JSON.stringify(userList));

              const objIndex = arrTemp.findIndex((obj => obj.id === userId));

              arrTemp[objIndex].status = "Active"

              Swal.fire('Active!', `"${name}" has changed status to Active`, 'success')

              setUserList(arrTemp)
              setUserListByType(arrTemp)
            }
          })
      }
    })
  };

  const handleInactive = () => {
    handleCloseMenu();
    Swal.fire({
      title: 'Inactive?',
      html: 'Do you want change status to Inactive?',
      showCancelButton: true,
      confirmButtonText: 'Inactive',
      icon: 'question',
      confirmButtonColor: 'red',
    }).then((result) => {
      if (result.isConfirmed) {
        apiBase.post(`/users/update/${userId}/status`,
          JSON.stringify({ value: 'Inactive' }))
          .then(res => {
            if (res.data.status === "success") {
              const arrTemp = JSON.parse(JSON.stringify(userList));

              const objIndex = arrTemp.findIndex((obj => obj.id === userId));

              arrTemp[objIndex].status = "Inactive"

              Swal.fire('Inactive!', `"${name}" has changed status to Inactive`, 'success')

              setUserList(arrTemp)
              setUserListByType(arrTemp)
            }
          })
      }
    })
  };

  return (
    <MoreMenuButton
      open={open}
      anchorEl={anchorEl}
      onClose={handleCloseMenu}
      onOpen={handleOpenMenu}
      actions={
        <>
          <MenuItem onClick={handleEdit}>
            <Iconify icon={'eva:edit-fill'} />
            Edit
          </MenuItem>

          {status === "Active" ? (
            <MenuItem onClick={handleInactive}>
              <Iconify icon={'material-symbols:change-circle-outline-rounded'} />
              Inactive
            </MenuItem>
          ) : (
            <MenuItem onClick={handleActive}>
              <Iconify icon={'material-symbols:change-circle-outline-rounded'} />
              Active
            </MenuItem>
          )}
          <Divider sx={{ borderStyle: 'dashed' }} />

          <MenuItem onClick={handleDelete} sx={{ color: 'error.main' }}>
            <Iconify icon={'eva:trash-2-outline'} />
            Delete
          </MenuItem>
        </>
      }
    />
  );
}
// =====================================================
MoreMenuButton.propTypes = {
  actions: PropTypes.node.isRequired,
  onClose: PropTypes.func,
  onOpen: PropTypes.func,
  open: PropTypes.bool,
};

function MoreMenuButton({ actions, open, onOpen, onClose, anchorEl }) {
  return (
    <>
      <IconButton size="large" color="inherit" sx={{ opacity: 0.48 }} onClick={onOpen}>
        <Iconify icon={'eva:more-vertical-fill'} width={20} height={20} />
      </IconButton>

      <MenuPopover
        open={Boolean(open)}
        anchorEl={anchorEl}
        onClose={onClose}
        anchorOrigin={{ vertical: 'top', horizontal: 'left' }}
        transformOrigin={{ vertical: 'top', horizontal: 'right' }}
        arrow="right-top"
        sx={{
          mt: -0.5,
          width: 'auto',
          '& .MuiMenuItem-root': {
            px: 1,
            typography: 'body2',
            borderRadius: 0.75,
            '& svg': { mr: 2, width: 20, height: 20 },
          },
        }}
      >
        {actions}
      </MenuPopover>
    </>
  );
}
