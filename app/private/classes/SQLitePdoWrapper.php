<?php

abstract class SQLitePdoWrapper {
    /**
     * @var \PDO
     */
    protected static $pdo;


    /**
     * Must be implemented in extending class.
     * This method must return the path to SQLite database file.
     *
     * @return string
     */
    abstract protected static function get_db_file_path();


    /**
     * This method initializes a PDO object.
     */
    public static function init() {
        $db_file_path = static::get_db_file_path();
        $pdo = new PDO("sqlite:" . $db_file_path);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        static::$pdo = $pdo;
    }


    /**
     * This method deletes the PDO object to close connection.
     */
    public static function close() {
        static::$pdo = null;
    }


    /**
     * This method returns PDO object.
     * If PDO object does not exist, creates one and returns it.
     *
     * @return \PDO
     */
    public static function get_pdo() {
        if (static::$pdo == null) {
            static::init();
        }

        return static::$pdo;
    }


    /**
     * execute query and returns PDOStatement object.
     *
     * @var string $sql
     * @var array|scalar $params
     * @return \PDOStatement
     */
    public static function execute($sql, $params = array()) {
        $pdo = static::get_pdo();

        if (is_scalar($params)) {
            $params = array($params);
        }

        $sth = $pdo->prepare($sql);
        $sth->execute($params);

        return $sth;
    }


    /**
     * insert values with associative array
     *
     * @var string $table_name
     * @var array $key_values
     */
    public static function insert($table_name, $key_values) {
        $column_names = implode(',', array_keys($key_values));
        $place_holders = self::create_place_holders($key_values);
        $params = array_values($key_values);

        $sql = "
            INSERT INTO $table_name (
                $column_names
            ) VALUES (
                $place_holders
            )
        ";

        static::execute($sql, $params);
    }


    /**
     * returns comma separated place holders.
     * e.g. if array of parameters with length of 4 was given,
     *      it returns '?,?,?,?'
     *
     * @var array $params  array of parameters
     * @return string
     */
    static function create_place_holders($params) {
        return implode(',', array_fill(0, count($params), '?'));
    }


    /**
     * execute SELECT query and return the result as
     * an indexed array of associative array.
     *
     * @var string $sql    'SELECT' sql statement
     * @var array $params  array of parameters
     * @return array       indexed array of associative array
     */
    static function select($sql, $params = array()) {
        $sth = static::execute($sql, $params);

        $result = $sth->fetchAll();

        return $result;
    }


    /**
     * execute SELECT query and return the result as
     * an associative array.
     *
     * If the result of SELECT matches multiple rows,
     * this method returns only first row.
     *
     * @var string $sql    'SELECT' sql statement
     * @var array $params  array of parameters
     * @return array       associative array
     */
    static function select_row($sql, $params = array()) {
        $sth = static::execute($sql, $params);

        $result = $sth->fetch();

        if ($result === false) {
            return null;
        } else {
            return $result;
        }
    }


    /**
     * execute SELECT query and return the result as
     * a single scaler value.
     *
     * If the result of SELECT matches multiple rows
     * or a single row, this method returns only
     * the value of first column in first row.
     *
     * @var string $sql    'SELECT' sql statement
     * @var array $params  array of parameters
     * @return string      a scaler value
     */
    static function select_value($sql, $params = array()) {
        $sth = static::execute($sql, $params);

        $result = $sth->fetch();

        if ($result === false) {
            return null;
        } else {
            return array_shift($result);
        }
    }
}