import { Navigate, useRoutes } from 'react-router-dom';
// layouts
import DashboardLayout from './layouts/dashboard';
import LogoOnlyLayout from './layouts/LogoOnlyLayout';
//

import * as Admin from './admin-link';
// ----------------------------------------------------------------------

export default function Router() {
  return useRoutes([
    {
      path: '/dashboard',
      element: <DashboardLayout />,
      children: [
        { path: 'app', element: <Admin.DashboardApp /> },
        { path: 'user', element: <Admin.User /> },
        { path: 'products', element: <Admin.Products /> },
        { path: 'blog', element: <Admin.Blog /> },
      ],
    },
    {
      path: 'login',
      element: <Admin.Login />,
    },
    {
      path: 'register',
      element: <Admin.Register />,
    },
    {
      path: '/',
      element: <LogoOnlyLayout />,
      children: [
        { path: '/', element: <Navigate to="/dashboard/app" /> },
        { path: '404', element: <Admin.NotFound /> },
        { path: '*', element: <Navigate to="/404" /> },
      ],
    },
    {
      path: '*',
      element: <Navigate to="/404" replace />,
    },
  ]);
}
