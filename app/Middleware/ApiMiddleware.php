<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Api\ApiAuthentication;
use App\Core\Middleware\BaseMiddleware;
use App\Core\Request\Request;
use App\Core\Response\Response;

class ApiMiddleware extends BaseMiddleware
{
    private Request $request;
    private ApiAuthentication $apiAuthentication;
    private Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->apiAuthentication = new ApiAuthentication();
        $this->response = new Response();
    }

    public function __invoke()
    {
        $headers = $this->request->getHeaders();
        $this->apiAuthentication->setHeaders($headers);
        if (!$this->apiAuthentication->authentication()) {
            return $this->response->json_encode(
                [
                    'code' => 'AUTH-0001',
                    'error' => 'Authentication failed',
                    'detail' => 'Make sure the header "Medical-Authorization" is correctly'
                ]
            );
        }
    }
}
