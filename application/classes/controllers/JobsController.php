<?php

class JobsController extends BaseController {
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
        $this->printJsonOrFail($jobs);
        exit(json_encode($jobs));
    }
    
    public function action_view($id) {
        $job = $this->jobsModel->retrieveById($id);
        
        $this->printJsonOrFail($job, 'Job not found');
    }
}
