<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\entity\Medicine;
use App\domain\repository\MedicineRepository;

class AddMedicineUseCase
{
    private MedicineRepository $medicineRepository;
    private Session $session;

    public function __construct()
    {
        $this->medicineRepository = new MedicineRepository();
        $this->session = new Session();
    }

    public function execute(string $name, string $unit, int $quantity, string $description, int $type_id): int
    {
        $medicine = $this->buildMedicine($name, $unit, $quantity, $description, $type_id);
        $id = $this->medicineRepository->addMedicine($medicine);
        if (!$id) {
            $this->session->setFlash('errorAddMedicine', 'Add medicine fail');
            return $id;
        }

        return $id;
    }

    private function buildMedicine(string $name, string $unit, int $quantity, string $description, int $type_id): Medicine
    {
        return new Medicine(null, $name, $unit, $quantity, $description, $type_id);
    }
}
