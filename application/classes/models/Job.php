<?php

class Job extends BaseModel {
    public function getPK() {
        return 'id';
    }

    public function getTableName() {
        return 'jobs';
    }
    
    /**
     * Get candidates for the job
     * 
     * @param  int $jobId Job id
     * @return array
     */
    public function findCandidates($jobId) {
        $query = 'SELECT c.*'
              . ' FROM candidates AS c'
              . ' INNER JOIN jobs_to_candidates AS j2c ON c.id = j2c.candidate_id'
              . ' WHERE j2c.job_id = :job_id';
        
        return $this->query($query, array(
            'job_id' => $jobId,
        ))->fetchAll();
    }
}
