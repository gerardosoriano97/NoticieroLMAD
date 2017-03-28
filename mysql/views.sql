#VIEWS

create or replace view vw_newsByUser as
select idUser, idNews, name, laSstName, title, description, content, state, releaseDate
from nl_user
inner join nl_news on fk_idUser = idUser
order by idUser desc, idNews desc;

create or replace view vw_commentInNews as
select 
	idNews,
    tbU.idUser as idUserPattern,
    tbU.name as namePattern,
    tbU.lastName as lastNamePattern,
    tbC.idComment as idCommentPattern, 
    tbC.comment as commentPattern, 
    tbC.publication as publicactionPatter
from nl_comment as tbC
inner join nl_news on tbC.fk_idNews = idNews
inner join nl_user as tbU on tbC.fk_idUser = idUser
where tbC.fk_idComment is null;

create or replace view vw_commentInComment as
select
	tbC1.idComment as idCommentPattern,
    tbU.idUser as idUserChild,
    tbU.name as nameChild,
    tbU.lastName as lastNameChild,
    tbC2.idComment as idCommentChild,
	tbC2.comment as commentChild,
    tbC2.publication as publicationChild
from nl_comment as tbC2
inner join nl_comment as tbC1 on tbC2.fk_idComment = tbC1.idComment
inner join nl_user as tbU on tbC2.fk_idUser = tbU.idUser;

create or replace view vw_multimediaInNews as 
select idNews, idMultimedia, path, description, type
from nl_news
inner join nl_multimedia on fk_idNews = idNews
order by idNews desc, idMultimedia desc