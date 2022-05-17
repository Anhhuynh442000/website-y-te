import axios from 'axios';

export const getTotalMedicineType = () => {
    return axios.get('/admin/ajax/get-total-medicines-types');
};
