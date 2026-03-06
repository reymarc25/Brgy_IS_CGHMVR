-- BMIS transactional and legal modules schema

ALTER TABLE users
    ADD COLUMN role VARCHAR(30) NOT NULL DEFAULT 'staff';

ALTER TABLE residents
    ADD COLUMN household_code VARCHAR(50) NULL,
    ADD COLUMN is_pwd TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN is_solo_parent TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN is_4ps TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN is_voter TINYINT(1) NOT NULL DEFAULT 0;

CREATE TABLE document_requests (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    resident_id BIGINT UNSIGNED NOT NULL,
    document_type VARCHAR(100) NOT NULL,
    purpose VARCHAR(255) NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    or_number VARCHAR(100) NULL,
    amount_paid DECIMAL(10,2) NOT NULL DEFAULT 0,
    payment_date DATE NULL,
    created_by BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_doc_resident FOREIGN KEY (resident_id) REFERENCES residents(id) ON DELETE CASCADE,
    CONSTRAINT fk_doc_user FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE blotter_cases (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    complainant_resident_id BIGINT UNSIGNED NULL,
    respondent_resident_id BIGINT UNSIGNED NULL,
    complainant_name VARCHAR(150) NULL,
    respondent_name VARCHAR(150) NULL,
    witness_name VARCHAR(150) NULL,
    incident_type VARCHAR(100) NOT NULL,
    narrative TEXT NOT NULL,
    status VARCHAR(60) NOT NULL DEFAULT 'Pending',
    incident_date DATE NULL,
    mediation_date DATE NULL,
    created_by BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_blotter_complainant FOREIGN KEY (complainant_resident_id) REFERENCES residents(id) ON DELETE SET NULL,
    CONSTRAINT fk_blotter_respondent FOREIGN KEY (respondent_resident_id) REFERENCES residents(id) ON DELETE SET NULL,
    CONSTRAINT fk_blotter_user FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE aid_distribution_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    resident_id BIGINT UNSIGNED NOT NULL,
    program_name VARCHAR(150) NOT NULL,
    assistance_type VARCHAR(150) NOT NULL,
    quantity DECIMAL(10,2) NOT NULL DEFAULT 1,
    distribution_date DATE NOT NULL,
    remarks TEXT NULL,
    recorded_by BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_aid_resident FOREIGN KEY (resident_id) REFERENCES residents(id) ON DELETE CASCADE,
    CONSTRAINT fk_aid_user FOREIGN KEY (recorded_by) REFERENCES users(id) ON DELETE SET NULL,
    UNIQUE KEY aid_unique_distribution (resident_id, program_name, distribution_date)
);

CREATE TABLE audit_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    action VARCHAR(100) NOT NULL,
    auditable_type VARCHAR(120) NOT NULL,
    auditable_id BIGINT UNSIGNED NULL,
    old_values JSON NULL,
    new_values JSON NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_audit_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);
