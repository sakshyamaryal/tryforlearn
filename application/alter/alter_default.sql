ALTER TABLE contentfile ADD only_for_app CHARACTER(1) DEFAULT 'N';

ALTER TABLE vouchercode ADD for_gender CHARACTER(1) DEFAULT 'N';

ALTER TABLE vouchercode ADD for_disabled CHARACTER(1) DEFAULT 'N';

ALTER TABLE users ADD gender CHARACTER(1);

ALTER TABLE users ADD is_differently_abled CHARACTER(1) DEFAULT 'N';

ALTER TABLE users ADD is_disability_approved CHARACTER(1) DEFAULT 'N';

ALTER TABLE user_information ADD user_verification_file VARCHAR(255);

ALTER TABLE datasetmain ADD subject_id INT(11) NOT NULL, ADD class_id INT(11) NOT NULL, ADD `order` INT(11) NOT NULL;

ALTER TABLE datasetmain ADD guideline JSON;

ALTER TABLE datasetmain DROP COLUMN guideline;
ALTER TABLE datasetmain ADD guideline TEXT;
ALTER TABLE datasetmain 
ADD COLUMN time_period INT(11) NOT NULL DEFAULT 0;

ALTER TABLE social_media ADD is_active TINYINT(1) NOT NULL DEFAULT 1;
ALTER TABLE social_media ADD `order` INT NOT NULL DEFAULT 0;

ALTER TABLE vouchercode
ADD COLUMN no_of_times_used INT DEFAULT 0,
ADD COLUMN used_username JSON;

ALTER TABLE `vouchercode` 
MODIFY COLUMN `no_of_times_used` INT(11) NOT NULL DEFAULT 0;