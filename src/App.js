// Recoil
import { RecoilRoot } from 'recoil';
// routes
import Router from './routes';
// theme
import ThemeProvider from './theme';
// components
import ScrollToTop from './components/ScrollToTop';
import { BaseOptionChartStyle } from './components/chart/BaseOptionChart';
import './App.css';
// ----------------------------------------------------------------------

export default function App() {
  return (
    <RecoilRoot>
      <ThemeProvider>
        <ScrollToTop />
        <BaseOptionChartStyle />
        <Router />
      </ThemeProvider>
    </RecoilRoot>
  );
}
