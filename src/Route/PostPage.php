<?php

namespace Blog\Route;

use Blog\PostMapper;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;

class PostPage
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

    public function __invoke(RequestInterface $request, ResponseInterface $response, $args = [] ) : ResponseInterface
    {
//    $postMapper = new PostMapper( $connection );
    $post = $this->postMapper->getByUrlKey( (string) $args[ 'url_key' ] );

    if( empty( $post ) )
    {
        $body = $this->view->render( 'not-found.twig' );
    }
else
{
    $body = $this->view->render( 'post.twig', [
        'post' => $post
    ] );

}
$response->getBody()->write( $body );
return $response;
}
}