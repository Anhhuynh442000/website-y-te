<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\Core\Session;
use App\Model\MedicalFile;
use App\Repository\MedicalFileRepository;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MedicalFileController extends BaseController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewMedicalFileAdd(): string
    {
        return $this->twig->render('admin/pages/medical_file_add');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewMedicalFileList(): string
    {
        if ($this->request->input->has('offset')) {
            $offset = $this->request->input->getInt('offset');
        } else {
            $offset = 0;
        }

        $medicalFiles = $this->getMedicalFiles($offset);
        return $this->twig->render(
            'admin/pages/medical_file_list',
            ['medicalFiles' => $medicalFiles, 'total' => count($medicalFiles)]
        );
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewMedicalFileDetail(): string
    {
        $medicalFileId = $this->request->input->get('id');
        $medicalRepository = new MedicalFileRepository();
        $medicalFile = $medicalRepository->getMedicalFileDetail($medicalFileId);
        $healths = $medicalRepository->getHealths($medicalFileId);
        $medicines = $medicalRepository->getMedicineList();
        if (empty($medicalFile)) {
            $this->response->redirect('/admin/medical-file-list');
        }

        return $this->twig->render(
            'admin/pages/medical_file_detail',
            ['medicalFile' => $medicalFile, 'healths' => $healths, 'medicines' => $medicines]
        );
    }

    public function getMedicalFiles(int $offset): array
    {
        $medicalFileRepository = new MedicalFileRepository();
        return $medicalFileRepository->getMedicalFiles($offset);
    }

    public function editHealth()
    {
        $healthId = $this->request->input->get('health-id');
        $summary = $this->request->input->get('summary');
        $fever = $this->request->input->get('fever');
        $haveACold = $this->request->input->get('have-a-cold');
        $soreThroat = $this->request->input->get('sore-throat');
        $note = $this->request->input->get('description');
        $medicalFileId = $this->request->input->get('medical-file-id');

        $symptoms = [
            'fever' => $fever,
            'cold' => $haveACold,
            'sore_throat' => $soreThroat,
        ];

        $medicalFileDetail = [
            'summary' => $summary,
            'healths' => serialize($symptoms),
            'note' => $note,
        ];

        $medicalFile = new MedicalFile();
        $result = $medicalFile->editHealth($medicalFileDetail, $healthId);

        $session = new Session();
        if (!$result) {
            $session->setFlash('errorHealth', 'Add health fail');
            $this->response->redirect('/admin/medical-file-detail', ['id' => $medicalFileId]);
        }

        $session->setFlash('successHealth', 'Add health success');
        $this->response->redirect('/admin/medical-file-detail', ['id' => $medicalFileId]);
    }

    public function getHealthDetail()
    {
        $healthId = $this->request->input->get('id');
        $medicalFileRepository = new MedicalFileRepository();
        $health = $medicalFileRepository->getHealthDetail($healthId);
        return $this->response->json_encode($health);
    }
}
