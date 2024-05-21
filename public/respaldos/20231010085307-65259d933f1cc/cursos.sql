SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `temario` varchar(100) NOT NULL,
  `idSalon` int(11) NOT NULL,
  `idProfesor` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `baja` int(11) NOT NULL,
  `baja_dt` datetime NOT NULL,
  `modificado_dt` datetime NOT NULL,
  `creado_dt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO cursos VALUES
("1","101","&Aacute;lgebra Superior 1","MA-1-&Aacute;lgebra Superior I.pdf","2","3","1","2023-10-09","2023-10-31","0","2023-10-01 17:39:31","2023-10-06 10:05:27","2023-10-01 16:20:06"),
("2","2","Geometr&iacute;a Anal&iacute;tica I","MA-1-GeometriaAnalitica.pdf","2","3","2","2023-10-16","2023-11-10","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-09 12:14:33"),
("3","3","&Aacute;lgebra Superior I - verspertino","MA-1-Álgebra Superior I.pdf","1","4","1","2023-10-16","2023-11-06","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-09 20:41:05");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;