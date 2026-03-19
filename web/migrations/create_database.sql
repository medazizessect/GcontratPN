-- SQL Script to create admin user in database
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$V7LQ5byhIz3VVPmcmzCG.eUoneSu4cBr22Qrv0sYbIOszHRQY7rFC');
-- In the above line, replace the password hash with the correct bcrypt hash for 'admin123'