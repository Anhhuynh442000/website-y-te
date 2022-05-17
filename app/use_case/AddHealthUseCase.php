<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\entity\Health;
use App\domain\repository\HealthRepository;
use App\domain\repository\HealthRepositoryInterface;

class AddHealthUseCase
{
    private HealthRepositoryInterface $healthRepository;
    private Session $session;

    public function __construct()
    {
        $this->healthRepository = new HealthRepository();
        $this->session = new Session();
    }

    public function execute(
        string $summary,
        array $healths,
        string $note,
        int $medical_file_id
    ) {
        $health = $this->buildHealth($summary, $healths, $note, $medical_file_id);
        $id = $this->healthRepository->addHealth($health);

        if (!$id) {
            $this->session->setFlash('errorHealth', 'Add health fail');
        }
        $this->session->setFlash('successHealth', 'Add health success');
    }

    private function buildHealth(
        string $summary,
        array $healths,
        string $note,
        int $medical_file_id
    ): Health {
        return new Health($summary, serialize($healths), $note, $medical_file_id,);
    }
}
