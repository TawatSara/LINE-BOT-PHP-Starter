
<?php
$fp = fopen('current.txt', 'r');
if (!$fp) {
    echo 'Could not open file current.txt';
}
while (false !== ($char = fgetc($fp))) {
    echo "$char\n";
}
?>
