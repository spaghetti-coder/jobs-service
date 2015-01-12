<?php

class Candidate extends BaseModel {
    public function getPK() {
        return 'id';
    }

    public function getTableName() {
        return 'candidates';
    }
}
