<?php
class conec{
 public static function conecta_mysql($host, $usu, $senha, $banco)
 {
  try
  {
	  $conec=new PDO('mysql:host='.$host.';dbname='.$banco,$usu, $senha, array(PDO::ATTR_PERSISTENT=>true));
      return $conec;
  }catch (Exception $e)
  {
	  print $e->getMessage();
      exit;
  }
 }
}
// para criar: conec::conecta_mysql($host,$usu,$senha,$banco);
?>

