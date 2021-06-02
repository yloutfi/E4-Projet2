drop database if exists OkBoomer;
create database OkBoomer;

use OkBoomer;

drop table if exists Membre;

create table Membre
	(idMembre int auto_increment not null,
	prenom varchar (15),
	nom varchar (20),
	pseudonyme varchar (20),
	jourNaissance int,
	moisNaissance int,
	anneeNaissance int,
	email varchar (30),
	mdp varchar (15),
	primary key (idMembre))engine=innodb;

drop table if exists relationMembre;

create table relationMembre
	(idMembreEnvoyeur int not null,
	idMembreReceveur int not null,
	accordMembreEnvoyeur boolean not null,
	accordMembreReceveur boolean not null,	
	primary key (idMembreEnvoyeur,idMembreReceveur))engine=innodb;

alter table relationMembre 
add constraint fk_relationMembre_idMembreEnvoyeur
foreign key (idMembreEnvoyeur) references Membre(idMembre);

alter table relationMembre
add constraint fk_relationMembre_idMembreReceveur
foreign key (idMembreReceveur) references Membre(idMembre);

drop table if exists GenreActivite;
	
create table GenreActivite
	(idGenreActivite int auto_increment not null,
	libelleGenreActivite varchar (30),
	primary key (idGenreActivite))engine=innodb; 
		
drop table if exists Activite;
	
create table Activite
	(idActivite int auto_increment not null,
	idGenreActivite int not null,
	libelleActivite varchar (25),
	lieuActivite varchar (30),
	jour varchar (10),
	horaire time,
	materiel varchar (30),
	dateDebut varchar (30),
	dateFin varchar (30),
	vacancesScolaires (true or false),
	primary key (idActivite))engine=innodb;
	
drop table if exists InscriptionActivite;

create table InscriptionActivite
	(idInscriptionActivite int auto_increment not null,
	idActivite int not null, 
	nom varchar (20),
	prenom varchar (15),
	email varchar (30),
	primary key (idInscriptionActivite))engine=innodb;

	drop table if exists tchat;	
create table tchat (
	idTchat int auto_increment not null	,
	pseudo varchar(55),
	messages varchar(360),
	heureMessage datetime,
primary key(idTchat))engine=innodb;
	
	alter table tchat 
add constraint fk_tchat_Membre
foreign key (idMembre) references Membre(idMembre);
	
alter table Activite drop foreign key fk_Activite_GenreActivite;
alter table Activite 
add constraint fk_Activite_GenreActivite
foreign key (idGenreActivite) references GenreActivite(idGenreActivite);
	


insert into Membre(idMembre, prenom, nom, pseudonyme, jourNaissance, moisNaissance, anneeNaissance, email, mdp)
values (1,'Evan','Roussin','Nym_Le_Manchot',20,04,2001,'evan.roussin@gmail.com','123');


insert into GenreActivite(idGenreActivite, libelleActivite)
values (1, 'Sportif'),
(2, 'Musicale'),
(3, 'Théâtrale'),
(4, 'Informatique'),
(5, 'Jeux');


insert into InscriptionActivite(idInscriptionActivite, idActivite, nom, prenom, email)
values (1, 3, 'Racicot', 'Roberta', 'roberta.racicot@gmail.com'),
(2, 1, 'Jodoin', 'Patrice', 'patrice.jodoin@gmail.com'),
(3, 4, 'Frigon', 'Fabien', 'frigon.fabien@gmail.com');


insert into Activite(idActivite, idGenreActivite, libelleActivite, lieuActivite, jour, horaire, materiel, dateDebut, dateFin, vacancesScolaires)
values (1, 1, 'Sportif', 'Montmorency', 'Lundi', '9:30', 'Tapis, boules', '11/05/2020', '13/05/2020', 'true'),
(2, 2, 'Musicale', 'Enghien-les-Bains', 'Jeudi', '14:30', 'Microphone', '14/05/2020', '16/05/2020', 'false'),
(3, 3, 'Théâtrale', 'Eaubonne', 'Mardi', '19:50', 'Microphone', '19/05/2020', '21/05/2020', 'false'),
(4, 4, 'Informatique','Paris', 'Samedi', '15:00', 'Aucun', '23/05/2020', '/24/05/2020', 'false'),
(5, 5, 'Jeux', 'Genneviliers', 'Lundi', '16:15', 'Cartes, boules', '27/05/2020', '285/05/2020', 'true');


genre : sportif(1), musicale(2), théâtrale(3), informatique(4), jeux(5)
activité : yoga, chorale, bridge, petanque, karaoke, danse de salon, stand-up, initiation internet
1 : yoga, petanque, danse de salon
2 : chorale, karaoke
3 : stand-up
4 : initiation internet
5 : petanque, bridge
 