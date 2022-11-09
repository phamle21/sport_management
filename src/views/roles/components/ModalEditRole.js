import CsLineIcons from 'cs-line-icons/CsLineIcons';
import React, { useState } from 'react';
import { Button, Form, Modal } from 'react-bootstrap';
import 'react-datepicker/dist/react-datepicker.css';
import 'react-toastify/dist/ReactToastify.css';

const ModalEditRole = ({show, onHide, data}) => {

    const [roleName, setRoleName] = useState();

    const [roleDes, setRoleDes] = useState();

    return (
        <>
            <Modal show={show} onHide={onHide}>
                <Modal.Header closeButton>
                <Modal.Title>Cập Nhật Loại Người Dùng</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Form>
                        <div className="mb-4 filled">
                            <CsLineIcons icon="pepper" />
                            <Form.Control
                                autoFocus
                                value={data && data.name}
                                // placeholder='Tên loại người dùng'
                                onChange={(e) => setRoleName(e.target.value)}
                            />
                        </div>
                        <div className="mb-4 filled">
                            <CsLineIcons icon="content" />
                            <Form.Control
                                value={data && data.description}
                                placeholder='Mô tả loại người dùng'
                                onChange={(e) => setRoleDes(e.target.value)}
                            />
                        </div>
                    </Form>
                </Modal.Body>
                <Modal.Footer>
                <Button variant="secondary" onClick={onHide}>
                    Hủy
                </Button>
                <Button variant="danger">
                    Xóa
                </Button>
                <Button onClick={() => {}}>Lưu</Button>
                </Modal.Footer>
            </Modal> 
        </>
    )
}

export default ModalEditRole;