<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\entity\Prescription;
use App\domain\repository\PrescriptionRepository;
use App\domain\repository\PrescriptionRepositoryInterface;

class EditPrescriptionUseCase
{
    private PrescriptionRepositoryInterface $prescriptionRepository;
    private Session $session;

    public function __construct()
    {
        $this->prescriptionRepository = new PrescriptionRepository();
        $this->session = new Session();
    }

    public function execute(
        string $full_name,
        string $gender,
        int $age,
        string $address,
        string $description,
        array $medicine_list,
        int $health_id,
        int $user_id,
        int $id
    ) {
        $prescription = $this->buildPrescription(
            $full_name,
            $gender,
            $age,
            $address,
            $description,
            $medicine_list,
            $health_id,
            $user_id,
            $id
        );
        $isSuccess = $this->prescriptionRepository->editPrescription($prescription);

        if (!$isSuccess) {
            $this->session->setFlash('errorUpdatePrescription', 'Add prescription fail');
            return;
        }
        $this->session->setFlash('successUpdatePrescription', 'Add prescription success');
    }

    public function buildPrescription(
        string $full_name,
        string $gender,
        int $age,
        string $address,
        string $description,
        array $medicine_list,
        int $health_id,
        int $user_id,
        int $id
    ): Prescription {
        return new Prescription(
            $id,
            $full_name,
            $gender,
            $age,
            $address,
            $description,
            serialize($medicine_list),
            $health_id,
            $user_id
        );
    }
}
