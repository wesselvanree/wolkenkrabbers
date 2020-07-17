CREATE TABLE `spelers` (
 `id` int(4) NOT NULL AUTO_INCREMENT,
 `username` varchar(32) NOT NULL,
 `score` int(32) NOT NULL,
 `moeilijkheidsgraad` varchar(32) NOT NULL,
 PRIMARY KEY (`id`)
) -- ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1

-- Dat laatste is misschien optioneel
-- Maak deze tabel in een database met de naam 'wolkenkrabbers'
