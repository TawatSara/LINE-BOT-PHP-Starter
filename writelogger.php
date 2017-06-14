<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<?php
$text1='ABC';
$handle = @fopen("current.txt", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        //echo $buffer;
        $text1 = $buffer;
    }
    if (!feof($handle)) {
        //echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
//echo $text1;

$fa = @fopen("logger.txt", "a+");
if ($fa) {
    fputs($fa,$text1);
    fclose($fa);
}

/*
$a=fopen("logger.txt","a+");//อ่านค่าทั้งหมดมาด้วย
//$a=fopen("logger.txt","w");//เขียนทับไปเลย
fputs($a,$text1);

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
//echo ("OK");

?>
