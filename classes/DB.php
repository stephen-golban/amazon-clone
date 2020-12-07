<?php

class DB
{
    private static $_instance = null;
    private $_pdo,
        $_query,
        $_error = false,
        $_results,
        $_count = 0;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    public function action($action, $table, $where = array())
    {
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }
    // Get results with conditions
    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }
    // Get results without any conditions
    public function getOnly($table)
    {
        $this->_query = $this->_pdo->prepare("SELECT * FROM {$table}");
        $this->_query->execute();
        return $this->_query;
    }
    // Get results sorted
    public function getSorted($table, $where, $q, $col, $sort)
    {
        $this->_query = $this->_pdo->prepare("SELECT * FROM {$table} {$where} '{$q}' ORDER BY CAST({$col} AS DECIMAL(10,2)) {$sort}");
        $this->_query->execute();
        return $this->_query;
    }
    public function get2($table, $where, $q)
    {
        $this->_query = $this->_pdo->prepare("SELECT * FROM {$table} {$where} '{$q}'");
        $this->_query->execute();
        return $this->_query;
    }
    public function get3($table, $where, $q)
    {
        $this->_query = $this->_pdo->prepare("SELECT * FROM {$table} {$where} LIKE '%{$q}%'");
        $this->_query->execute();
        return $this->_query;
    }
    public function getSum($table, $where, $q, $col)
    {
        $this->_query = $this->_pdo->prepare("SELECT SUM({$col} + 0) FROM {$table} {$where} '{$q}'");
        $this->_query->execute();
        return $this->_query;
    }
    // Delete From specified table with conditions
    public function delete($table, $where)
    {
        return $this->action('DELETE', $table, $where);
    }
    // Insert into specified table
    public function insert($table, $fields = array())
    {
        $keys = array_keys($fields);
        $values = "";
        $x = 1;
        foreach ($fields as $field) {
            $values .= "?";
            if ($x < count($fields)) {
                $values .= ", ";
            }
            $x++;
        }
        $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$values})";
        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }
    // Update specified table with the specified id and fields
    public function update($table, $id, $fields)
    {
        $set = "";
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ", ";
            }
            $x++;
        }
        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
        if (!$this->query($sql, $fields)->error()) {
            return true;
        }
    }

    // Return  _results  in a function

    public function results()
    {
        return $this->_results;
    }
    // Returns first element as a result from a database query 
    public function first()
    {
        return $this->results()[0];
    }
    // Returns _error in a function
    public function error()
    {
        return $this->_error;
    }
    // Returns _count in a form
    public function count()
    {
        return $this->_count;
    }
}
