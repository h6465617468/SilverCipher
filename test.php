<?php
require_once "TreeBox.php";
$plain_text="Hello World Test 123456789ABC";
$key="Hello World123456789";
echo "Plain Text:<br>".$plain_text."<br><br>";
echo "<br><br>";
echo "Example TreeBox1 Encrypted Text(1)<br>";
$ht = new TreeBox1($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example TreeBox2 Encrypted Text(2)<br>";
$ht = new TreeBox2($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example TreeBox3 Encrypted Text(3)<br>";
$ht = new TreeBox3($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example TreeBox4 Encrypted Text(4)<br>";
$ht = new TreeBox4($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example TreeBox5 Encrypted Text(5)<br>";
$ht = new TreeBox5($key); // Best
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=$ht->Decrypt($encrypted_text);
?>
