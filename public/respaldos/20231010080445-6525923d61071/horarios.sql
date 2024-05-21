SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(11) NOT NULL,
  `idSalon` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `observacion` varchar(200) NOT NULL,
  `baja` int(11) NOT NULL,
  `baja_dt` datetime NOT NULL,
  `modificado_dt` datetime NOT NULL,
  `creado_dt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO horarios VALUES
("1","1","1","1","10:00:00","12:00:00","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-06 09:58:34"),
("2","1","1","3","10:00:00","12:00:00","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-06 09:58:59"),
("3","1","1","5","10:00:00","12:00:00","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-06 09:59:26"),
("4","2","2","2","08:00:00","10:00:00","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-09 12:15:41"),
("5","2","2","4","08:00:00","10:00:00","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-09 12:16:28");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;