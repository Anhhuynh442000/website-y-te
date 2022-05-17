import ReactDOM from 'react-dom';
import React from 'react';
import { Paginated } from '../../components/Pagination/Paginated';
import { getTotalMedicine } from './service/services';

export default class MedicineList {
    private renderPagination() {
        ReactDOM.render(
            React.createElement(Paginated, {
                itemsPerPage: 10,
                path: '/admin/medicine-list',
                service: getTotalMedicine
            }),
            document.getElementById('pagination')
        );
    }
    public render() {
        this.renderPagination();
    }
}
