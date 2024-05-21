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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `clave` varchar(500) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidoPaterno` varchar(100) NOT NULL,
  `apellidoMaterno` varchar(100) NOT NULL,
  `genero` int(11) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codpos` varchar(10) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `tipoSangre` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `baja` int(11) NOT NULL,
  `login_dt` datetime NOT NULL,
  `baja_dt` datetime NOT NULL,
  `modificado_dt` datetime NOT NULL,
  `creado_dt` datetime NOT NULL,
  `calificacion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO usuarios VALUES
("1","1","admon@escuela.com","e2e09a9a2d3ce79d4a82272d546b00d9c1e9dcb7163034f4f48893e43ea1c3b1e3aeda74d1581dceaa20d4c46f2f003b1a32b716fb4af18ded2121525e958e2b","Francisco","Arce","Anguiano","1","+559998223","M&eacute;xico","Ciudad de M&eacute;xico","02710","abuelita.jpg","2004-02-10","2","1","0","2023-09-05 18:32:06","2023-09-05 18:32:06","2023-09-06 15:26:55","2023-09-05 18:32:06","0"),
("3","2","profesor1@escuela.com","f1d12495df8b6e2507a79dbfad9acd55c3c9862bf6736b5418d8b1a75c667aeb6f8d865498e291bd426ef21370925f7c1cba1c40ca004f3848928ba11c3884c0","Juan","L&oacute;pez","San Mateo","1","5512953542","M&eacute;xico","CDMX","54054","estudiante4.jpg","1998-10-02","7","1","0","0000-00-00 00:00:00","2023-09-27 09:53:23","2023-09-27 12:10:26","2023-09-26 17:56:24","0"),
("4","2","profesor2@escuela.com","81683de466bc178a3d5f9baad676498ab3ff2a43487fb7817d22b22e4f5814828bc1898e16c593c5cbae110c048f1427bb47b3cc07f59a8ed7355247ca1e3a65","Alicia","Acosta","San mateo","2","5512953542","M&eacute;xico","mexico city","54054","avatar2.jpg","1970-01-01","4","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-27 12:19:29","0"),
("5","3","estudiante1@escuela.com","e2e09a9a2d3ce79d4a82272d546b00d9c1e9dcb7163034f4f48893e43ea1c3b1e3aeda74d1581dceaa20d4c46f2f003b1a32b716fb4af18ded2121525e958e2b","Adrian Jesus","Aceves","Pastor","1","5500547075","México","Ciudad de México","740524","estudiante1.jpg","1998-12-02","3","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("6","3","estudiante2@escuela.com","","Adriana","Acevedo ","Hernandez","2","5542766038","México","Ciudad de México","183665","estudiante2.jpg","1996-10-04","8","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("7","3","estudiante3@escuela.com","","Alejandro","Aceves","Lopez de Nava","1","5561625847","México","Ciudad de México","644744","estudiante3.jpg","1999-09-06","8","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("8","3","estudiante4@escuela.com","","Alejandro","Acosta","Garcia","1","5532703403","México","Ciudad de México","376114","estudiante4.jpg","1995-08-08","5","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("9","3","estudiante5@escuela.com","","Alicia","Acosta","Baeza","2","5524480457","México","Ciudad de México","613760","estudiante5.jpg","1991-07-10","6","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("10","3","estudiante6@escuela.com","","Alicia Maria","Acosta","Garcia","2","5576492044","México","Ciudad de México","418083","estudiante6.jpg","1980-06-12","8","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("11","3","estudiante7@escuela.com","","Ana Lilia","Acuna","Gallareta","2","5520315061","México","Ciudad de México","437261","estudiante7.jpg","1978-05-11","6","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("12","3","estudiante8@escuela.com","","Arturo","Adame","Gomez","1","5526865897","México","Ciudad de México","791763","estudiante8.jpg","1984-04-09","7","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("13","3","estudiante9@escuela.com","","Benjamin","Aguado","Medina","1","5566535863","México","Ciudad de México","654706","estudiante9.jpg","1998-04-07","6","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("14","3","estudiante10@escuela.com","","Blanca Araceli","Aguario","Albarran","1","5569871491","México","Ciudad de México","990595","estudiante10.jpg","1995-03-06","2","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("15","3","estudiante11@escuela.com","","Carmen Julieta","Aguilar","Tellez","2","5538762830","México","Ciudad de México","391227","estudiante11.jpg","1993-02-06","8","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("16","3","estudiante12@escuela.com","","Diana","Aguilar","Casillas","2","5567180547","México","Ciudad de México","919856","estudiante12.jpg","1991-03-05","3","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("17","3","estudiante13@escuela.com","","Edgar","Aguilar","Flores","1","5594669257","México","Ciudad de México","746032","estudiante13.jpg","1989-04-03","4","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("18","3","estudiante14@escuela.com","","Edmundo Rafael","Aguilar","Galvan","1","5566416948","México","Ciudad de México","949864","estudiante14.jpg","1970-06-02","3","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("19","3","estudiante15@escuela.com","","Elvira","Aguilar","De Llano","2","5577952389","México","Ciudad de México","208790","estudiante1.jpg","1989-07-04","4","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("20","3","estudiante16@escuela.com","","Erika","Aguilar","Castro","2","5557700794","México","Ciudad de México","670200","estudiante2.jpg","1988-09-07","3","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("21","3","estudiante17@escuela.com","","Fernanda","Aguilar","Ramirez","2","5562759359","México","Ciudad de México","350285","estudiante3.jpg","1978-07-09","8","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("22","3","estudiante18@escuela.com","","Francisco Alejandro","Escobar","Diaz","1","5590444929","México","Ciudad de México","794075","estudiante4.jpg","1999-11-01","6","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("23","3","estudiante19@escuela.com","","Gabriel","Acevedo","Hernandez","1","5592760514","México","Ciudad de México","462003","estudiante5.jpg","1997-12-03","1","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("24","3","estudiante20@escuela.com","","Hector","Aceves","Pulido","1","5522323826","México","Ciudad de México","266830","estudiante6.jpg","1993-11-05","3","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("25","3","estudiante21@escuela.com","","Irais","Aceves","Alvarado","2","5531515307","México","Ciudad de México","674533","estudiante7.jpg","1994-09-07","3","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("26","3","estudiante22@escuela.com","","Jose Luis","Acosta","Gonzalez","1","5509790968","México","Ciudad de México","437261","estudiante8.jpg","1992-08-09","8","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("27","3","estudiante23@escuela.com","","Jose Maria","Acosta","Moctezuma","1","5561364966","México","Ciudad de México","791763","estudiante9.jpg","1990-07-11","2","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("28","3","estudiante24@escuela.com","","Josefina","Acosta","Acosta Aguirre","2","5519380430","México","Ciudad de México","654706","estudiante10.jpg","1981-06-12","5","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("29","3","estudiante25@escuela.com","","Juan Jesus","Adame","Adame Garcia","1","5544174560","México","Ciudad de México","990595","estudiante11.jpg","1979-05-10","1","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("30","3","estudiante26@escuela.com","","Julio Cesar","Adams","Adams Huitron","1","5514436268","México","Ciudad de México","391227","estudiante12.jpg","1978-04-08","5","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("31","3","estudiante27@escuela.com","","Laura Patricia","Aguado ","","2","5519010330","México","Ciudad de México","919856","estudiante13.jpg","1996-05-05","6","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("32","3","estudiante28@escuela.com","","Monica","Aguayo","Labastida","2","5571326173","México","Ciudad de México","746032","estudiante14.jpg","1994-03-07","5","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("33","3","estudiante29@escuela.com","","Monica","Aguilar","Ochoa","2","5547265044","México","Ciudad de México","949864","estudiante1.jpg","1992-02-07","4","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("34","3","estudiante30@escuela.com","","Nora Karina","Aguilar","Ramirez","2","5591383442","México","Ciudad de México","208790","estudiante2.jpg","1989-03-04","5","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("35","3","estudiante31@escuela.com","","Pavel Alfonso","Aguilar","Rendon","1","5595634781","México","Ciudad de México","670200","estudiante3.jpg","1979-05-02","1","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("36","3","estudiante32@escuela.com","","Roberto Carlos","Aguilar","Gomez Tagle","1","5583865599","México","Ciudad de México","350285","estudiante4.jpg","1988-05-03","8","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("37","3","estudiante33@escuela.com","","Tania Gabriela","Aguilar","Pedrero","2","5550318887","México","Ciudad de México","794075","estudiante5.jpg","1977-08-06","7","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("38","3","estudiante34@escuela.com","","Victoria Eugenia","Aguilar","Sanchez","2","5505513442","México","Ciudad de México","462003","estudiante6.jpg","1989-07-08","8","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0"),
("39","3","estudiante35@escuela.com","","Virginia","Aguilar","Flores","2","5593286179","México","Ciudad de México","266830","estudiante7.jpg","1998-11-10","6","1","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-09-06 12:00:00","0");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;