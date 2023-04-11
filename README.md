# ❯ AntaresCrypt
It is an advanced symmetric encryption algorithm that can be used on PHP, inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It produces different results each time. The strength of this encryption algorithm is stronger than AES. It drives the attacker crazy because it consumes a lot of processor power when encrypting, contains many different encryption methods, and has too many loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of breaking the encryption increase abnormally.
## ❯ How To Use?
```php
// How to use AntaresCrypt

// Put 'antarescrypt_core.php' in your project file, then require(),require_once() it in your own file

require_once "AntaresCrypt.php";

$plain_text="Hello World"; // Unlimited Text Size

$key="123"; // Unlimited Key Size

$encrypted_text=AntaresCrypt::Encrypt($plain_text,$key);

$decrypted_text=AntaresCrypt::Decrypt($encrypted_text,$key);

echo $encrypted_text;
echo "<br>";
echo $decrypted_text;
```
## ❯ Developer Note
If you're into encryption, you should take a look at file shredders.(DoD 5220.22-M,Pseudorandom Data,Random Data,Write Zeroes) It will be more secure if you use it together with RSA or Elliptic-curve cryptography algorithm. When using this encryption algorithm in your project, I recommend you to use it by adding or changing different functions.

## ❯ End Note
This project is a student project. It's very safe, but don't expect flexibility. The producer produced this project when he was just starting high school. There is a big difference with the current knowledge of the producer.
