<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\SearchMedicalFileUseCase;

class SearchMedicalFileController extends BaseController
{
    public function search()
    {
        $key_word = $this->request->input->getString('k');
        $use_case = new SearchMedicalFileUseCase();
        return $this->response->json_encode($use_case->execute($key_word));
    }
}
