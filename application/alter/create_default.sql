CREATE TABLE `tryforlearn`.`blogs` (`blog_id` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `content` TEXT NOT NULL , `image` VARCHAR(255) NOT NULL , `is_active` BOOLEAN NOT NULL , `created_by` VARCHAR(11) NOT NULL , `updated_by` INT(11) NOT NULL , `created_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`blog_id`)) ENGINE = InnoDB;

CREATE TABLE dataset_question (
    db_q_id INT AUTO_INCREMENT PRIMARY KEY,
    setid INT NOT NULL,
    class_id INT NOT NULL,
    subject_id INT NOT NULL,
    eid INT NOT NULL
);
