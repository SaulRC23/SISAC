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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idCarrera` int(11) NOT NULL,
  `temario` varchar(100) NOT NULL,
  `baja` int(11) NOT NULL,
  `baja_dt` datetime NOT NULL,
  `modificado_dt` datetime NOT NULL,
  `creado_dt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO materias VALUES
("1","1","&Aacute;lgebra Superior 01","1","","0","0000-00-00 00:00:00","2023-09-25 12:34:57","2023-09-25 10:56:17"),
("2","2","Geometr&iacute;a Anal&iacute;tica I","1","MA-1-GeometriaAnalitica.pdf","0","2023-09-25 12:37:51","0000-00-00 00:00:00","2023-09-25 11:01:41");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;