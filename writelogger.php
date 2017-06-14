<?
$text1='A';
$fp = fopen('current.txt', 'r');
if (!$fp) {
    //echo 'Could not open file current.txt';
}
while (false !== ($char = fgetc($fp))) {
    //echo "$char\n";
    $text1=$char;
}
fclose($fp);

//$a=fopen("logger.txt","a+");//อ่านค่าทั้งหมดมาด้วย
//$a=fopen("logger.txt","w");//เขียนทับไปเลย
//fputs($a,$text1);
/*
//$d="####".date("d M Y H:i:s")."####\r\n";
//$d="####".date("Y-m-d H:i:s")."####\r\n";
$d="<{date: ".date("Y-m-d H:i:s")."}>"."\r\n";
fputs($a,$d);
fputs($a,"<{new: ");
fputs($a,$b);
fputs($a,"}>");
fputs($a,"\r\n");
*/
    
//fclose($a);
echo ($text1);

//echo ("OK");

?>
