
/*création des tables lier au Compte*/
CREATE TABLE Academie(
	ref_academie CHAR(15) NOT NULL PRIMARY KEY,
	nom_academie VARCHAR(50) NOT NULL	
);	



/*création des tables lier aux Clients*/


CREATE TABLE client(
	id_client CHAR(11) NOT NULL PRIMARY KEY,
	nom VARCHAR(80) NOT NULL,
	prenom VARCHAR(800) NOT NULL,
	tel VARCHAR(12) NOT NULL,
	nationalite VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	age INT NOT NULL,
	photo BYTEA  NULL,
	adresse VARCHAR(255) NOT NULL,
	date_naissance TIMESTAMP NOT NULL,
	
	solde FLOAT NOT NULL,
	code_tarif INT NOT NULL,
	mdp_hashe CHAR(60) NOT NULL,
	ref_academie CHAR(15),
	FOREIGN KEY (ref_academie) REFERENCES Academie(ref_academie)
	
);

CREATE TABLE etudiant(
	ine CHAR(11) NOT NULL PRIMARY KEY,
	FOREIGN KEY (ine) REFERENCES client(id_client)  ON UPDATE CASCADE ON DELETE CASCADE,
	no_etu CHAR(8) NOT NULL UNIQUE,
	nbr_abscence_nj int NOT NULL,
	redoublement BOOLEAN NULL,
	annee_scolaire TIMESTAMP NOT NULL
);


CREATE TABLE personnel(
	id_personnel CHAR(11) NOT NULL PRIMARY KEY,
	FOREIGN KEY (id_personnel) REFERENCES client(id_client)  ON UPDATE CASCADE ON DELETE CASCADE,
	no_personnel CHAR(8) NOT NULL UNIQUE,
	lieu_travail VARCHAR(255) NOT NULL
);




/*
CREATE TABLE compte_crous(
	no_compte CHAR(11) NOT NULL PRIMARY KEY,
	solde FLOAT NOT NULL,
	code_tarif INT NOT NULL,
	mdp_hashe CHAR(60) NOT NULL,
	ref_academie CHAR(15),
	FOREIGN KEY (ref_academie) REFERENCES Academie(ref_academie)*//*,
	
	id_client CHAR(11),
	FOREIGN KEY (id_client) REFERENCES client(id_client)
	*/
/*);       */



CREATE TABLE achat(
	id_achat CHAR(11) NOT NULL PRIMARY KEY,
	lieu_achat VARCHAR(15)  NULL,
	date_achat TIMESTAMP NULL,
	prix_achat FLOAT NULL,
	heure_achat TIMESTAMP NULL
);

CREATE TABLE banque(
	id_banque CHAR(24) NOT NULL PRIMARY KEY ,
	nom_banque VARCHAR(80) NOT NULL,
	solde FLOAT NOT NULL,
	iban CHAR(27) NOT NULL UNIQUE,
	rib CHAR(11) NOT NULL UNIQUE
);

--Création de table association N-N---------------------------
CREATE TABLE recharger(
	id_banque CHAR(24),
	id_client CHAR(11),
	PRIMARY KEY(id_banque,id_client),
	CONSTRAINT FK_id_banque FOREIGN KEY (id_banque) REFERENCES banque(id_banque) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_id_client FOREIGN KEY (id_client) REFERENCES client(id_client) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE a_effectuer(
	id_achat CHAR(11),
	id_client CHAR(11),
	PRIMARY KEY(id_achat,id_client),
	CONSTRAINT FK_id_achat FOREIGN KEY (id_achat) REFERENCES achat(id_achat) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_id_client FOREIGN KEY (id_client) REFERENCES client(id_client) ON UPDATE CASCADE ON DELETE CASCADE
);

--------------------------------------------------------------

/*création des tables lier au Restaurant*/
CREATE TABLE restaurant(
	id_restaurant CHAR(8) NOT NULL PRIMARY KEY,
	adresse VARCHAR(255) NOT NULL,
	nom_resto VARCHAR(80) NOT NULL,
	capacite_accueil INT NOT NULL
);

CREATE TABLE caisse(
	ip_caisse CHAR(10) NOT NULL PRIMARY KEY,
	num_caisse INT NOT NULL UNIQUE,
	responsable_caisse CHAR(4) NOT NULL,
	id_restaurant CHAR(8),
	FOREIGN KEY (id_restaurant) REFERENCES restaurant(id_restaurant)
) ;

CREATE TABLE tpe(
	no_serie CHAR(15) NOT NULL PRIMARY KEY,
	adresse_ip VARCHAR(15) NOT NULL UNIQUE,
	id_caisse CHAR(10),
	FOREIGN KEY (id_caisse) REFERENCES caisse(ip_caisse)
);


CREATE TABLE menu(
	id_menu CHAR(2) NOT NULL PRIMARY KEY,
	type_menu VARCHAR(80) NOT NULL ,
	total_point INT  NULL,
	prix_menu FLOAT NULL,
	id_restaurant CHAR(8),
	FOREIGN KEY (id_restaurant) REFERENCES restaurant(id_restaurant)
);
CREATE TABLE produit(
	ref_produit CHAR(10) NOT NULL PRIMARY KEY,
	nom_produit VARCHAR(60) NOT NULL,
	categorie VARCHAR(80) NOT NULL,
	nbr_point INT NULL,
	prix_produit FLOAT NULL,
	id_menu CHAR(2),
	FOREIGN KEY (id_menu) REFERENCES menu(id_menu)
);
/*alimentation des tables*/
