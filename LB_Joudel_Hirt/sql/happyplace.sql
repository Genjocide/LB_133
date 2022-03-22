/* create user and admin
   use drop to delete users
*/
drop user if exists 'admin'@'localhost';
drop user if exists 'user'@'localhost';
create user 'admin'@'localhost' identified by 'admin_password';
create user 'user'@'localhost' identified by 'user_password';

/* grant for admin all, for user only select and update for all databases */
grant all on *.* to 'admin'@'localhost' identified by 'admin_password';
grant select on *.* to 'user'@'localhost' identified by 'user_password';

/* create database if not exist and use it */
drop database if exists happyplace;
create database happyplace;

use happyplace;

/* create user table */
drop table if exists users;
create table users (
                      id integer unique auto_increment not null,
                      name varchar(60),
                      firstname varchar(60),
                      email varchar(60) unique not null,
                      password varchar(60) not null,
                      user_type boolean not null default false,
                      primary key (id)
);

/* insert standart Admin */
insert into user (name, firstname, email, password, user_type)
values ('Boss',
        'Joudel',
        'admin@admin.ch',
        '$2y$10$9VBF44QiAZ8hI9xg2.UBJuxlZ8x5xi9mJH7L3ceLWyJFbaO3YtJSC',
        true);

insert into user (name, firstname, email, password, user_type)
values ('User',
        'Jasmin',
        'user@user.ch',
        '$2y$10$3h683CM/tfgO/wDc8j91YOM6AkDfxtSxaAWP5DLZuCobQpJ7iLmHW',
        true);

/* create place table */
drop table if exists place;
create table place (
                       id integer unique auto_increment not null,
                       name varchar(255),
                       latitude varchar(255) not null,
                       longitude varchar(255) not null,
                       primary key (id)
);

/* fill place */
load data local infile 'C:\\xampp\\htdocs\\happyplace_LB\\documents\\locations.csv' into table place
    fields terminated by ',' lines terminated by '\n'
    ignore 1 lines
    (@col1,@col2, @col3, @col4) set name=@col2, latitude=@col3, longitude=@col4;
/* create student with foreign key to place*/
drop table if exists student;
create table student (
                         id integer unique auto_increment not null,
                         name varchar(60),
                         firstname varchar(60),
                         zip integer not null,
                         primary key (id),
                         foreign key (zip) references place (id)
);

/* fill student */
insert into student (name, firstname, zip) values ('ming','long',1);
insert into student (name, firstname, zip) values ('yilmaz','eril',1);
insert into student (name, firstname, zip) values ('wittwer','morice',2);
insert into student (name, firstname, zip) values ('mustero','max',2);

/* fill user */
insert into user (name, firstname, email, password, user_type) values ('admin',
                                                                      'Joudel',
                                                                      'admin@admin.ch',
                                                                      'passwort', true);

