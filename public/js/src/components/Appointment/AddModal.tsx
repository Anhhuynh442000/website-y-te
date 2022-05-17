import { Button, Modal } from 'react-bootstrap';
import { FormAdd } from './FormAdd';
import { useState, VFC } from 'react';
import {
    ErrorParams,
    getCalendar,
    GetCalendarResponse,
    saveCalendar
} from '../../pages/appointment/services/services';
import { ItemDataType } from 'rsuite/esm/@types/common';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

interface AddModalProps {
    isShow: boolean;
    onClickClose: () => void;
    handleSetEvent: (events: GetCalendarResponse[]) => void;
    doctors: ItemDataType<string>[];
    defaultDate: string;
    defaultTimeStart: string;
    defaultTimeEnd: string;
}

export const AddModal: VFC<AddModalProps> = ({
    isShow,
    onClickClose,
    doctors,
    handleSetEvent,
    defaultDate,
    defaultTimeStart,
    defaultTimeEnd
}) => {
    const [subject, setSubject] = useState('');
    const [fullName, setFullName] = useState('');
    const [date, setDate] = useState('');
    const [timeStart, setTimeStart] = useState('');
    const [timeEnd, setTimeEnd] = useState('');
    const [doctorId, setDoctorId] = useState('');
    const [description, setDescription] = useState('');

    const onChangeSubject = (subject: string) => {
        setSubject(subject);
    };
    const onChangeFullName = (fullName: string) => {
        setFullName(fullName);
    };
    const onChangeDate = (date: string) => {
        setDate(date);
    };
    const onChangeTimeStart = (timeStart: string) => {
        setTimeStart(timeStart);
    };
    const onChangeTimeEnd = (timeEnd: string) => {
        setTimeEnd(timeEnd);
    };
    const onChangeDoctor = (doctorId: string) => {
        setDoctorId(doctorId);
    };
    const onChangeDescription = (description: string) => {
        setDescription(description);
    };

    const handleOnshow = () => {
        setTimeStart(defaultTimeStart);
        setTimeEnd(defaultTimeEnd);
        setDate(defaultDate);
    };

    function handleShowError(error: ErrorParams) {
        if (error.type === 1) {
            toast.error(error.message, {
                position: toast.POSITION.TOP_RIGHT
            });
        }
        if (error.type === 2) {
            toast.error(error.message, {
                position: toast.POSITION.TOP_RIGHT
            });
        }
        if (error.type === 3) {
            toast.error(error.message, {
                position: toast.POSITION.TOP_RIGHT
            });
        }
        if (error.type === 4) {
            toast.error(error.message, {
                position: toast.POSITION.TOP_RIGHT
            });
        }
        if (error.type === 5) {
            toast.error(error.message, {
                position: toast.POSITION.TOP_RIGHT
            });
        }
        if (error.type === 6) {
            toast.error(error.message, {
                position: toast.POSITION.TOP_RIGHT
            });
        }
    }

    const handleSubmit = async () => {
        const requestParams = {
            subject,
            fullName,
            date,
            timeStart,
            timeEnd,
            doctorId,
            description
        };
        await saveCalendar(requestParams)
            .then(result => {
                const error = result.data.info.error;
                if (error.hasError) {
                    handleShowError(error);
                } else {
                    toast.success('Add calendar success!', {
                        position: toast.POSITION.TOP_RIGHT
                    });
                    onClickClose();
                }
            })
            .catch(error => {
                console.log(error);
            });
        await getCalendar().then(result => {
            handleSetEvent(result.data);
        });
    };

    return (
        <>
            <Modal
                show={isShow}
                size="lg"
                autoFocus={false}
                backdrop={false}
                onShow={() => {
                    document
                        .getElementsByClassName('modal')[0]
                        .removeAttribute('tabindex');
                    handleOnshow();
                }}
            >
                <Modal.Header>
                    <Modal.Title>Add calendar</Modal.Title>
                </Modal.Header>

                <Modal.Body>
                    <FormAdd
                        defaultDate={defaultDate}
                        defaultTimeStart={defaultTimeStart}
                        defaultTimeEnd={defaultTimeEnd}
                        doctors={doctors}
                        onChangeSubject={onChangeSubject}
                        onChangeFullName={onChangeFullName}
                        onChangeDate={onChangeDate}
                        onChangeTimeStart={onChangeTimeStart}
                        onChangeTimeEnd={onChangeTimeEnd}
                        onChangeDoctor={onChangeDoctor}
                        onChangeDescription={onChangeDescription}
                    />
                </Modal.Body>

                <Modal.Footer>
                    <Button variant="secondary" onClick={() => onClickClose()}>
                        Close
                    </Button>
                    <Button variant="primary" onClick={() => handleSubmit()}>
                        Save changes
                    </Button>
                </Modal.Footer>
            </Modal>
        </>
    );
};
