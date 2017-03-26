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

# PROCEDURES

delimiter $$
create or replace procedure sp_setUser(
	in _name varchar(40),
    in _lastName varchar(40),
    in _email varchar(60),
    in _password varchar(30),
    in _phoneNumber varchar(15),
    in _birthDate date,
    in _avatar varchar(100),
    in _cover varchar(100),
    in _fk_idType int unsigned
)
begin
	if not exists (select email from nl_user where email = _email) then
	insert into nl_user set
		name = _name,
        lastName = _lastName,
        email = _email,
        password = _password,
        phoneNumber = _phoneNumber,
        birthDate = _birthDate,
        avatar = _avatar,
		cover = _cover,
		fk_idType = _fk_idType;
	else 
    update nl_user set
		name = _name,
        lastName = _lastName,
        password = _password,
        phoneNumber = _phoneNumber,
        birthDate = _birthDate,
        avatar = _avatar,
		cover = _cover,
		fk_idType = _fk_idType
	where email = _email;
    end if;
end$$
delimiter ;

delimiter $$
create or replace procedure sp_getUser(
	in _idUser int unsigned
)
begin
	select name, lastName, email, password, phoneNumber, birthDate, avatar, cover, fk_idType from nl_user where idUser = _idUser;
end$$
delimiter ;

delimiter $$
create or replace procedure sp_dropUser(
	in _idUser int unsigned
)
begin
	delete from nl_user where idUser = _idUser;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_setSection(
	in _sectionName varchar(20),
    in _sectionDescription varchar(150)
)
begin
	if not exists (select sectionName from nl_section where sectionName = _sectionName) then
    insert into nl_section set
		sectionName = _sectionName,
        sectionDescription = _sectionDescription;
	end if;
end$$
delimiter ;

delimiter $$
create or replace procedure sp_getSection(
	in _idSection int unsigned
)
begin
	select sectionName, sectionDescription from nl_section where idSection = _idSection;
end$$
delimiter ;

delimiter $$
create or replace procedure sp_dropSection(
	in _idSection int unsigned
)
begin
	delete from nl_section where idSection = _idSection;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_setNews(
	in _title varchar(100),
	in _description varchar(255),
	in _content text,
	in _fk_idUser int unsigned,
	in _fk_idSection int unsigned,
    in _fk_idStyle int unsigned
)
begin
	insert into nl_news set
		title = _title,
        description = _description,
        content = _content,
        fk_idUser = _fk_idUser,
        fk_idSection = _fk_idSection,
        fk_idStyle = _fk_idStyle;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getNews(
	in _idNews int unsigned
)
begin
	declare _status bit(1);
    select state into _status from nl_news where idNews = _idNews;
    if(_status = 1) then
		select title, description, content, releaseDate from nl_news where idNews = _idNews;
	end if;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getRecentNews()
begin
	select idNews, title, description, content, state, releaseDate, fk_idUser, fk_idSection, fk_idStyle 
    from nl_news order by idNews desc limit 30;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getSectionNews(
	in _idSection int unsigned
)
begin
	select title, description, content, fk_idSection from nl_news
	left outer join nl_section on fk_idSection = _idSection
	order by idNews desc limit 30;
end $$
delimiter ;
	
)

#TRIGGERS

delimiter $$
create or replace trigger tg_deleteNewsReferencesSection before delete on nl_section 
for each row begin
	delete from nl_news where fk_idSection = old.idSection;
end $$
delimiter ;	

delimiter $$
create or replace trigger tg_deleteNewsReferencesUser before delete on nl_user 
for each row begin
	delete from nl_news where fk_idUser = old.idUser;
end $$
delimiter ;	

#VIEWS

insert into nl_type(typeName, typeDescription) values
('Administrador','Es el usuario base, el que maneja todo.'),
('Reportero','Este usuario tiene ciertos privilegios, como escribir noticias.'),
('Registrado','Puede opinar libremente en el sitio web.'),
('Anonimo','Solo se tiene registro de que existe');

insert into nl_style(styleName, styleDescription) values
('Prueba','Elemento de prueba.');

call sp_setUser('Juan Gerardo','Soriano Soto','gerardosoriano97@gmail.com','','8282810966',now(),'','',1);
#call sp_getUser(1);
#call sp_dropUser(1);
call sp_setSection('Deportes','Noticias de deportes');
#call sp_getSection(1);
#call sp_dropSection(1);
call sp_setNews('Primer noticia','Sorprendente avance en el proyecto final', 'El día de hoy, un alumno sorprendio a mucha gente al poder insertar su primer noticia.',1,1,1);
call sp_setNews('Segunda noticia','Sorprendente avance en el proyecto final', 'El día de hoy, un alumno sorprendio a mucha gente al poder insertar su primer noticia.',1,1,1);
call sp_setNews('Tercera noticia','Sorprendente avance en el proyecto final', 'El día de hoy, un alumno sorprendio a mucha gente al poder insertar su primer noticia.',1,1,1);
call sp_setNews('Cuarta noticia','Sorprendente avance en el proyecto final', 'El día de hoy, un alumno sorprendio a mucha gente al poder insertar su primer noticia.',1,1,1);
call sp_getNews(1);
call sp_getRecentNews();
call sp_getSectionNews(1);