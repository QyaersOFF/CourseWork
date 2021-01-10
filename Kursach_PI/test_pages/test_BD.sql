DROP DATABASE test_bd;
CREATE DATABASE test_bd;
USE test_bd;
CREATE TABLE user_t (
id_u int primary key auto_increment,
login_u varchar(30),
password_u varchar(80),
email varchar(30),
users_hash varchar(80),
privelegy_u varchar(30) default "user"
);
CREATE TABLE test_l(
id int primary key,
id_u_l int
);
select * from user_t;
select * from test_l;

insert into test_l(id,id_u_l) values(1,1);
insert into test_l(id,id_u_l) values(2,2);
insert into test_l(id,id_u_l) values(3,3);
insert into test_l(id,id_u_l) values(4,4);