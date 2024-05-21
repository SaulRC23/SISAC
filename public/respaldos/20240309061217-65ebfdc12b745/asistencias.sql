SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `asistencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idClase` int NOT NULL,
  `idEstudiante` int NOT NULL,
  `idCurso` int NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO asistencias VALUES
("1","1","5","1","1"),
("2","2","5","1","1"),
("3","3","5","1","1"),
("4","4","5","1","1"),
("5","5","5","1","1"),
("6","6","5","1","1"),
("7","7","5","1","2"),
("8","8","5","1","1"),
("9","9","5","1","1"),
("10","10","5","1","1"),
("11","11","5","1","1"),
("12","12","5","1","1"),
("13","13","5","1","1"),
("14","14","5","1","1"),
("15","15","5","1","1"),
("16","16","5","1","1"),
("17","17","5","1","1"),
("18","18","5","1","1"),
("19","19","5","1","1");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;