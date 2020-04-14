-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: cpsc471
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `Actor`
--

DROP TABLE IF EXISTS `Actor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Actor` (
  `ActorName` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ActorName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Actor`
--

LOCK TABLES `Actor` WRITE;
/*!40000 ALTER TABLE `Actor` DISABLE KEYS */;
INSERT INTO `Actor` VALUES ('Aaron Paul'),('Aloma Wright'),('Amanda Abbington'),('Amanda Schull'),('Andrew Scott'),('Angela Kinsey'),('Anna Gunn'),('Art Parkinson'),('B.J Novak'),('Benedict Cumberbatch'),('Betsy Brandt'),('Bob Odenkirk'),('Brain Baumgartner'),('Bryan Cranston'),('Cara Gee'),('Cas Anavar'),('Craig Robinson'),('Creed Bratton'),('Dean Norris'),('Dominique Tipper'),('Dule Hill'),('Ed Helms'),('Ellie Kemper'),('Emilia Clarke'),('Florence Faivre'),('Frankie Adams'),('Gabriel Macht'),('Giancarlo Esposito'),('Gina Torres'),('Harry Lloyd'),('Isaac Hempstead-Wright'),('Jack Gleeson'),('Jenna Fischer'),('John Krasinski'),('Jonathan Banks'),('Kate Flannery'),('Katherine Heigl'),('Kit Harrington'),('Lena Headley'),('Leslie David Baker'),('Louise Brealey'),('Maisie Williams'),('Mark Addy'),('Mark Gatiss'),('Martin Freeman'),('Meghan Markle'),('Michelle Fairley'),('Mikolaj Coster-Waldau'),('Mindy Kaling'),('Oscar Nunez'),('Patrick J. Adams'),('Paul Lieberstein'),('Paulo Costanzo'),('Peter Dinklage'),('Phyllis Smith'),('Rachael Harris'),('Rainn Wilson'),('Richard Madden'),('Rick Hoffman'),('RJ Mitte'),('Rupert Graves'),('Sarah Rafferty'),('Sean Bean'),('Shawn Doyle'),('Shohreh Aghgashloo'),('Sophie Turner'),('Steve Carell'),('Steven Michael Quezada'),('Steven Strait'),('Thomas Jane'),('Una Stubbs'),('Wendell Pierce'),('Wes Chatham');
/*!40000 ALTER TABLE `Actor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ActsIn`
--

DROP TABLE IF EXISTS `ActsIn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ActsIn` (
  `ShowID` int(11) NOT NULL,
  `ActorName` varchar(50) COLLATE latin1_general_ci NOT NULL,
  KEY `ShowID` (`ShowID`),
  KEY `ActorName` (`ActorName`),
  CONSTRAINT `ActsIn_ibfk_1` FOREIGN KEY (`ActorName`) REFERENCES `Actor` (`ActorName`),
  CONSTRAINT `ActsIn_ibfk_2` FOREIGN KEY (`ShowID`) REFERENCES `Shows` (`ShowID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ActsIn`
--

LOCK TABLES `ActsIn` WRITE;
/*!40000 ALTER TABLE `ActsIn` DISABLE KEYS */;
INSERT INTO `ActsIn` VALUES (2,'Benedict Cumberbatch'),(2,'Martin Freeman'),(2,'Rupert Graves'),(2,'Una Stubbs'),(2,'Mark Gatiss'),(2,'Louise Brealey'),(2,'Andrew Scott'),(2,'Amanda Abbington'),(3,'Gabriel Macht'),(3,'Rick Hoffman'),(3,'Patrick J. Adams'),(3,'Sarah Rafferty'),(3,'Meghan Markle'),(3,'Gina Torres'),(3,'Amanda Schull'),(3,'Wendell Pierce'),(3,'Dule Hill'),(3,'Aloma Wright'),(3,'Rachael Harris'),(3,'Katherine Heigl'),(4,'Bryan Cranston'),(4,'Anna Gunn'),(4,'Aaron Paul'),(4,'Betsy Brandt'),(4,'RJ Mitte'),(4,'Dean Norris'),(4,'Bob Odenkirk'),(4,'Steven Michael Quezada'),(4,'Jonathan Banks'),(4,'Giancarlo Esposito'),(5,'Thomas Jane'),(5,'Steven Strait'),(5,'Cas Anavar'),(5,'Dominique Tipper'),(5,'Wes Chatham'),(5,'Paulo Costanzo'),(5,'Florence Faivre'),(5,'Shawn Doyle'),(5,'Shohreh Aghgashloo'),(5,'Frankie Adams'),(5,'Cara Gee'),(6,'Rainn Wilson'),(6,'John Krasinski'),(6,'Jenna Fischer'),(6,'Leslie David Baker'),(6,'Brain Baumgartner'),(6,'Angela Kinsey'),(6,'Phyllis Smith'),(6,'Kate Flannery'),(6,'Creed Bratton'),(6,'Oscar Nunez'),(6,'B.J Novak'),(6,'Mindy Kaling'),(6,'Ed Helms'),(6,'Paul Lieberstein'),(6,'Steve Carell'),(6,'Craig Robinson'),(6,'Ellie Kemper');
/*!40000 ALTER TABLE `ActsIn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Add_Remove`
--

DROP TABLE IF EXISTS `Add_Remove`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Add_Remove` (
  `AdminID` int(11) NOT NULL,
  `ShowID` int(11) NOT NULL,
  `SeasonNum` int(11) NOT NULL,
  `EpisodeNum` int(11) NOT NULL,
  KEY `AdminID` (`AdminID`),
  KEY `ShowID` (`ShowID`),
  KEY `SeasonNum` (`SeasonNum`),
  KEY `EpisodeNum` (`EpisodeNum`),
  CONSTRAINT `Add_Remove_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `Admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Add_Remove_ibfk_2` FOREIGN KEY (`ShowID`) REFERENCES `Shows` (`ShowID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Add_Remove_ibfk_3` FOREIGN KEY (`SeasonNum`) REFERENCES `Season` (`SeasonNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Add_Remove_ibfk_4` FOREIGN KEY (`EpisodeNum`) REFERENCES `Episode` (`EpisodeNum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Add_Remove`
--

LOCK TABLES `Add_Remove` WRITE;
/*!40000 ALTER TABLE `Add_Remove` DISABLE KEYS */;
/*!40000 ALTER TABLE `Add_Remove` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Admin`
--

DROP TABLE IF EXISTS `Admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`AdminID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Admin`
--

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;
INSERT INTO `Admin` VALUES (1,'Dal'),(2,'Jarred'),(3,'Kell');
/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Episode`
--

DROP TABLE IF EXISTS `Episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Episode` (
  `Title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `EpisodeNum` int(11) NOT NULL,
  `Synopsis` varchar(1000) COLLATE latin1_general_ci NOT NULL,
  `Runtime` int(11) NOT NULL,
  `SeasonNum` int(11) NOT NULL,
  `ShowID` int(11) NOT NULL,
  KEY `EpisodeNum` (`EpisodeNum`),
  KEY `SeasonNum` (`SeasonNum`),
  KEY `ShowID` (`ShowID`),
  CONSTRAINT `Episode_ibfk_1` FOREIGN KEY (`ShowID`) REFERENCES `Shows` (`ShowID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Episode_ibfk_2` FOREIGN KEY (`SeasonNum`) REFERENCES `Season` (`SeasonNum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Episode`
--

LOCK TABLES `Episode` WRITE;
/*!40000 ALTER TABLE `Episode` DISABLE KEYS */;
INSERT INTO `Episode` VALUES ('Winter is Coming',1,'A really boring start to the show.',45,1,1),('The Kingsroad',2,'The Lannisters plot to ensure Bran\'s silence; Jon and Tyrion head to the Wall; Ned faces a family crisis en route to King\'s Landing.',56,1,1),('Lord Snow',3,'Jon impresses Tyrion at Castle Black; Ned confronts his past and future at King\'s Landing; Daenerys finds herself at odds with Viserys.',58,1,1),('Cripples, Bastards, and Broken Things',4,'Ned probes Arryn\'s death; Jon takes measures to protect Sam; Tyrion is caught in the wrong place.',56,1,1),('The Wolf and the Lion',5,'Ned refuses an order from the King; Tyrion escapes one perilous encounter, only to find himself in another.',55,1,1),('A Golden Crown',6,'Ned makes a controversial decree; Tyrion confesses to his \"crimes\"; Viserys receives final payment for Daenerys.',53,1,1),('You Win or You Die',7,'Ned confronts Cersei about her secrets; Jon takes his Night\'s Watch vows; Drogo promises to lead the Dothraki to King\'s Landing.',58,1,1),('The Pointy End',8,'The Lannisters press their advantage over the Starks; Robb rallies his father\'s northern allies and heads south to war.',59,1,1),('Baelor',9,'Ned makes a fateful decision; Robb takes a prized prisoner; Dany finds her reign imperiled.',57,1,1),('Fire and Blood',10,'A new king rises in the North; a Khaleesi finds new hope.',53,1,1),('The North Remembers',1,'Tyrion arrives to save Joffrey\'s crown; Daenerys searches for allies and water in the Red Waste; Jon Snow faces the wilderness beyond the Wall.',53,2,1),('The Night Lands',2,'Arya shares a secret; a scout returns to Dany with disturbing news; Theon comes home to the Iron Islands; Tyrion administers justice; Jon witnesses a terrible crime.',54,2,1),('What is Dead May Never Die',3,'Tyrion roots out a spy; Catelyn meets a new king and queen; Bran dreams; Theon drowns.',53,2,1),('Garden of Bones',4,'Catelyn tries to save two kings from themselves; Tyrion practices coercion; Robb meets a foreigner; Dany finds her ally; Melisandre casts a shadow on the Stormlands.',51,2,1),('The Ghost of Harrenhal',5,'The Baratheon rivalry ends; Tyrion learns of Cersei\'s secret weapon; Dany suffers a loss; Arya collects a debt she didn\'t know was owed; Jon Snow meets a legend.',55,2,1),('The Old Gods and the New',6,'Arya has a surprise visitor; Dany vows to take what is hers; Joffrey meets his subjects; Qhorin gives Jon a chance to prove himself.',54,2,1),('A Man Without Honor',7,'Jaime meets a relative; Theon hunts; Dany receives an invitation.',56,2,1),('The Prince of Winterfell',8,'Theon holds down the fort; Arya calls in her debt with Jaqen; Robb is betrayed; Stannis and Davos approach their destination.',54,2,1),('Blackwater',9,'Tyrion and the Lannisters fight for their lives as Stannis\' fleet assaults King\'s Landing.',55,2,1),('Valar Morghulis',10,'Arya receives a gift from Jaqen; Dany goes to a strange place; Jon proves himself.',64,2,1),('Valar Dohaeris',1,'Jon is tested by the wildling king; Tyrion asks for his reward; Daenerys sails into Slaver\'s Bay. ',55,3,1),('Dark Wings, Dark Words',2,'Arya runs into the Brotherhood Without Banners; Jaime finds a way to pass the time.',57,3,1),('Walk of Punishment',3,'Dany hears the price; Jaime strikes a deal with his captors.',57,3,1),('And Now His Watch is Ended',4,'The Night\'s Watch takes stock; Dany exchanges a chain for a whip.',57,3,1),('Kissed by Fire',5,'The Hound is judged; Jon proves himself; Robb is betrayed.',57,3,1),('The Climb',6,'Four Houses consider make-or-break alliances; Jon and the wildlings face a daunting climb.',57,3,1),('The Bear and the Maiden Fair',7,'Dany exchanges gifts in Yunkai; Brienne faces a formidable foe in Harrenhal.',57,3,1),('Second Sons',8,'Dany meets the Titan\'s Bastard; King\'s Landing hosts a royal wedding.',57,3,1),('The Rains of Castamere',9,'House Frey joins forces with House Tully; Jon faces his most difficult test yet.',57,3,1),('Mhysa',10,'Joffrey challenges Tywin; Dany waits to see if she is a conqueror or a liberator.',63,3,1),('Two Swords',1,'King\'s Landing prepares for a royal wedding; Dany finds the way to Meereen; the Night\'s Watch braces for a new threat.',58,4,1),('The Lion and the Rose',2,'The Lannisters and their guests gather in King\'s Landing.',53,4,1),('Breaker of Chains',3,'Tyrion ponders his options; Tywin extends an olive branch; Jon proposes a bold plan.',57,4,1),('Oathkeeper',4,'Dany balances justice and mercy; Jaime turns to Brienne; Jon readies his men.',55,4,1),('First of His Name',5,'Cersei and Tywin plot the Crown\'s next move; Jon embarks on a new mission.',53,4,1),('The Laws of Gods and Men',6,'Tyrion faces down his father in the Throne Room.',51,4,1),('Mockingbird',7,'Tyrion enlists an unlikely ally.',51,4,1),('The Mountain and the Viper',8,'Mole\'s Town receives unexpected visitors; Tyrion\'s fate is decided.',52,4,1),('The Watchers on the Wall',9,'The Night\'s Watch face their biggest challenge.',51,4,1),('The Children',10,'Dany faces some harsh realities; Tyrion sees the truth of his situation.',65,4,1);
/*!40000 ALTER TABLE `Episode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Genre`
--

DROP TABLE IF EXISTS `Genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Genre` (
  `GenreName` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`GenreName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Genre`
--

LOCK TABLES `Genre` WRITE;
/*!40000 ALTER TABLE `Genre` DISABLE KEYS */;
INSERT INTO `Genre` VALUES ('Action'),('Comedy'),('Documentary'),('Drama'),('Romcom'),('Science Fiction'),('Thriller');
/*!40000 ALTER TABLE `Genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Manages`
--

DROP TABLE IF EXISTS `Manages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Manages` (
  `AdminID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  KEY `AdminID` (`AdminID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `Manages_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `Admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Manages_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Manages`
--

LOCK TABLES `Manages` WRITE;
/*!40000 ALTER TABLE `Manages` DISABLE KEYS */;
INSERT INTO `Manages` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(3,13),(3,14),(3,15),(3,16),(1,17),(2,18),(3,19),(1,20),(2,21);
/*!40000 ALTER TABLE `Manages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Network`
--

DROP TABLE IF EXISTS `Network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Network` (
  `NetworkName` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `Logo` varchar(200) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`NetworkName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Network`
--

LOCK TABLES `Network` WRITE;
/*!40000 ALTER TABLE `Network` DISABLE KEYS */;
INSERT INTO `Network` VALUES ('ABC','https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/ABC_%282013%29_Dark_Grey.svg/300px-ABC_%282013%29_Dark_Grey.svg.png'),('Amazon','https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Amazon_Prime_Video_logo.svg/2880px-Amazon_Prime_Video_logo.svg.png'),('AMC','https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Amc_theatres_logo.svg/1200px-Amc_theatres_logo.svg.png'),('BBC One','https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/BBC_One_logo.svg/2880px-BBC_One_logo.svg.png'),('CBC','https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/CBC_Radio-Canada_logo.svg/2880px-CBC_Radio-Canada_logo.svg.png'),('CNBC','https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/CNBC_logo.svg/400px-CNBC_logo.svg.png'),('Disney','https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/The_Walt_Disney_Company_Logo.svg/2880px-The_Walt_Disney_Company_Logo.svg.png'),('HBO','https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/HBO_logo.svg/844px-HBO_logo.svg.png'),('NBC','https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/NBC_logo.svg/1039px-NBC_logo.svg.png'),('Netflix','https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Netflix_2015_logo.svg/2880px-Netflix_2015_logo.svg.png'),('SyFy','https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/SYFY.svg/2880px-SYFY.svg.png'),('USA Network','https://upload.wikimedia.org/wikipedia/commons/thumb/3/38/USA-Network-Logo.svg/1200px-USA-Network-Logo.svg.png');
/*!40000 ALTER TABLE `Network` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Season`
--

DROP TABLE IF EXISTS `Season`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Season` (
  `Name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `SeasonNum` int(11) NOT NULL,
  `ShowID` int(11) NOT NULL,
  KEY `SeasonNum` (`SeasonNum`),
  KEY `ShowID` (`ShowID`) USING BTREE,
  CONSTRAINT `Season_ibfk_1` FOREIGN KEY (`ShowID`) REFERENCES `Shows` (`ShowID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Season`
--

LOCK TABLES `Season` WRITE;
/*!40000 ALTER TABLE `Season` DISABLE KEYS */;
INSERT INTO `Season` VALUES ('Series One',1,2),('Series Two',2,2),('Series Three',3,2),('Series Four',4,2),('Season One',1,3),('Season Two',2,3),('Season Three',3,3),('Season One',1,4),('Season Two',2,4),('Season Three',3,4),('Season One',1,5),('Season Two',2,5),('Season Three',3,5),('Season One',1,6),('Season Two',2,6),('Season Three',3,6),('Season One',1,1),('Season One',1,1),('Season Two',2,1);
/*!40000 ALTER TABLE `Season` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Shows`
--

DROP TABLE IF EXISTS `Shows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Shows` (
  `ShowID` int(11) NOT NULL,
  `Title` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Description` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Poster` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `Rating` double NOT NULL,
  `GenreName` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `NetworkName` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ShowID`),
  KEY `GenreName` (`GenreName`),
  KEY `NetworkName` (`NetworkName`),
  CONSTRAINT `Shows_ibfk_1` FOREIGN KEY (`GenreName`) REFERENCES `Genre` (`GenreName`),
  CONSTRAINT `Shows_ibfk_2` FOREIGN KEY (`NetworkName`) REFERENCES `Network` (`NetworkName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shows`
--

LOCK TABLES `Shows` WRITE;
/*!40000 ALTER TABLE `Shows` DISABLE KEYS */;
INSERT INTO `Shows` VALUES (1,'Game of Thrones','GoT description','no poster available',9.3,'Drama','HBO'),(2,'Sherlock','Sherlock is a British crime television series based on Sir Arthur Conan Doyle\'s Sherlock Holmes detective stories','https://upload.wikimedia.org/wikipedia/en/4/4d/Sherlock_titlecard.jpg',9.1,'Thriller','BBC One'),(3,'Suits','Mike Ross, a talented young college dropout, is hired as an associate by Harvey Specter, one of New York\'s best lawyers. They must handle cases while keeping Mike\'s qualifications a secret.','https://m.media-amazon.com/images/M/MV5BNmVmMmM5ZmItZDg0OC00NTFiLWIxNzctZjNmYTY5OTU3ZWU3XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg',8.5,'Drama','USA Network'),(4,'Breaking Bad','Walter White, a chemistry teacher, discovers that he has cancer and decides to get into the meth-making business to repay his medical debts. His priorities begin to change when he partners with Jesse.','https://n.sinaimg.cn/sinacn20120/237/w2037h3000/20191202/d716-ikcacer6666613.jpg',9.5,'Action','AMC'),(5,'The Expanse','The Expanse is an American science fiction television series developed by Mark Fergus and Hawk Ostby, based on the series of novels of the same name by James S. A. Corey.','https://images2.minutemediacdn.com/image/fetch/c_fill,g_auto,f_auto,h_1524,w_980/https%3A%2F%2Fwinteriscoming.net%2Ffiles%2F2019%2F07%2FScreen-Shot-2019-07-18-at-11.40.37-AM.jpg',8.5,'Action','Amazon'),(6,'The Office','A mediocre paper company in the hands of Scranton, PA branch manager Michael Scott. This mockumentary follows the everyday lives of the manager and the employees he \"manages.\"','https://i.pinimg.com/originals/80/14/f1/8014f1e1dbbcb6bae8cf3f4d50d4d6b5.jpg',8.9,'Comedy','NBC');
/*!40000 ALTER TABLE `Shows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Track`
--

DROP TABLE IF EXISTS `Track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Track` (
  `UserID` int(11) NOT NULL,
  `ShowID` int(11) NOT NULL,
  `SeasonNum` int(11) NOT NULL,
  `EpisodeNum` int(11) NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ShowID` (`ShowID`),
  KEY `SeasonNum` (`SeasonNum`),
  KEY `EpisodeNum` (`EpisodeNum`),
  CONSTRAINT `Track_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Track_ibfk_2` FOREIGN KEY (`ShowID`) REFERENCES `Shows` (`ShowID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Track_ibfk_3` FOREIGN KEY (`SeasonNum`) REFERENCES `Season` (`SeasonNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Track_ibfk_4` FOREIGN KEY (`EpisodeNum`) REFERENCES `Episode` (`EpisodeNum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Track`
--

LOCK TABLES `Track` WRITE;
/*!40000 ALTER TABLE `Track` DISABLE KEYS */;
INSERT INTO `Track` VALUES (1,1,1,1),(1,1,1,2),(1,1,1,3),(2,1,1,1),(2,1,1,2),(2,1,1,3),(2,1,1,4),(20,2,1,1),(20,2,1,2),(20,2,1,3),(20,2,2,1),(20,2,2,2),(20,2,2,3),(16,2,4,1),(16,2,4,2),(16,2,4,3),(11,3,1,1),(11,3,2,6),(11,4,2,2),(11,4,3,1),(11,5,1,8),(11,5,2,1),(11,6,1,5),(13,5,2,1),(18,1,1,3),(18,4,1,4);
/*!40000 ALTER TABLE `Track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TrackShow`
--

DROP TABLE IF EXISTS `TrackShow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TrackShow` (
  `UserID` int(11) NOT NULL,
  `ShowID` int(11) NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ShowID` (`ShowID`),
  CONSTRAINT `TrackShow_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TrackShow_ibfk_4` FOREIGN KEY (`ShowID`) REFERENCES `Track` (`ShowID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrackShow`
--

LOCK TABLES `TrackShow` WRITE;
/*!40000 ALTER TABLE `TrackShow` DISABLE KEYS */;
/*!40000 ALTER TABLE `TrackShow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Kell'),(2,'Dal'),(3,'Jared'),(4,'Jacob'),(5,'Ezra'),(6,'Zach'),(7,'George'),(8,'Drew'),(9,'Xannah'),(10,'Kaden'),(11,'Nadif'),(12,'John'),(13,'Eric'),(14,'Mike'),(15,'Owen'),(16,'Vanessa'),(17,'Abbey'),(18,'Brody'),(19,'Grayson'),(20,'Colin'),(21,'Keifer');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-13 22:23:12
