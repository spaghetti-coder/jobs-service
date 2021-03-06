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
     * Get all records from the model's table.
     * Returns an array of stdClass objects or empty array
     * the table is empty
     * 
     * @return array
     */
    public function findAll() {
        $query = 'SELECT *'
              . ' FROM ' . $this->getTableName();
        
        // Run query and return fetched result
        $result = getPdo()->query($query);
        return $result->fetchAll();
    }
    
    /**
     * Get a record by its id.
     * Returns a strClass object or false if the record doesn't exist
     * 
     * @param  int $id
     * @return stdClass
     */
    public function findById($id) {
        return $this->retrieveByCriteria('id = :id', array(
            'id' => $id
        ))->fetch();
    }
    
    /**
     * Get all records from the model's table, that corresond to the criteria
     * Returns an array of stdClass objects or empty array.Usage example:
     * <pre>
     *  $fullAgedSimpsons = $this->findByCriteria(
     *      'lastname = :lastname AND age >= :age',
     *      array('firstname' => 'simpson', 'age' => 21));
     * </pre>
     * 
     * @param string $criteria Criteria string
     * @param array  $params Criteria parameters
     * @return array
     */
    public function findByCriteria($criteria, array $params) {
        return $this
                ->retrieveByCriteria($criteria, $params)
                ->fetchAll();
    }
    
    /**
     * Run sql and return PDOStatement with result. Usage example:
     * <pre>
     *  $result = $this->query(
     *      'SELECT * FROM users WHERE id = :id',
     *      array('id' => 5));
     * </pre>
     * 
     * @param string $query Query with PDO placeholders
     * @param array  $params Array of params for placeholders
     * @return PDOStatement
     */
    protected function query($query, array $params = array()) {
        // Prepare query for further processing
        $stmt = getPdo()->prepare($query);
        // Iterate over placeholders and bind values
        foreach ($params as $placeholder => $value) {
            $stmt->bindValue(':' . $placeholder, $value, PDO::PARAM_STR);
        }
        // Execute statement
        $stmt->execute();
        // Return results
        return $stmt;
    }
    
    /**
     * Run sql to retrieve data by criteria and return PDOStatement with result.
     * Uses PDO placeholders. Usage example:
     * <pre>
     *  $fullAgedSimpsons = $this->retrieveByCriteria(
     *      'lastname = :lastname AND age >= :age',
     *      array('firstname' => 'simpson', 'age' => 21));
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
        
        return $this->query($query, $params);
    }
}
