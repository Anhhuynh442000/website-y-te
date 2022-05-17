import axios from 'axios';

export const getTotalUser = () => {
    return axios.get('/admin/ajax/get-total-users');
};
