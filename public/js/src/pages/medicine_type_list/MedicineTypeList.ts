import ReactDOM from 'react-dom';
import React from 'react';
import { Paginated } from '../../components/Pagination/Paginated';
import { getTotalMedicineType } from './service/services';

export default class MedicineTypeList {
    private renderPagination() {
        ReactDOM.render(
            React.createElement(Paginated, {
                itemsPerPage: 10,
                path: '/admin/medicine-type-list',
                service: getTotalMedicineType
            }),
            document.getElementById('pagination')
        );
    }
    public render() {
        this.renderPagination();
    }
}
