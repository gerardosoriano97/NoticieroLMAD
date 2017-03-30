#PROCEDURES

/*User procedures*/

delimiter $$
create or replace procedure sp_getAllUsers()
begin
	select idUser, name, lastName, email, password, phoneNumber, birthDate, avatar, cover, fk_idType 
    from nl_user order by idUser asc;
end$$
delimiter ;

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
    select state into _status from vw_newsByUser where idNews = _idNews;
    if(_status = 1) then
		select title, description, content, releaseDate, name, lastName from vw_newsByUser where idNews = _idNews;
	end if;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getRecentNews()
begin
	select idNews,title,description,name,lastName,idSection,sectionName,idStyle,styleName 
    from vw_newsByUser order by idNews desc limit 30;
end $$
delimiter ;

delimiter $$
create or replace procedure sp_getSectionNews(
	in _idSection int unsigned
)
begin
	select idNews,title,description,name,lastName,idStyle,styleName from vw_newsByUser
	where idSection = _idSection order by idNews desc limit 30;
end $$
delimiter ;
*/
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
	select namePattern,lastNamePattern,idCommentPattern,commentPattern,publicationPattern
    from vw_commentInNews where idNews = _idNews order by publicationPattern desc;
end $$
delimiter ;

call sp_getCommentInNews(1);