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
        $jobs = $this->jobsModel->findAll();
        $this->printJsonOrFail($jobs);
    }
    
    public function action_view($id) {
        $job = $this->jobsModel->findById($id);
        
        $this->printJsonOrFail($job, 'Job not found');
    }
    
    public function action_viewWithCandidates($id) {
        $job = $this->jobsModel->findById($id);
        
        if (! $job) {
            throw new HttpError('Job not found', 400);
        }
        
        $candidates = $this->jobsModel->findCandidates($id);
        $job->candidates = $candidates;
        $this->printJsonOrFail($job);
    }
}
