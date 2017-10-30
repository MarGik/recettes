#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

#------------------------------------------------------------
# Table: LIEU
#------------------------------------------------------------

DROP TABLE IF EXISTS LIEU;
CREATE TABLE LIEU(
        idL       Integer Auto_increment  NOT NULL ,
        latitude  Float NOT NULL ,
        longitude Float NOT NULL ,
        idZ       Integer REFERENCES ZONE_GEOGRAPHIQUE(idZ) ,
        PRIMARY KEY (idL )
);


#------------------------------------------------------------
# Table: ZONE GEOGRAPHIQUE
#------------------------------------------------------------

DROP TABLE IF EXISTS ZONE_GEOGRAPHIQUE;
CREATE TABLE ZONE_GEOGRAPHIQUE(
        idZ       Integer Auto_increment NOT NULL ,
        continent Varchar (30) NOT NULL,
        pays      Varchar (60) NOT NULL,
        PRIMARY KEY (idZ )
);


#------------------------------------------------------------
# Table: ADRESSE
#------------------------------------------------------------

DROP TABLE IF EXISTS ADRESSE;
CREATE TABLE ADRESSE(
        pays       Varchar (60) NOT NULL ,
        ville      Varchar (50) NOT NULL ,
        codePostal Integer NOT NULL ,
        adresse    Varchar (50) NOT NULL ,
        idL        Integer REFERENCES LIEU(idL) ,
        idU        Integer REFERENCES UTILISATEUR(idU) ,
        PRIMARY KEY (idL, idU)
);

#------------------------------------------------------------
# Table: RECETTE
#------------------------------------------------------------

DROP TABLE IF EXISTS RECETTE;
CREATE TABLE RECETTE(
        idR         int (11) Auto_increment  NOT NULL ,
        titre       Varchar (50) NOT NULL ,
        categorie   Varchar (25) NOT NULL ,
        nbPersonne Int NOT NULL ,
        description Varchar (500) ,
        PRIMARY KEY (idR )
);

#------------------------------------------------------------
# Table: ETAPE
#------------------------------------------------------------

DROP TABLE IF EXISTS ETAPE;
CREATE TABLE ETAPE(
        numero       Integer NOT NULL ,
        instructions Varchar (255) NOT NULL ,
        idR          Integer REFERENCES RECETTE(idR) ,
        PRIMARY KEY (numero, idR)
);


#------------------------------------------------------------
# Table: USTENSILE
#------------------------------------------------------------

DROP TABLE IF EXISTS USTENSILE;
CREATE TABLE USTENSILE(
        nom Varchar (50) NOT NULL ,
        PRIMARY KEY (nom )
);

#------------------------------------------------------------
# Table: NECESSITE_USTENSILE
#------------------------------------------------------------

DROP TABLE IF EXISTS NECESSITE_USTENSILE;
CREATE TABLE NECESSITE_USTENSILE(
        nom    Varchar (50) REFERENCES USTENSILE(nom) ,
        numero Integer REFERENCES ETAPE(numero) ,
        idR Integer REFERENCES RECETTE(idR) ,
        PRIMARY KEY (nom, numero, idR)
);


#------------------------------------------------------------
# Table: INGREDIENT
#------------------------------------------------------------

DROP TABLE IF EXISTS INGREDIENT;
CREATE TABLE INGREDIENT(
        idIng         Integer Auto_increment NOT NULL ,
        nomIngredient Varchar (25) NOT NULL ,
        categorie     Varchar (25) NOT NULL ,
        qtiteIng      Integer ,
        PRIMARY KEY (idIng)
);

#------------------------------------------------------------
# Table: PRODUIT
#------------------------------------------------------------

DROP TABLE IF EXISTS PRODUIT;
CREATE TABLE PRODUIT(
        idProduit  Integer Auto_increment NOT NULL ,
        nomProduit Varchar (25) NOT NULL ,
        categorie  Varchar (25) NOT NULL ,
        qtiteProd  Integer ,
        PRIMARY KEY (idProduit)
);

#------------------------------------------------------------
# Table: UNITE
#------------------------------------------------------------

DROP TABLE IF EXISTS UNITE;
CREATE TABLE UNITE(
        valeurUnite Varchar (25) NOT NULL ,
        PRIMARY KEY (valeurUnite )
);


#------------------------------------------------------------
# Table: NECESSITE_INGREDIENT
#------------------------------------------------------------

DROP TABLE IF EXISTS NECESSITE_INGREDIENT;
CREATE TABLE NECESSITE_INGREDIENT(
	qteNecessaireIng Integer NOT NULL ,
        idR              Integer REFERENCES RECETTE(idR) ,
        idIng            Integer REFERENCES INGREDIENT(idIng) ,
        valeurUnite      Varchar (25) REFERENCES UNITE(valeurUnite) ,
        PRIMARY KEY (idR ,idIng ,valeurUnite )
);

#------------------------------------------------------------
# Table: NECESSITE_PRODUIT
#------------------------------------------------------------

DROP TABLE IF EXISTS NECESSITE_PRODUIT;
CREATE TABLE NECESSITE_PRODUIT(
        qteNecessaireProd Integer NOT NULL ,
        idR               Integer REFERENCES RECETTE(idR) ,
        idProduit         Integer REFERENCES PRODUIT(idProduit) ,
        valeurUnite       Varchar (25) REFERENCES UNITE(valeurUnite) ,
        PRIMARY KEY (idR ,idProduit ,valeurUnite )
);



#------------------------------------------------------------
# Table: UTILISATEUR
#------------------------------------------------------------

DROP TABLE IF EXISTS UTILISATEUR;
CREATE TABLE UTILISATEUR(
        idU             integer Auto_increment  NOT NULL ,
        nom             Varchar (25) NOT NULL ,
        prenom          Varchar (25) NOT NULL ,
        dateNaissance   Date NOT NULL ,
        genre           Varchar (25) NOT NULL ,
        mail            Varchar (255) NOT NULL ,
        dateInscription Date NOT NULL ,
        mdp             Varchar (15) NOT NULL ,
        pseudo          Varchar (12) NOT NULL ,
        idL             Integer REFERENCES LIEU(idL),
        PRIMARY KEY (idU ) ,
        UNIQUE (pseudo)
);

#------------------------------------------------------------
# Table: PROPOSE
#------------------------------------------------------------

DROP TABLE IF EXISTS PROPOSE;
CREATE TABLE PROPOSE(
        dateProposition Date NOT NULL ,
        idR Integer REFERENCES RECETTE(idR),
        idU Integer REFERENCES UTILISATEUR(idU),
        PRIMARY KEY (idR ,idU )
);

#------------------------------------------------------------
# Table: TRANSFORME
#------------------------------------------------------------

DROP TABLE IF EXISTS TRANSFORME;
CREATE TABLE TRANSFORME(
        dateTransformation Date ,
        qtiteIngNecessaire Integer NOT NULL ,
        idProduit         Integer REFERENCES PRODUIT(idProduit) ,
        idIng          Integer REFERENCES INGREDIENT(idIng) ,
        PRIMARY KEY (idIng ,idProduit )
);


#------------------------------------------------------------
# Table: PROVIENT
#------------------------------------------------------------

DROP TABLE IF EXISTS PROVIENT;
CREATE TABLE PROVIENT(
        dateProvenance Date ,
        idIng          Integer REFERENCES INGREDIENT(idIng) ,
        idL            Integer REFERENCES LIEU(idL) ,
        PRIMARY KEY (idIng ,idL )
);

