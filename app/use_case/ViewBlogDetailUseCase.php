<?php
declare(strict_types=1);

namespace App\use_case;

use App\dto\BlogDto;
use App\query_services\BlogDetailQueryService;
use App\query_services\BlogDetailQueryServiceInterface;

class ViewBlogDetailUseCase
{
    private BlogDetailQueryServiceInterface $blogDetailQueryService;

    public function __construct()
    {
        $this->blogDetailQueryService = new BlogDetailQueryService();
    }

    public function execute(string $id): BlogDto {
        return $this->blogDetailQueryService->getBlog($id);
    }
}
