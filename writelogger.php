<?
//$a=fopen("logger.txt","a+");//อ่านค่าทั้งหมดมาด้วย
$a=fopen("logger.txt","w");//เขียนทับไปเลย
$strFileName = "current.txt";
$objFopen = fopen($strFileName, 'r');
if ($objFopen) {
    while (!feof($objFopen)) {
    $file = fgets($objFopen, 4096);
    fputs($a,$file);
}
//$d="####".date("d M Y H:i:s")."####\r\n";
//$d="####".date("Y-m-d H:i:s")."####\r\n";
$d="<{date: ".date("Y-m-d H:i:s")."}>"."\r\n";
fputs($a,$d);
//fputs($a,"<{new: ");
//fputs($a,$b);
//fputs($a,"}>");
//fputs($a,"\r\n");

fclose($objFopen);
fclose($a);

echo ("OK");

?>
