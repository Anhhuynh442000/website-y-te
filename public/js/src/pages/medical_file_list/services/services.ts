import axios, { AxiosResponse } from 'axios';

export const getHealth = (healthId: string) => {
    return axios.get(`/admin/ajax-get-prescription?id=${healthId}`);
};

interface SearchMedicalFileResponse {
    full_name: string;
    phone: string;
    id: string;
}

export const searchMedicalFile = (
    keyWord: string
): Promise<AxiosResponse<SearchMedicalFileResponse[]>> => {
    return axios.get(`/admin/ajax/search-medical-file?k=${keyWord}`);
};

export const getTotalMedicalFile = () => {
    return axios.get('/admin/ajax/get-total-medical-files');
};
