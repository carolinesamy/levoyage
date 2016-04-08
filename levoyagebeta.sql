-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: levoyage
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `book_hotel`
--

DROP TABLE IF EXISTS `book_hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_hotel` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(50) NOT NULL,
  `time_to` varchar(50) NOT NULL,
  `time_from` varchar(50) NOT NULL,
  `num_member` int(10) NOT NULL,
  `num_rooms` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_name` (`hotel_name`),
  CONSTRAINT `book_hotel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_hotel_ibfk_2` FOREIGN KEY (`hotel_name`) REFERENCES `hotel` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_hotel`
--

LOCK TABLES `book_hotel` WRITE;
/*!40000 ALTER TABLE `book_hotel` DISABLE KEYS */;
/*!40000 ALTER TABLE `book_hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `rate` int(20) NOT NULL DEFAULT '0',
  `lat` double DEFAULT NULL,
  `longd` double DEFAULT NULL,
  `country_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country` (`country_id`),
  CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (8,'Rome','Roman.jpg','Rome (Roma), the eternal city, is literally eternal. It has endured for over 2,700 years, with an ambiance like no other. Embedded in centuries of history and culture, it is Italy\'s capital and largest city, offering far too much to see in one visit. In this city a phenomenal concentration of history, legend, and monuments coexists with an equally phenomenal concentration of people busily going about their everyday life.\r\n\r\nHere the ancient world is integrated with the modern. The Roman Forum and the Pantheon rub shoulders with Baroque palazzos, and Renaissance villas sit alongside the modernism of Mussolini\'s redesign of the capital, and you can drive along a busy Roman street and see the Coliseum rearing up in front of you.\r\n\r\nRome (Roma) means history: Etruscan tombs, Republican meeting rooms, imperial temples, early Christian churches, medieval bell towers, Renaissance palaces, and baroque basilicas. As you stroll through this remarkable city you are walking in the footsteps of the Caesars, St. Peter, Charlemagne, the Popes, and Michelangelo!',0,41.9,12.4833333,30),(9,'Milan','Milan.jpg','Milan, the capital of Lombardy, has a population of 1.3 million people. It is the biggest industrial city of Italy with many different industrial sectors. It is a magnetic point for designers, artists, photographers and models. Milan has an ancient city centre with high and interesting buildings and palazzos, which is why so many people from all over the world want to see the city of glamour.\r\n\r\n ',0,45.465422,9.185924,30),(10,'Naples','napless.jpg','Naples is located halfway between two volcanic areas, the volcano Mount Vesuvius and the Phlegraean Fields.The city is noted for its rich history, art, culture and gastronomy and, in the modern day, the historic centre of the city is listed by UNESCO as a World Heritage Site. The metropolitan area of Naples is the second most populated in Italy and one of the largest in all of Europe with around 3.8 million people.\r\n\r\nThe whole history of Naples is based on the concept of welcoming foreigners and of different cultures living side by side. The city\'s enviable geographical position half-way down the Italian coast makes it easy to reach from anywhere in the world.\r\n\r\nThe wonderful historical, artistic and archaeological heritage is an intrinsic part of the city. At the same time, we mustn\'t forget its contemporary creative nature which ensures the city always has some new project on the go, some new goal, and plenty of new ideas.\r\n\r\nNaples is a city on the sea, a place full of light yet with dark, hidden foundations. It has a great cultural and artistic identity which is stamped on the brow of its many museums, castles, churches, squares, narrow streets and archaeological remains. It is a city in which culture, art and \"light\" mix with the obscure darkness of a hidden, submerged, underground world.',0,26.142036,-81.79481,30),(11,'Palermo','Palermo.jpg','Palermo is Sicily\'s cultural, economic and touristic capital. It is a city rich in history, culture, art, music and food. Numerous tourists are attracted to the city for its good Mediterranean weather, its renowned gastronomy and restaurants, its Romanesque, Gothic and Baroque churches, palaces and buildings, and its nightlife and music. Palermo is the main Sicilian industrial and commercial center: the main industrial sectors include tourism, services, commerce and agriculture.[2] Palermo currently has an international airport, and a significant underground economy.[citation needed] In fact, for cultural, artistic and economic reasons, Palermo was one of the largest cities in the Mediterranean and is now among the top tourist destinations in both Italy and Europe. The city is also going through careful redevelopment, preparing to become one of the major cities of the Euro-Mediterranean area.',0,38.115688,13.361267,30),(12,'Bologna','Bologna.jpg','Bologna is home to numerous prestigious cultural, economic and political institutions as well as one of the most impressive trade fair districts in Europe. In 2000 it was declared European capital of culture and in 2006, a UNESCO “city of music”. The city of Bologna was selected to participate in the Universal Exposition of Shanghai 2010 together with 45 other cities from around the world. Bologna is also one of the wealthiest cities in Italy, often ranking as one of the top cities in terms of quality of life in the country: in 2011 it ranked 1st out of 107 Italian cities.',0,44.494887,11.342616,30),(13,'Florence','Florence.jpg','Florence is an important city in Italian fashion being ranked in the top 51 fashion capitals of the world furthermore, it is a major national economic centre as well as a tourist and industrial hub. In 2008, the city had the 17th highest average income in Italy.',0,43.76956,11.255814,30),(14,'Bari','Bari.jpg','Bari is made up of four different urban sections. To the north is the closely built old town on the peninsula between two modern harbours, with the Basilica of Saint Nicholas, the Cathedral of San Sabino (1035–1171) and the Hohenstaufen Castle built for Frederick II, which is now also a major nightlife district. To the south is the Murat quarter (erected by Joachim Murat), the modern heart of the city, which is laid out on a rectangular grid-plan with a promenade on the sea and the major shopping district (the via Sparano and via Argiro).\r\n\r\nModern residential zones surround the centre of Bari, the result of chaotic development during the 1960s and 1970s replacing the old suburbs that had developed along roads splaying outwards from gates in the city walls. In addition, the outer suburbs have developed rapidly during the 1990s. The city has a redeveloped airport named after Pope John Paul II, Karol Wojty&#322;a Airport, with connections to several European cities.',0,41.117143,16.871871,30),(15,'Istanbul','Istanbul.jpg','Istanbul\'s strategic position on the historic Silk Road, rail networks to Europe and the Middle East, and the only sea route between the Black Sea and the Mediterranean have produced a cosmopolitan populace, although less so since the establishment of the Turkish Republic in 1923. Overlooked for the new capital during the interwar period, the city has since regained much of its prominence. The population of the city has increased tenfold since the 1950s, as migrants from across Anatolia have moved in and city limits have expanded to accommodate them. Arts, Music, Film and Cultural festivals were established at the end of the 20th century and continue to be hosted by the city today, and infrastructure improvements have produced a complex transportation network.',0,41.008238,28.978359,20),(16,'Ankara','Ankara.jpg','Ankara is a very old city with various Hittite, Phrygian, Hellenistic, Roman, Byzantine, and Ottoman archaeological sites. The historical center of town is a rocky hill rising 150 m (500 ft) over the left bank of the Ankara Çay&#305;, a tributary of the Sakarya River, the classical Sangarius. The hill remains crowned by the ruins of the old citadel. Although few of its outworks have survived, there are well-preserved examples of Roman and Ottoman architecture throughout the city, the most remarkable being the 20 BC Temple of Augustus and Rome that boasts the Monumentum Ancyranum, the inscription recording the Res Gestae Divi Augusti.',0,39.933363,32.859742,20),(17,'Gaziantep','Gaziantep.jpg','Gaziantep, previously and still informally called Antep, is a city in the western part of Turkey\'s Southeastern Anatolia Region, some 185 kilometres (115 mi) east of Adana and 97 kilometres (60 mi) north of Aleppo, Syria. The city has two urban districts under its administration, &#350;ahinbey and &#350;ehitkamil. It is the sixth most populous city in Turkey. In 2014 the city of Gaziantep had a population of 1,465,019.',0,37.065953,37.37811,20),(18,'Samsun','Samsun.jpg','Samsun is a city with a population over half a million people on the north coast of Turkey. It is the provincial capital of Samsun Province and a major Black Sea port. The growing city has two universities, several hospitals, shopping malls, a lot of light manufacturing industry, sports facilities and an opera.\r\n\r\nMustafa Kemal Atatürk began the Turkish War of Independence here in 1919',0,41.279703,36.336067,20),(19,'Antalya','Antalya.jpg','The city that is now Antalya was first settled around 200 BC by the Attalid dynasty of Pergamon, which was soon subdued by the Romans. Roman rule saw Antalya thrive, including the construction of several new monuments, such as Hadrian\'s Gate, and the proliferation of neighboring cities. The city has changed hands several times, including to the Byzantine Empire in 1207 and an expanding Ottoman Empire in 1391. Ottoman rule brought relative peace and stability for the next five-hundred years. The city was transferred to Italian suzerainty in the aftermath of World War I, but was recaptured by a newly independent Turkey in the War of Independence.\r\n\r\nAntalya is Turkey\'s biggest international sea resort, located on the Turkish Riviera. Large-scale development and governmental funding has promoted tourism. A record 12.5 million tourists passed through the city in 2014.',0,36.896891,30.713323,20),(20,'Oran','Oran.jpg','Oran is an important coastal city that is located in the north-west of Algeria. It is considered the second most important city after the capital Algiers, due to its commercial, industrial, and cultural importance. It is 432 km (268 mi) from Algiers. The total population of the city was 759,645 in 2008 (2008), while the metropolitan area has a population of approximately 1,500,000, making it the second largest city in Algeria.\r\n\r\nThe name \"Wahran\" (Oran in Arabic) is derived from the Berber word \"uharan\" (two lions).\r\n\r\nLegend says that in 900 AD, lions still lived in the area. The last two lions were hunted on a mountain near Oran and are elsewhere referred to as \"mountain lions\"',0,35.697654,-0.633738,18),(21,'Constantine','Constantine.jpg','Constantine is the capital of Constantine Province in north-eastern Algeria. During Roman times it was called Cirta and was renamed \"Constantina\" in honor of emperor Constantine the Great. It was the capital of the same-named French département until 1962. Slightly inland, it is about 80 kilometres (50 miles) from the Mediterranean coast, on the banks of the Rhumel river.',0,36.360155,6.642433,18),(22,'Blida','Blida.jpg','Blida lies surrounded with orchards and gardens, 190 metres (620 ft) above the sea, at the base of the Tell Atlas, on the southern edge of the fertile Mitidja Plain, and the right bank of the Oued el kebir outflow from the Chiffa gorge. The abundant water of this stream provides power for large corn mills and several factories, and also supplies the town, with its numerous fountains and irrigated gardens. Blida is surrounded by a wall of considerable extent, pierced by six gates, and is further defended by Port Mimieh, crowning a steep hill on the left bank of the river.\r\n\r\nThe nearby Chiffa gorge is a habitat of the endangered Barbary macaque, Macaca sylvanus; this habitat is one of only a few relict locations where populations of this primate are found.',0,36.479868,2.800568,18),(23,'Annaba','Annaba.jpg','Annaba is a coastal city and has undergone significant growth. Annaba has a metropolitan area with a higher population density than the other metropolises of the Algerian coastline such as Oran and the capital Algiers. Much of eastern and southern Algeria seeks the services, equipment, and infrastructure of the city. Economically, it is the centre for various dynamic activities, such as industry, transport, finance and tourism.',0,36.926458,7.752535,18),(24,'Paris','Paris.jpg','Paris is the capital city of France, and the largest city in that country. The area is 105 square km, and around 2.15 million people live there. If suburbs are counted, the population of the Paris area rises to 12 million people.\r\n\r\nThe Seine river runs through the oldest part of Paris, and divides it into two parts, known as the Left Bank and the Right Bank. It is surrounded by many forests.\r\n\r\nParis is also the center of French economy, politics, traffic and culture. Paris has many art museums and historical buildings. As a traffic center, Paris has a very good underground subway system (called the Metro). It also has two airports. The Metro was built in 1900, and its total length is more than 200 km.\r\n\r\nThe city has a multi-cultural style, because 20% of the people there are from outside France. There are many different restaurants with all kinds of food. Paris also has some types of pollution like air pollution and light pollution.',0,48.856614,2.352222,21),(25,'Lyon','Lyon.jpg','Lyon  is a city in the southeast of France. Today it is the second largest metropolis, or metro area in France (Paris is the largest). In 2012, about 500,000 people lived in Lyon, about 2,300,000 in the urban area.\r\n\r\nIn ancient history, the name of Lyon was Lugdunum. Someone who lives in Lyon is called a Lyonnais (male) or a Lyonnaise (female) in French.\r\n\r\nLyon is between the Rhône and the Saône. It is about 150 kilometres (93 mi) west of the Italian border.',0,45.764043,4.835659,18),(26,'Nice','Nice.jpg','Nice is a city in southern France on the Mediterranean coast. It is a commune in the French department of Alpes-Maritimes. It has over 345,000 people living in the city as of 2012 (1,000,000 in its metropolitan area). It has many beaches. It has a hot-summer Mediterranean climate. Summers are hot, dry, and sunny; winters are temperate, rarely going below 20°C.\r\n\r\nFrom the late 18th century, wealthy British visitors came to Nice, with its beauty and its warm but mild climate. Queen Victoria was amongst them: she made several visits. The city\'s main seaside promenade, the Promenade des Anglais owes its name to these visitors. The clear air and soft light appeals to painters. Marc Chagall and Henri Matisse spent years here, and are well represented in the city\'s museums, the Musée Marc Chagall, Musée Matisse and Musée des Beaux-Arts.\r\n\r\nNice has the second largest hotel capacity in the country, and is one of its most visited cities. It gets 4 million tourists every year. It also has the third busiest airport in France after the two main Parisian ones',0,43.710173,7.261953,21),(27,'Marseille','Marseille.jpg','Marseille is a city in the south of France in the Bouches-du-Rhône department. About 1.7 million people live in the metropolitan area, and about 850,000 in the city itself. This makes it the second largest city in France by number of people. It is the third largest by size. Marseille is all in the south, just at the Mediterranean sea. It has the biggest commercial port in France. The port is one of the most important ones in the Mediterranean.\r\n\r\nAlthough part of the region of Provence, Marseilles has a soul of its own. Founded in 600 B.C. by the Greek sailors of Phocaea, this city is the oldest in France and probably the most complex.\r\n\r\nThe city was started around 600 BC by Greek sailors from (modern day) Foça. This was a Greek colony in Asia Minor. It is in what is now Turkey.',0,43.296482,43.296482,21),(28,'British Columbia','British Columbia.jpg','British Columbia evolved from British possessions that were established in what is now British Columbia by 1871. First Nations, the original inhabitants of the land, have a history of at least 10,000 years in the area. Today there are few treaties and the question of Aboriginal Title, long ignored, has become a legal and political question of frequent debate as a result of recent court actions. Notably, the Tsilhqot\'in Nation has established Aboriginal title to a portion of their territory, as a result of the recent Supreme Court of Canada decision (Tsilhqot\'in Nation v. British Columbia).',0,53.726668,-127.647621,22),(29,'Manitoba','Manitoba.jpg','Manitoba is a province located at the longitudinal centre of Canada. It is one of the three prairie provinces and is the fifth-most populous province in Canada, with a population of 1,208,268 as of 2011. Manitoba covers an area of 649,950 square kilometres (250,900 sq mi) with a widely varied landscape; the southern and western regions are predominantly prairie grassland, the eastern and northern regions are dominated by the Canadian Shield, and the far northern regions along the Hudson Bay coast are arctic tundra. Manitoba is bordered by the provinces of Ontario to the east and Saskatchewan to the west, the territory of Nunavut to the north, and the US states of North Dakota and Minnesota to the south.\r\n\r\nMore than 90% of Manitoba\'s population lives within the far southern regions of the province, where its arable land and largest cities are located. The northern region of Manitoba, which encompasses nearly 70% the province\'s total area, is mostly undeveloped consisting primarily of remote and isolated communities amongst vast wilderness. Winnipeg is the capital and most populous city in Manitoba by a significant margin, with 730,018 people residing in the Winnipeg Capital Region. Other cities in the province are Brandon, Portage la Prairie, Steinbach, Thompson, Winkler, Selkirk, Dauphin, Morden, and Flin Flon.',0,53.760861,-98.813876,22),(30,'New Brunswick','New Brunswick.jpg','New Brunswick is one of Canada\'s three Maritime provinces and is the only constitutionally bilingual (English–French) province.[4] It was created as a result of the partitioning of the British Colony of Nova Scotia in 1784. Fredericton is the capital, Moncton is the largest metropolitan (CMA) area and Saint John is the most populous city. In the 2011 nationwide census, Statistics Canada estimated the provincial population to have been 751,171. The majority of the population is English-speaking, but there is also a large Francophone minority (33%), chiefly of Acadian origin. The flag features a ship superimposed on a yellow background with a yellow lion above it.',0,40.486216,-74.451819,22);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `exp_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exp_id` (`exp_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`exp_id`) REFERENCES `experience` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `rate` int(50) NOT NULL DEFAULT '0',
  `lat` double DEFAULT NULL,
  `longd` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (18,'Algeria','Algeria.jpg',0,NULL,NULL),(19,'Egypt','Egypt.jpg',0,NULL,NULL),(20,'Turkey','Turkey.jpg',0,NULL,NULL),(21,'France','Paris.jpg',0,NULL,NULL),(22,'Canada','Canada.jpg',0,NULL,NULL),(23,'China ','china.png',0,NULL,NULL),(24,'Germany','Germany.jpg',0,NULL,NULL),(25,'Greece','Greece.jpg',0,NULL,NULL),(26,'India','India.jpg',0,NULL,NULL),(27,'japan','japan.jpg',0,NULL,NULL),(28,'Lebanon','Lebanon.jpg',0,NULL,NULL),(29,'Russia','Russia.jpg',0,NULL,NULL),(30,'Italy','Italy.jpg',0,NULL,NULL);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experience`
--

DROP TABLE IF EXISTS `experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experience` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` text,
  `title` varchar(100) NOT NULL,
  `city_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `image_path` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `experience_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experience`
--

LOCK TABLES `experience` WRITE;
/*!40000 ALTER TABLE `experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel` (
  `name` varchar(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image_path` varchar(100) NOT NULL,
  `city_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `location_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rent_car`
--

DROP TABLE IF EXISTS `rent_car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rent_car` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `from_city` int(10) NOT NULL,
  `to_city` int(10) NOT NULL,
  `pick_time` varchar(50) NOT NULL,
  `leaving_time` varchar(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `from_city` (`from_city`,`to_city`),
  KEY `to_city` (`to_city`),
  CONSTRAINT `rent_car_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rent_car_ibfk_4` FOREIGN KEY (`from_city`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rent_car_ibfk_5` FOREIGN KEY (`to_city`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rent_car`
--

LOCK TABLES `rent_car` WRITE;
/*!40000 ALTER TABLE `rent_car` DISABLE KEYS */;
/*!40000 ALTER TABLE `rent_car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1',
  `is_admin` int(2) NOT NULL DEFAULT '0',
  `image_path` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'caroline','caroline@gmail.com','123456',1,1,NULL),(3,'aya','aya@gmail.com','123456',1,1,NULL),(4,'hossam','hossam@gmail.com','123456',1,0,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-08 11:23:27
