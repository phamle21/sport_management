import PropTypes from 'prop-types';
// material
import { Paper, Typography } from '@mui/material';
import Iconify from './Iconify';

// ----------------------------------------------------------------------

SearchNotFound.propTypes = {
  searchQuery: PropTypes.string,
};

export default function SearchNotFound({ searchQuery = '', ...other }) {
  return (
    <Paper {...other}>
      <Typography gutterBottom display="flex" justifyContent="center" alignItems="center" variant="subtitle1">
        <Iconify icon="tabler:face-id-error" sx={{color: 'red' , width: 50, height: 50 }} />
      </Typography>
      <Typography variant="body2" align="center">
        Xin lỗi, chúng tôi không tìm thấy dữ liệu nào với từ khóa "<b>{searchQuery}</b>".
      </Typography>
    </Paper>
  );
}
