SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `catalogos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `clave` int NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO catalogos VALUES
("2","tipoUsuario","2","Profesor"),
("3","tipoUsuario","3","Estudiante"),
("4","tipoSangre","1","A+"),
("5","tipoSangre","2","A-"),
("6","tipoSangre","3","B+"),
("7","tipoSangre","4","B-"),
("8","tipoSangre","5","AB+"),
("9","tipoSangre","6","AB-"),
("10","tipoSangre","7","O+"),
("11","tipoSangre","8","O-"),
("12","genero","1","Masculino"),
("13","genero","2","Femenino"),
("14","genero","3","Otros"),
("15","estado","1","Activo"),
("16","estado","2","Inactivo"),
("17","estado","3","Baja temporal"),
("20","tipoUsuario","1","Admon"),
("21","dia","1","Lunes"),
("22","dia","2","Martes"),
("23","dia","3","Mi&eacute;rcoles"),
("24","dia","4","Jueves"),
("25","dia","5","Viernes"),
("26","dia","6","S&aacute;bado"),
("27","tipoExamen","1","Examen escrito"),
("28","tipoExamen","2","Examen oral"),
("29","tipoExamen","3","Trabajo"),
("30","tipoMaterial","1","Libro"),
("31","tipoMaterial","2","Libro electrónico"),
("32","tipoMaterial","3","Video");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;