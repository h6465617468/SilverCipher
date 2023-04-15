<?php
require_once "LavaCipher5.php";
require_once "LavaCipher4.php";
require_once "LavaCipher3.php";
require_once "LavaCipher2.php";
require_once "LavaCipher1.php";
$plain_text="Hello World Test 123456789ABC";
$key="Hello World123456789";
echo "Plain Text:<br>".$plain_text."<br><br>";
echo "<br><br>";
echo "Example LavaCipher1 Encrypted Text(1)<br>";
$ht = new LavaCipher1($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example LavaCipher2 Encrypted Text(2)<br>";
$ht = new LavaCipher2($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example LavaCipher3 Encrypted Text(3)<br>";
$ht = new LavaCipher3($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example LavaCipher4 Encrypted Text(4)<br>";
$ht = new LavaCipher4($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example LavaCipher5 Encrypted Text(5)<br>";
$ht = new LavaCipher5($key); // Best
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=$ht->Decrypt($encrypted_text);
?>
