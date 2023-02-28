<?php

use Blog\Database;
use Blog\PostMapper;
use Blog\Route\BlogPage;
use Blog\twig\AssetExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\get;

return [
    'server.params' => $_SERVER,
    FilesystemLoader::class => autowire()
    ->constructorParameter( 'paths', 'templates' ),

    Environment::class => autowire()
    ->constructorParameter( 'loader', get( FilesystemLoader::class ) )
    ->method( 'addExtension', get( AssetExtension::class ) ),

    Database::class => autowire()
    ->constructorParameter( 'connection', get( PDO::class ) ),

    PDO::class =>autowire()
    ->constructor( $_ENV[ 'DATABASE_DNS'], $_ENV[ 'DATABASE_USERNAME'], $_ENV[ 'DATABASE_PASSWORD'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT => 1
    ] ),

    BlogPage::class => autowire()
    ->constructorParameter( 'postMapper', get( PostMapper::class ) )
    ->constructorParameter( 'view', get( Environment::class ) ),

    AssetExtension::class => autowire()
    ->constructorParameter( 'params', get( 'server.params' ) )


];