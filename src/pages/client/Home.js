import React from "react";
import { Link as RouterLink } from 'react-router-dom';
import { Button } from '@mui/material';

const Home = () => {
    return (
        <main id="Home" className="vh-100">
            <Button to="/admin" size="large" variant="contained" component={RouterLink}>
                Go to Admin Page
            </Button>
        </main>
    )
}

export default Home;