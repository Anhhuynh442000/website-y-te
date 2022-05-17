import axios from 'axios';

export const logout = () => {
    return axios.post('/admin/logout');
};
