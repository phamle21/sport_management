import React, { useCallback, useRef, useState } from 'react'

import { Container, Row } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { LoginSocialGoogle, LoginSocialFacebook } from "reactjs-social-login";
import FacebookRegisterButton from '../../../layouts/client/FacebookRegisterButton';
import GoogleRegisterButton from '../../../layouts/client/GoogleRegisterButton';

const Register = () => {

  const REDIRECT_URI = "http://localhost:3000/register";

  const [provider, setProvider] = useState("");
  const [profile, setProfile] = useState();
  const googleRef = useRef();
  const facebookRef = useRef();

  const onLoginStart = useCallback(() => {
    alert("login start");
  }, []);

  const onLogoutFailure = useCallback(() => {
    alert("logout fail");
  }, []);

  const onLogoutSuccess = useCallback(() => {
    setProfile(null);
    setProvider("");
    alert("logout success");
  }, []);

  return (
    <>
      <Container>
        <Row>
          <div className="col-md-8 col-md-offset-2">
            <div className="panel">
              <div className='panel-heading'>
                <div className='panel-title'>
                  <h3>Register</h3>
                </div>
              </div>

              <div className='panel-body'>
                <div className='col-md-10 col-md-offset-1'>

                  <div className="social-login mb-3">
                    <LoginSocialFacebook
                      refs={facebookRef}
                      appId={"431451242017946"}
                      onLoginStart={onLoginStart}
                      onLogoutSuccess={onLogoutSuccess}
                      onResolve={({ provider, data }) => {
                        setProvider(provider);
                        setProfile(data);
                        console.log(data, "data");
                        console.log(provider, "provider");
                      }}
                      onReject={(err) => {
                        console.log(err);
                      }}
                    >
                      <FacebookRegisterButton />
                    </LoginSocialFacebook>

                    <LoginSocialGoogle
                      refs={googleRef}
                      client_id="1024616921919-hns9m0q39jb21qrp4kpb57kti2sd5t1n.apps.googleusercontent.com"
                      onLogoutFailure={onLogoutFailure}
                      onLoginStart={onLoginStart}
                      onLogoutSuccess={onLogoutSuccess}
                      onResolve={({ provider, data }) => {
                        setProvider(provider);
                        setProfile(data);
                        console.log(data, "data");
                        console.log(provider, "provider");
                      }}
                      onReject={(err) => {
                        console.log("hbhbdhd", err);
                      }}
                    >
                      <GoogleRegisterButton />
                    </LoginSocialGoogle>
                  </div>

                  <form>
                    <div className="mb-3">
                      {/* <label htmlFor="email-login" className="form-label text-white">Email address</label> */}
                      <input type="email" className="form-control" id="email-login" placeholder='Email address' />
                    </div>
                    <div className="mb-3">
                      {/* <label htmlFor="pass-login" className="form-label text-white">Password</label> */}
                      <input type="password" className="form-control" id="pass-login" placeholder='Password' />
                    </div>
                    <div className='text-right'>
                      <Link to="/register" className='login-link'>Have an account? Login</Link>
                    </div>
                  </form>
                </div>
              </div>

              <div className="panel-footer">
                <div className='row'>
                  <div className='col-md-10 col-md-offset-1'>
                    <button type="submit" className="btn btn-primary btn-block">Register</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Row>
      </Container>
    </>
  )
}

export default Register