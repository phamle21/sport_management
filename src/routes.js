import { Navigate, useRoutes, Outlet } from 'react-router-dom';

// layouts
import DashboardLayout from './layouts/dashboard';
import LogoOnlyLayout from './layouts/LogoOnlyLayout';
//

import * as Admin from './admin-link';
import * as Client from './client-link';

// ----------------------------------------------------------------------

const ClientRender = ({ component }) => {
  
  return (
    <>
      <Client.Header />
      {component}
      <Client.Footer />
    </>
  )
}

export default function Router() {
  return useRoutes([
    {
      path: '/admin',
      element: <LogoOnlyLayout />,
      children: [
        {
          path: 'dashboard',
          element: <DashboardLayout />,
          children: [
            { path: 'app', element: <Admin.DashboardApp /> },
            { path: 'users', element: <Admin.User /> },
            { path: 'users/create', element: <Admin.CreateUser /> },
            { path: 'users/:id/edit', element: <Admin.EditUser/> },
            { path: 'seasons', element: <Admin.Season /> },
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
          path: '',
          element: <LogoOnlyLayout />,
          children: [
            { path: '', element: <Navigate to="/admin/dashboard/app" /> },
            { path: '404', element: <Admin.NotFound /> },
            { path: '*', element: <Navigate to="/404" /> },
          ],
        },
      ]
    },
    // ====================== Client ===================
    {
      path: '/',
      element: <Outlet />,
      children: [
        {
          path: 'home',
          element: <ClientRender component={<Client.Home />} />
        },
        {
          path: 'create_tournament',
          element: <ClientRender component={<Client.CreateTour />} />
        },
        {
          path: 'find_tournament',
          element: <ClientRender component={<Client.FindTournament />} />
        },
        {
          path: 'find_team',
          element: <ClientRender component={<Client.FindTeam />} />
        },
        {
          path: 'register_team',
          element: <ClientRender component={<Client.CreateTeam />} />
        },
        { path: '', element: <Navigate to="/home" /> },
        { path: '*', element: <Navigate to="/404" /> },
      ],
    },


    { path: '404', element: <Admin.NotFound /> },
    {
      path: '*',
      element: <Navigate to="/404" replace />,
    },
  ]);
}
