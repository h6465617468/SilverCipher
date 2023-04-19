# SilverCipher
Complex library of folder, file and text encryption and unique encryption algorithm

This project is written using PHP and Javascript programming language.

| Name | Folder Encryption | File Encryption | Text Encryption | File Shredder | Type | Security | JS Support |
| --- | --- | --- | --- | --- | --- | --- | --- |
| SilverCipher Tool | Yes | Yes | Yes | All Shredders (Powerful) | Symetric/Block | Very High | No |
| SilverCipher5 Cryptography | - | - | Yes | - | Symetric | Very High | No |
| SilverCipherMini Cryptography | - | - | Yes | - | Symetric/Block | Sufficient | Yes |

| Type | Supported Encryption Algorithms |
| --- | --- |
| Vanilla | AES-128-CBC, AES-128-CFB, AES-128-CTR, AES-128-ECB, AES-128-OFB, AES-192-CBC, AES-192-CFB, AES-192-CTR, AES-192-ECB, AES-192-OFB, AES-256-CBC, AES-256-CFB, AES-256-CTR, AES-256-ECB, AES-256-OFB, BF-CBC, BF-CFB, BF-ECB, BF-OFB, CAMELLIA-128-CBC, CAMELLIA-128-CFB, CAMELLIA-128-CTR, CAMELLIA-128-ECB, CAMELLIA-128-OFB, CAMELLIA-192-CBC, CAMELLIA-192-CFB, CAMELLIA-192-CTR, CAMELLIA-192-ECB, CAMELLIA-192-OFB, CAMELLIA-256-CBC, CAMELLIA-256-CFB, CAMELLIA-256-CTR, CAMELLIA-256-ECB, CAMELLIA-256-OFB, CAST5-CBC, CAST5-CFB, CAST5-ECB, CAST5-OFB, CHACHA20, CHACHA20-POLY1305, DES-CBC, DES-CFB, DES-CFB1, DES-CFB8, DES-ECB, DES-EDE, DES-EDE-CBC, DES-EDE-CFB, DES-EDE-OFB, DES-EDE3, DES-EDE3-CBC, DES-EDE3-CFB, DES-EDE3-OFB, DES-OFB, IDEA-CBC, IDEA-CFB, IDEA-ECB, IDEA-OFB, RC2-40-CBC, RC2-64-CBC, RC2-CBC, RC2-CFB, RC2-ECB, RC2-OFB, RC4, RC4-40, SEED-CBC, SEED-CFB, SEED-CTR, SEED-ECB, SEED-OFB |
| SilverCipher | SilverCipherMini(JS,PHP), SilverCipher1, SilverCipher2, SilverCipher3, SilverCipher4, SilverCipher5 |
| AntaresCrypt | AntaresCryptv1.0, AntaresCryptv1.1, AntaresCryptv1.2, AntaresCryptv1.3, AntaresCryptv1.4, AntaresCryptv1.5, AntaresCryptv1.6, AntaresCryptv1.7, AntaresCrypt X7500roundedition |

## Description
SilverCipher has Folder, File and Text encryption options. While encrypting Folder and File, it takes the data, shreds the original file, then creates a file to write the encrypted data. Its original encryption algorithm, SilverCipher5, is inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It gives different results each time. It is very hard to crack as it consumes a lot of processing power when encrypting, contains many different encryption methods, and has a lot of loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of cracking the increase abnormally.

# Setup
### Download SilverCipher
### [ Latest Version SilverCipher](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher.php)
### [ Latest Version SilverCipher5 Unique Encryption Algorithm](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher5.php)
#### Download Other Unique Encryption Algorithm Library
#### [SilverCipher4](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher4.php) , [SilverCipher3](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher3.php) , [SilverCipher2](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher2.php) , [SilverCipher1](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher1.php)
# Usage

## Folder Encryption/Decryption
Folder/File Encryption uses [Gutmann](https://en.wikipedia.org/wiki/Gutmann_method) , [DoD 5220.22-M](https://en.wikipedia.org/wiki/National_Industrial_Security_Program) file shredding method
Encrypts all subfolders and files. Before encrypting, it takes the data and parts it so that it cannot be recovered. It does not re-encrypt the previously encrypted file. Appends '_enc' to the end of the encrypted file.
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
Javascript
```html
<script src="SilverCipherMini.js"></script>
```
```javascript
const cipher = new SilverCipherMini("123");
const encryptedText = cipher.Encrypt("123");
const decryptedText = cipher.Decrypt(encryptedText);
document.write("Encrypted: "+encryptedText);
document.write("<br>");
document.write("Decrypted: "+decryptedText);
```
PHP
```php
require_once "SilverCipherMini.php";
$plain_text="123";
$key="123";
echo "Plain Text:<br>".$plain_text."<br><br>";
echo "<br><br>";
echo "Example SilverCipherMini Encrypted Text<br>";
$ht = new SilverCipherMini($key);
echo "Encrypted Text:<br>";
echo $encrypted_text=$ht->Encrypt($plain_text);
echo "<br><br>";
echo "Decrypted Text:<br>";
echo $decrypted_text=$ht->Decrypt($encrypted_text);
```
## SilverCipher5 Encryption
#### [ Encryption Tool](https://github.com/eenonde/SilverCipher/blob/main/encryption_tool.php)
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

| SilverCipher.php Functions | Method |
| --- | --- |
| Hash(data,lenght) | You can generate huge hashes with this function. The function uses a while loop that generates multiple hashes and concatenates them to produce the final hash. In each iteration of the loop, the function generates a key and a salt using the "gost" hash algorithm, and then uses those values, along with the input data ($data), to generate 23 different hashes using various hash algorithms, such as sha3-512, ripemd160, tiger128,3, gost, adler32, crc32, crc32b, snefru, fnv132, fnv1a32, fnv164, fnv1a64, joaat, haval128,3, haval160,3, haval192,3, haval224,3, haval256,3, ripemd256, sha256, sha512, whirlpool, and sha3-256.The 23 generated hashes are then concatenated to produce a single hash. The concatenated hash is then encrypted using the AES-256-CBC encryption algorithm with a key derived from the hash of the salt using SHA256 and initialization vector (IV) that is generated using the "tiger128,3" hash algorithm. The resulting ciphertext is converted to hexadecimal format using bin2hex(), and then used as the input data ($data) for the next iteration of the loop.The loop continues until the length of the concatenated hash ($a) is greater than or equal to the specified length ($length). The function then returns the first $length characters of the concatenated hash. |
| add_key(new_key) | This is a method of a class that sets a new value for the key property of the object. The add_key method takes one parameter, new_key, which is the new value to be assigned to the key property. The this keyword is used to refer to the current instance of the class, and the arrow -> is used to access the key property.By calling this method with a new key, you can update the value of the key property of the object. |
| encrypt_data(type, data, algorithm, dir) | This is a PHP class called SilverCipher which can be used to encrypt and decrypt files or directories.When you create an object of this class, you can pass a key and initialization vector (iv) to it. These will be used as the encryption key and iv for any encryption or decryption operations that you perform with this object.The encrypt_data method can encrypt data of three types: folder, file or text. If you pass "folder" as the first parameter, it will encrypt all the files inside the folder. If you pass "file" as the first parameter, it will encrypt the file passed as the second parameter. If you pass "text" as the first parameter, it will encrypt the text passed as the second parameter.The encryption algorithm used is determined by the third parameter. The options used for encryption are set to OPENSSL_RAW_DATA. The files will be encrypted using openssl_encrypt function and decrypted using openssl_decrypt function.If the decryption fails for any reason, the code will echo an error message with the details.There is also a class called SilverCipherEraser which has a static method called Eraser0. This is used to securely erase the original file after it has been encrypted or decrypted. |
| decrypt_data(type, data, algorithm, dir) | This is a PHP class called SilverCipher which can be used to encrypt and decrypt files or directories.When you create an object of this class, you can pass a key and initialization vector (iv) to it. These will be used as the encryption key and iv for any encryption or decryption operations that you perform with this object.The decrypt_data method can decrypt data of three types: folder, file or text. If you pass "folder" as the first parameter, it will decrypt all the files inside the folder. If you pass "file" as the first parameter, it will decrypt the file passed as the second parameter. If you pass "text" as the first parameter, it will decrypt the text passed as the second parameter.The encryption algorithm used is determined by the third parameter. The options used for encryption are set to OPENSSL_RAW_DATA. The files will be encrypted using openssl_encrypt function and decrypted using openssl_decrypt function.If the decryption fails for any reason, the code will echo an error message with the details.There is also a class called SilverCipherEraser which has a static method called Eraser0. This is used to securely erase the original file after it has been encrypted or decrypted. |

| SilverCipher5.php Functions | Method |
| --- | --- |
| Encrypt(text) | This code is an implementation of encryption and decryption functions in PHP. The code uses a combination of XOR encryption, hash functions (such as SHA-512 and MD5), and other techniques to encrypt and decrypt the input data.The Encrypt function takes two optional parameters, $d and $j, which represent the data to be encrypted and a flag to indicate whether to compress the data before encryption. The function starts by setting the key to $this->key and checking the $j flag. If $j is true, the data is compressed using the gzcompress function. The data is then XOR encrypted with a SHA-512 hash of the key in hexadecimal format.Next, several operations are performed on a variable $a, which is a combination of binary and ASCII characters. The operations include XOR encryption with $a and various other characters and applying the Raw_hexrev function (which reverses the order of the hexadecimal characters in the input string). Finally, $a is XOR encrypted with the concatenation of 16 hexadecimal strings (self::$hash0 through self::$hashf) and the result of an MD5 hash of the key concatenated with the sine, cosine, and tangent of the modulus of the length of the key divided by a constant value.The function then calculates a value $c using the numHash function, which is based on the CRC32 algorithm. If $c is not equal to zero, $a is XOR encrypted with the character at the index $c in the self::$salt_1_dat array. The input data is split into chunks of 256 bytes, and each chunk is encrypted using the Enc function, which performs a series of XOR operations with the key and other values.Before encrypting each chunk, the function performs additional operations on the key and $a, including XOR encryption with other characters and hashing with SHA-512 and GOST. The function also updates the value of $a by applying the strrev, utf8_encode, substr, and numHash functions. Finally, the function returns the encrypted data, which is optionally base64-encoded if $j is true. |
| Decrypt(text) | This appears to be a PHP function named Decrypt that takes two parameters, $e and $j, and returns a decrypted value. The decryption process seems to involve several cryptographic operations, including hashing, encryption, and XOR operations.Here is a rough breakdown of what the function does:The function starts by initializing several variables and constants, including the encryption key ($b) and some hash values (self::$hash0, self::$hash1, etc.).If the $j parameter is true, the $e parameter is base64-encoded.A string ($a) is created using several characters and the result of a mathematical expression involving the exp and pow functions.The $a string is encrypted using an XOR operation with another string that includes some characters and the result of another mathematical expression involving exp and tan.The resulting encrypted string is passed through two more functions (Raw_hexrev and another XOR encryption with a long string made up of several hash values concatenated together).A hash value is generated using the $b key and some mathematical expressions involving sin, cos, and tan functions applied to the length of the key. The hash value is used to modify the $a string using another XOR operation.The encrypted value ($e) is split into chunks of 684 characters, and a loop processes each chunk.Inside the loop, the chunk is decrypted using another function (Dec) and the $b key.If the current chunk is not the last one, the $b key is modified using several hash functions (sha512, gost, and whirlpool) and XOR operations with some other strings.The decrypted values from each chunk are concatenated together to form the final decrypted value.If the $j parameter was true, the final decrypted value is decompressed using the gzuncompress function.The final decrypted value is returned.Overall, it is difficult to determine the exact purpose or security properties of this function without more context about its usage and the values of its variables. It is also possible that some of the code has been obfuscated or intentionally made difficult to understand for security reasons. |
| Enc() | This code snippet defines two static functions, Enc and Dec, which are used to encrypt and decrypt data.The Enc function takes two parameters, $f and $c, where $f is the data to be encrypted, and $c is the encryption key. It first splits the data into chunks of length 2^7 and then uses the Crypt function to encrypt each chunk using the key. The Crypt function is not defined in this code snippet, but it can be assumed that it is a custom encryption function.If the length of the data is greater than 2^7, the function then performs additional encryption steps by XOR encrypting a salt value with the key and using it to modify the key. It then applies a SHA-512 hash to the result of XOR encryption of the modified key and the encrypted chunk of data. The result of the hash is then used as the new key for the next chunk of data to be encrypted.Finally, the encrypted data and the last key used for encryption are returned as an array. |
| Dec() | The Dec function is used to decrypt the encrypted data generated by the Enc function. It takes two parameters, $f and $d, where $f is the encrypted data, and $d is the decryption key. The function first splits the encrypted data into chunks of length 342 (presumably a multiple of 2^7) and then uses the Crypt function to decrypt each chunk using the key.If the length of the encrypted data is greater than 2^7, the function performs similar additional decryption steps as the Enc function, using XOR encryption with a salt value to modify the key before applying a SHA-512 hash to the result of the XOR encryption of the modified key and the encrypted chunk of data.Finally, the decrypted data and the last key used for decryption are returned as an array. |
| Crypt() | This code seems to be a PHP implementation of a cryptographic function that encrypts data using a combination of hash functions, XOR encryption, and other techniques. It appears to be a custom implementation rather than using any established cryptographic standard or library.The Crypt function takes three parameters: $r, $x, and $f. $r is the data to be encrypted or decrypted, $x is a flag to indicate whether to encrypt ("e") or decrypt ("d") the data, and $f is the encryption key.The function first generates two hash values t and f using the SHA-512 algorithm and the $f key. It then uses these hash values to generate several other hash values using various algorithms including SHA-512, Whirlpool, and MD5. XOR encryption is also used to modify the input data before and after the encryption process.The encrypted data is returned as a hexadecimal string.However, it should be noted that this implementation may not be secure or reliable for actual use, as it is not designed or tested against established standards, and may have weaknesses or vulnerabilities. It is recommended to use established cryptographic libraries or consult with a security expert when designing or implementing cryptographic systems. |
| numHash() | This function takes a string as input and returns its MD5 hash in binary form. If the optional $a parameter is specified as an integer, the output is truncated to that length. |
| Raw_hexrev() | This function takes a binary string as input, converts it to hexadecimal, reverses the order of the resulting string, and then returns it as a binary string. |
| E_Shift() | This function performs a shift operation on the input string $b. The amount of shifting is determined by the integer value of $e. If $e is 1, each 4-character block in $b is rotated one position to the left. If $e is 2, each block is rotated two positions to the left. If $e is 3, each block is rotated three positions to the left. |
| D_Shift() | This function performs a shift operation on the input string $b. The amount of shifting is determined by the integer value of $e. If $e is 1, each 4-character block in $b is rotated one position to the right. If $e is 2, each block is rotated two positions to the right. If $e is 3, each block is rotated three positions to the right. |
| Hex_Dont_Count() | This function takes a hexadecimal string as input and performs a series of character replacements based on the value of each pair of adjacent characters. The replacement values are stored in various static class variables such as self::$change_a, self::$change_b, etc. It's unclear what the purpose of these replacements is without additional context. |
| XOREncryption() | This function takes two string inputs and applies XOR operation on each character of the first string with each character of the second string. It returns the result as a string. |
| XOREncrypt() | This function is a wrapper around XOREncryption($a, $c) function with $b as the second parameter. |
| XORDecrypt() | This function is similar to XOREncrypt($a, $b) but with the XOR operation reversed to decrypt the original string. |
| bk_kb() | This function takes a string as input and converts each uppercase letter to lowercase and each lowercase letter to uppercase, returning the result as a string. |
| Hex_Encrypt_Key() | This is a PHP code for two static functions: Hex_Encrypt_Key and Hex_Decrypt_Key. These functions take in two parameters, $a and $c, which are strings representing the input and key, respectively. The functions first call the Hex_Dont_Count function, passing in the MD5 hash of $c as a parameter. This function returns a string which is used as the "hex code" for the encryption/decryption process. The functions then loop through each character in the input string ($a) and perform a substitution operation based on the current character in the hex code string ($c). The substitution is done using the strtr function, which replaces characters in $a based on a lookup table that is defined within the function. The lookup table consists of arrays that map each hexadecimal character to a specific set of replacement characters. For example, the self::$change_a array maps the hexadecimal character "a" to the string "0,2,5,6,7,8,a,b,c,d,e,f". The substitution is done using the strtr function, which takes in the input string ($a) and a lookup table (e.g., self::$change_a) and replaces all occurrences of characters in the table with their corresponding replacement values. Finally, the modified input string ($a) is returned as the output of the function. |
| Hex_Decrypt_Key() | This is a PHP static function called Hex_Decrypt_Key that takes two parameters, $a and $c. The function first uses the Hex_Dont_Count function to calculate the MD5 hash of $c and store it in $c. It then initializes a variable $d to 0 and loops through the characters in $a. If $d is equal to 32 (i.e., pow(2,5)), it is reset to 0 and $c is transformed using the strtr function to replace certain characters in $c with others from self::$hashchan. Depending on the value of $c[$d], the character at position $b in $a is transformed using the strtr function with different arrays stored in self::$change_a through self::$change_9. The value of $d is then incremented by 1. The function returns the modified $a string. |
| encrypt_key() | This is a PHP function called encrypt_key which takes two parameters, $c and $a. It uses the self::Hex_Dont_Count function to calculate the MD5 hash of the $c parameter and then assigns the resulting hash to the $c variable. It then loops through each character in the $a parameter and performs a series of conditional statements based on the value of $c[$d], where $d is a counter variable that starts at 0 and is incremented by 1 after each iteration of the loop. The value of $c[$d] is used to determine which hash transformation to apply to the current character in $a[$b]. The hash transformations are defined in the self::$base64_characters array, which contains all possible characters that can appear in the $a parameter. Each element in the array maps to a specific character transformation, which is applied to the current character in $a[$b] if the corresponding condition in the conditional statement is true. The resulting transformed character is then assigned back to $a[$b]. After all characters in $a have been transformed, the function returns the transformed string. |
| decrypt_key() | This is a PHP function called "decrypt_key" that takes two arguments: $c and $a. The function first hashes the $c parameter using the md5 algorithm and then removes any counting of hexadecimal characters in the resulting hash value. The function then proceeds to iterate through the characters of the $a parameter and perform a series of character substitutions based on the value of each character and the current index of the iteration. The substitution values used are stored in various static variables, such as self::$hash0, self::$hash1, and so on, which are arrays of character mappings for each hexadecimal digit. The $d variable keeps track of the current index in the hexadecimal hash value, and when it reaches 2^5 (32), the value of $d is reset to 0 and a new set of substitution values is used. The function finally returns the modified $a parameter. Without additional context, it's difficult to say exactly what this function is being used for, but it appears to be a custom encryption/decryption algorithm that uses a combination of md5 hashing and character substitution to transform input data. |
| E_hex_1() | This function replaces characters in $a with corresponding values in self::$hex_1. The result is returned in $d. |
| D_hex_1() | This function is the reverse of E_hex_1. It replaces characters in $a with corresponding values in self::$hex_characters. The result is returned in $d. |
| E_hex_2() | This function replaces characters in $a with corresponding values in self::$hex_2. The result is returned in $d. |
| D_hex_2() | This function is the reverse of E_hex_2. It replaces characters in $a with corresponding values in self::$hex_characters. The result is returned in $d. |
| E_hex_3() | This function replaces characters in $a with corresponding values in self::$hex_2. The result is returned in $d. |
| D_hex_3() | This function is the reverse of E_hex_3. It replaces characters in $a with corresponding values in self::$hex_characters. The result is returned in $d. |
| settingsgenerator() | This function replaces characters in $a with corresponding values in self::$sg. The result is returned in $d. |
| settingsgenerator1() | This function replaces characters in $a with corresponding values in self::$sg1. The result is returned in $d. |
| settingsgenerator2() | This function replaces characters in $a with corresponding values in self::$sg2. The result is returned in $d. |
| hashtoXcode() | This function replaces characters in $a with corresponding values in self::$hXc. The result is returned in $d. |
| hashtohash_1() | This function replaces characters in $a with corresponding values in self::$hth_1. The result is returned in $d. |
## End Note
This project is a student project. It's very safe, but don't expect flexibility. The producer produced this project when he was just starting high school. There is a big difference with the current knowledge of the producer.
