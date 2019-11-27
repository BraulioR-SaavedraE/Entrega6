create database id11511314_entrega6;

CREATE USER 'id11511314_dogspott'@'localhost' IDENTIFIED BY 'Entrar567';
GRANT ALL PRIVILEGES ON *.* TO 'id11511314_dogspott'@'localhost' IDENTIFIED BY 'Entrar567*';
use id11511314_entrega6;

select * from user;

drop table if exists dog;
create table dog(
    idDog int(3) not null primary key,
    name varchar(100) not null,
    image varchar(500) not null,
    likes int(6) not null
)ENGINE=InnoDB;
select * from dog;

drop table if exists feed;
create table feed(
    idFeed int(3) not null primary key,
    idDog int(3) not null,
    idUser int(3) not null,
    date datetime not null,
    text varchar(500) not null,
    foreign key(idDog) references dog(idDog) on delete cascade on update cascade,
    foreign key(idUser) references user(idUser) on delete cascade on update cascade
)ENGINE=InnoDB;

drop table if exists user;
create table user(
    idUser int(3) not null primary key,
    username varchar(20) not null,
    password varchar(100) not null
)ENGINE=InnoDB;

drop procedure if exists sp_signup;
delimiter qwe
create procedure sp_signup(in us varchar(20), in pas varchar(100))
sp: begin
    declare idU int;
    if exists (select * from user where username = us) then
        select 'this username has been used' as msj;
        leave sp;
    end if;
    set idU = (select ifnull(max(idUser),0) + 1 from user);
    insert into user value(idU, us, pas);
    select 'ok' as msj;
end; qwe
delimiter ;

drop procedure if exists sp_auth;
delimiter qwe
create procedure sp_auth(in ky varchar(100))
begin
	if exists (select * from user where sha2(concat(username, password), 256) = ky) then
		select idUser as id from user where sha2(concat(username, password), 256) = ky;
	else
		select 0 as id;
	end if;
end; qwe
delimiter ;
