# SilverCipher
This project was written using the PHP programming language.
It is an advanced symmetric encryption algorithm that can be used on PHP, inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It produces different results each time. The strength of this encryption algorithm is stronger than AES. It drives the attacker crazy because it consumes a lot of processor power when encrypting, contains many different encryption methods, and has too many loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of breaking the encryption increase abnormally. This encryption algorithm is run on PHP only.

| Name | Folder Encryption | File Encryption | Text Encryption | File Shredder | Type | Security |
| --- | --- | --- | --- | --- | --- | --- |
| SilverCipher Tool | Yes | Yes | Yes | All Shredders (Powerful) | Symetric/Block | Very High |
| SilverCipher5 Cryptography | - | - | Yes | - | Symetric | Very High |

| Type | Supported Encryption Algorithms |
| --- | --- |
| Vanilla | AES-128-CBC, AES-128-CFB, AES-128-CTR, AES-128-ECB, AES-128-OFB, AES-192-CBC, AES-192-CFB, AES-192-CTR, AES-192-ECB, AES-192-OFB, AES-256-CBC, AES-256-CFB, AES-256-CTR, AES-256-ECB, AES-256-OFB, BF-CBC, BF-CFB, BF-ECB, BF-OFB, CAMELLIA-128-CBC, CAMELLIA-128-CFB, CAMELLIA-128-CTR, CAMELLIA-128-ECB, CAMELLIA-128-OFB, CAMELLIA-192-CBC, CAMELLIA-192-CFB, CAMELLIA-192-CTR, CAMELLIA-192-ECB, CAMELLIA-192-OFB, CAMELLIA-256-CBC, CAMELLIA-256-CFB, CAMELLIA-256-CTR, CAMELLIA-256-ECB, CAMELLIA-256-OFB, CAST5-CBC, CAST5-CFB, CAST5-ECB, CAST5-OFB, CHACHA20, CHACHA20-POLY1305, DES-CBC, DES-CFB, DES-CFB1, DES-CFB8, DES-ECB, DES-EDE, DES-EDE-CBC, DES-EDE-CFB, DES-EDE-OFB, DES-EDE3, DES-EDE3-CBC, DES-EDE3-CFB, DES-EDE3-OFB, DES-OFB, IDEA-CBC, IDEA-CFB, IDEA-ECB, IDEA-OFB, RC2-40-CBC, RC2-64-CBC, RC2-CBC, RC2-CFB, RC2-ECB, RC2-OFB, RC4, RC4-40, SEED-CBC, SEED-CFB, SEED-CTR, SEED-ECB, SEED-OFB |
| SilverCipher | SilverCipher1, SilverCipher2, SilverCipher3, SilverCipher4, SilverCipher5 |
| AntaresCrypt | AntaresCryptv1.0, AntaresCryptv1.1, AntaresCryptv1.2, AntaresCryptv1.3, AntaresCryptv1.4, AntaresCryptv1.5, AntaresCryptv1.6, AntaresCrypt X7500roundedition |

| SilverCipher File Shredder | Method |
| --- | --- |
| File Shredder 0 | This function takes a filename as input and overwrites its contents using various erasure methods, including DoD5220.22-M, NSA, ATA, Cryptographic, Purge, Clear, and Gutmann. The function uses a loop to iterate over the methods, and within each iteration, it opens the file, generates a pattern based on the current method, writes the pattern to the file, and repeats the process for all files with the same name in the directory. Finally, the function deletes the original file. |
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
# Setup
### Download SilverCipher
### [ Latest Version SilverCipher](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher.php)
### [ Latest Version SilverCipher5 Unique Encryption Algorithm](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher5.php)
#### Download Other Unique Encryption Algorithm Library
#### [SilverCipher4](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher4.php) , [SilverCipher3](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher3.php) , [SilverCipher2](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher2.php) , [SilverCipher1](https://github.com/eenonde/SilverCipher/blob/main/SilverCipher1.php)
# Usage

## Folder Encryption/Decryption
Folder/File Encryption uses [Gutmann](https://en.wikipedia.org/wiki/Gutmann_method) file shredding method
Folder/File Encryption uses [DoD 5220.22-M](https://en.wikipedia.org/wiki/National_Industrial_Security_Program) file shredding method
Encrypts all subfolders and files. Before encrypting, it takes the data and parts it so that it cannot be recovered. It does not re-encrypt the previously encrypted file. Appends '_enc' to the end of the encrypted file.
```php
require_once "SilverCipher.php";
$key="my_key";
$iv = "1234567890123456";
$dir = "/path";
// OR
// $dir = __DIR__."/path";
$algo="AES-256-CBC"; // Only uses Vanilla Encryption Algorithms
$ht = new SilverCipher($key,$iv); // $key,$iv required
// encrypt a folder
$ht->encrypt_data("folder", null, $algo, $dir);
// decrypt the encrypted folder
$ht->decrypt_data("folder", null, $algo, $dir);
// Note: All files in the folder will be encrypted and saved with '_enc' suffix.
// The decrypted files will have the same name as the encrypted files without the '_enc' suffix.
```
## File Encryption/Decryption
```php
require_once "SilverCipher.php";
$key="my_key";
$iv = "1234567890123456";
$encrypt_file_path="file_to_encrypt.txt";
$decrypt_file_path="file_to_encrypt.txt_enc";
$algo="AES-256-CBC"; // Only uses Vanilla Encryption Algorithms
$ht = new SilverCipher($key,$iv); // $key,$iv required
// encrypt a file
$ht->encrypt_data("file", $encrypt_file_path, $algo);
// decrypt the encrypted file
$ht->decrypt_data("file", $decrypt_file_path, $algo);
// Note: The encrypted file will be saved as 'file_to_encrypt.txt_enc'
// and the decrypted file will be saved as 'file_to_encrypt.txt'
```
## Text Encryption/Decryption
```php
require_once "SilverCipher.php";
$key="my_key";
$iv = "1234567890123456";
$plain_text="my secret data";
$algo="AES-256-CBC"; // Only uses Vanilla Encryption Algorithms
$ht = new SilverCipher($key,$iv); // $key,$iv required
// encrypt a text
$encrypted_text = $ht->encrypt_data("text", $plain_text, $algo);
// decrypt the encrypted text
$decrypted_text = $ht->decrypt_data("text", $encrypted_text, $algo);
echo $decrypted_text; // output: my secret data
```
## SilverCipher5 Encryption
#### [ Encryption Tool](https://github.com/eenonde/SilverCipher/blob/main/encryption_tool.php)
```php
require_once "SilverCipher5.php"; // Only uses SilverCipher Encryption Algorithms
$plain_text = "Hello World"; // Unlimited Text Size
$key = "123"; // Unlimited Key Size
$ht = new SilverCipher5($key); // $key required
$encrypted_text=$ht->Encrypt($plain_text);
$decrypted_text=$ht->Decrypt($encrypted_text);
echo $encrypted_text;
echo "<br>";
echo $decrypted_text;
```
## SilverCipher File Shredder
Operations such as file shredding require data to be written directly into memory areas, and therefore low-level programming languages are better suited for these operations. The use of these languages can increase the processing speed of files and minimize memory usage.
PHP is unfortunately a high level programming language.
```php
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
```
## SilverCipher Hash
```php
require_once "SilverCipher.php";
$text="hello world";
$lenght=1024;
$ht = new SilverCipher();
echo $ht->hash($text,$lenght);
```
## Contributing
SilverCipher is an open-source project that welcomes contributions from anyone. If you want to contribute to SilverCipher, you can fork the project on GitHub and submit a pull request with your changes. You can also report issues and suggest improvements on the GitHub issue tracker.

## Developer Note
If you're into encryption, you should take a look at file shredders.(DoD 5220.22-M,Pseudorandom Data,Random Data,Write Zeroes) It will be more secure if you use it together with RSA or Elliptic-curve cryptography algorithm. When using this encryption algorithm in your project, I recommend you to use it by adding or changing different functions.

## End Note
This project is a student project. It's very safe, but don't expect flexibility. The producer produced this project when he was just starting high school. There is a big difference with the current knowledge of the producer.
