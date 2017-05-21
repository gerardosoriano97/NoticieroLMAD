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
#Agregamos un timestamp en cuanto el estado de una noticia cambia de 0 a 1;
delimiter $$
create or replace trigger tg_setReleaseDateOnActivateANew before update on nl_news
for each row begin
	if old.state = 0 and new.state = 1 then
		set new.releaseDate = now();
	end if;
end $$
delimiter ;
#Agregamos un timestamp en cuanto una noticia con estado 1 es insertada;
delimiter $$
create or replace trigger tg_setReleaseDateOnNewActivatedNews before insert on nl_news
for each row begin
	if new.state = 1 then
		set new.releaseDate = now();
	end if;
end $$
delimiter ;
#Borramos todos los comentarios antes de borrar una noticia
delimiter $$
create or replace trigger tg_deleteCommentsReferencesInNews before delete on nl_news
for each row begin
	delete from nl_comment where fk_idNews = old.idNews;
end $$
delimiter ;
