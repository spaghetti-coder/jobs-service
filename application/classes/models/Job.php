<?php

class Job extends BaseModel {
    public function getPK() {
        return 'id';
    }

    public function getTableName() {
        return 'jobs';
    }
}
