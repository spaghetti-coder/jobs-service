SET NAMES 'utf8';

DROP TABLE IF EXISTS jobs;
CREATE TABLE jobs (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  position VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS candidates;
CREATE TABLE candidates (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  job_id INT(10) UNSIGNED NOT NULL,
  name VARCHAR(50) NOT NULL,
  created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT FK_candidates_jobs_id FOREIGN KEY (job_id)
    REFERENCES jobs(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

INSERT INTO jobs VALUES
(1, 'Programmer', 'Responsibilities:\r\n\r\n* Development of different Internet and Intranet web applications\r\n* Follow specification or written description\r\n* Meeting productivity standards, completion of work in timely manner\r\n* Ability to establish and maintain satisfactory working relationships with co-workers\r\n* Willingness to further develop his/her design skills and technical knowledge', '2015-01-11 22:45:39'),
(2, 'Web-Designer', '* HTML5\r\n* CSS3\r\n* JS / jQuery / Ajax / JSON\r\n* Slice PSD designs and transform them into working websites\r\n* Responsive websites\r\n* Good working habits\r\n* English (verbal and written)', '2015-01-11 22:47:50');

INSERT INTO candidates VALUES
(1, 1, 'Donald Duck', '2015-01-11 22:48:13'),
(2, 1, 'Goofy', '2015-01-11 22:48:21'),
(3, 2, 'Професор Ксавие', '2015-01-11 22:50:10'),
(4, 1, 'Spaghetti Coder', '2015-01-11 22:50:30');

