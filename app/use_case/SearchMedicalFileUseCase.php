<?php

declare(strict_types=1);

namespace App\use_case;

use App\dto\MedicalFileForSearchDto;
use App\query_services\MedicalFileQueryService;

class SearchMedicalFileUseCase
{
    private MedicalFileQueryService $medicalFileQueryService;

    public function __construct()
    {
        $this->medicalFileQueryService = new MedicalFileQueryService();
    }

    public function execute(string $key_word): array
    {
        $medical_files_dto = $this->medicalFileQueryService->getMedicalFileForSearch($key_word);
        return $this->createResponse($medical_files_dto);
    }

    /**
     * @param MedicalFileForSearchDto[] $medical_files_dto
     * @return array
     */
    private function createResponse(array $medical_files_dto): array
    {
        $data = [];
        foreach ($medical_files_dto as $medical_file) {
            $temp = [];
            $temp['id'] = $medical_file->getId();
            $temp['full_name'] = $medical_file->getFullName();
            $temp['phone'] = $medical_file->getPhone();
            $data[] = $temp;
        }
        return $data;
    }
}
