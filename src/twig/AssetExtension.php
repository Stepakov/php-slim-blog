<?php

namespace Blog\twig;



use Psr\Http\Message\ServerRequestInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    private array $params;
    private TwigFunctionFactory $twigFunctionFactory;

    /**
     * @param array $params
     * @param TwigFunctionFactory $twigFunctionFactory
     */
    public function __construct(array $params, TwigFunctionFactory $twigFunctionFactory)
    {
        $this->params = $params;
        $this->twigFunctionFactory = $twigFunctionFactory;
    }


    public function getFunctions()
    {
        return [
            $this->twigFunctionFactory->create( 'asset_url', [ $this, 'getAssetUrl' ] ),
            $this->twigFunctionFactory->create( 'url', [ $this, 'getUrl' ] ),
            $this->twigFunctionFactory->create( 'base_url', [ $this, 'getBaseUrl' ] )
        ];
    }

    public function getAssetUrl( string $path ) : string
    {
        return $this->getBaseUrl() . $path;
    }

    public function getBaseUrl() : string
    {
//        $params = $this->request->getServerParams();
        $scheme = $this->params[ 'REQUEST_SCHEME' ] ?? 'http';
        return $scheme . "://" . $this->params[ 'HTTP_HOST' ] . '/';
    }

    public function getUrl( string $path ) : string
    {
        return $this->getBaseUrl() . $path;
    }
}