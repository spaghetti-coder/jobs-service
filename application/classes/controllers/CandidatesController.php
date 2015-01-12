<?php

class CandidatesController extends BaseController {
    public $candidatesModel;
    
    public function __construct() {
        parent::__construct();
        
        $this->candidatesModel = new Candidate;
    }
    
    public function action_index() {
        $candidates = $this->candidatesModel->retrieveAll();
        
        $this->printJsonOrFail($candidates);
    }
    
    public function action_view($id) {
        $candidate = $this->candidatesModel->retrieveById($id);
        
        $this->printJsonOrFail($candidate, 'Candidate not found');
    }
    
    public function action_viewWithJobs($id) {
        $candidate = $this->candidatesModel->retrieveById($id);
        
        if (! $candidate) {
            throw new HttpError('Candidate not found', 400);
        }
        
        $jobs = $this->candidatesModel->retrieveJobs($id);
        $candidate->jobs = $jobs;
        $this->printJsonOrFail($candidate);
    }
}
