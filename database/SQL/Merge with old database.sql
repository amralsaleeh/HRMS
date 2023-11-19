ALTER TABLE employees ADD COLUMN contract_id INT DEFAULT 1;
ALTER TABLE employees ADD COLUMN created_by VARCHAR(255) DEFAULT 'Administrator';
ALTER TABLE employees ADD COLUMN updated_by VARCHAR(255) DEFAULT 'Administrator';

ALTER TABLE employees RENAME COLUMN firstName TO first_name;
ALTER TABLE employees RENAME COLUMN fatherName TO father_name;
ALTER TABLE employees RENAME COLUMN lastName TO last_name;
ALTER TABLE employees RENAME COLUMN motherName TO mother_name;
ALTER TABLE employees RENAME COLUMN birthAndPlace TO birth_and_place;
ALTER TABLE employees RENAME COLUMN nationalNumber TO national_number;
ALTER TABLE employees RENAME COLUMN mobile TO mobile_number;
ALTER TABLE employees RENAME COLUMN vacationCount TO max_leave_allowed;
ALTER TABLE employees RENAME COLUMN hourlyLate TO delay_counter;
ALTER TABLE employees RENAME COLUMN hourlyVac TO hourly_counter;
ALTER TABLE employees RENAME COLUMN isActive TO is_active;

ALTER TABLE employees DROP COLUMN fullName;
ALTER TABLE employees DROP COLUMN startDate;
ALTER TABLE employees DROP COLUMN quitDate;
ALTER TABLE employees DROP COLUMN noPaymentCount;
ALTER TABLE employees DROP COLUMN healthCount;
ALTER TABLE employees DROP COLUMN workingYears;
