<?php // Routes

// You can set your routes in the routes array in following form
// 'urlRegexPattern' => 'Controller@action:params'
//
// Example:
//  '#users#ui' => 'Users@index'
//      (maps /users/ to action_index method in UsersController class)
//  '#users/(\d+)#ui' => 'Users@view'
//      (maps /users/{id} to 'action_view method in UsersController class,
//          which excepts 1 argument (the numeric id from the url))
//  '#jobs/(\d+)/users/(\d+)#ui' => 'Jobs@viewUser'
//      (maps /jobs/{job_id}/users/{user_id} to action_viewUser method
//          in JobsController class with 2 arguments from url)

// TODO: factor out regexp bounds
// Routes array
return array(
    '#^jobs$#ui'       => 'Jobs@index',
    '#^jobs/(\d+)$#ui' => 'Jobs@view',
    '#^jobs/(\d+)/candidates$#ui' => 'Jobs@viewWithCandidates',
    '#^candidates$#ui' => 'Candidates@index',
    '#^candidates/(\d+)$#ui' => 'Candidates@view',
    '#^candidates/(\d+)/jobs$#ui' => 'Candidates@viewWithJobs',
);
