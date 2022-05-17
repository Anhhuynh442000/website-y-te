import ReactDOM from 'react-dom';
import {
    Doctors,
    selectDoctor
} from '../../components/Appointment/SelectDoctor';
import React from 'react';
import { getDoctor } from './services/services';

const SELECTOR_EDIT_BTN_CALENDAR = '.js-btn-edit-calendar';
const SELECTOR_EDIT_CALENDAR_MODAL = '#editCalendarModal';

export default class CalendarDetail {
    private doctors!: Doctors[];
    private selected: string = '0';
    private $modal: JQuery | any;
    private $buttonEdit!: JQuery<HTMLButtonElement>;

    private bindEvent() {
        this.$buttonEdit = $(SELECTOR_EDIT_BTN_CALENDAR);
        this.$modal = $(SELECTOR_EDIT_CALENDAR_MODAL) as any;
        this.$buttonEdit.on('click', async () => {
            await this.handleOnclickEditButton();
        });
    }

    private async handleOnclickEditButton() {
        await this.fetchDoctors();
        this.renderSelectPicker();
        this.showModal();
    }

    private showModal() {
        this.$modal.modal('show');
    }

    private async fetchDoctors() {
        const selectedDoctorId = this.$buttonEdit.data('selected-doctor-id');
        await getDoctor().then(result => {
            this.doctors = result.data;
            this.selected = selectedDoctorId.toString();
        });
    }

    private onChangeSelectDoctor(id: string) {
        const currentDoctorIdElement =
            document.getElementById('current-doctor-id');
        currentDoctorIdElement &&
            currentDoctorIdElement.setAttribute(
                'value',
                id !== null ? id.toString() : ''
            );
    }

    private renderSelectPicker() {
        ReactDOM.render(
            React.createElement(selectDoctor, {
                doctors: this.doctors,
                selected: this.selected,
                onChange: this.onChangeSelectDoctor
            }),
            document.getElementById('select-doctor')
        );
    }

    public render() {
        this.bindEvent();
    }
}
