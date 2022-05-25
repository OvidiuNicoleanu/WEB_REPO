<?php

namespace controller;
/**
 * This method provides a number of methods that link to endpoints so that
 * database requests can be made.
 */
class ScreenActorsController
{
    /**
     * Connection for database.
     */
    private $conn;
    /**
     * Database name.
     */
    private string $db_table = "aga";
    /**
     * Database columns.
     */
    public $year;
    public $category;
    public $fullname;


    /**
     * Database connection.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * This method provides a query that gives us all the rows in the table.
     * Syntax: < SELECT * FROM table_name >.
     */
    public function getAll()
    {
        $sqlQuery = sprintf("SELECT * FROM %s", $this->db_table);
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    /**
     * This method provides a query that gives us all the rows in the table by a condition.
     * Syntax: < SELECT * FROM table_name WHERE condition ( where year=...) >.
     */
    public function getAllByYear()
    {
        $sqlQuery = sprintf("SELECT * FROM %s WHERE year=?", $this->db_table);
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->year);
        $stmt->execute();
        return $stmt;
    }

    /**
     * This method provides a query that gives us all the rows in the table by a condition.
     * Syntax: < SELECT * FROM table_name WHERE condition ( where category=...) >.
     */
    public function getAllByCategory()
    {
        $sqlQuery = sprintf("SELECT * FROM %s WHERE category=?", $this->db_table);
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->category);
        $stmt->execute();
        return $stmt;
    }

    /**
     * This method provides a query that gives us all the rows in the table by a condition.
     * Syntax: < SELECT * FROM table_name WHERE condition ( where category=.. and year=...) >.
     */
    public function getAllByCategoryYear()
    {
        $sqlQuery = sprintf("SELECT year,category,fullname FROM %s WHERE category=? and year=?", $this->db_table);
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->category);
        $stmt->bindParam(2, $this->year);
        $stmt->execute();
        return $stmt;
    }

    /**
     * This method provides a query that gives us all the rows in the table by a condition.
     * Syntax: < SELECT * FROM table_name WHERE condition ( where year=...and category=..) >.
     */

    public function getAllByYearCategory()
    {
        $sqlQuery = sprintf("SELECT year,category,fullname FROM %s WHERE year=? and category=?", $this->db_table);
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->year);
        $stmt->bindParam(2, $this->category);
        $stmt->execute();
        return $stmt;
    }

    /**
     * This method provides a query that gives us all the rows in the table having a condition
     * ( where category=...).
     * Syntax: < SELECT * FROM table_name WHERE condition >.
     */
    public function getOneCategory()
    {
        $stmt = $this->conn->prepare(sprintf("SELECT * FROM %s WHERE category = ?", $this->db_table));

        $stmt->bindParam(1, $this->category);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->year = $dataRow['year'];
        $this->category = $dataRow['category'];
        $this->fullname = $dataRow['fullname'];
    }

    /**
     * This method provides a query that gives us all the rows in the table having a condition
     * ( where category=...).
     * Syntax: < SELECT * FROM table_name WHERE condition >.
     */
    public function getOneYear()
    {
        $stmt = $this->conn->prepare(sprintf("SELECT * FROM %s WHERE year = ?", $this->db_table));

        $stmt->bindParam(1, $this->year);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->year = $dataRow['year'];
        $this->category = $dataRow['category'];
        $this->fullname = $dataRow['fullname'];
    }

    /**
     * This method provides a query that allows us to add rows in the table.
     * Syntax: < INSERT INTO table_name (column_1,column_2,...,column_k) VALUES (value_1,...,value_k) >.
     */
    public function add(): bool
    {
        if (isset($_POST['year']) && isset($_POST['category']) && isset($_POST['fullname'])) {

            $this->year = $_POST['year'];
            $this->category = $_POST['category'];
            $this->fullname = $_POST['fullname'];
            $sqlQuery = sprintf("INSERT INTO %s (year,category,fullname) VALUES (?,?,?)", $this->db_table);

            $stmt = $this->conn->prepare($sqlQuery);


            $this->year = htmlspecialchars(strip_tags($this->year));
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->fullname = htmlspecialchars(strip_tags($this->fullname));

            $stmt->bindParam(1, $this->year);
            $stmt->bindParam(2, $this->category);
            $stmt->bindParam(3, $this->fullname);

            if ($stmt->execute()) {
                return true;
            }
        }

        return false;
    }


    /**
     * This method provides a query that allows us to update rows in the table.
     * Syntax: < UPDATE table_name SET column_1=value_1,..,column_k=value_k WHERE condition >.
     */
    public function update(): bool
    {
        if (isset($_POST['year']) && isset($_POST['category']) && isset($_POST['fullname'])) {

            $this->year = $_POST['year'];
            $this->category = $_POST['category'];
            $this->fullname = $_POST['fullname'];
            echo $this->year, $this->category, $this->fullname;
            $sqlQuery = "UPDATE " . $this->db_table . " SET  year = :year, category = :category, fullname = :fullname   WHERE  fullname = :fullname";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->year = htmlspecialchars(strip_tags($this->year));
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->fullname = htmlspecialchars(strip_tags($this->fullname));

            $stmt->bindParam(1, $this->year);
            $stmt->bindParam(2, $this->category);
            $stmt->bindParam(3, $this->fullname);

            if ($stmt->execute()) {
                return true;
            }
        }

        return false;
    }

    /**
     * This method provides a query that allows us to delete rows in the table.
     * Syntax: < DELETE FROM table_name WHERE condition >.
     */
    function delete(): bool
    {
        if (isset($_POST['fullname'])) {

            $this->fullname = $_POST['fullname'];

            $sqlQuery = sprintf("DELETE FROM %s WHERE fullname = ?", $this->db_table);
            $stmt = $this->conn->prepare($sqlQuery);

            $this->fullname = htmlspecialchars(strip_tags($this->fullname));

            $stmt->bindParam(1, $this->fullname);

            if ($stmt->execute()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Getter for variable $conn.
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * Setter for variable $conn.
     */
    public function setConn($conn): void
    {
        $this->conn = $conn;
    }

    /**
     * Getter for variable $db_table.
     */
    public function getDbTable(): string
    {
        return $this->db_table;
    }

    /**
     * Setter for variable $db_table.
     */
    public function setDbTable(string $db_table): void
    {
        $this->db_table = $db_table;
    }

    /**
     * Getter for variable $year.
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Setter for variable $year.
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * Getter for variable $category.
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Setter for variable $category.
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * Getter for variable $fullname.
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Setter for variable $fullname.
     */
    public function setFullname($fullname): void
    {
        $this->fullname = $fullname;
    }

    public function getActorByAPI($fullname)
    {

    }
}