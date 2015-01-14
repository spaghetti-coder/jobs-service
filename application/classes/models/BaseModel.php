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
        return $this->retrieveByCriteria('id = :id', array(
            ':id' => $id
        ))->fetch();
    }
    
    /**
     * Run sql to retrieve data by criteria and return PDOStatement with result.
     * Uses PDO placeholders. Usage example:
     * <pre>
     *  $fullAgedSimpsons = $this->retrieveByCriteria(
     *      'lastname = :lastname AND age >= :age',
     *      array(':firstname' => 'simpson', ':age' => 21));
     * </pre>
     * 
     * @param  string $criteria Criteria string
     * @param  array  $params Criteria parameters
     * @return PDOStatement
     */
    protected function retrieveByCriteria($criteria, array $params) {
        $query =   'SELECT *'
                . ' FROM ' . $this->getTableName()
                . ' WHERE ' . $criteria;
        
        // Prepare query for further processing
        $stmt = getPdo()->prepare($query);
        // Iterate over placeholders and bind values
        foreach ($params as $placeholder => $value) {
            $stmt->bindValue($placeholder, $value, PDO::PARAM_STR);
        }
        // Execute statement
        $stmt->execute();
        // Return results
        return $stmt;
    }
}
