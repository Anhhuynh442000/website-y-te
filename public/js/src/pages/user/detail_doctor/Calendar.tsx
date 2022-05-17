import FullCalendar from '@fullcalendar/react';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';
import { useEffect, useRef, useState } from 'react';
import { getCalendarDoctor } from './service/services';
import { ItemDataType } from 'rsuite/esm/@types/common';

export const Calendar = () => {
    const [events, setEvents] = useState<ItemDataType<string>[]>([]);
    const calendarRef = useRef(null);

    function getDoctorId() {
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        const doctorId = url.searchParams.get('user_id') ?? '0';
        return parseInt(doctorId);
    }

    useEffect(() => {
        const doctorId = getDoctorId();
        getCalendarDoctor(doctorId).then(result => {
            setEvents(result.data);
        });
    }, []);

    const handleNext = () => {
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        calendarRef.current.getApi().next();
    };

    const handlePrevious = () => {
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        calendarRef && calendarRef.current.getApi().prev();
    };

    return (
        <FullCalendar
            plugins={[interactionPlugin, timeGridPlugin]}
            events={events}
            initialView="timeGridWeek"
            slotMinTime="06:00:00"
            slotMaxTime="19:00:00"
            height={700}
            ref={calendarRef}
            customButtons={{
                handleNext: {
                    text: 'Next',
                    click: () => {
                        handleNext();
                    }
                },
                handlePrevious: {
                    text: 'Previous',
                    click: () => {
                        handlePrevious();
                    }
                }
            }}
            headerToolbar={{
                left: 'timeGridWeek,timeGridDay',
                center: 'title',
                right: 'today handlePrevious,handleNext'
            }}
            buttonIcons={{
                handlePrevious: 'chevron-left',
                handleNext: 'chevron-right'
            }}
            buttonText={{
                today: 'Today',
                week: 'Week view',
                day: 'Day view'
            }}
        />
    );
};
