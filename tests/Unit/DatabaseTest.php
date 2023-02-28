<?php

namespace Blog\tests\Unit;

use Blog\Database;
use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    private Database $database;

    private MockPDO|PDO $connection;
    protected function setUp(): void
    {
        parent::setUp();

        $this->connection = $this->createMock( PDO::class );
        $this->database = new Database( $this->connection );
    }

    public function testGetConnection() : void
    {
        $result = $this->database->getConnection();

        $this->assertInstanceOf( PDO::class, $result );
        $this->assertNotEmpty( $result, 'Incorrect result' );
    }
}