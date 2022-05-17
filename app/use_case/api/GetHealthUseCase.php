<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\dto\HealthDto;
use App\errors\Health as HealthError;
use App\query_services\HealthQueryService;
use App\query_services\HealthQueryServiceInterface;

class GetHealthUseCase
{
    private HealthQueryServiceInterface $healthQueryService;
    private HealthError $healthError;

    public function __construct()
    {
        $this->healthQueryService = new HealthQueryService();
        $this->healthError = new HealthError();
    }

    public function execute(int $medical_file_id): array
    {
        $medical_files = $this->healthQueryService->getHealthByMedicalFileId($medical_file_id);
        if (empty($medical_files)) {
            return $this->healthError->getError('HEA-0001');
        }
        return $this->createResponse($medical_files);
    }

    /**
     * @param HealthDto[] $medical_files
     */
    private function createResponse(array $medical_files): array
    {
        $data = [];
        foreach ($medical_files as $medical_file) {
            $temp = [];
            $temp['id'] = $medical_file->getId();
            $temp['summary'] = $medical_file->getSummary();
            $temp['note'] = $medical_file->getNote();
            $temp['date'] = $medical_file->getDate();
            $temp['health'] = unserialize($medical_file->getHealth());
            $data[] = $temp;
        }
        return $data;
    }
}
