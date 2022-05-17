<?php

declare(strict_types=1);

namespace App\use_case;

use App\query_services\BlogListQueryService;

class GetTotalBlogListUseCase
{
    private BlogListQueryService $blogListQueryService;

    public function __construct()
    {
        $this->blogListQueryService = new BlogListQueryService();
    }

    public function execute(): int
    {
        return $this->blogListQueryService->getTotalBlog();
    }
}
