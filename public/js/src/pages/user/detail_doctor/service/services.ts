import axios, { AxiosResponse } from 'axios';

interface GetCalendarResponse {
    title: string;
    start: string;
    end: string;
    backgroundColor: string;
    description: string;
}

export const getCalendarDoctor = (
    doctorId: number
): Promise<AxiosResponse<GetCalendarResponse[]>> => {
    return axios.get(`/user/ajax/get-doctor-calendar?id=${doctorId}`);
};
