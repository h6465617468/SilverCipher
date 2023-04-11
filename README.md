# AntaresCrypt
# It is inspired by the AES and XOR encryption algorithm that can be used on PHP. A simple encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It produces different results each time. Please encrypt short data. Depending on the length of the data to be encrypted, the encryption time increases abnormally.

#How To Use?
include "ac17.php";\n
$plain_text="Hello World/Hello World/Hello World/Hello World/Hello World";
$key="Hello World12345678910";
echo "Plain Text:".$plain_text."<br>";
echo "Encrypted Text:<br>";
echo $encrypted_text=AntaresCrypt_Core::Encrypt($plain_text,$key);
echo "<br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=AntaresCrypt_Core::Decrypt($encrypted_text,$key);
