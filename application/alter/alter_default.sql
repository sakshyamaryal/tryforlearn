ALTER TABLE contentfile ADD only_for_app CHARACTER(1) DEFAULT 'N';

ALTER TABLE vouchercode ADD for_gender CHARACTER(1) DEFAULT 'N';

ALTER TABLE vouchercode ADD for_disabled CHARACTER(1) DEFAULT 'N';

ALTER TABLE users ADD gender CHARACTER(1);

ALTER TABLE users ADD is_differently_abled CHARACTER(1) DEFAULT 'N';

ALTER TABLE users ADD is_disability_approved CHARACTER(1) DEFAULT 'N';

ALTER TABLE user_information ADD user_verification_file VARCHAR(255);