CREATE TABLE IF NOT EXISTS approver_user_role (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  type ENUM('user','group','department') DEFAULT 'user',
  sl INT DEFAULT 0,
  status TINYINT(1) DEFAULT 1,
  remarks VARCHAR(255) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS approval_role_manage (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  role_id INT NOT NULL,
  role_type ENUM('approver','reviewer','verifier') DEFAULT 'approver',
  access_forward INT DEFAULT NULL,
  access_backward INT DEFAULT NULL,
  INDEX idx_role (role_id),
  FOREIGN KEY (role_id) REFERENCES approver_user_role(id) ON DELETE CASCADE
);
