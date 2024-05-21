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
  `id` int NOT NULL AUTO_INCREMENT,
  `clave` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `temario` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `idSalon` int NOT NULL,
  `idProfesor` int NOT NULL,
  `idMateria` int NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `baja` int NOT NULL,
  `baja_dt` datetime DEFAULT NULL,
  `modificado_dt` datetime DEFAULT NULL,
  `creado_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO cursos VALUES
("1","A","Calculo Diferencial","AC001CalculoDiferencial.pdf","1","4","1","2024-01-29","2024-06-07","0","","2024-03-05 23:17:35","2024-03-05 22:54:19");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;