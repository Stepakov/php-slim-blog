<?php

namespace Blog\Route;

use Blog\Database;
use Blog\LatestPosts;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class HomePage
{
    private LatestPosts $latestPosts;
    private Environment $view;

    /**
     * @param LatestPosts $latestPosts
     * @param Environment $view
     */
    public function __construct(LatestPosts $latestPosts, Environment $view)
    {
        $this->latestPosts = $latestPosts;
        $this->view = $view;
    }


    public function index(Request $request, Response $response, $args) : Response
    {
//    $latestPosts = new LatestPosts( $connection );
    $posts = $this->latestPosts->get( 2 );
    $body = $this->view->render( 'index.twig', [
        'posts' => $posts
    ] );
    $response->getBody()->write( $body );
    return $response;
}
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}