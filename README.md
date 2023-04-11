# AntaresCrypt
It is an advanced encryption algorithm that can be used on PHP, inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It produces different results each time. It is in no way affected by the Brute Force attack. Depending on the length of the data to be encrypted, the encryption time increases abnormally. Its cracking depends on the length of the data to be encrypted.
## How To Use?
```php
require_once "ac17.php";
$plain_text="Hello World   Test   123456789ABC";
$key="Hello World12345678910";
echo "Plain Text:".$plain_text."<br>";
echo "Encrypted Text:<br>";9
echo $encrypted_text=AntaresCrypt_Core::Encrypt($plain_text,$key);
echo "<br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=AntaresCrypt_Core::Decrypt($encrypted_text,$key);
```
