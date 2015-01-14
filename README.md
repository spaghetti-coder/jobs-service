# jobs-service

###Installation instructions

 * Set public directory as a document root (i.e. leave application directory outside of document root)
   * If you change application directory position relatively to public/index.php, then update $appDir path in index.php as well, because the entry point should know where the application resides
   * application is not necessarily need to be outside of document root but it's a good precaution against direct access to the code files
 * Create a database and import sql dump from assets/db.sql
 * Change db access credentials to yours in application/config/db.php

###API

* /jobs - list all jobs
* /jobs/{id} - view a job with the id supplied
* /candidates - list all candidates
* /candidates?id={id} - search by id (can be extended later to except more search criteria)
* /candidates/{id} - view a candidate with the id supplied
* /jobs/{id}/candidates - view a job with the id supplies with all candidates for this job
* /candidates/{id}/jobs - view a candidate with the id supplies with all jobs for this candidate

###Errors

HTTP status codes list:

* 404 - Not Found. This means the URL you've entered is not valid
* 500 - Internal server error. It denotes a server error
* 400 - {Entry} not found. This means that the entry could be there, but it's not. For example /jobs/99999 (in case there is no job with such id) will produce this error

Along with this status code you receive a json, that contains an appropriate message
{"error" : "{error-text}"}
