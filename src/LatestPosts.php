<?php

namespace Blog;
use Blog\Database;
use PDO;

class LatestPosts
{
    private Database $database;

    /**
     * @param Database $database
     */
    public function __construct( Database $database)
    {
        $this->database = $database;
    }


    public function get( int $limit ) : ?array
    {
        $statment = $this->database->getConnection()->prepare(
            'SELECT * FROM post ORDER BY published_date DESC LIMIT :limit'
        );

        $statment->bindParam( ':limit', $limit, PDO::PARAM_INT );

//        $statment->debugDumpParams(); exit;

        $statment->execute();

        $result = $statment->fetchAll();

        return $result;
    }
}