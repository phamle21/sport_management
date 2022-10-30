// component
import Iconify from '../../components/Iconify';

// ----------------------------------------------------------------------

const getIcon = (name) => <Iconify icon={name} width={22} height={22} />;

const navConfig = [
  {
    title: 'Tổng quát',
    path: '/admin/dashboard/app',
    icon: getIcon('eva:pie-chart-2-fill'),
  },
  {
    title: 'Người dùng',
    path: '/admin/dashboard/users',
    icon: getIcon('eva:people-fill'),
  },
  {
    title: 'Mùa giải',
    path: '/admin/dashboard/seasons',
    icon: getIcon('fluent:sport-soccer-16-filled'),
  },
  {
    title: 'Giải đấu',
    path: '/admin/dashboard/leagues',
    icon: getIcon('fluent:sport-soccer-16-filled'),
  },
  {
    title: 'Trận đấu',
    path: '/admin/dashboard/matches',
    icon: getIcon('fluent:sport-soccer-16-filled'),
  },
  {
    title: 'Người chơi',
    path: '/admin/dashboard/players',
    icon: getIcon('fluent:sport-soccer-16-filled'),
  }
];

export default navConfig;
