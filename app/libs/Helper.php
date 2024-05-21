<?php  
/**
 * 
 */
class Helper
{
	public static function mostrar($data='', $detener=true)
	{
		print "<pre>";
		var_dump($data);
		print "</pre>";
		if ($detener) {
			exit;
		}
	}

	
  public static function encriptar($data)
  {
    $llaveEncriptada = base64_decode(LLAVE);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
    $cadena = openssl_encrypt($data, "aes-256-cbc", $llaveEncriptada,0,$iv);
    return base64_encode($cadena."::".$iv);
  }

  public static function desencriptar($data)
  {
    $llaveEncriptada = base64_decode(LLAVE);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
    list($cadena,$iv) = array_pad(explode("::",base64_decode($data),2),2,null);
    return openssl_decrypt($cadena, "aes-256-cbc", $llaveEncriptada,0,$iv);
  }

  public static function cadena($cadena){
    //
    $buscar  = array('^', 'delete', 'drop','truncate','exec','system');
    $reemplazar = array('-', 'dele*te', 'dr*op','truneca*te','ex*ec','syst*em');
    $cadena = trim(str_replace($buscar, $reemplazar, $cadena));
    $cadena = addslashes(htmlentities($cadena));
    return $cadena;
  }

  public static function fecha($cadena=""){
    //ISO AAAA-MM-DD
    $salida = false;
    if ($cadena!="") {
      $fecha_array = explode("-", $cadena);
      $salida = checkdate($fecha_array[1], $fecha_array[2], $fecha_array[0]);
    }
    return $salida;
  }

  public static function correo($correo='')
  {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
  }
}


?>