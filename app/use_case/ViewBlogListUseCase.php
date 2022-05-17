<?php
declare(strict_types=1);

namespace App\use_case;

use App\query_services\BlogListQueryService;
use App\query_services\BlogListQueryServiceInterface;

class ViewBlogListUseCase
{
    private BlogListQueryServiceInterface $blogListQueryService;

    public function __construct()
    {
        $this->blogListQueryService = new BlogListQueryService();
    }

    public function execute(int $offset): array
    {
        return $this->blogListQueryService->getBlogList($offset);
    }
}
