import React, { useState } from 'react'

import { Form, FormLabel, Row } from 'react-bootstrap';
import AvatarUploader from 'react-avatar-upload';



const CreateTeam = () => {

  const [images, setImages] = useState([]);
  const [imagesPreview, setImagesPreview] = useState([]);


  const onChange = e => {

    const files = Array.from(e.target.files)

    setImagesPreview([]);
    setImages([])

    files.forEach(file => {
      const reader = new FileReader();

      reader.onload = () => {
        if (reader.readyState === 2) {
          setImagesPreview(oldArray => [...oldArray, reader.result])
          setImages(oldArray => [...oldArray, reader.result])
        }
      }

      reader.readAsDataURL(file)
    })
  }

  return (
    <div className="container container-fluid">
      <Row>
        <div className='col-md-10 col-md-offset-1'>
          <div className='panel text-white'>
            <div className='panel-heading'>
              <div className='panel-title'>
                <h3>Create Team</h3>
              </div>
            </div>

            <div className='panel-body'>
              <div className='col-md-8 col-md-offset-2'>
                <Form>
                  <Row>
                    <div className='col-sm-4'>
                      <Form.Group>
                        <FormLabel>Tournament Logo</FormLabel>
                        <AvatarUploader
                          defaultImg="https://ss-images.saostar.vn/w800/2020/02/03/6918023/untitled-ininity.jpg"
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

                  </Row>

                  <Row>
                    <div className="col-sm-6 mb-3">
                      <Form.Group className="mb-3">
                        <FormLabel>Sport/Game</FormLabel>
                        <Form.Select aria-label="Default select example">
                          <option>Open this select menu</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </Form.Select>
                      </Form.Group>

                      <Form.Group className="mb-3">
                        <FormLabel>Sport/Game</FormLabel>
                        <Form.Select aria-label="Default select example">
                          <option>Open this select menu</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </Form.Select>
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
                    </div>

                    <div className="col-sm-6 mb-3">
                      <Form.Group className="mb-3">
                        <FormLabel>Sport/Game</FormLabel>
                        <Form.Select aria-label="Default select example">
                          <option>Open this select menu</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </Form.Select>
                      </Form.Group>

                      <Form.Group >
                        <FormLabel>Sport/Game</FormLabel>
                        <Form.Select aria-label="Default select example">
                          <option>Open this select menu</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </Form.Select>
                      </Form.Group>
                    </div>
                  </Row>


                  <Form.Group controlId="formFileMultiple" className="mb-3">
                    <Form.Label>Uniform</Form.Label>
                    <div className='uniform-preview-img'>
                      {imagesPreview.map(img => (
                        <img src={img} key={img} alt="Images Preview" className="mr-2 uniform-img" />
                      ))}
                    </div>

                    <input
                      type='file'
                      name='product_images'
                      className='form-control'
                      id='formFile'
                      onChange={onChange}
                      multiple
                    />


                  </Form.Group>

                  <Row>
                    <div className="col-sm-6 mb-3">
                      <Form.Group className="mb-3">
                        <FormLabel>Name</FormLabel>
                        <Form.Control type="text" name="name" placeholder="Name" />
                      </Form.Group>

                      <Form.Group className="mb-3">
                        <FormLabel>Name</FormLabel>
                        <Form.Control type="text" name="name" placeholder="Name" />
                      </Form.Group>

                      <Form.Group>
                        <FormLabel>Name</FormLabel>
                        <Form.Control type="text" name="name" placeholder="Name" />
                      </Form.Group>
                    </div>

                    <div className="col-sm-6 mb-3">
                      <Form.Group className="mb-3">
                        <FormLabel>Name</FormLabel>
                        <Form.Control type="text" name="name" placeholder="Name" />
                      </Form.Group>

                      <Form.Group className="mb-3">
                        <FormLabel>Name</FormLabel>
                        <Form.Control type="text" name="name" placeholder="Name" />
                      </Form.Group>

                      <Form.Group >
                        <FormLabel>Name</FormLabel>
                        <Form.Control type="text" name="name" placeholder="Name" />
                      </Form.Group>
                    </div>
                  </Row>

                  <Form.Group>
                    <FormLabel>About</FormLabel>
                    <Form.Control as="textarea" style={{ height: '100px' }} />
                  </Form.Group>

                </Form>
              </div>
            </div>

            <div className='panel-footer'>
              <Row>
                <div className='col-md-8 col-md-offset-2'>
                  <button type="submit" className="btn btn-primary float-end">Save</button>
                </div>
              </Row>
            </div>
          </div>
        </div>
      </Row>
    </div>

  )
}

export default CreateTeam