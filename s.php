<?php
$b = $a = 5;
$c = $a++;
echo $c,"<br>";
echo gettype($c),"<br>";
$e = $d = ++$b;
echo $e,"<br>";
echo gettype($e),"<br>";
$f = (double)($d++);//convert to another data type
echo $f,"<br>";
echo gettype($f),"<br>";
$g = (double)(++$e);
$h = $g += 10;
echo $h,"<br>";
echo gettype($h),"<br>";
$s="test";
$m = $s."13";
echo $m ,"<br>";
echo gettype($m),"<br>";
?>
<?php
	$d="D";

if ($d=="D") 
	echo "Have a nice weekend!"; 
?>