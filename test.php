<?php
require_once "HiddenTunnel.php";
$plain_text="Hello World Test 123456789ABC";
$key="Hello World123456789";
echo "Plain Text:<br>".$plain_text."<br><br>";
echo "Example HiddenTunnel1 Encrypted Text(1)<br>";
echo $encrypted_text=HiddenTunnel1::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Example HiddenTunnel2 Encrypted Text(2)<br>";
echo $encrypted_text=HiddenTunnel2::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Example HiddenTunnel3 Encrypted Text(3)<br>";
echo $encrypted_text=HiddenTunnel3::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Example HiddenTunnel4 Encrypted Text(4)<br>";
echo $encrypted_text=HiddenTunnel4::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Example HiddenTunnel5 Encrypted Text(5)<br>";
echo $encrypted_text=HiddenTunnel5::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=HiddenTunnel5::Decrypt($encrypted_text,$key);
?>
