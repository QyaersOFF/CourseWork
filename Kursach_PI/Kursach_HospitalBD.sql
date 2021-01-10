DROP DATABASE hospital_tech;
CREATE DATABASE hospital_tech;
USE hospital_tech;
CREATE TABLE Doctor(
    id_doctor INT NOT NULL DEFAULT '1' PRIMARY KEY,
    id_d_u int,
    id_work_h int
);
CREATE TABLE user_t (
id_u int primary key auto_increment,
login_u varchar(30),
password_u varchar(80),
email varchar(30),
users_hash varchar(80),
privelegy_u varchar(30) default "user"
);
CREATE TABLE work_h(
id_h INT NOT NULL DEFAULT '1' PRIMARY KEY,
id_dockor_t int,
work_h varchar(30)
);
CREATE TABLE list_p(
id INT NOT NULL DEFAULT '1' PRIMARY KEY,
id_u_l int,
id_doc int,
id_p_wh int
);

ALTER TABLE Doctor ADD CONSTRAINT FK_d1 FOREIGN KEY Doctor(id_d_u) REFERENCES user_t(id_u);
ALTER TABLE Doctor ADD CONSTRAINT Fk_d2  FOREIGN KEY Doctor(id_work_h) REFERENCES work_h(id_h);
ALTER TABLE list_p ADD CONSTRAINT Fk_p1 FOREIGN KEY list_p(id_u_l) REFERENCES user_t(id_u); 
ALTER TABLE list_p  ADD CONSTRAINT Fk_p2 FOREIGN KEY list_p (id_doc) REFERENCES Doctor(id_doctor);
ALTER TABLE list_p ADD CONSTRAINT Fk_p3 FOREIGN KEY list_p(id_p_wh) REFERENCES work_h(id_h);  

INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (1,2,'8:30');
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (2,2,'9:30'); 
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (3,3,'10:30'); 
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (4,3,'11:30'); 
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (5,4,'12:30'); 
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (6,4,'13:30');
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (7,5,'14:30');
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (8,5,'15:30');
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (9,6,'16:30');
 
INSERT INTO work_h (id_h,id_dockor_t,work_h) VALUES (10,6,'17:30');


insert into doctor (id_doctor,id_d_u,id_work_h) values (1,2,1);
 
insert into doctor (id_doctor,id_d_u,id_work_h) values (2,2,2);
 
insert into doctor (id_doctor,id_d_u,id_work_h) values (3,3,3);
 
insert into doctor (id_doctor,id_d_u,id_work_h) values (4,3,4);
 
insert into doctor (id_doctor,id_d_u,id_work_h) values (5,4,5);
 
insert into doctor (id_doctor,id_d_u,id_work_h) values (6,4,6);
 
insert into doctor (id_doctor,id_d_u,id_work_h) values (7,5,7);
 
insert into doctor (id_doctor,id_d_u,id_work_h) values (8,5,8);

insert into list_p (id,id_doc,id_p_wh) values (1,2,1);
 
insert into list_p (id,id_doc) values (2,2,2);
 
insert into list_p (id,id_doc) values (3,3,3);
 
insert into list_p (id,id_doc) values (4,3,4);
 
insert into list_p (id,id_doc) values (5,4,5);
 
insert into list_p (id,id_doc) values (6,4,6);
 
insert into list_p (id,id_doc) values (7,5,7);
 
insert into list_p (id,id_doc) values (8,5,8);
 
insert into list_p (id,id_doc) values (9,6,9);
 
insert into list_p (id,id_doc) values (10,6,10);
