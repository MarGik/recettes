--
-- Contenu de la table `unite`
--

INSERT INTO `unite` (`valeurUnite`) VALUES
('kg'),
('g'),
('mg'),
('L'),
('cL'),
('mL'),
('Cuillère à café'),
('Cuillère à soupe'),
('Pot de yaourt'),
('Tasse'),
('Verre'),
('Boîte'),
('Pièce'),
('Sachet'),
('Pincée');


--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`nomProduit`,`categorie`) VALUES
('Pâte feuilletée','Pâte'),
('Pâte brisée','Pâte'),
('Pâte sablée','Pâte'),
('Pâte à choux','Pâte'),
('Pâte à pizza','Pâte'),
('Beurre','Laitage'),
('Crème fraiche','Laitage'),
('Fromage','Laitage'),
('Fromage râpé','Laitage'),
('Chocolat au lait','Chocolat'),
('Chocolat blanc','Chocolat'),
('Chocolat noir','Chocolat'),
('Pépites de chocolat','Chocolat'),
('Pâte','Féculent'),
('Jus de pommes','Jus'),
('Jus de citron','Jus'),
('Jus d\'orange','Jus'),
('Jus de tomates','Jus'),
('Jus multifruits','Jus'),
('Moutarde','Condiment'),
('Moutarde à l\'ancienne','Condiment'),
('Huile','Condiment'),
('Vinaigre de vin','Condiment'),
('Vinaigre de framboise','Condiment'),
('Vinaigre de noix','Condiment'),
('Vin','Alcool'),
('Rhum','Alcool'),
('Vodka','Alcool'),
('Bière','Alcool'),
('Liqueur','Alcool'),
('Sucre de canne','Sucre'),
('Sucre roux','Sucre'),
('Sucre blanc','Sucre'),
('Sucre glace','Sucre'),
('Sucre vanillé','Sucre'),
('Sauce tomate','Sauce');


--
-- Contenu de la table `ingredient`
--

INSERT INTO `ingredient` (`nomIngredient`,`categorie`) VALUES
('Banane','Fruit'),
('Orange','Fruit'),
('Clémentine','Fruit'),
('Mandarine','Fruit'),
('Citron','Fruit'),
('Pamplemousse','Fruit'),
('Tomate','Fruit'),
('Pomme','Fruit'),
('Poire','Fruit'),
('Raisin','Fruit'),
('Kiwi','Fruit'),
('Ananas','Fruit'),
('Cerise','Fruit'),
('Pêche','Fruit'),
('Prune','Fruit'),
('Abricot','Fruit'),
('Mangue','Fruit'),
('Fruit de la passion','Fruit'),
('Goyave','Fruit'),
('Amande','Fruit'),
('Noix','Fruit'),
('Noix de cajou','Fruit'),
('Noisette','Fruit'),
('Noix de coco','Fruit'),
('Papaye','Fruit'),
('Noix de pécan','Fruit'),
('Melon','Fruit'),
('Pastèque','Fruit'),
('Fraise','Fruit'),
('Framboise','Fruit'),
('Mûre','Fruit'),
('Myrtille','Fruit'),
('Groseille','Fruit'),
('Fraise des bois','Fruit'),
('Poireaux','Légume'),
('Aubergine','Légume'),
('Radis','Légume'),
('Chou-fleur','Légume'),
('Choux de Bruxelles','Légume'),
('Comcombre','Légume'),
('Cornichon','Légume'),
('Courgette','Légume'),
('Courge','Légume'),
('Potiron','Légume'),
('Potimarron','Légume'),
('Butternut','Légume'),
('Salsifi','Légume'),
('Marron','Légume'),
('Rutabaga','Légume'),
('Epinard','Légume'),
('Carotte','Légume'),
('Pomme de terre','Légume'),
('Salade','Légume'),
('Champignon','Légume'),
('Betterave','Légume'),
('Chou-rouge','Légume'),
('Oignon','Légume'),
('Ail','Légume'),
('Haricot vert','Légume'),
('Haricot rouge','Légume'),
('Haricot blanc','Légume'),
('Petits pois','Légume'),
('Poix cassés','Légume'),
('Endives','Légume'),
('Pois chiches','Légume'),
('Navets','Légume'),
('Sel','Epice'),
('Harissa','Epice'),
('Poivre','Epice'),
('Curry','Epice'),
('Persil','Epice'),
('Thym','Epice'),
('Laurier','Epice'),
('Curcuma','Epice'),
('Badiane','Epice'),
('Coriandre','Epice'),
('Anette','Epice'),
('Colin','Poisson/Crustacé'),
('Congre','Poisson/Crustacé'),
('Eperlan','Poisson/Crustacé'),
('Espadon','Poisson/Crustacé'),
('Cabillaud','Poisson/Crustacé'),
('Loup','Poisson/Crustacé'),
('Dorade','Poisson/Crustacé'),
('Sole','Poisson/Crustacé'),
('Hareng','Poisson/Crustacé'),
('Sardine','Poisson/Crustacé'),
('Capitaine','Poisson/Crustacé'),
('Lotte','Poisson/Crustacé'),
('Anchois','Poisson/Crustacé'),
('Saumon','Poisson/Crustacé'),
('Thon','Poisson/Crustacé'),
('Maquereau','Poisson/Crustacé'),
('Calamar','Poisson/Crustacé'),
('Seiche','Poisson/Crustacé'),
('Huître','Poisson/Crustacé'),
('Couteau','Poisson/Crustacé'),
('Moule','Poisson/Crustacé'),
('Bigorneau','Poisson/Crustacé'),
('Crevette','Poisson/Crustacé'),
('Coquille Saint Jacques','Poisson/Crustacé'),
('Oursin','Poisson/Crustacé'),
('Palourdes','Poisson/Crustacé'),
('Langoustines','Poisson/Crustacé'),
('Escargot','Viande'),
('Agneau','Viande'),
('Porc','Viande'),
('Veau','Viande'),
('Boeuf','Viande'),
('Lapin','Viande'),
('Bison','Viande'),
('Poulet','Viande'),
('Dinde','Viande'),
('Oie','Viande'),
('Chapon','Viande'),
('Canard','Viande'),
('Caille','Viande'),
('Pintade','Viande'),
('Grenouille','Viande'),
('Riz','Féculent'),
('Semoule','Féculent'),
('Farine de sarrasin','Farine'),
('Farine de blé','Farine'),
('Farine de seigle','Farine'),
('Lait de vache','Lait'),
('Lait de chèvre','Lait'),
('Oeuf de poule','Oeuf'),
('Oeuf de caille','Oeuf');

--
-- Contenu de la table `recette`
--

INSERT INTO `recette` (`idR`, `titre`, `categorie`, `nbPersonne`, `description`) VALUES
(1, 'Pâte à crêpes', 'Dessert', 4, 'À la fête de la Chandeleur ou au Mardi Gras en France, la tradition veut que l''on fasse des crêpes. En Bretagne, les crêpes font parties de la culture locale et se consomment très souvent sucrées avec de la farine de froment ou salées avec de la farine de blé noir. Seulement voilà, pas de bonnes crêpes sans une bonne pâte à crêpes simple et rapide à faire !'),
(2, 'Couscous à la cocotte-minute', 'Plat', 5, 'Le plat familial par excellence aux bonnes odeurs et saveurs orientales.'),
(3, 'Soufflé au fromage', 'Entrée', 4, 'Un simple soufflé au fromage de votre choix ! (Une petite préférence pour le camembert)');

--
-- Contenu de la table `propose`
--

INSERT INTO `propose` (`dateProposition`, `idR`, `idU`) VALUES
('2016-12-12', 1, 1),
('2016-12-12', 2, 1),
('2016-12-12', 3, 1);


--
-- Contenu de la table `etape`
--

INSERT INTO `etape` (`numero`, `instructions`, `idR`) VALUES
(1, 'Mettez la farine, le sel, le sucre vanillé et cassez les oeufs dans un saladier.', 1),
(1, 'Préparez la cuisson de la semoule dans de l\\''eau huilée.', 2),
(1, 'Préchauffez le four à 240°C (thermostat 8).', 3),
(2, 'Mélangez à l\\''aide d\\''une cuillère jusqu\\''à obtenir une pâte homogène', 1),
(2, 'Dans une cocotte-minute, faites revenir l\\''huile, l\\''oignon, l\\''ail et la viande jusqu\\''à ce que la viande soit dorée.', 2),
(2, 'Faire fondre le beurre dans un petite casserole. Ajoutez la farine en la saupoudrant et laissez cuire 2min à feu très doux en remuant avec une cuillère.', 3),
(3, 'Versez le lait petit à petit tout en mélangeant afin d\\''éviter les grumeaux.', 1),
(3, 'Salez, poivrez, ajoutez les épices, la sauce tomate et les carottes coupées en rondelles. Recouvrir d\\''eau à hauteur et fermez la cocotte.', 2),
(3, 'Faites bouillir le lait et versez le dans la casserole précédente tout en remuant. Salez, poivrez et laissez refroidir', 3),
(4, 'Incorporez le beurre fondu, et laissez reposer une demie heure.', 1),
(4, 'Laissez cuire 12 minutes à partir du début de rotation de la soupape.', 2),
(5, 'Verser dans une poêle à crêpe une louche de pâte, saupoudrez de sucre. C\\''est prêt !', 1),
(5, 'Ouvrez, ajoutez les courgettes, les navets et les pois chiches. Laissez cuire 5 minutes.', 2),
(6, 'Servez la semoule avec la viande. C\\''est prêt !', 2),
(6, 'Incorporez cette pâte à la sauce au lait.', 3),
(7, 'Montez les blancs d\\''oeufs en neige et incorporez le à la sauce.', 3),
(8, 'Versez cette préparation dans un moule à soufflé préalablement beurré et enfourner 50min environ.', 3);


--
-- Contenu de la table `necessite_ingredient`
--

INSERT INTO `necessite_ingredient` (`qteNecessaireIng`, `idR`, `idIng`, `valeurUnite`) VALUES
(1, 1, 65, 'Pincée'),
(250, 1, 119, 'g'),
(3, 1, 123, 'Pièce'),
(3, 2, 42, 'Pièce'),
(3, 2, 51, 'Pièce'),
(1, 2, 57, 'Pièce'),
(1, 2, 58, 'Pièce'),
(1, 2, 65, 'Pincée'),
(1, 2, 66, 'Pincée'),
(400, 2, 103, 'g'),
(400, 2, 106, 'g'),
(500, 2, 125, 'g'),
(250, 2, 126, 'g'),
(750, 2, 127, 'g'),
(1, 2, 128, 'Cuillère à café'),
(1, 3, 65, 'Pincée'),
(1, 3, 66, 'Pincée'),
(75, 3, 119, 'g'),
(50, 3, 121, 'cL'),
(4, 3, 123, 'Pièce');
--
-- Contenu de la table `necessite_produit`
--

INSERT INTO `necessite_produit` (`qteNecessaireProd`, `idR`, `idProduit`, `valeurUnite`) VALUES
(30, 1, 6, 'g'),
(1, 1, 35, 'Sachet'),
(25, 2, 6, 'g'),
(2, 2, 22, 'Cuillère à soupe'),
(1, 2, 36, 'Boîte'),
(80, 3, 6, 'g'),
(1, 3, 8, 'Pièce'),
(100, 3, 9, 'g');

--
-- Contenu de la table `ustensile`
--

INSERT INTO `ustensile` (`nom`) VALUES
('Casserole'),
('Casserolle'),
('Cocotte-minute'),
('Couteau'),
('Cuillère'),
('Cuillère à soupe'),
('Fouet'),
('Four'),
('Fourchette'),
('Moule à soufflé'),
('Poêle'),
('Saladier'),
('Verre doseur');

--
-- Contenu de la table `necessite_ustensile`
--

INSERT INTO `necessite_ustensile` (`nom`, `numero`, `idR`) VALUES
('Casserole', 2, 3),
('Casserolle', 1, 2),
('Cocotte-minute', 2, 2),
('Couteau', 2, 2),
('Cuillère', 2, 3),
('Fouet', 7, 3),
('Four', 1, 3),
('Fourchette', 5, 3),
('Moule à soufflé', 8, 3),
('Saladier', 1, 1),
('Verre doseur', 3, 1);

