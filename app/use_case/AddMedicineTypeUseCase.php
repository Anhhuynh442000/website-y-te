<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\entity\MedicineType;
use App\domain\repository\MedicineTypeRepository;
use App\domain\repository\MedicineTypeRepositoryInterface;

class AddMedicineTypeUseCase
{
    private MedicineTypeRepositoryInterface $medicineTypeRepository;
    private Session $session;

    public function __construct()
    {
        $this->medicineTypeRepository = new MedicineTypeRepository();
        $this->session = new Session();
    }

    public function execute(string $name, string $description): bool
    {
        $medicine_type = $this->buildMedicineType($name, $description);
        $id = $this->medicineTypeRepository->addMedicineType($medicine_type);
        if (!$id) {
            $this->session->setFlash('errorAddMedicineType', 'Add medicine type fail');
            return false;
        }
        $this->session->setFlash('successAddMedicineType', 'Add medicine type success');
        return false;
    }

    private function buildMedicineType(string $name, string $description): MedicineType
    {
        return new MedicineType(null, $name, $description);
    }
}
