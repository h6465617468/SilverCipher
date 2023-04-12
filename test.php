<?php
require_once "HiddenTunnel.php";
$plain_text="Hello World Test 123456789ABC";
$key="Hello World123456789";
echo "Plain Text:<br>".$plain_text."<br><br>";
echo "<br><br>";
echo "Example HiddenTunnel1 Encrypted Text(1)<br>";
$ht = new HiddenTunnel1($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example HiddenTunnel2 Encrypted Text(2)<br>";
$ht = new HiddenTunnel2($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example HiddenTunnel3 Encrypted Text(3)<br>";
$ht = new HiddenTunnel3($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example HiddenTunnel4 Encrypted Text(4)<br>";
$ht = new HiddenTunnel4($key);
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Example HiddenTunnel5 Encrypted Text(5)<br>";
$ht = new HiddenTunnel5($key); // Best
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=$ht->Decrypt($encrypted_text);
?>
