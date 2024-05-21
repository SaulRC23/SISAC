SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `carreras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `baja` int(11) NOT NULL,
  `baja_dt` datetime NOT NULL,
  `modificado_dt` datetime NOT NULL,
  `creado_dt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO carreras VALUES
("1","1","Matem&aacute;ticas aplicadas y computaci&oacute;n 01","0","0000-00-00 00:00:00","2023-09-23 19:30:14","2023-09-23 16:07:25"),
("2","2","Matem&aacute;ticas aplicadas y computaci&oacute;n 02","0","2023-09-23 20:49:03","2023-09-23 19:30:32","2023-09-23 16:08:17"),
("3","3","Matem&aacute;ticas aplicadas 03","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-24 13:52:41"),
("4","4","Matem&aacute;ticas aplicadas 04","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-24 13:54:17"),
("5","5","Matem&aacute;ticas aplicadas y computaci&oacute;n 05","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-24 13:54:41"),
("6","6","Matem&aacute;ticas aplicadas 06","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-24 13:54:53"),
("7","7","Matem&aacute;ticas aplicadas 07","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-24 13:55:07"),
("8","8","Matem&aacute;ticas aplicadas 08","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-24 13:55:25");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;