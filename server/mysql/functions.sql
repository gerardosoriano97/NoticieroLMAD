#FUNCTIONS

delimiter $$
create or replace function fn_fullname(
	_name varchar(40),
    _lastName varchar(40)
)
returns varchar(80)
begin
	return CONCAT(_name, " ", _lastName);
end$$
delimiter ;

delimiter $$
create or replace function fn_encrypt(
	_password varchar(255)
)
returns varchar(255)
begin
	return AES_ENCRYPT(_password, UNHEX(SHA2('fakenews rules',512)));
end$$
delimiter ;

delimiter $$
create or replace function fn_decrypt(
	_password varchar(255)
)
returns varchar(255)
begin
	return AES_DECRYPT(_password, UNHEX(SHA2('fakenews rules',512)));
end$$
delimiter ;

delimiter $$
create or replace function fn_hoursAgo(
	_releaseDate date
)
returns int
begin
	return TIMESTAMPDIFF(hour, _releaseDate, NOW());
end$$
delimiter ;

delimiter $$
create or replace function fn_yearsOld(
	_birthDate date
)
returns int
begin
	return TIMESTAMPDIFF(year, _birthDate, NOW());
end$$
delimiter ;
delimiter $$
create or replace function fn_getLastIdUser(
	_email varchar(60)
)
returns int
begin
	declare _idUser int default 0;
    
    if not exists (select idUser from nl_user where email = _email) then
		select idUser into _idUser from nl_user order by idUser desc limit 1;
    else
		select idUser into _idUser from nl_user where email = _email;
	end if;
    
    return _idUser;
end$$
delimiter ;
