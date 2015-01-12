<?php

class JobsController extends BaseServiceController {
    /**
     * @var Job
     */
    private $jobsModel;
    
    public function __construct() {
        parent::__construct();
        
        $this->jobsModel = new Job;
    }
    
    public function action_index() {
        $jobs = $this->jobsModel->retrieveAll();
        exit(json_encode($jobs));
    }
    
    public function action_view($id) {
        $job = $this->jobsModel->retrieveById($id);
        
        // If the job doesn't exist, throe 400 error
        if (! $job) {
            throw new HttpError('Job not found', 400);
        }
        
        exit(json_encode($job));
    }
}
