<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\entity\Prescription;
use App\domain\repository\PrescriptionRepository;

class AddPrescriptionUseCase
{
    private PrescriptionRepository $prescriptionRepository;
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
        int $user_id
    ) {
        $prescription = $this->buildPrescription(
            $full_name,
            $gender,
            $age,
            $address,
            $description,
            $medicine_list,
            $health_id,
            $user_id
        );
        $id = $this->prescriptionRepository->addPrescription($prescription);

        if (!$id) {
            $this->session->setFlash('errorAddPrescription', 'Add prescription fail');
            return;
        }
        $this->session->setFlash('successAddPrescription', 'Add prescription success');
    }

    public function buildPrescription(
        string $full_name,
        string $gender,
        int $age,
        string $address,
        string $description,
        array $medicine_list,
        int $health_id,
        int $user_id
    ): Prescription {
        return new Prescription(
            null,
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
