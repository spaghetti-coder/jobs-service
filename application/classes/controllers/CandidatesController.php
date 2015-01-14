<?php

class CandidatesController extends BaseController {
    public $candidatesModel;
    
    public function __construct() {
        parent::__construct();
        
        $this->candidatesModel = new Candidate;
    }
    
    public function action_index() {
        $criteria = '1 = 1';
        $params = array();
        
        // If there is an integer id get params,
        // add filtering by id
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $criteria .= ' AND id = :id';
            $params['id'] = $id;
        }
        
        $candidates = $this->candidatesModel->findByCriteria($criteria, $params);
        
        $this->printJsonOrFail($candidates);
    }
    
    public function action_view($id) {
        $candidate = $this->candidatesModel->findById($id);
        
        $this->printJsonOrFail($candidate, 'Candidate not found');
    }
    
    public function action_viewWithJobs($id) {
        $candidate = $this->candidatesModel->findById($id);
        
        if (! $candidate) {
            throw new HttpError('Candidate not found', 400);
        }
        
        $jobs = $this->candidatesModel->findJobs($id);
        $candidate->jobs = $jobs;
        $this->printJsonOrFail($candidate);
    }
}
