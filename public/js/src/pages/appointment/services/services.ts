import axios, { AxiosResponse } from 'axios';
import { CalendarOptions } from '@fullcalendar/react';

interface SaveCalendarRequestParams {
    subject: string;
    fullName: string;
    date: string;
    timeStart: string;
    timeEnd: string;
    doctorId: string;
    description: string;
}

export interface ErrorParams {
    hasError: boolean;
    type?: number;
    message?: string;
}

interface SaveCalendarResponse {
    info: {
        error: ErrorParams;
    };
}

export const saveCalendar = (
    params: SaveCalendarRequestParams
): Promise<AxiosResponse<SaveCalendarResponse>> => {
    return axios.post('/admin/ajax/add-calendar', {
        ...params
    });
};

export const getDoctor = async () => {
    return await axios.get('/admin/ajax/get-doctor');
};

export interface GetCalendarResponse extends CalendarOptions {
    title: string;
    start: string;
    end: string;
    backgroundColor: string;
    description: string;
}

export const getCalendar = async (): Promise<
    AxiosResponse<GetCalendarResponse[]>
> => {
    return await axios.get('/admin/ajax/get-calendar');
};
