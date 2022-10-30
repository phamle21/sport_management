import React from 'react'

import {
  Form,
  FormLabel,
  ButtonGroup,
  Button,
  Row,
} from 'react-bootstrap';
import AvatarUploader from 'react-avatar-upload';

export default function CreateTour() {

  const [selectedBtn, setSelectedBtn] = React.useState(3);

  return (
    <div className="container container-fluid">
      <Row>
        <div className='col-md-10 col-md-offset-1'>
          <div className='panel'>
            <div className='panel-heading'>
              <div className='panel-title'>
                <h3>Create Tournament</h3>
              </div>
            </div>

            <div className='panel-body text-white'>
              <div className='col-md-8 col-md-offset-2'>
                <Form>
                  <div className='row'>
                    <div className='col-sm-4'>
                      <Form.Group>
                        <FormLabel>Tournament Logo</FormLabel>
                        <AvatarUploader
                          defaultImg="https://sunagro.com.tr/wp-content/uploads/2020/01/image-placeholder-350x350-1.png"
                          size={150}
                          name="asd"
                          uploadURL="http://localhost:3000"
                          fileType={"image"}
                        />
                      </Form.Group>
                    </div>

                    <div className="col-sm-8">
                      <Form.Group>
                        <FormLabel>Name</FormLabel>
                        <Form.Control type="text" name="name" placeholder="Name" />
                      </Form.Group>
                      <Form.Group>
                        <FormLabel>Location</FormLabel>
                        <Form.Control type="text" name="location" placeholder="Location" />
                      </Form.Group>
                    </div>

                  </div>

                  <Form.Group>
                    <FormLabel>Tournament Type</FormLabel>
                    <Row>
                      <div className='col-sm-8'>
                        {['radio'].map((type) => (
                          <div key={`inline-${type}`} className="mb-3">
                            <Form.Check
                              inline
                              label="Knockout (Elimination)"
                              name="group1"
                              type={type}
                              id={`inline-${type}-1`}

                            />
                            <Form.Check
                              inline
                              label="Rounds (Round robin)"
                              name="group1"
                              type={type}
                              id={`inline-${type}-2`}
                            />
                          </div>
                        ))}
                      </div>
                      <div className="col-sm-4">
                        {['radio'].map((type) => (
                          <div key={`inline-${type}`} className="mb-3">
                            <Form.Check
                              inline
                              label="Two Stages"
                              name="group1"
                              type={type}
                              id={`inline-${type}-3`}
                            />
                            <Form.Check
                              inline
                              label="Swiss System"
                              name="group1"
                              type={type}
                              id={`inline-${type}-4`}
                            />
                          </div>
                        ))}
                      </div>
                    </Row>

                  </Form.Group>

                  <Form.Group>
                    <FormLabel>Sport/Game</FormLabel>
                    <Form.Select aria-label="Default select example">
                      <option>Open this select menu</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </Form.Select>
                  </Form.Group>

                  <div className='row mt-3'>
                    <div className='col-sm-8'>
                      <Form.Group>
                        <FormLabel>Competitor Type</FormLabel>
                        <div>
                          {/* <div className='btn-group btn-group-justify btn-group-outline' style={{display:"flex"}}>

                            </div> */}

                          <ButtonGroup disableElevation variant="contained" className='btn-group-justify btn-group-outline'>
                            <Button
                              className={selectedBtn === 1 ? "btn-primary" : "btn-light"}
                              onClick={() => setSelectedBtn(1)}
                            >
                              Single
                            </Button>
                            <Button
                              className={selectedBtn === 2 ? "btn-primary" : "btn-light"}
                              onClick={() => setSelectedBtn(2)}
                            >
                              Double
                            </Button>
                            <Button
                              className={selectedBtn === 3 ? "btn-primary" : "btn-light"}
                              onClick={() => setSelectedBtn(3)}
                            >
                              Team
                            </Button>
                          </ButtonGroup>



                        </div>
                      </Form.Group>
                    </div>
                    <div className='col-sm-4'>
                      <Form.Group>
                        <FormLabel>Number of Team</FormLabel>
                        <Form.Control type="number" name="number" />
                      </Form.Group>
                    </div>
                  </div>
                </Form>
              </div>
            </div>

            <div className='panel-footer'>
              <div className='row'>
                <div className='col-md-8 col-md-offset-2'>
                  <button type="submit" className="btn btn-primary float-end">Create</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </Row>
    </div>

  )
}