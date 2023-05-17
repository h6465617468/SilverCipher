# SC Encryption Algorithm
![rsa encryption tool](https://raw.githubusercontent.com/h6465617468/SilverCipher/main/images/main.png?raw=true)
## [ Online Encryption Tool](https://h6465617468.github.io/SilverCipher/index.html)
Complex library of folder, file and text encryption and unique encryption algorithm

| Name | Folder/File Encryption | Text Encryption | File Shredder | Type | Security | JS Support |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| SilverCipher Tool | Yes | Yes | All Shredders (Powerful) | Symetric/Block | Very High | No |
| SilverCipher5 Cryptography | Available | Yes | - | Symetric | Very High | No |
| SilverCipherMini Cryptography | Available | Yes | - | Symetric/Block | Sufficient | Yes |

## Description
SilverCipher has Folder, File and Text encryption options. While encrypting Folder and File, it takes the data, shreds the original file, then creates a file to write the encrypted data. Its original encryption algorithm, SilverCipher5, is inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It gives different results each time. It is very hard to crack as it consumes a lot of processing power when encrypting, contains many different encryption methods, and has a lot of loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of cracking the increase abnormally.


# SilverCipher+RSA Online Encryption Tool
## [ Online Encryption Tool](https://h6465617468.github.io/SilverCipher/index.html)

# Demo
## [ Online Encryption Tool](https://h6465617468.github.io/SilverCipher/demo.html)

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

## End Note
This project is a student project. It's very safe, but don't expect flexibility. The producer produced this project when he was just starting high school. There is a big difference with the current knowledge of the producer.
