SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `escuela`
--



CREATE TABLE `materiales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` int(11) NOT NULL,
  `tipoMaterial` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `referencia` varchar(200) NOT NULL,
  `baja` int(11) NOT NULL,
  `baja_dt` datetime NOT NULL,
  `modificado_dt` datetime NOT NULL,
  `creado_dt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO materiales VALUES
("1","101","1","C&aacute;rdenas, H., Lluis, E., Raggi, F., Tom&aacute;s, F., &Aacute;lgebra Superior. M&eacute;xico:","5855585556","0","0000-00-00 00:00:00","2023-09-30 17:58:04","2023-09-30 16:10:29"),
("2","201","2","Nachbin, L., &Aacute;lgebra Elemental. Washington, USA: Secretar&iacute;a General de la OEA, Program","www.escuela.com.mx","0","2023-09-30 18:02:51","2023-09-30 17:58:18","2023-09-30 16:16:03"),
("3","202","1","Efimov, N. Geometr&iacute;a Superior. Mosc&uacute;: MIR., 1984","5855585556:55555","0","0000-00-00 00:00:00","2023-10-10 16:56:27","2023-10-10 16:55:07"),
("4","203","1","Preston, G. C., Lovaglia, A. R., Modern Analytic Geometry. New York: Harper &amp; Row, 1971.","5855585556","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-10 16:57:26"),
("5","204","1","Hilbert, D., Cohn Vossen, S., Geometry and the Imagination. M&eacute;xico: V&iacute;nculos Matem&aac","585558555","0","0000-00-00 00:00:00","0000-00-00 00:00:00","2023-10-10 16:58:17");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;