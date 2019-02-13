CREATE TABLE ADMIN AS 
SELECT emp_no id, substr(first_name,1,8) username, substr(last_name,1,8) passcode
FROM employees;

ALTER TABLE ADMIN ADD CONSTRAINT pk_admin PRIMARY KEY(id);