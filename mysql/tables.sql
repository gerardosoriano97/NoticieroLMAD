create database noticiero_lmad;

use noticiero_lmad;

create table nl_type(
idType int unsigned not null auto_increment,
typeName varchar(20) not null,
typeDescription varchar(150),
primary key(idType)
);

create table nl_user(
idUser int unsigned not null auto_increment,
name varchar(40) not null,
lastName varchar(40) not null,
email varchar(60) not null,
password varchar(30), 
phoneNumber varchar(15),
birthDate date,
avatar varchar(100),
cover varchar(100),
fk_idType int unsigned not null,
primary key(idUser),
foreign key(fk_idType) references nl_type(idType)
);

create table nl_section(
idSection int unsigned not null auto_increment,
sectionName varchar(20) not null,
sectionDescription varchar(150),
primary key(idSection)
);

create table nl_style(
idStyle int unsigned not null auto_increment,
styleName varchar(20) not null,
styleDescription varchar(150),
primary key(idStyle)
);

create table nl_news(
idNews int unsigned not null auto_increment,
title varchar(100) not null,
description varchar(255) not null,
content text not null,
state bit(1) not null default 0,
releaseDate datetime,
fk_idUser int unsigned not null,
fk_idSection int unsigned not null,
fk_idStyle int unsigned not null,
primary key(idNews),
foreign key(fk_idUser) references nl_user(idUser),
foreign key(fk_idSection) references nl_section(idSection),
foreign key(fk_idStyle) references nl_style(idStyle)
);

create table nl_comment(
idComment int unsigned not null auto_increment,
comment varchar(255) not null,
publication timestamp not null,
fk_idUser int unsigned not null,
fk_idNews int unsigned not null,
fk_idComment int unsigned,
primary key(idComment),
foreign key(fk_idUser) references nl_user(idUser),
foreign key(fk_idNews) references nl_news(idNews),
foreign key(fk_idComment) references nl_comment(idComment)
);

create table nl_multimedia(
idMultimedia int unsigned not null auto_increment,
path varchar(255) not null,
description varchar(255) not null,
type decimal(1) not null,
fk_idNews int unsigned not null,
primary key(idMultimedia),
foreign key(fk_idNews) references nl_news(idNews)
);

create table nl_like(
idLike int unsigned not null auto_increment,
fk_idUser int unsigned not null,
fk_idNews int unsigned not null,
primary key(idLike),
foreign key(fk_idUser) references nl_user(idUser),
foreign key(fk_idNews) references nl_news(idNews)
);
