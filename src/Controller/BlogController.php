<?php
namespace Blog\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BlogController
{
    public function blog(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $response->getBody()->write("blog list");
        return $response;
    }
}
