# AntaresCrypt
It is an advanced symmetric encryption algorithm that can be used on PHP, inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It produces different results each time. The strength of this encryption algorithm is stronger than AES. It drives the attacker crazy because it consumes a lot of CPU power while encrypting and has a lot of loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of breaking the encryption increase abnormally.
## How To Use?
```php
require_once "ac17.php";
$plain_text="Hello World Test 123456789ABC";
$key="Hello World123456789";
echo "Plain Text:<br>".$plain_text."<br><br>";
echo "Example Encrypted Text(1)<br>";
echo $encrypted_text=AntaresCrypt_Core::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Example Encrypted Text(2)<br>";
echo $encrypted_text=AntaresCrypt_Core::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Example Encrypted Text(3)<br>";
echo $encrypted_text=AntaresCrypt_Core::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Example Encrypted Text(4)<br>";
echo $encrypted_text=AntaresCrypt_Core::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Example Encrypted Text(5)<br>";
echo $encrypted_text=AntaresCrypt_Core::Encrypt($plain_text,$key);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=AntaresCrypt_Core::Decrypt($encrypted_text,$key);
```
