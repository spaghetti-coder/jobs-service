<?php

class Candidate extends BaseModel {
    public function getPK() {
        return 'id';
    }

    public function getTableName() {
        return 'candidates';
    }
    
    /**
     * Get jobs for the candidate
     * 
     * @param  int $candidateId Candidate id
     * @return array
     */
    public function findJobs($candidateId) {
        $query = 'SELECT j.*'
              . ' FROM jobs AS j'
              . ' INNER JOIN jobs_to_candidates AS j2c ON j.id = j2c.job_id'
              . ' WHERE j2c.candidate_id = :candidate_id';
        
        return $this->query($query, array(
            'candidate_id' => $candidateId,
        ))->fetchAll();
    }
}
