import React, { useCallback, useRef, useState } from 'react'

import { Container, Row } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { FacebookLoginButton, GoogleLoginButton } from "react-social-login-buttons";
import { LoginSocialGoogle, LoginSocialFacebook } from "reactjs-social-login";

const Login = () => {

  const REDIRECT_URI = "http://localhost:3000/login";

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
                  <h3>Login</h3>
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
                      <FacebookLoginButton />
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
                      <GoogleLoginButton />
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
                    <Row style={{ textAlign: "center" }}>
                      <div className='col-md-4'>
                        <div className="mb-3 form-check">
                          <input type="checkbox" className="form-check-input" id="input-login" />
                          {/* <label htmlFor="input-login" className="form-check-label text-white">Remember me</label> */}
                        </div>
                      </div>
                      <div className='col-md-4'>
                        <Link to="/register" className='login-link'>Register</Link>
                      </div>
                      <div className='col-md-4' >
                        <Link to="/password/forgot" className='login-link'>Forgot Password?</Link>
                      </div>
                    </Row>
                  </form>
                </div>
              </div>

              <div className="panel-footer">
                <div className='row'>
                  <div className='col-md-10 col-md-offset-1'>
                    <button type="submit" className="btn btn-primary btn-block">Login</button>
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

export default Login