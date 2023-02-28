<?php

use Blog\Database;
use Blog\LatestPosts;
use Blog\Route\AboutPage;
use Blog\Route\BlogPage;
use Blog\Route\HomePage;
use Blog\Route\PostPage;
use Blog\Slim\TwigMiddleware;
use Blog\twig\AssetExtension;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Blog\PostMapper;

require __DIR__ . '/vendor/autoload.php';

//$loader = new FilesystemLoader( 'templates' );
//$view = new Environment( $loader );

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions( 'config/di.php' );

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__  );
$dotenv->load();


//var_dump( getenv( 'DATABASE_USERNAME' ) );
//var_dump( $_ENV['DATABASE_DNS'] );

$container = $builder->build();

AppFactory::setContainer( $container );

//$view->addExtension( new AssetExtension() );

//$config = require 'config/database.php';

//$dsn = $config[ 'dsn' ];
//$username = $config[ 'username' ];
//$password = $config[ 'password' ];

//try
//{
//    $connection = new PDO( $dsn, $username, $password );
//    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//    $connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
//    $connection->setAttribute( PDO::ATTR_PERSISTENT, 1 );
//}
//catch( PDOException $e )
//{
//    echo 'Database error: ' . $e->getMessage();
//    exit;
//}

//$postMapper = new PostMapper( $connection );

$app = AppFactory::create();

//$view = $container->get( Environment::class );
//$app->add( new TwigMiddleware( $view ) );
//$app->add( $container->get( TwigMiddleware::class ) );

//$connection = $container->get( Database::class )->getConnection();

$app->get('/', HomePage::class . ':index' );

$app->get('/about', AboutPage::class . ':index' );

$app->get('/blog[/{page}]', BlogPage::class . ':index' );

$app->get('/{url_key}', PostPage::class );

$app->run();