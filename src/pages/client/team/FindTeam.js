import React, { Fragment } from 'react'

import {
  Button,
  Container,
  Image,
  Form,
  Nav,
  Navbar,
  Row,
  Card,
  Col,
} from 'react-bootstrap';

const FindTeam = () => {
  return (
    <>
      <Navbar expand="lg" style={{ backgroundColor: "#fff" }}>
        <Form className="d-flex" style={{ paddingLeft: "100px" }}>
          <Form.Control type="search" placeholder="Search for (Name, Email, Phone)" className="me-2" aria-label="Search" style={{ width: "300px" }} />
          <Button variant="outline-primary">Search</Button>
        </Form>

        <Navbar.Collapse id="navbarScroll" style={{ marginLeft: "150px" }}>
          <Nav className="my-2 my-lg-0" style={{ maxHeight: '100px' }} navbarScroll>
            <Form.Select aria-label="Default select example" style={{ marginRight: "30px", width: "110px" }}>
              <option >Sort By</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </Form.Select >

            <Form.Select aria-label="Default select example" style={{ marginRight: "30px", width: "150px" }}>
              <option>Sport/Game</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </Form.Select>

            <Form.Select aria-label="Default select example" style={{ marginRight: "30px", width: "140px" }}>
              <option>Team Type</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </Form.Select>

            <Form.Select aria-label="Default select example" style={{ marginRight: "30px", width: "110px" }}>
              <option>Gender</option>
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
              <Row xs={1} md={4} className="text-center g-4">
                {Array.from({ length: 4 }).map((_, idx) => (
                  <Col>
                    <Card>
                      <Image roundedCircle variant="top" src="https://vcdn1-giaitri.vnecdn.net/2022/07/28/MinionsTheRiseofGuru-165900688-9080-3169-1659006963.png?w=1200&h=0&q=100&dpr=1&fit=crop&s=RNx84AcTg01LPr9Z6_3sKQ" className="team-img" />
                      <Card.Body>
                        <Card.Title>Team's Name</Card.Title>
                        <Card.Text className="team-info">
                          Team's Info
                        </Card.Text>
                        <div className="team-member">
                          <p className="mb-0">Members</p>
                          <div className="flex flex-justify-center">
                            <Image roundedCircle variant="top" src="https://vcdn1-giaitri.vnecdn.net/2022/07/28/MinionsTheRiseofGuru-165900688-9080-3169-1659006963.png?w=1200&h=0&q=100&dpr=1&fit=crop&s=RNx84AcTg01LPr9Z6_3sKQ" className="member-img" />
                          </div>
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

export default FindTeam