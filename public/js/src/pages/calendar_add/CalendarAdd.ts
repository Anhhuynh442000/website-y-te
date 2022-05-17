import {
    Doctors,
    selectDoctor
} from '../../components/Appointment/SelectDoctor';
import { getDoctor } from './services/services';
import ReactDOM from 'react-dom';
import React from 'react';

const SELECTOR_DOCTOR_ID_INPUT = '#doctor-id';

export default class CalendarAdd {
    private doctors!: Doctors[];

    private async fetchDoctors() {
        await getDoctor().then(result => {
            this.doctors = result.data;
        });
    }

    private onChangeSelectDoctor(id: string) {
        $(SELECTOR_DOCTOR_ID_INPUT).prop('value', id);
    }

    private renderSelectPicker() {
        ReactDOM.render(
            React.createElement(selectDoctor, {
                doctors: this.doctors,
                onChange: this.onChangeSelectDoctor
            }),
            document.getElementById('select-doctor')
        );
    }

    public render() {
        this.fetchDoctors().then(() => {
            this.renderSelectPicker();
        });
    }
}
