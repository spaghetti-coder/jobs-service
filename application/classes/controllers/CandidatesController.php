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
}
