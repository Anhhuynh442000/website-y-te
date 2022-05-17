import ReactDOM from 'react-dom';
import { Paginated } from '../../components/Pagination/Paginated';
import React from 'react';
import { getTotalUser } from './service/services';

export class UserPagination {
    render() {
        ReactDOM.render(
            React.createElement(Paginated, {
                itemsPerPage: 10,
                path: '/admin/user-list',
                service: getTotalUser
            }),
            document.getElementById('pagination')
        );
    }
}
