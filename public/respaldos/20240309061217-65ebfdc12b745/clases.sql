SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `clases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCurso` int NOT NULL,
  `fecha` date NOT NULL,
  `observacion` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `tipoExamen` int NOT NULL,
  `calificacion` int NOT NULL,
  `baja` int NOT NULL,
  `baja_dt` datetime DEFAULT NULL,
  `modificado_dt` datetime DEFAULT NULL,
  `creado_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO clases VALUES
("1","1","2024-01-29","","0","0","0","","","2024-03-05 22:55:25"),
("2","1","2024-02-05","","0","0","0","","","2024-03-05 22:55:25"),
("3","1","2024-02-12","","1","80","0","","2024-03-05 23:28:47","2024-03-05 22:55:25"),
("4","1","2024-02-19","","0","0","0","","","2024-03-05 22:55:25"),
("5","1","2024-02-26","","0","0","0","","","2024-03-05 22:55:25"),
("6","1","2024-03-04","examen unidad 2","1","75","0","","2024-03-05 23:29:09","2024-03-05 22:55:25"),
("7","1","2024-03-11","","0","0","0","","","2024-03-05 22:55:25"),
("8","1","2024-03-18","","0","0","0","","","2024-03-05 22:55:25"),
("9","1","2024-03-25","","0","0","0","","","2024-03-05 22:55:25"),
("10","1","2024-04-01","","0","0","0","","","2024-03-05 22:55:25"),
("11","1","2024-04-08","","0","0","0","","","2024-03-05 22:55:25"),
("12","1","2024-04-15","","0","0","0","","","2024-03-05 22:55:25"),
("13","1","2024-04-22","","0","0","0","","","2024-03-05 22:55:25"),
("14","1","2024-04-29","","0","0","0","","","2024-03-05 22:55:25"),
("15","1","2024-05-06","","0","0","0","","","2024-03-05 22:55:25"),
("16","1","2024-05-13","","0","0","0","","","2024-03-05 22:55:25"),
("17","1","2024-05-20","","0","0","0","","","2024-03-05 22:55:25"),
("18","1","2024-05-27","","0","0","0","","","2024-03-05 22:55:25"),
("19","1","2024-06-03","","0","0","0","","","2024-03-05 22:55:25");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;