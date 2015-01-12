<?php

abstract class BaseModel {
    /**
     * Get associated with the model table name
     */
    abstract function getTableName();
    /**
     * Get table's primary key field name
     */
    abstract function getPK();
    
    /**
     * Retrieve all records from the model's table.
     * Returns an array of stdClass objects or empty array
     * the table is empty
     * 
     * @return array
     */
    public function retrieveAll() {
        $query = 'SELECT *'
              . ' FROM ' . $this->getTableName();
        
        // Run query and return fetched result
        $result = getPdo()->query($query);
        return $result->fetchAll();
    }
    
    /**
     * Retrieve a record by its id.
     * Returns a strClass object or false if the record doesn't exist
     * 
     * @param  int $id
     * @return stdClass
     */
    public function retrieveById($id) {
        $query = 'SELECT *'
              . ' FROM ' . $this->getTableName()
              . ' WHERE ' . $this->getPK() . ' = :id';
        
        // Prepare query for further processing
        $stmt = getPdo()->prepare($query);
        // Bind id as an int
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        // Execute statement
        $stmt->execute();
        // Return first result
        return $stmt->fetch();
    }
}
