<?php

namespace Blog;

use http\Exception\InvalidArgumentException;
use PDO;
use PDOException;

class Database
{
    private PDO $connection;

    public function __construct( PDO $connection )
    {
//        try
//        {
            $this->connection = $connection;
//            $this->connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//            $this->connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
//            $this->connection->setAttribute( PDO::ATTR_PERSISTENT, 1 );
//        }
//        catch( PDOException $e )
//        {
//            throw new InvalidArgumentException( $e->getMessage() );
//        }
    }

    public function getConnection() : PDO
    {
        return $this->connection;
    }
}