create database project3;
use project3;
create table Users(
    id int auto_increment not null,
    firstname varchar(25),
    lastname varchar(25),
    username varchar(30),
    password varchar(40),
    passworddigest varchar(50),
    primary key(id)
);
create table Messages(
    id int auto_increment not null,
    recipient_ids int,
    sender_id int,
    subject varchar(50),
    body text not null,
    date_sent timestamp not null,
    primary key(id)
);
create table Message_read(
    id int auto_increment not null,
    message_id int,
    reader_id int,
    date_read timestamp not null,
    primary key (id)
);

    
insert into Users values('000','Fred','Stone','admin',md5('password123'));