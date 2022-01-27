
DROP DATABASE test_task;
CREATE DATABASE test_task;
USE test_task;

CREATE TABLE positions
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	code VARCHAR(32) UNIQUE NOT NULL
);

CREATE TABLE salary_method
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	code VARCHAR(32) UNIQUE NOT NULL
);

CREATE TABLE persons
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	name VARCHAR(255) NOT NULL,
	phone BIGINT NOT NULL UNIQUE,
	telegram VARCHAR(32) NOT NULL UNIQUE,
	id_position INT,
	id_salary_method INT,
	id_manager INT,
	FOREIGN KEY (id_position) REFERENCES positions (id) ON DELETE SET NULL,
	FOREIGN KEY (id_salary_method) REFERENCES salary_method (id) ON DELETE SET NULL,
	FOREIGN KEY (id_manager) REFERENCES persons (id) ON DELETE SET NULL
);

CREATE VIEW persons_with_codes AS
    SELECT
        persons.id,
        persons.name,
        persons.phone,
        persons.telegram,
        persons.id_manager,
        positions.code AS position_code,
        salary_method.code AS salary_method_code
    FROM persons, salary_method, positions
    WHERE persons.id_position = positions.id
        AND persons.id_salary_method = salary_method.id;
