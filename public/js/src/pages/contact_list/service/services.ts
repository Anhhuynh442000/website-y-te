import axios from 'axios';

export const getTotalContact = () => {
    return axios.get('/admin/ajax/get-total-contact');
};
