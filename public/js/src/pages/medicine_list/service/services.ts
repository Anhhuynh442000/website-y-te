import axios, { AxiosResponse } from 'axios';

interface GetTotalMedicineResponse {
    total: number;
}

export const getTotalMedicine = (): Promise<
    AxiosResponse<GetTotalMedicineResponse>
> => {
    return axios.get('/admin/ajax/get-total-medicines');
};
