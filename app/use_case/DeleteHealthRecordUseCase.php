<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\repository\HealthRepository;

class DeleteHealthRecordUseCase
{
    private HealthRepository $useCase;
    private Session $session;

    public function __construct()
    {
        $this->useCase = new HealthRepository();
        $this->session = new Session();
    }

    public function execute(int $id)
    {
        $isSuccess = $this->useCase->deleteHealth($id);
        if (!$isSuccess) {
            $this->session->setFlash('errorDeleteHealth', 'Delete health fail');
            return;
        }
        $this->session->setFlash('successDeleteHealth', 'Delete health success');
    }
}
