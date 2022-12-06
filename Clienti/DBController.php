<?php
class DBController
{
    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "magazin online";
    public $connect;

    function __construct()
    { 
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }
   
    public function getConnection()
    {
        if (empty($this->connect)) {
            new DBController();
        }
    }

    function getDBResult($query, $params = array())
    {
        $sql_statement = $this->connect->prepare($query);
        if (!empty($params)) {
            $this->bindParams($sql_statement, $params);
        }
        $sql_statement->execute();
        $result = $sql_statement->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (!empty($resultset)) {
            return $resultset;
        }
    }
    function updateDB($query, $params = array())
    {
        $sql_statement = $this->connect->prepare($query);
        if (!empty($params)) {
            $this->bindParams($sql_statement, $params);
        }
        $sql_statement->execute();
    }

    function bindParams($sql_statement, $params)
    {
        $param_type = "";
        foreach ($params as $query_param) {
            $param_type.= $query_param["param_type"];
        }

        $bind_params[] = & $param_type;
        foreach ($params as $k => $query_param) {
            $bind_params[] = & $params[$k]["param_value"];
        }
        call_user_func_array(array($sql_statement,'bind_param'), $bind_params);
    }
}