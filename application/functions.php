<?php

/**
 * Get PDO object
 * 
 * @staticvar \PDO $connection PDO object
 * @return \PDO
 */
function getPdo() {
    // Cached connection
    static $connection = null;
    
    if (! $connection) {
        $options = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHARSET,
        );
        
        try {
            $connection = new PDO(
                DB_DSN,
                DB_USER,
                DB_PASS,
                $options
            );
        } catch (PDOException $ex) {
            throw new ServerError('Internal Server Error', 500);
        }
    }
    
    return $connection;
}
