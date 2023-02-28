<?php

namespace Blog\Route;

use Blog\PostMapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class BlogPage
{
    private PostMapper $postMapper;
    private Environment $view;

    /**
     * @param PostMapper $postMapper
     * @param Environment $view
     */
    public function __construct(PostMapper $postMapper, Environment $view)
    {
        $this->postMapper = $postMapper;
        $this->view = $view;
    }


    public function index(Request $request, Response $response, $args) : Response
    {

        $page = isset( $args[ 'page' ] ) ? (int) $args[ 'page' ] : 1;

        $limit = 3;

//        $postMapper = new PostMapper( $connection );
        $posts = $this->postMapper->getList( $page, $limit, 'DESC' );

        $totalCount = $this->postMapper->getTotalCount();

        $body = $this->view->render( 'blog.twig', [
            'posts' => $posts,
            'pagination' => [
                'current' => $page,
                'page_number' => ceil( $totalCount / $limit ),
            ],
        ] );
        $response->getBody()->write( $body );
        return $response;
    }
}