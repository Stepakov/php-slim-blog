<?php

namespace Blog\Route;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class AboutPage
{
    private Environment $view;

    /**
     * @param Environment $view
     */
    public function __construct(Environment $view)
    {
        $this->view = $view;
    }


    public function index(Request $request, Response $response, $args) : Response
    {
    $body = $this->view->render( 'about.twig', [
        'name' => 'Sasha'
    ] );
    $response->getBody()->write( $body );
    return $response;
}
}