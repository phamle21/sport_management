import React, { Fragment } from 'react'

import {
  Button,
  Container,
  Image,
  Form,
  Nav,
  Navbar,
  ProgressBar,
  Row,
  Card,
  Col,
} from 'react-bootstrap';

const FindTour = () => {
  return (
    <>
      <Navbar expand="lg" style={{ backgroundColor: "#fff" }}>
        <Form className="d-flex" style={{ paddingLeft: "150px" }}>
          <Form.Control type="search" placeholder="Search" className="me-2" aria-label="Search" />
          <Button variant="outline-primary">Search</Button>
        </Form>

        <Navbar.Collapse id="navbarScroll" style={{ marginLeft: "300px" }}>
          <Nav className="my-2 my-lg-0" style={{ maxHeight: '100px' }} navbarScroll>
            <Form.Select aria-label="Default select example" style={{ marginRight: "50px", width: "150px" }}>
              <option >Game type</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </Form.Select >

            <Form.Select aria-label="Default select example" style={{ marginRight: "50px", width: "110px" }}>
              <option>Status</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </Form.Select>

            <Form.Select aria-label="Default select example" style={{ marginRight: "50px", width: "160px" }}>
              <option>Last update</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </Form.Select>
          </Nav>
        </Navbar.Collapse>
      </Navbar>

      <Container className='mt-4'>
        <Row>
          <div className='col-xs-12'>
            <Row>
              <div className="col-md-12">
                <div className="flex flex-justify-between flex-align-center mb-20">
                  <h6>123 Leagues</h6>

                </div>
              </div>
            </Row>
            <div className="section-content">
              <Row xs={1} md={3} className="text-center g-4">
                {Array.from({ length: 3 }).map((_, idx) => (
                  <Col>
                    <Card>
                      <Image roundedCircle variant="top" src="https://vcdn1-giaitri.vnecdn.net/2022/07/28/MinionsTheRiseofGuru-165900688-9080-3169-1659006963.png?w=1200&h=0&q=100&dpr=1&fit=crop&s=RNx84AcTg01LPr9Z6_3sKQ" className="league-img" />
                      <Card.Body>
                        <Card.Title>League's Name</Card.Title>
                        <Card.Text>
                          League's Info
                        </Card.Text>
                        <div className="league-status">
                          <span className="float-left">
                            <i className='fa fa-user'/>
                            <span>11</span>
                          </span>
                          <span className="float-end">
                            <i className='fa fa-eye'/>
                            <span>110</span>
                          </span>
                        </div>

                        <div className='league-progress'>
                          <ProgressBar now={50} />

                        </div>
                      </Card.Body>
                    </Card>
                  </Col>
                ))}
              </Row>
            </div>
          </div>
        </Row>
      </Container>

    </>
  )
}

export default FindTour