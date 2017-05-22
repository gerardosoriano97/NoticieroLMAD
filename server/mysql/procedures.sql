#PROCEDURES

/*User procedures*/

delimiter $$
create or replace procedure sp_getAllUsers()
begin
	select idUser, name, lastName, email, fn_decrypt(password), phoneNumber, birthDate, avatar, mimeAvatar, cover, mimeCover, type 
    from nl_user order by idUser asc;
end$$
delimiter ;

delimiter $$
create or replace procedure sp_setUser(
	in _name varchar(40),
    in _lastName varchar(40),
    in _email varchar(60),
    in _password varchar(255),
    in _phoneNumber varchar(15),
    in _birthDate date,
    in _type int unsigned
)
begin
	if not exists (select email from nl_user where email = _email) then
	insert into nl_user set
		name = _name,
        lastName = _lastName,
        email = _email,
        password = fn_encrypt(_password),
        phoneNumber = _phoneNumber,
        birthDate = _birthDate,
		type = _type;
	else 
    update nl_user set
		name = _name,
        lastName = _lastName,
        password = fn_encrypt(_password),
        phoneNumber = _phoneNumber,
        birthDate = _birthDate,
		type = _type
	where email = _email;
    end if;
end$$
delimiter ;

delimiter $$
create or replace procedure sp_updateAvatar(
	in _idUser int unsigned,
	in _avatar blob,
    in _mimeAvatar varchar(30)
)
begin
	update nl_user set
		avatar = _avatar,
        mimeAvatar = _mimeAvatar
	where idUser = _idUser;
end$$
delimiter ;

delimiter $$
create or replace procedure sp_updateCover(
	in _idUser int unsigned,
	in _cover blob,
    in _mimeCover varchar(30)
)
begin
	update nl_user set
		cover = _cover,
        mimeCover = _mimeCover
	where idUser = _idUser;
end$$
delimiter ;

delimiter $$
create or replace procedure sp_getUser(
	in _idUser int unsigned
)
begin
	select name, lastName, email, fn_decrypt(password) as password, phoneNumber, birthDate, avatar, mimeAvatar, cover, mimeCover, type 
    from nl_user where idUser = _idUser;
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
create or replace procedure sp_login(
	in _email varchar(60),
    in _password varchar(255)
)
begin
	select idUser, fn_fullname(name, lastName) as fullname, name, lastName, email, phoneNumber, birthDate, avatar, mimeAvatar, cover, mimeCover, type
    from nl_user where email = _email and password = fn_encrypt(_password);
end $$
delimiter ;

/*Section procedures*/

delimiter $$
create or replace procedure sp_getAllSections()
begin
	select idSection, sectionName, sectionDescription from nl_section;
end$$
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

/*News procedures*/

delimiter $$
create or replace procedure sp_setNews(
	in _id int unsigned,
	in _title varchar(100),
	in _description varchar(255),
	in _content text,
	in _fk_idUser int unsigned,
	in _fk_idSection int unsigned,
    in _fk_idStyle int unsigned
)
begin
	if _id = 0 then
	insert into nl_news set
		title = _title,
        description = _description,
        content = _content,
        fk_idUser = _fk_idUser,
        fk_idSection = _fk_idSection,
        fk_idStyle = _fk_idStyle;
	else
    update nl_news set
		title = _title,
        description = _description,
        content = _content,
        fk_idUser = _fk_idUser,
        fk_idSection = _fk_idSection,
        fk_idStyle = _fk_idStyle
	where id = _id;
    end if;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getNews(
	in _idNews int unsigned
)
begin
	select title, description, content, fn_hoursAgo(releaseDate) as hours, releaseDate, 
			idUser, fn_fullname(name, lastName) as fullname, avatar, mimeAvatar,
            idSection, sectionName 
            from vw_newsInfo where idNews = _idNews;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getRecentNews(
	in _style enum('destacada','normal'),
    in _start int unsigned
)
begin
	select idNews,title,description, style, fn_hoursAgo(releaseDate) as hours, releaseDate,
			idUser, fn_fullname(name, lastName) as fullname, avatar, mimeAvatar,
			idSection,sectionName
    from vw_newsInfo 
    where state = 1 and style = _style
    order by idNews desc limit _start, 15;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getRecentNewsBySection(
	in _idSection int unsigned,
    in _style enum('destacada','normal'),
    in _start int unsigned
)
begin
	select idNews,title,description, style, fn_hoursAgo(releaseDate) as hours, releaseDate,
			idUser, fn_fullname(name, lastName) as fullname, avatar, mimeAvatar,
			idSection,sectionName
    from vw_newsInfo 
    where state = 1 and idSection = _idSection and style = _style
    order by idNews desc limit _start, 15;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getAllNews()
begin
	select idNews,title,description,content,idSection,sectionName,idStyle,styleName 
    from vw_newsByUser order by idNews desc;
end $$
delimiter ;

/*Comment procedures*/
delimiter $$
create or replace procedure sp_setComment(
	in _comment varchar(255),
    in _fk_idUser int unsigned,
    in _fk_idNews int unsigned,
    in _fk_idComment int unsigned
)
begin
	insert into nl_comment set
		comment = _comment,
        fk_idUser = _fk_idUser,
        fk_idNews = _fk_idNews,
        fk_idComment = _fk_idComment;
end $$
delimiter ; 

delimiter $$
create or replace procedure sp_getCommentInNews(
	in _idNews int unsigned
)
begin
	select fn_fullname(namePattern,lastNamePattern) as fullname, avatarPattern, mimeAvatarPattern, idCommentPattern,commentPattern,publicationPattern
    from vw_commentInNews where idNews = _idNews order by publicationPattern desc;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getCommentInComment(
	in _idCommentPattern int unsigned
)
begin
	select fn_fullname(nameChild,lastNameChild) as fullname, avatarChild, mimeAvatarChild, idCommentChild,commentChild,publicationChild
    from vw_commentInComment where idCommentPattern = _idCommentPattern order by publicationChild desc;
end $$
delimiter ;

/*Multimedia in news*/
delimiter $$
create or replace procedure sp_getMultimediaByNews(
	in _idNews int unsigned
)
begin
	select idNews, idMultimedia, path, description, type from vw_multimediaInNews where idNews = _idNews;
end$$
delimiter ;