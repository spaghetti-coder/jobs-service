<?php // Routes

// You can set your routes in the routes array in following form
// 'urlRegexPattern' => 'Controller@action:params'
//
// Example:
//  'users' => 'Users@index'
//      (maps /users/ to action_index method in UsersController class)
//  'users/(\d+)' => 'Users@view'
//      (maps /users/{id} to 'action_view method in UsersController class,
//          which excepts 1 argument (the numeric id from the url))
//  'jobs/(\d+)/users/(\d+)' => 'Jobs@viewUser'
//      (maps /jobs/{job_id}/users/{user_id} to action_viewUser method
//          in JobsController class with 2 arguments from url)

// Routes array
return array(
    'jobs'       => 'Jobs@index',
    'jobs/(\d+)' => 'Jobs@view',
    'jobs/(\d+)/candidates' => 'Jobs@viewWithCandidates',
    'candidates' => 'Candidates@index',
    'candidates/(\d+)' => 'Candidates@view',
    'candidates/(\d+)/jobs' => 'Candidates@viewWithJobs',
);
