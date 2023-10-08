

--Data for the table academie
INSERT INTO Academie(ref_academie,nom_academie) VALUES
('478425641295123','Versailles'),
('478425641295124','Cretail'),
('478425641295125','Lille');

INSERT INTO client (id_client, nom, prenom, tel, nationalite, email, age, photo, adresse, date_naissance, solde, code_tarif, mdp_hashe, ref_academie) VALUES 
('85412365419','JAGUAR','Fiona', '0712359648', 'Italienne', 'Fiona.jaguar@gmail.com',23,NULL,'121 avenue toto','1999-04-01',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd2','478425641295123'),
('84526552545','SARLY','Irene', '0784623512', 'Anglais', 'Irene.sarly@gmail.com',21,NULL,'41 boulevard saucisson','2001-02-25',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd3','478425641295123'),
('48569852963','NAMGOON','Joon', '0674256432', 'Coréen', 'Joon.namgoon@gmail.com',20,NULL,'1 rue patate','2002-11-10',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd4','478425641295123'),
('45215252813','DJAJDA','Julia', '0745412518', 'Française', 'Julia.djadja@gmail.com',19,NULL,'12 rue la vache','2002-12-31',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd5','478425641295123'),
('75274562258','RUISSEAU','Jean-Jacques', '0645239685', 'Français', 'jean-jacques.ruisseau@gmail.com',57,NULL,'48 avenue Jean-Jalal','1965-04-23',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd6','478425641295123'),
('25632147545','FALAFEL','Dominique', '0674125634', 'Français', 'Dominique.falafel@gmail.com',61,NULL,'91 boulevard kifkif','1961-02-28',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd2','478425641295123');

--Data for the table etudiant 
INSERT INTO etudiant (ine, no_etu, nbr_abscence_nj, redoublement, annee_scolaire ) VALUES
('85412365419', '22004665', 0, NULL,  '2022-09-01' ),
('84526552545', '22004666' , 2,NULL , '2022-09-01' ),
('48569852963','22004667' ,0 ,NULL , '2022-09-01'),
('45215252813', '22004664', 0, NULL, '2022-09-01' );

--Data for the table personel
INSERT INTO personnel (id_personnel, no_personnel, lieu_travail) VALUES
('75274562258' ,'12345678' ,'ST-MARTIN' ),
('25632147545','abcdefgh' ,'CHENE'  );





/*
--Data for the table compte_crous
INSERT INTO compte_crous(no_compte,solde,code_tarif,mdp_hashe,ref_academie)VALUES
('71264296278',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd2','478425641295123');
('61264296278',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd3','478425641295123');
('51264296278',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd4','478425641295123');
('41264296278',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd5','478425641295123');
('31264296278',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd6','478425641295123');
('21264296278',0.0,1,'$2a$04$3AY2RtOFIGmaJR6c7.bpx.9hV3Fn/3j9OeQ7ims.0cdlmGCaQssd7','478425641295123');
*/

--Data for the table achat

INSERT INTO achat(id_achat, lieu_achat, date_achat, prix_achat, heure_achat)
 VALUES
 ('1234567891q','ST-MARTIN','2022-11-23', 3.30, NULL),
 ('qzertyuiop1', 'NEUVILLE','2022-11-24',1,NULL),
 ('ygggffrdop1','CHENE','2022-11-25',1,NULL);


--Data for the table banque

INSERT INTO banque(id_banque, nom_banque, solde, iban, rib)
 VALUES
 ('azertyuiop1234567891qsdf','AXA',2500,'FR7612548029989876543210917', '12345678911'),
 ('qzertyuiop1234567891qsdf', 'BNB-Parisbas',5000,'FR7630004028379876543210943','98765432110'),
 ('ygggffrdop1234567891qsdf','HSBC',7500,'FR1420041010050500013M02606','14725836998');

--Data for the table recharger

/*###########################################################

       A COMPLETER RECHARHER / lister

       + Verifier si les donnée entre les valeur PK et FK sont cohérent

####################################################### */

INSERT INTO recharger(id_banque,id_client)VALUES
('azertyuiop1234567891qsdf','75274562258'),
('qzertyuiop1234567891qsdf','75274562258'),
('ygggffrdop1234567891qsdf','75274562258');



--Data for the table a_effectuer

INSERT INTO a_effectuer(id_achat, id_client)VALUES
('1234567891q','75274562258'),
('qzertyuiop1','75274562258'),
('ygggffrdop1','75274562258');



--Data for the table restaurant

INSERT INTO restaurant (id_restaurant, adresse, nom_resto, capacite_accueil)
 VALUES
 ('CYSTMART','Avenue toto rue 50','Resto CY ST-Martin',100),
 ('CYCHENES','Avenue Tata rue 20','Resto CY Chene',200),
 ('CYNEWVIL','Avenue Tictac rue 80','Resto CY Neuville',300);

--Data for the table caisse

INSERT INTO caisse (ip_caisse, num_caisse,responsable_caisse, id_restaurant)
 VALUES
 ('1234567894', 1, 'ABCD','CYSTMART'),
 ('2111019871', 2, 'AABB','CYCHENES'),
 ('5458019873', 3, 'DCBA','CYSTMART');


--Data for the table tpe

INSERT INTO tpe (no_serie, adresse_ip, id_caisse)
 VALUES
 ('123456789101112', '145.0.0.1', '1234567894'),
 ('211101987654321', '145.0.0.2', '2111019871'),
 ('545801987654321', '145.0.0.3', '5458019873');

--Data for the table menu

INSERT INTO menu (id_menu, type_menu, total_point, prix_menu, id_restaurant)
 VALUES
 ('VI', 'Menu Viande', 3, 3.30,'CYSTMART'),
 ('VE', 'Menu Vegan', 3, 3.30,'CYNEWVIL'),
 ('PO', 'Menu Poisson', 3, 3.30,'CYCHENES'),
 ('GR', 'Menu Grillade', 6, 4.00,'CYSTMART');

----Data for the table produit

INSERT INTO produit (ref_produit, nom_produit, categorie, nbr_point, prix_produit, id_menu)
 VALUES
 ('0554126875', 'Yaourt au Chocolat', 'desert', 1,0.75,'VI'),
 ('0751668821', 'Fromage', 'Produit Laitier', 1,0.75,'VE'),
 ('0554126999', 'Salade', 'entree', 1,0.75,'PO');
 