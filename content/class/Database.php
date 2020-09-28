<?php

    /* Database helper class 
     * 
     * Author: Erwin Ignacio
     * 
     * 1. $connection: Database connection
     * 
     * SQL function
     * 1. connect(): Use to connect to the database
     * 2. disconnect(): Disconnects from the database
     * 3. query(): Can be used with UPDATE and INSERT statements
     * 4. select($query): Search for a single record and returns it in the form of array if successful and false if not
     *    $query: SQL statement that to be executed(String)
     *    
     * Other function
     * 1. select_row($query, $row = 1) - Get a specific row on the result set
     * 2. error() - Display database connection status in case of errors
     * 3. quote($value) - Escapes special characters in a string for use in an SQL statement 
     */

    class Database {
        protected static $connection;

        public function __construct() {
            $this->connect();
        }

        public function __destruct() {
            $this->disconnect();
        }

        public function connect() {    
            if(!isset(self::$connection)) {
                $config = parse_ini_file('config.ini');
                self::$connection = new mysqli($config['DB_SERVER'], $config['DB_USER'], $config['DB_PASSWORD'], $config['DB_NAME']);
            } else {
                if (!self::$connection) {
                    die("Database connection/selection failed: " . mysqli_error($connection));
                }
            }
            return self::$connection;
        }

        public function disconnect() {
            if (isset($this->connection)) {
                mysqli_close($this->$connection);
                unset($this->$connection);
            }
        }

        public function query($query) {
            $connection = $this->connect();
            $result = $connection->query($query);
            return $result;
        }
        
        public function select($query) {
            $result = $this->query($query);
            if($result === false) {
                echo "There was an error on your sql statement...";
                return false;
            }

            // one-liner for transforming a mysqli_result set into an array instead above code
            for ($set = array(); $row = $result->fetch_assoc(); $set[] = $row);
            return $set;
        }

        public function select_row($query, $row = 1){
            $result = $this->select($query);
            if(count($result)===0){
                return NULL;
            }
            return $result[$row-1];
        }

        public function error() {
            $connection = $this->connect();
            if(self::$connection === false) {
                die("Database connection failed. " . mysqli_error($this->$connection));
                return false;
            }
        }

        public function quote($value) {
            $connection = $this->connect();
            return "'" . $connection->real_escape_string($value) . "'";
        }
    }
?>