# SC5 Cryptography Library v1.0
Complex library of folder, file and text encryption and unique encryption algorithm

## Description
- SCP-1024 encryption algorithm is a formidable hybrid that combines the mechanisms of various cryptographic systems to encrypt data with an unbreakable cipher. It has a highly complex structure that defies any attempt to decrypt or crack it. It is extremely slow but utterly secure, and it demands a large amount of computational resources.
- SilverCipher Tool has Folder, File and Text encryption options. While encrypting Folder and File, it takes the data, shreds the original file, then creates a file to write the encrypted data.
- SCM encryption algorithm implements encryption with high speed and adaptability, but low security level.

## SCP-1024 Encryption Example
### Text: Let's meet at Duygu Cafe at 17:00. I have things to tell you. , Key: 123
### Output:
#### pcKgImdVeyA1waJT3OMvJq6OZ/cCajws8PrhJ6xNhDIbwwPuzAP8xa+Ndys5HHF+8VonH0P4dwQgEb2tHOueT0vcK/OJaEnlPQ/Xb+GYkPkj8/mPLYJ9DtAgr8+3APr8KtnU1DgF5gzRYbq2VR2kv3BUtJH4hwc4GN+077qN+FIGKvRd74ruZH0FVTjGmurXBGHXFzanTFmD1mvxItnTX+ELj3CgXBLooXIkT8AXKsruEpwaTr74Un6Dv0/nk/66t++q0W+Qp28RjpeYoEWe/LnXVRw6gQ7gFENOUs2lCdViPfGhltzYYvxwHp/5LRW/9IJ0HKWjuG+KgI0U6tmw99==
### Text: xxxxhub. com/video/search?search=link , Key: Secret0123
### Output:
#### TuQ2PsJv6iVdHKrixOUoC/Z+JTInN2zPTTrXzKm6G4ZbS0f1jnTAKA1Zmfdm+uy+GYR725rIMNQ+LM8TYw17dmKGSMh/vQomnM2MM5fYH2UXyg4+YPVL3REW9rfx4OmFIgJbGSie2Q5JEgoXVNrlSTv+fm1VB1yo+L9A2ctaMPSnAOIcvJb3JSKjn7kVdIfREUD9tXL9VQw71MZsTN+PcjwSCppJtwbshEDPLJShqfsBnQqqWKYmCN/KAraRktT0YsJBOa8I+ZnQNfEgdpcT6mHBk6aVCD3V1jNt2mdhlzLy4X/T2WuFaxLnYKKLvfkeSWMxaLHwvhk3BZKoQ2r3ce==
### Text: I'm afraid someone else will see this message, I have no freedom of expression. , Key: Adan9999
### Output:
#### 3ZBomwVFw1yqdEqv8aPXSeTHy4su8g7eBwn1/ahy2Yf3p9BdUTNQk37gTUQ/Xd2prFxuJezK41cZuetesi9++uFivW/ZdKDvFmCpzbyiEhnvqC1RxuC87xUes5jyQLUuRyfqw5/ZY2sO03nzv8CPm6wM8nhUdaR/9qsvxCj3/cGxDxTdvy7zxD1UwrRvqIwvrEaidJNI6OH9xfj5oIVZwXJKjpSuG9WB7AtO1dfbBWfMzearrl0mHqLi5ROYbEck3WW5AmTp7B2/H+gJ86u18Act0Ca17QY7/EfKpkagsPEYvKQ7Rb/AfZeoiGqhhEsEjaFUXEKfv0ZWnJJVEIw2Nc==
### [ Decrypt Link](https://h6465617468.github.io/SilverCipher/scp.html)



### SCP-1024/SCM,RSA Online Encryption Tool
## [ Online Encryption Tool](https://h6465617468.github.io/SilverCipher/index.html)
### SCP-1024 Beta Version (Military Level) Encryption Tool
## [ Online Encryption Tool](https://h6465617468.github.io/SilverCipher/scp.html)
### SCM Encryption Tool
## [ Online Encryption Tool](https://h6465617468.github.io/SilverCipher/demo.html)

## Methods used in SCP-1024 encryption
- [ Increases the block size from 1024 bits to 3072 bits](https://en.wikipedia.org/wiki/Block_size_(cryptography))
- [ Adds random bytes](https://www.tabnine.com/code/javascript/functions/crypto/randomBytes)
- [ Bitwise XOR,AND,OR](https://en.wikipedia.org/wiki/Bitwise_operation)
- [ ShiftRows](https://commons.wikimedia.org/wiki/File:AES-ShiftRows.svg)

![ shiftrows image](https://raw.githubusercontent.com/h6465617468/SilverCipher/main/images/Figure-26-Inverse-Shift-Rows-diagram-in-AES-NIST-01.png)

- [ SHA512/256,SHA1](https://tr.wikipedia.org/wiki/SHA-2)

![ sha256 image](https://raw.githubusercontent.com/h6465617468/SilverCipher/main/images/Two-Consecutive-SHA-256-operations.png)

- [ Whirlpool](https://en.wikipedia.org/wiki/Whirlpool_(hash_function))

![ Whirlpool image](https://raw.githubusercontent.com/h6465617468/SilverCipher/main/images/3-Figure3-1.png)

- [ Bit Flip](https://www.researchgate.net/figure/Bit-flip-mutation-Each-gene-of-an-individual-has-a-certain-probability-to-perform-the_fig1_341844437)
- [ Swap Pairs](https://stackoverflow.com/questions/72974883/how-to-swap-pairs-of-bits-of-unsigned-int-in-c)

![ Swap Pairs image](https://raw.githubusercontent.com/h6465617468/SilverCipher/main/images/XOR_Swap.svg.png)

- [ Bit Shift](https://www.omnicalculator.com/math/bit-shift)

![ Bit Shift image](https://raw.githubusercontent.com/h6465617468/SilverCipher/main/images/bitshift.webp)

- [ Cipher Block Chaining](https://www.techtarget.com/searchsecurity/definition/cipher-block-chaining)

![ Cipher Block Chaining image](https://raw.githubusercontent.com/h6465617468/SilverCipher/main/images/Cipher-Block-Chaining-Operation-CBC.png)

- [ Uint8array Operations,Substitutes Uint8array values with a table](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Uint8Array)
- [ Bit Level Operations](https://www.ijsr.net/archive/v6i6/ART20174580.pdf)
- [ Substitutes hex values with another table](https://en.wikipedia.org/wiki/Hexadecimal)
- [ Text Operations,Replaces Base64 characters according to the values obtained from sha512](https://en.wikipedia.org/wiki/ROT13)

# Setup
### Download SilverCipher
### [ Beta Version SCP-1024 Unique Encryption Algorithm](https://github.com/h6465617468/SilverCipher/blob/main/sc5.js)
### [ Latest Version SilverCipher](https://github.com/h6465617468/SilverCipher/blob/main/SCPHP/SilverCipher.php)
### [ Latest Version SilverCipher5 Unique Encryption Algorithm](https://github.com/h6465617468/SilverCipher/blob/main/SCPHP/SilverCipher5.php)
### [ Latest Version SilverCipherMini Unique Encryption Algorithm](https://github.com/h6465617468/SilverCipher/blob/main/js/SilverCipherMini.min.js)
#### Download Other Unique Encryption Algorithm Library
#### [SilverCipher4](https://github.com/h6465617468/SilverCipher/blob/main/SCPHP/SilverCipher4.php) , [SilverCipher3](https://github.com/h6465617468/SilverCipher/blob/main/SCPHP/SilverCipher3.php) , [SilverCipher2](https://github.com/h6465617468/SilverCipher/blob/main/SCPHP/SilverCipher2.php) , [SilverCipher1](https://github.com/h6465617468/SilverCipher/blob/main/SCPHP/SilverCipher1.php)

# Usage

| Name | Folder/File Encryption | Text Encryption | File Shredder | Type | Security | Support |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| SilverCipher Tool | Yes | Yes | All Shredders (Powerful) | Symetric/Block | Very High | PHP |
| SCP-1024 | Available | Yes | - | Symetric/Block	 | Extreme | JS |
| SCM | Available | Yes | - | Symetric/Block | Sufficient | JS |

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
## SCM And SCP Encryption Javascript and PHP
#### [ SCM Encryption Tool](https://h6465617468.github.io/SilverCipher/demo.html)
#### [ SCP Encryption Tool](https://h6465617468.github.io/SilverCipher/scp.html)
HTML
```html
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="js/SilverCipherMini.min.js"></script>
<script src="js/sc5.min.js"></script>
```
Dynamically load a JS file in JavaScript
```javascript
const loadScript=function(r){return new Promise(function(n,e){const t=document.createElement("script");t.src=r,t.addEventListener("load",function(){n(!0)}),document.head.appendChild(t)})},waterfall=function(n){return n.reduce(function(n,e){return n.then(function(){return"function"==typeof e?e().then(function(n){return!0}):Promise.resolve(e)})},Promise.resolve([]))},loadScriptsInOrder=function(n){n=n.map(function(n){return loadScript(n)});return waterfall(n)};
loadScriptsInOrder(['https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js', 'js/SilverCipherMini.min.js', 'js/sc5.min.js']).then(function () {
    // All scripts are loaded completely
    // Do something
});
```
Javascript
SCM
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
SCP
```javascript
const cipher = new SC5("123","0");
const encryptedText = cipher.Encrypt("123");
const decryptedText = cipher.Decrypt(encryptedText);
document.write("Encrypted: "+encryptedText);
document.write("<br>");
document.write("Decrypted: "+decryptedText);
```
Output:
```
Encrypted: y1O1LAbfiS+CHzSKvtxQherxeLThCDx8nQTvm6QjzxlG47GS/Ud1li7hyFeeTe9eWiYuogKvduaJAp7fX0Wj/HaToNH+BufkKVLQW6vVNbxDvohIuCKff1Wv9S2QrYb2+3GOCam4OtDlFgVY1G6ipx2COFGsWMBt1CYF5xk/FSTlSCmhF48KcciciiOeUcCNgcKBvwlqx4nSF/GFMF6MrbQDkC4dUZdO3qEkKmYWGs5LWgkmH/+b3rlL/86mJXUm8KHYz7Gyqs1LlkAMIQI//uGz3MX7NJgauVIGpZalqENSGEG3YvFZ31mT3hCVKrqMYZcF7hH0Shsh/l4EsQwVzt==
Decrypted: 123
```
PHP SCM
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
## SilverCipher5 Encryption
#### [ Download Encryption Tool](https://github.com/h6465617468/SilverCipher/blob/main/SCPHP/encryption_tool.php)
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
