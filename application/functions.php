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
            PDO::MYSQL_ATTR_INIT_COMMAND => DB_CHATSET,
        );
        
        try {
            $connection = new PDO(
                DB_DSN,
                DB_USER,
                DB_PASS,
                $options
            );
        } catch (PDOException $ex) {
            // FIXME: throw new ServerError
        }
    }
    
    return $connection;
}
