DROP DATABASE IF EXISTS quick_bite;
DROP USER IF EXISTS `quick_bite_admin`@`%`;
DROP USER IF EXISTS `quick_bite_admin`@`%`;
CREATE DATABASE IF NOT EXISTS quick_bite CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS `quick_bite_admin`@`%` IDENTIFIED WITH mysql_native_password BY 'password';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, REFERENCES, INDEX, ALTER, EXECUTE, CREATE VIEW, SHOW VIEW
 ON `quick_bite`.* TO `quick_bite_admin`@`%`;
FLUSH PRIVILEGES;
