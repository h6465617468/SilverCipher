<?php
require_once "EuclidBox5.php";
require_once "EuclidBox4.php";
require_once "EuclidBox3.php";
require_once "EuclidBox2.php";
require_once "EuclidBox1.php";
$plain_text="Hello World Test 123456789ABC";
$key="Hello World123456789";
echo "Plain Text:<br>".$plain_text."<br><br>";
echo "<br><br>";
echo "Example EuclidBox1 Encrypted Text(1)<br>";
$ht = new EuclidBox1($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example EuclidBox2 Encrypted Text(2)<br>";
$ht = new EuclidBox2($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example EuclidBox3 Encrypted Text(3)<br>";
$ht = new EuclidBox3($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example EuclidBox4 Encrypted Text(4)<br>";
$ht = new EuclidBox4($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example EuclidBox5 Encrypted Text(5)<br>";
$ht = new EuclidBox5($key); // Best
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=$ht->Decrypt($encrypted_text);
?>
