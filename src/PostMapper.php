<?php

namespace Blog;

use PDO;

class PostMapper
{
    private Database $database;

    /**
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }


    public function getByUrlKey( string $urlKey ) : ?array
    {
        $statment = $this->database->getConnection()->prepare( "SELECT * FROM post WHERE url_key = :url_key" );
        $statment->execute([
            'url_key' => $urlKey
        ]);

        $result = $statment->fetchAll();

        return array_shift( $result );
    }

    public function getList( int $page = 1, int $limit = 3, string $direction = 'ASC' ) : ?array
    {
        if( ! in_array( $direction, [ 'ASC', 'DESC' ] ) )
        {
            throw new \Exception( 'Unknown direction of sorting' );
        }

        $page -= 1;
//        var_dump( $page );
        $offset = $page * $limit;

        $query = "SELECT * FROM post ORDER BY published_date $direction LIMIT $offset,$limit";
//        var_dump( $query );

        $statment = $this->database->getConnection()->prepare(
            $query
        );

        $statment->execute();

        $result = $statment->fetchAll();

        return $result;
    }

    public function getTotalCount() : int
    {
        $statment = $this->database->getConnection()->prepare(
            "SELECT COUNT( post_id ) AS total FROM post"
        );
        $statment->execute();

        return (int) ( $statment->fetchColumn() ?? 0 );
    }
}