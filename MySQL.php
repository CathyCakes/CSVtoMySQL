<?php
/**
 * Created by PhpStorm.
 * User: CupCakes
 * Date: 2021/02/14
 * Time: 11:10 PM
 */

namespace MySQL;

class MySQL
{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DATABASENAME = 'import_csv';

    private $conn;

    function __construct()
    {
        $this->conn = $this->getConnection();
    }

    /*Database connection*/
    public function getConnection()
    {
        $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

        if (mysqli_connect_errno())
        {
            trigger_error("Problem with connecting to database.");
        }

        $conn->set_charset("utf8");
        return $conn;
    }

    /*Prepares parameter binding & bind parameters to sql statement*/
    public function bindQueryParams($stmt, $paramType, $paramArray = array())
    {
        $paramValueReference[] = & $paramType;

        for ($i = 0; $i < count($paramArray); $i ++)
        {
            $paramValueReference[] = & $paramArray[$i];
        }

        call_user_func_array(array($stmt,'bind_param'), $paramValueReference);
    }

    /*To execute query*/
    public function execute($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray))
        {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
    }

    /*Insert into database*/
    public function insert($query, $paramType, $paramArray)
    {
        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }

    /*Get database results & return results*/
    public function select($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray))
        {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $resultset[] = $row;
            }
        }

        if (! empty($resultset))
        {
            return $resultset;
        }
    }

    /*Get database results & return count*/
    /**
    public function getRecordCount($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray))
        {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;

        return $recordCount;
    }
     * */
}