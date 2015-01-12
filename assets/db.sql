SET NAMES 'utf8';

DROP TABLE IF EXISTS candidates;
CREATE TABLE candidates (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  position VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX FK_candidates_jobs_id (position)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS jobs;
CREATE TABLE jobs (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  position VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS jobs_to_candidates;
CREATE TABLE jobs_to_candidates (
  job_id INT(10) UNSIGNED NOT NULL,
  candidate_id INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (job_id, candidate_id),
  CONSTRAINT FK_jobs_to_candidates_candidates_id FOREIGN KEY (candidate_id)
    REFERENCES candidates(id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_jobs_to_candidates_jobs_id FOREIGN KEY (job_id)
    REFERENCES jobs(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

INSERT INTO candidates VALUES
(1, 'Web Developer', 'Donald Duck', '2015-01-11 22:48:13'),
(2, 'Senior Web Developer', 'Goofy', '2015-01-11 22:48:21'),
(3, 'Designer', 'Професор Ксавие', '2015-01-11 22:50:10'),
(4, 'Team Leader', 'Spaghetti Coder', '2015-01-11 22:50:30');

INSERT INTO jobs VALUES
(1, 'Programmer', 'Responsibilities:\r\n\r\n* Development of different Internet and Intranet web applications\r\n* Follow specification or written description\r\n* Meeting productivity standards, completion of work in timely manner\r\n* Ability to establish and maintain satisfactory working relationships with co-workers\r\n* Willingness to further develop his/her design skills and technical knowledge', '2015-01-11 22:45:39'),
(2, 'Web-Designer', '* HTML5\r\n* CSS3\r\n* JS / jQuery / Ajax / JSON\r\n* Slice PSD designs and transform them into working websites\r\n* Responsive websites\r\n* Good working habits\r\n* English (verbal and written)', '2015-01-11 22:47:50'),
(3, 'Maintenance', 'Cleaning, washing', '2015-01-12 16:01:20');

INSERT INTO jobs_to_candidates VALUES
(1, 1),
(1, 2),
(2, 3),
(1, 4);
