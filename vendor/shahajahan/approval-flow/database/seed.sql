INSERT INTO approver_user_role (name,type,sl,status,remarks) VALUES
('Admin','user',1,1,'Administrator role'),
('Manager','user',2,1,'Manager role'),
('Reviewer','user',3,1,'Reviewer role');

INSERT INTO approval_role_manage (user_id,role_id,role_type,access_forward,access_backward) VALUES
(1,1,'approver',2,NULL),
(2,2,'approver',3,1),
(3,3,'reviewer',NULL,2);
