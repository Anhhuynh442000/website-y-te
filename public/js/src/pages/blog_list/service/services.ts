import axios from 'axios';

export const getTotalBlog = () => {
    return axios.get('/admin/ajax/get-total-blog');
};
