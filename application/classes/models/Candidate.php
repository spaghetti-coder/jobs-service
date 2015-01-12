<?php

class Candidate extends BaseModel {
    public function getPK() {
        return 'id';
    }

    public function getTableName() {
        return 'candidates';
    }
    
    /**
     * Retrieve jobs for the candidate
     * 
     * @param  int $candidateId Candidate id
     * @return array
     */
    public function retrieveJobs($candidateId) {
        $query = 'SELECT j.*'
              . ' FROM jobs AS j'
              . ' INNER JOIN jobs_to_candidates AS j2c ON j.id = j2c.job_id'
              . ' WHERE j2c.candidate_id = :candidate_id';
        
        // Prepare query
        $stmt = getPdo()->prepare($query);
        $stmt->bindParam(':candidate_id', $candidateId, PDO::PARAM_INT);
        // Execute query
        $stmt->execute();
        
        // Return result
        return $stmt->fetchAll();
    }
}
