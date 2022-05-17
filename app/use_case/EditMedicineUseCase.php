<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\entity\Medicine;
use App\domain\repository\MedicineRepository;
use App\domain\repository\MedicineRepositoryInterface;

class EditMedicineUseCase
{
    private MedicineRepositoryInterface $medicineRepository;
    private Session $session;

    public function __construct()
    {
        $this->medicineRepository = new MedicineRepository();
        $this->session = new Session();
    }

    public function execute(int $id, string $name, string $unit, int $quantity, string $description, int $type_id): bool
    {
        $medicine = $this->buildMedicine($id, $name, $unit, $quantity, $description, $type_id);
        $isSuccess = $this->medicineRepository->updateMedicine($medicine);
        if (!$isSuccess) {
            $this->session->setFlash('errorEditMedicine', 'Update medicine fail');
            return false;
        }
        $this->session->setFlash('successEditMedicine', 'Update medicine success');
        return true;
    }

    private function buildMedicine(
        int $id,
        string $name,
        string $unit,
        int $quantity,
        string $description,
        int $type_id
    ): Medicine {
        return new Medicine($id, $name, $unit, $quantity, $description, $type_id);
    }
}
