<?php
namespace PHP\dbconnection;
use PDO;
use PDOException;

class DatabaseConnector
{
    /** Constants for DB connection.
     */
    private string $host = 'ec2-54-228-218-84.eu-west-1.compute.amazonaws.com';
    private string $db_name = 'd7m5ibp75psssi';
    private string $username = 'dbrdsgnvxneszi';
    private string $password = 'e55517cccc7ba6668e41f0bcf0cc2250a43be1100165250dd47c36586c453327';
    private PDO $dbConnection;

    /**
     * Getting database credentials.
     */
    public function __construct()
    {

        try {
            $this->dbConnection = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }

    /** Connect to DataBase
     */
    public function getConnection(): ?PDO
    {
        return $this->dbConnection;
    }
}