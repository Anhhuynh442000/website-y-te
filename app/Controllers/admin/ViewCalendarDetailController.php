<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\domain\factory\AttendeesForViewDetailFactory;
use App\dto\CalendarInfoForViewDetailDto;
use App\use_case\GetCalendarDetailUseCase;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ViewCalendarDetailController extends BaseController
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function getView(): string
    {
        $id = $this->request->input->getInt('id');
        $use_case = new GetCalendarDetailUseCase();
        $calendar_detail_for_view = $use_case->execute($id);
        if (empty($calendar_detail_for_view)) {
            $this->response->redirect('/admin/calendar');
        }
        $calendar_info = $this->createResponse($calendar_detail_for_view);
        return $this->twig->render('admin/pages/calendar_detail', ['calendar_for_view' => $calendar_info]);
    }

    private function createResponse(CalendarInfoForViewDetailDto $calendar_info_for_view_detail): array
    {
        $calendar = $calendar_info_for_view_detail->getCalendar();
        $calendar_info = [
            'id' => $calendar->getId(),
            'status' => $calendar->getStatus(),
            'subject' => $calendar->getSubject(),
            'full_name' => $calendar->getFullName(),
            'date' => explode(' ', $calendar->getDateStart())[0],
            'date_start' => $calendar->getDateStart(),
            'date_end' => $calendar->getDateEnd(),
            'time_start' => explode(' ', $calendar->getDateStart())[1] ?? '',
            'time_end' => explode(' ', $calendar->getDateEnd())[1] ?? '',
            'description' => $calendar->getDescription(),
            'note' => empty($calendar->getNote()) ? null : $calendar->getNote(),
        ];
        $attendees = $calendar_info_for_view_detail->getAttendees();
        $attendees_info = [];
        /** @var  $attendee AttendeesForViewDetailFactory */
        foreach ($attendees as $attendee) {
            $temp = [];
            $temp['full_name'] = $attendee->getAttendeesForView()->getFullName();
            $temp['id'] = $attendee->getAttendeesForView()->getId();
            if ($attendee->getAttendeesForView()->getRole() === 2) {
                $attendees_info['doctor'] = $temp;
            } else {
                $attendees_info['patient'] = $temp;
            }
        }

        return [
            'calendar_info' => $calendar_info,
            'attendees_info' => $attendees_info,
        ];
    }
}
