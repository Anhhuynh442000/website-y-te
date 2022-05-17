import axios, { AxiosResponse } from 'axios';

export interface GetDoctorResponseData {
    label: string;
    value: string;
    role: string;
}

export const getDoctor = async (): Promise<
    AxiosResponse<GetDoctorResponseData[]>
> => {
    return await axios.get('/admin/ajax/get-doctor');
};
