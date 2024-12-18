ALTER TABLE contentfile ADD only_for_app CHARACTER(1) DEFAULT 'N';

ALTER TABLE vouchercode ADD for_gender CHARACTER(1) DEFAULT 'N';

ALTER TABLE vouchercode ADD for_disabled CHARACTER(1) DEFAULT 'N';