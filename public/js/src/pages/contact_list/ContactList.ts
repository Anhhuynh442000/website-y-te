import ReactDOM from 'react-dom';
import React from 'react';
import { Paginated } from '../../components/Pagination/Paginated';
import { getTotalContact } from './service/services';

export default class ContactList {
    private renderPagination() {
        ReactDOM.render(
            React.createElement(Paginated, {
                itemsPerPage: 10,
                path: '/admin/blog-list',
                service: getTotalContact
            }),
            document.getElementById('pagination')
        );
    }
    public render() {
        this.renderPagination();
    }
}
