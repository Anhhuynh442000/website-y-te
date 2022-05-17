<?php

declare(strict_types=1);

namespace App\Controllers\api;

use App\Core\Controller\BaseController;
use App\dto\api\AttendeesForApiDto;
use App\use_case\api\GetAttendeesUseCase;

class GetAttendeesApiController extends BaseController
{
    const ROLE_DOCTOR = 1;

    public function get()
    {
        $id = $this->request->input->getInt('id');
        $use_case = new GetAttendeesUseCase();
        $attendees = $use_case->execute($id);
        return $this->response->json_encode($this->createResponse($attendees));
    }

    /**
     * @param AttendeesForApiDto[] $attendees
     */
    private function createResponse(array $attendees): array
    {
        $data = [];
        foreach ($attendees as $attendee) {
            $temp = [];
            if ($attendee->getRole() === self::ROLE_DOCTOR) {
                $temp['doctor']['full_name'] = $attendee->getFirstName() . ' ' . $attendee->getLastName();
                $temp['doctor']['gender'] = $attendee->getGender();
                $temp['doctor']['email'] = $attendee->getEmail();
            } else {
                $temp['patient']['full_name'] = $attendee->getFullName();
                $temp['patient']['gender'] = $attendee->getGender();
                $temp['patient']['email'] = $attendee->getEmail();
            }
            $data[] = $temp;
        }
        return $data;
    }
}
