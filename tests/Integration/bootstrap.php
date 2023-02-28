<?php

//use Blog\tests\Integration\ContainerProvider;
//use Blog\tests\Integration\ContainerProvider;
use Blog\tests\Integration\ContainerProvider;
use DI\ContainerBuilder;

//var_dump( 'sup' ); exit;


//(new DotEnv(__DIR__ . '/../.env'))->load();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, './../.env'  );
$dotenv->load();

//require __DIR__ . './../../vendor/autoload.php';

require __DIR__ . '/../../vendor/autoload.php';

//$builder = new ContainerBuilder();
//$builder->addDefinitions(__DIR__ .  '/../../config/di.php');
$builder = new ContainerBuilder();
//$builder->addDefinitions( './../../config/di.php' );
$builder->addDefinitions(__DIR__ .  '/../../config/di.php');

//(new DotEnv(__DIR__ . '/../.env'))->load();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, './../.env'  );
$dotenv->load();

$container = $builder->build();

//ContainerProvider::setContainer();

//var_dump( 'sup' ); exit;

ContainerProvider::setContainer($container);

