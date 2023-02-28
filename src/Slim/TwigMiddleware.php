<?php

namespace Blog\Slim;

use Blog\twig\AssetExtension;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class TwigMiddleware implements MiddlewareInterface
{
//    private Environment $environment;

    /**
     * @param Environment $environment
     * @param AssetExtension $assetExtension
     */
    public function __construct(Environment $environment, AssetExtension $assetExtension )
    {
//        $this->environment = $environment;
        $environment->addExtension( $assetExtension );
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
//        new AssetExtension( $request );

        return $handler->handle( $request );
    }
}