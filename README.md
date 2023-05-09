# SilverCipher
Complex library of folder, file and text encryption and unique encryption algorithm

This project is written using PHP and Javascript programming language.

| Name | Folder/File Encryption | Text Encryption | File Shredder | Type | Security | JS Support |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| SilverCipher Tool | Yes | Yes | All Shredders (Powerful) | Symetric/Block | Very High | No |
| SilverCipher5 Cryptography | Available | Yes | - | Symetric | Very High | No |
| SilverCipherMini Cryptography | Available | Yes | - | Symetric/Block | Sufficient | Yes |

| Type | Supported Encryption Algorithms |
| --- | --- |
| Vanilla | AES-128-CBC, AES-128-CFB, AES-128-CTR, AES-128-ECB, AES-128-OFB, AES-192-CBC, AES-192-CFB, AES-192-CTR, AES-192-ECB, AES-192-OFB, AES-256-CBC, AES-256-CFB, AES-256-CTR, AES-256-ECB, AES-256-OFB, BF-CBC, BF-CFB, BF-ECB, BF-OFB, CAMELLIA-128-CBC, CAMELLIA-128-CFB, CAMELLIA-128-CTR, CAMELLIA-128-ECB, CAMELLIA-128-OFB, CAMELLIA-192-CBC, CAMELLIA-192-CFB, CAMELLIA-192-CTR, CAMELLIA-192-ECB, CAMELLIA-192-OFB, CAMELLIA-256-CBC, CAMELLIA-256-CFB, CAMELLIA-256-CTR, CAMELLIA-256-ECB, CAMELLIA-256-OFB, CAST5-CBC, CAST5-CFB, CAST5-ECB, CAST5-OFB, CHACHA20, CHACHA20-POLY1305, DES-CBC, DES-CFB, DES-CFB1, DES-CFB8, DES-ECB, DES-EDE, DES-EDE-CBC, DES-EDE-CFB, DES-EDE-OFB, DES-EDE3, DES-EDE3-CBC, DES-EDE3-CFB, DES-EDE3-OFB, DES-OFB, IDEA-CBC, IDEA-CFB, IDEA-ECB, IDEA-OFB, RC2-40-CBC, RC2-64-CBC, RC2-CBC, RC2-CFB, RC2-ECB, RC2-OFB, RC4, RC4-40, SEED-CBC, SEED-CFB, SEED-CTR, SEED-ECB, SEED-OFB |
| SilverCipher | SilverCipherMini(JS,PHP), SilverCipher1, SilverCipher2, SilverCipher3, SilverCipher4, SilverCipher5 |
| AntaresCrypt | AntaresCryptv1.0, AntaresCryptv1.1, AntaresCryptv1.2, AntaresCryptv1.3, AntaresCryptv1.4, AntaresCryptv1.5, AntaresCryptv1.6, AntaresCryptv1.7, AntaresCrypt X7500roundedition |

## Description
SilverCipher has Folder, File and Text encryption options. While encrypting Folder and File, it takes the data, shreds the original file, then creates a file to write the encrypted data. Its original encryption algorithm, SilverCipher5, is inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It gives different results each time. It is very hard to crack as it consumes a lot of processing power when encrypting, contains many different encryption methods, and has a lot of loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of cracking the increase abnormally.

# Demo
## [ Online Encryption Tool](https://h6465617468.github.io/SilverCipher/)

# Setup
### Download SilverCipher
### [ Latest Version SilverCipher](https://github.com/h6465617468/SilverCipher/blob/main/SilverCipher.php)
### [ Latest Version SilverCipher5 Unique Encryption Algorithm](https://github.com/h6465617468/SilverCipher/blob/main/SilverCipher5.php)
### [ Latest Version SilverCipherMini Unique Encryption Algorithm](https://github.com/h6465617468/SilverCipher/blob/main/js/SilverCipherMini.min.js)
#### Download Other Unique Encryption Algorithm Library
#### [SilverCipher4](https://github.com/h6465617468/SilverCipher/blob/main/SilverCipher4.php) , [SilverCipher3](https://github.com/h6465617468/SilverCipher/blob/main/SilverCipher3.php) , [SilverCipher2](https://github.com/h6465617468/SilverCipher/blob/main/SilverCipher2.php) , [SilverCipher1](https://github.com/h6465617468/SilverCipher/blob/main/SilverCipher1.php)
# Usage

## Folder Encryption/Decryption
Folder/File Encryption uses [Gutmann](https://en.wikipedia.org/wiki/Gutmann_method) , [DoD 5220.22-M](https://en.wikipedia.org/wiki/National_Industrial_Security_Program) file shredding method
Encrypts all subfolders and files. Before encrypting, it takes the data and parts it so that it cannot be recovered. It does not re-encrypt the previously encrypted file. Appends '_enc' to the end of the encrypted file.
If it can't find the folder, it automatically adds  __ ___DIR___ __ and checks the folder again. If the power of the server goes out, you will not lose data.
### Example 1 (Advanced)
```php
// php
require_once "SilverCipher.php";
$key="12345678901234561234567890123456"; // required
$iv = "1234567890123456"; // required
$dir = "/path";
// OR
// $dir = __DIR__."/path";
$algo="AES-256-CBC"; // Only uses Vanilla Encryption Algorithms
$ht = new SilverCipher($key,$iv); // key and iv required
// encrypt a folder
$ht->encrypt_data("folder", null, $algo, $dir);
// decrypt the encrypted folder
$ht->decrypt_data("folder", null, $algo, $dir);
// Note: All files in the folder will be encrypted and saved with '_enc' suffix.
// The decrypted files will have the same name as the encrypted files without the '_enc' suffix.
```
### Example 2 (Easy)
```php
require_once "SilverCipher.php";
$sc = new SilverCipher();
$sc->setKey("12345678901234561234567890123456");
$sc->setIV("1234567890123456");
$sc->setAlgorithm("AES-256-CBC");
$datax = "/path";
echo $sc->EncryptDirectory($datax);
echo $sc->DecryptDirectory($datax);
```
### Example 3 (Auto)
```php
require_once "SilverCipher.php";
/*
$sc = new SilverCipher();
$sc->setKey("12345678901234561234567890123456");
$sc->setIV("1234567890123456");
$sc->setAlgorithm("AES-256-CBC");
*/
$sc = new SilverCipher("12345678901234561234567890123456","1234567890123456","AES-256-CBC");
$datax = "/path";
echo $sc->Encrypt($datax);
echo $sc->Decrypt($datax);
```
## File Encryption/Decryption
### Example 1 (Advanced)
```php
// php
require_once "SilverCipher.php";
$key="12345678901234561234567890123456"; // required
$iv = "1234567890123456"; // required
$encrypt_file_path="file_to_encrypt.txt";
$decrypt_file_path="file_to_encrypt.txt_enc";
$algo="AES-256-CBC"; // Only uses Vanilla Encryption Algorithms
$ht = new SilverCipher($key,$iv); // key and iv required
// encrypt a file
$ht->encrypt_data("file", $encrypt_file_path, $algo);
// decrypt the encrypted file
$ht->decrypt_data("file", $decrypt_file_path, $algo);
// Note: The encrypted file will be saved as 'file_to_encrypt.txt_enc'
// and the decrypted file will be saved as 'file_to_encrypt.txt'
```
### Example 2 (Easy)
```php
require_once "SilverCipher.php";
$sc = new SilverCipher();
$sc->setKey("12345678901234561234567890123456");
$sc->setIV("1234567890123456");
$sc->setAlgorithm("AES-256-CBC");
$encrypt_file_path="file_to_encrypt.txt";
$decrypt_file_path="file_to_encrypt.txt_enc";
echo $sc->EncryptFile($encrypt_file_path);
echo $sc->DecryptFile($decrypt_file_path);
```
### Example 3 (Auto)
```php
require_once "SilverCipher.php";
/*
$sc = new SilverCipher();
$sc->setKey("12345678901234561234567890123456");
$sc->setIV("1234567890123456");
$sc->setAlgorithm("AES-256-CBC");
*/
$sc = new SilverCipher("12345678901234561234567890123456","1234567890123456","AES-256-CBC");
$encrypt_file_path="file_to_encrypt.txt";
$decrypt_file_path="file_to_encrypt.txt_enc";
echo $sc->Encrypt($encrypt_file_path);
echo $sc->Decrypt($decrypt_file_path);
```
## Text Encryption/Decryption
### Example 1 (Advanced)
```php
// php
require_once "SilverCipher.php";
$key="12345678901234561234567890123456"; // required
$iv = "1234567890123456"; // required
$plain_text="my secret data";
$algo="AES-256-CBC"; // Only uses Vanilla Encryption Algorithms
$ht = new SilverCipher($key,$iv); // key and iv required
// encrypt a text
$encrypted_text = $ht->encrypt_data("text", $plain_text, $algo);
// decrypt the encrypted text
$decrypted_text = $ht->decrypt_data("text", $encrypted_text, $algo);
echo $encrypted_text;
echo "<br>";
echo $decrypted_text;
```
Output:
```
(RAW DATA)
my secret data
```
### Example 2 (Easy)
```php
require_once "SilverCipher.php";
$sc = new SilverCipher();
$sc->setKey("12345678901234561234567890123456");
$sc->setIV("1234567890123456");
$sc->setAlgorithm("AES-256-CBC");
$plain_text="Hello World";
echo $cipher_text=$sc->EncryptText($plain_text);
echo "<br>";
echo $sc->DecryptText($cipher_text);
```
### Example 3 (Auto)
```php
require_once "SilverCipher.php";
/*
$sc = new SilverCipher();
$sc->setKey("12345678901234561234567890123456");
$sc->setIV("1234567890123456");
$sc->setAlgorithm("AES-256-CBC");
*/
$sc = new SilverCipher("12345678901234561234567890123456","1234567890123456","AES-256-CBC");
$plain_text="Hello World";
echo $cipher_text=$sc->Encrypt($plain_text);
echo "<br>";
echo $sc->Decrypt($cipher_text);
```
## SilverCipherMini Encryption Javascript and PHP
#### [ Encryption Tool](https://eenonde.github.io/SilverCipher/)
HTML
```html
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="js/SilverCipherMini.min.js"></script>
```
Dynamically load a JS file in JavaScript
```javascript
const loadScript=function(r){return new Promise(function(n,e){const t=document.createElement("script");t.src=r,t.addEventListener("load",function(){n(!0)}),document.head.appendChild(t)})},waterfall=function(n){return n.reduce(function(n,e){return n.then(function(){return"function"==typeof e?e().then(function(n){return!0}):Promise.resolve(e)})},Promise.resolve([]))},loadScriptsInOrder=function(n){n=n.map(function(n){return loadScript(n)});return waterfall(n)};
loadScriptsInOrder(['https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js', 'js/SilverCipherMini.min.js']).then(function () {
    // All scripts are loaded completely
    // Do something
});
```
Javascript
```javascript
const cipher = new SilverCipherMini("123");
const encryptedText = cipher.Encrypt("123");
const decryptedText = cipher.Decrypt(encryptedText);
document.write("Encrypted: "+encryptedText);
document.write("<br>");
document.write("Decrypted: "+decryptedText);
```
Output:
```
Encrypted: A0KCtSEs
Decrypted: 123
```
PHP
```php
require_once "SilverCipherMini.php";
$plain_text="123";
$key="123";
echo "Plain Text:<br>".$plain_text."<br><br>";
$ht = new SilverCipherMini($key);
echo "Encrypted Text:<br>";
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=$ht->Decrypt($encrypted_text);
```
Output:
```
Plain Text:
123
Encrypted Text:
A0KCtSEs
Decrypted Text:
123
```
## SilverCipher5 Encryption
#### [ Download Encryption Tool](https://github.com/h6465617468/SilverCipher/blob/main/encryption_tool.php)
```php
// php
require_once "SilverCipher5.php"; // Only uses SilverCipher Encryption Algorithms
$plain_text = "Hello World"; // Unlimited Text Size
$key = "123"; // Unlimited Key Size
$ht = new SilverCipher5($key); // key required
$encrypted_text=$ht->Encrypt($plain_text);
$decrypted_text=$ht->Decrypt($encrypted_text);
echo $encrypted_text;
echo "<br>";
echo $decrypted_text;
```
Output:
```
e7eApDnSg9VETXiEqyFxGWn6g2RO8S==
Hello World
```
## SilverCipher File Shredder
Operations such as file shredding require data to be written directly into memory areas, and therefore low-level programming languages are better suited for these operations. The use of these languages can increase the processing speed of files and minimize memory usage.
PHP is unfortunately a high level programming language.
```php
// php
require_once "SilverCipher.php";
SilverCipherEraser::Eraser0($file_path); // Best
SilverCipherEraser::Eraser1($file_path);
SilverCipherEraser::Eraser2($file_path);
SilverCipherEraser::Eraser3($file_path);
SilverCipherEraser::Eraser4($file_path);
SilverCipherEraser::Eraser5($file_path);
SilverCipherEraser::Eraser6($file_path);
SilverCipherEraser::Eraser7($file_path);
SilverCipherEraser::Eraser8($file_path);
SilverCipherEraser::Eraser9($file_path);
SilverCipherEraser::Eraser10($file_path);
SilverCipherEraser::Eraser11($file_path);
SilverCipherEraser::Eraser12($file_path);
SilverCipherEraser::Eraser13($file_path);
SilverCipherEraser::Eraser14($file_path);
```
## SilverCipher Hash
```php
// php
require_once "SilverCipher.php";
$text="hello world";
$lenght=1024;
$ht = new SilverCipher();
echo $ht->hash($text,$lenght);
```
Output:
```
b6b2b815b6700dd0cd054f5cc8ce1ffe2a6e472bb62e1452d87844395055365dc4f1087863d4d5e3d778ca3988fa3ce33eec7e3e7f5d829f6fd6a87cdbe31563238470405d2b01d6839deceb9f435f1cf01370f3054ba62d496236955527bbea28b3cfc8c332fad99a759e9256ba5cdcf43855b5988327afb7a6db950a49a4b1f73ea64c1eb023575b9468b1e67c9e4d2128ccf9cb20a8a009880223e5259e16f0c2c58bc4024b2fdedfda10aedb35e497cc01226a0171261aca95ee5cba022ded2a6afda37890b6a703f0b7b8f984dca675bda0246db67e12d12bc9896503da6c80bcaae1193d10d9b467c2bd7043de6985abf0adaf96e70afa8fd970c2decece400740c5d2bbf475a2790c2693b2d650b21da222c2a202c3b848cdc4c89dabe33e1316ac70d4f9f196f168948d1749090b95cc035554a2daca2aa574ab5200b4d73ddcaa76ddd54a355700c4b664b62cb7e519432c507bff8cbf3123f3a508cae5f412234907684e9e32d40446a30f8f4e0b88a33a62554ea3628df09f8861cf1c34ce47ca98dcdb02d0ff85cc7e54365fa70ffe79f2adfb81a46a65f4ab709cfe8ace0219490542ac0f2cd83e1c2e48786fc1e17fa6121f8beaa60e0d3dafe44f8699a1f2001a470f6a854796ebc92d5d1b6ff18dac45ceeeb5250a27c9e18f8bea5f6ea228eb1679843687561edee5c51434fc0e24efac431b021ec9f146
```
## Contributing
SilverCipher is an open-source project that welcomes contributions from anyone. If you want to contribute to SilverCipher, you can fork the project on GitHub and submit a pull request with your changes. You can also report issues and suggest improvements on the GitHub issue tracker.

## Developer Note
If you're into encryption, you should take a look at file shredders.(DoD 5220.22-M,Pseudorandom Data,Random Data,Write Zeroes) It will be more secure if you use it together with RSA or Elliptic-curve cryptography algorithm. When using this encryption algorithm in your project, I recommend you to use it by adding or changing different functions.

# Wiki

| SilverCipher File Shredder | Method |
| --- | --- |
| File Shredder 0 | It uses a number of different erasure methods, including NIST SP-800-88 Rev. 1, Gutmann, DoD 5220.22-M, NSA 130-2, ATA Secure Erase, Cryptographic Erase, Purge, and Clear. Each of these methods uses a specific pattern or set of patterns to overwrite the file data, making it much more difficult for anyone to recover the original data.The function begins by defining an array of erasure methods and an array of patterns to be used with each method. The patterns are defined as hexadecimal strings, such as "\x00\xFF". The function then counts the number of patterns and enters a loop that will execute each erasure method five times.For each iteration of the loop, the function opens the file to be erased and determines its size. It then selects the pattern to be used based on the current erasure method and writes it to the file, overwriting the existing data. The function uses a bitwise XOR operation to combine the pattern with the existing data, making it more difficult for the original data to be recovered. The function then closes the file and moves on to the next iteration of the loop.Overall, Eraser0() is a relatively complex function that uses a number of different erasure methods to securely overwrite file data. While it may not provide absolute security against data recovery, it does make it much more difficult for someone to recover the original data. |
| File Shredder 1 | The function uses a loop to write random data to the file, with each iteration writing one byte of random data. This is done 35 times to ensure that the file is completely overwritten with random data. After this, two more loops are used to write null bytes and all ones to the file. |
| File Shredder 2 | This function also takes a filename as an argument and overwrites the contents of the file with specific patterns of bytes. It uses an array of 42 different patterns and writes each pattern five times to the file. Finally, the file is deleted. |
| File Shredder 3 | The function uses a loop to write null bytes to the entire file. After this, it uses two loops to write random data to the first half of the file, and another two loops to write random data to the second half of the file. Each iteration of the loops writes one byte of random data to the file. All three functions ensure that the file is completely overwritten with either random data or specific patterns of bytes, making it much more difficult for anyone to recover the original contents of the file. |
| File Shredder 4 | This function overwrites the contents of the file with a series of pre-determined byte sequences (e.g., all zeros, all ones, alternating 0s and 1s, etc.). It performs multiple passes with different sequences. |
| File Shredder 5 | This function overwrites the contents of the file with a repeating pattern of bytes (0x55, 0xAA, 0xFF). |
| File Shredder 6 | This function overwrites the contents of the file with null bytes (chr(0)), flushes the file buffer, and then deletes the file. |
| File Shredder 7 | This function overwrites the contents of the file with a random pattern of bytes (a combination of '0xff' and '0x00' bytes), with the pattern length randomly selected between 1 and 3 bytes. The function then closes the file handle and deletes the file. |
| File Shredder 8 | This function replaces the contents of a file with "x" characters, effectively erasing the original data. It does this by reading the file contents, creating a string of "x" characters the same length as the file, writing that string to the file, flushing the file buffer to ensure it's written immediately, closing the file, and then deleting it. |
| File Shredder 9 | This function uses OpenSSL to generate a pseudorandom byte string the same length as the file, overwriting the original data. It does this by opening the file for writing, generating the random bytes, writing them to the file, closing the file, and then deleting it. |
| File Shredder 10 | This function overwrites the contents of a file with a series of bytes (0-34) repeated 35 times, effectively erasing the original data. It does this by opening the file for reading and writing, iterating over the file's bytes 35 times, and overwriting each byte with the current pass number. It then closes the file and deletes it. |
| File Shredder 11 | This function overwrites the contents of a file with three alternating byte patterns (0x55, 0xAA, and 0x92) to erase the original data. It does this by opening the file for reading and writing, calculating the file size, and then iterating over the file in 1024-byte chunks, overwriting each chunk with the three byte patterns in sequence. It then closes the file and deletes it. |
| File Shredder 12 | This function overwrites the contents of a file with a set of predefined byte patterns to erase the original data. It does this by opening the file for appending, calculating the file size, and then iterating over the file in 512-byte chunks, writing each predefined pattern in sequence to the end of the file. It then closes the file and deletes it. |
| File Shredder 13 | takes a file path as its argument and overwrites the file's contents with null bytes (\0) using a nested loop. The variable $passes determines the number of times the file will be overwritten, and $block_size determines the size of the blocks that will be written to the file. After the file has been overwritten, the function deletes it from the hard drive using unlink(). |
| File Shredder 14 | function takes a filename as its parameter. It begins by checking if the file exists, and returns false if it does not. The function then creates an array of secure erase methods, including "DoD5220.22-M", "NSA", "ATA", "Cryptographic", "Purge", "Clear", and "Gutmann". For each method in the array, the function opens the file in read-write mode (r+), determines the appropriate pattern for overwriting the file contents based on the method, and writes the pattern to the file. The function then flushes the file buffer, seeks to the beginning of the file, and continues to the next method in the array. Once all methods have been applied, the function closes the file and deletes it from the system.The patterns used by the different methods are as follows:"DoD5220.22-M": Overwrite with the byte 0x55."NSA": Overwrite with null bytes (\0)."ATA": Overwrite with the byte 0xFF."Cryptographic": Overwrite with random bytes generated using the OpenSSL library."Purge": Overwrite with null bytes (\0)."Clear": Overwrite with the byte 0xFF."Gutmann": Overwrite with a specific pattern of 35 bytes that is repeated multiple times until the entire file has been overwritten. This method is based on a paper by Peter Gutmann that proposed a specific sequence of overwrites to ensure data cannot be recovered.The function then iterates over all files in the directory containing the file to be erased, and when it finds a file with the same filename, it overwrites that file as well. Finally, the function deletes the original file from the system. |

## End Note
This project is a student project. It's very safe, but don't expect flexibility. The producer produced this project when he was just starting high school. There is a big difference with the current knowledge of the producer.
