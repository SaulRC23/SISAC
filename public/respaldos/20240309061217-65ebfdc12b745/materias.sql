SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `materias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clave` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `idCarrera` int NOT NULL,
  `temario` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `baja` int NOT NULL,
  `baja_dt` datetime DEFAULT NULL,
  `modificado_dt` datetime DEFAULT NULL,
  `creado_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO materias VALUES
("1","ACF-0901","Calculo Diferencial","2","AC001CalculoDiferencial.pdf","0","","","2024-03-05 22:45:42"),
("2","AED-1285","Fundamentos De Programacion","2","AE085FundamentosProgramacion.pdf","0","","","2024-03-05 22:46:14"),
("3","ACA-0907","Taller De Etica","2","","0","","","2024-03-06 15:33:28"),
("4","AEF-1041","Matematicas Discretas","2","","0","","","2024-03-06 15:33:44"),
("5","SCH-1024","Taller De Administracion","2","","0","","","2024-03-06 15:33:58"),
("6","ACC-0906","Fundamentos De Investigacion","2","","0","","","2024-03-06 15:34:15");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;