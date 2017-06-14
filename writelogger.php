<?
$a=fopen("logger.txt","a+");
//$d="####".date("d M Y H:i:s")."####\r\n";
//$d="####".date("Y-m-d H:i:s")."####\r\n";
$d="<{date: ".date("Y-m-d H:i:s")."}>"."\r\n";
fputs($a,$d);

fputs($a,"<{data: ");
fputs($a,$dt);
fputs($a,"}>");
fputs($a,"\r\n");
fclose($a);

echo ("OK");

?>
