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
import { userListType, roleState, selectedSeasonState } from '../../../app/recoil/store';
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

SeasonListToolbar.propTypes = {
  numSelected: PropTypes.number,
  filterName: PropTypes.string,
  onFilterName: PropTypes.func,
};

export default function SeasonListToolbar({ numSelected, filterName, onFilterName }) {
  const ref = React.useRef(null);

  const [isOpen, setIsOpen] = React.useState(false);

  const setUserType = useSetRecoilState(userListType);

  const roles = useRecoilValue(roleState);

  const selectedSeason = useRecoilValue(selectedSeasonState);

  const handleFilterRole = (type) => {
    setUserType(type);
  }

  const handleDeteleUserList = () => {
    Swal.fire({
      title: 'Delete all?',
      html: 'Are you sure you want to delete the select season?',
      showCancelButton: true,
      confirmButtonText: 'Delete all',
      cancelButtonText: 'No, thanks!',
      icon: 'warning',
      confirmButtonColor: 'red',
    }).then((result) => {
      if (result.isConfirmed) {
        apiBase.post(`/seasons/delete-all`,
          JSON.stringify({ season_id_list: selectedSeason }))
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
          {numSelected} selected
        </Typography>
      ) : (
        <SearchStyle
          value={filterName}
          onChange={onFilterName}
          placeholder="Search season..."
          startAdornment={
            <InputAdornment position="start">
              <Iconify icon="eva:search-fill" sx={{ color: 'text.disabled', width: 20, height: 20 }} />
            </InputAdornment>
          }
        />
      )}

      {numSelected > 0 ? (
        <Tooltip title="Delete">
          <IconButton onClick={handleDeteleUserList}>
            <Iconify icon="eva:trash-2-fill" />
          </IconButton>
        </Tooltip>
      ) : (
        <>
        </>

      )}
    </RootStyle>
  );
}
