SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` int NOT NULL,
  `correo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `clave` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `apellidoPaterno` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `apellidoMaterno` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `genero` int NOT NULL,
  `telefono` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `codpos` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `tipoSangre` int NOT NULL,
  `estado` tinyint NOT NULL,
  `baja` int NOT NULL,
  `login_dt` datetime DEFAULT NULL,
  `baja_dt` datetime DEFAULT NULL,
  `modificado_dt` datetime DEFAULT NULL,
  `creado_dt` datetime DEFAULT NULL,
  `calificacion` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO usuarios VALUES
("1","1","admon","e1297822f4ce50faf00cce85896f55be0f2233c55f38e2e5771085a550ff9895faf0a03c35c10abf8a8b44ef9d9e1af8774499b769f61ffd3473ca285febe1a4","admin","","","1","+559998223","M&eacute;xico","Ciudad de M&eacute;xico","02710","avatar.png","2004-02-10","2","1","0","2023-09-05 18:32:06","2023-09-05 18:32:06","2023-09-06 15:26:55","2023-09-05 18:32:06","0"),
("2","1","saulromero200323@gmail.com","e1297822f4ce50faf00cce85896f55be0f2233c55f38e2e5771085a550ff9895faf0a03c35c10abf8a8b44ef9d9e1af8774499b769f61ffd3473ca285febe1a4","Saul","Romero","Cruz","1","+559998223","M&eacute;xico","Ciudad de M&eacute;xico","02710","avatar.png","2004-02-10","2","1","0","2023-09-05 18:32:06","2023-09-05 18:32:06","2023-09-06 15:26:55","2023-09-05 18:32:06","0"),
("3","1","saulromero20023@gmail.com","c80d49b2285c4cb4edfe63fdd92252363de5d5f77a35011d85b803a805b651c1b60c69011149eefb620802e43bf323dfe8e1e6e2d4dd331e2c9db3b83b5cf3ba","ssa","ss","ss","2","324325","d","d","3425","wallpaper9.jpg","2024-03-08","6","1","1","","2024-03-05 22:46:24","","2024-03-05 02:16:12","0"),
("4","2","MAAE","e1297822f4ce50faf00cce85896f55be0f2233c55f38e2e5771085a550ff9895faf0a03c35c10abf8a8b44ef9d9e1af8774499b769f61ffd3473ca285febe1a4","Eladio","Martinez","Ambriz","1","4434221289","Mexico","Morelia","57230","wallpaper9.jpg","2003-07-13","8","1","0","","","","2024-03-05 11:43:32","0"),
("5","3","l22120721@morelia.tecnm.mx","e1297822f4ce50faf00cce85896f55be0f2233c55f38e2e5771085a550ff9895faf0a03c35c10abf8a8b44ef9d9e1af8774499b769f61ffd3473ca285febe1a4","Sinuh&eacute;","Sanchez","Contreras","1","4432546523","Mexico","Morelia","58220","201818.png","2003-09-21","3","1","0","","","","2024-03-05 22:48:21","0");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;