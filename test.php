<?php
require_once "SilverCipher5.php";
require_once "SilverCipher4.php";
require_once "SilverCipher3.php";
require_once "SilverCipher2.php";
require_once "SilverCipher1.php";
$plain_text="Hello World Test 123456789ABC";
$key="Hello World123456789";
echo "Plain Text:<br>".$plain_text."<br><br>";
echo "<br><br>";
echo "Example SilverCipher1 Encrypted Text(1)<br>";
$ht = new SilverCipher1($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example SilverCipher2 Encrypted Text(2)<br>";
$ht = new SilverCipher2($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example SilverCipher3 Encrypted Text(3)<br>";
$ht = new SilverCipher3($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example SilverCipher4 Encrypted Text(4)<br>";
$ht = new SilverCipher4($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example SilverCipher5 Encrypted Text(5)<br>";
$ht = new SilverCipher5($key); // Best
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=$ht->Decrypt($encrypted_text);
?>
