#TRIGGERS

#Borramos todas las noticias relacionadas a una sección cuando una sección es borrada
delimiter $$
create or replace trigger tg_deleteNewsReferencesInSection before delete on nl_section 
for each row begin
	delete from nl_news where fk_idSection = old.idSection;
end $$
delimiter ;	
#Borramos todas las noticias relacionadas a un usuario cuando un usuario es borrado
delimiter $$
create or replace trigger tg_deleteNewsReferencesInUser before delete on nl_user 
for each row begin
	delete from nl_news where fk_idUser = old.idUser;
end $$
delimiter ;
#Borramos todas las noticias relacionadas a un estilo cuando un estilo es borrado
delimiter $$
create or replace trigger tg_deleteNewsReferencesInStyle before delete on nl_style 
for each row begin
	delete from nl_news where fk_idStyle = old.idStyle;
end $$
delimiter ;		
#Agregamos un timestamp en cuanto el estado de una noticia cambia de 0 a 1;
delimiter $$
create or replace trigger tg_setReleaseDateOnActivateANew after update on nl_news
begin
	if old.state = 0 and new.state = 1 then
		update into nl_news set
			releaseDate = now();
	end if;
end $$
delimiter ;

insert into nl_news(title, content, description) values ('','','');