<?
//$a=fopen("logger.txt","a+");//อ่านค่าทั้งหมดมาด้วย
$a=fopen("logger.txt","w");//เขียนทับไปเลย
//$d="####".date("d M Y H:i:s")."####\r\n";
//$d="####".date("Y-m-d H:i:s")."####\r\n";
$d="<{date: ".date("Y-m-d H:i:s")."}>"."\r\n";
fputs($a,$d);

fputs($a,"<{new: ");
fputs($a,$b);
fputs($a,"}>");
fputs($a,"\r\n");
fclose($a);

echo ("OK");

?>
