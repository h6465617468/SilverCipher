# ❯ AntaresCrypt
It is an advanced symmetric encryption algorithm that can be used on PHP, inspired by the AES and XOR encryption algorithm. It was originally produced as an original encryption algorithm for encrypted messaging application, and later shared on the internet. You can take an example to design your own encryption algorithm by looking at the source code. It produces different results each time. The strength of this encryption algorithm is stronger than AES. It drives the attacker crazy because it consumes a lot of processor power when encrypting, contains many different encryption methods, and has too many loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of breaking the encryption increase abnormally.
## ❯ How To Use?
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
## ❯ Developer Note
If you're into encryption, you should take a look at file shredders.(DoD 5220.22-M,Pseudorandom Data,Random Data,Write Zeroes) It will be more secure if you use it together with RSA or Elliptic-curve cryptography algorithm. When using this encryption algorithm in your project, I recommend you to use it by adding or changing different functions.

## ❯ Best File Shredder
```php
//Most compliant with DoD 5220.22-M standard
function secure_delete_file_x1($file_path) {
    $file_handle = fopen($file_path, 'r+');
    $file_size = filesize($file_path);
    for ($i = 0; $i < $file_size; $i++) {
        fwrite($file_handle, chr(0));
    }
    $half_file_size = intval($file_size / 2);
    for ($i = 0; $i < 3; $i++) {
        fseek($file_handle, 0);
        for ($j = 0; $j < $half_file_size; $j++) {
            $rand_num = rand(0, 255);
            fwrite($file_handle, chr($rand_num));
        }
    }
    fseek($file_handle, $half_file_size);
    for ($i = 0; $i < 3; $i++) {
        for ($j = $half_file_size; $j < $file_size; $j++) {
            $rand_num = rand(0, 255);
            fwrite($file_handle, chr($rand_num));
        }
    }
    fclose($file_handle);
    unlink($file_path);
}
//use
secure_delete_file_x1("file.txt");
```
## ❯ Other
```php
function secure_delete_file_ac_n($file_path) {
    $fp = fopen($file_path, "r+");
    $file_size = filesize($file_path);
    $passes = array(
        str_repeat(chr(0x00), $file_size),
        str_repeat(chr(0xFF), $file_size),
        str_repeat(chr(0x55), $file_size),
        str_repeat(chr(0xAA), $file_size),
        str_repeat(chr(0x92), $file_size),
        str_repeat(chr(0x49), $file_size),
        str_repeat(chr(0xB6), $file_size),
        str_repeat(chr(0xDB), $file_size),
        str_repeat(chr(0xE5), $file_size),
        str_repeat(chr(0x24), $file_size),
        str_repeat(chr(0x6D), $file_size),
        str_repeat(chr(0x8C), $file_size),
        str_repeat(chr(0xB2), $file_size),
        str_repeat(chr(0xCC), $file_size),
        str_repeat(chr(0xE1), $file_size),
        str_repeat(chr(0xF0), $file_size)
    );
    foreach ($passes as $pass) {
        fseek($fp, 0);
        fwrite($fp, $pass);
        fflush($fp);
    }
    fclose($fp);
    unlink($file_path);
}
//use
secure_delete_file_ac_n("file.txt");

function secure_delete_file_x($file_path) {
    $fp = fopen($file_path, "r+");
    $pattern = pack("H*", "55") . pack("H*", "AA") . pack("H*", "FF");
    $file_size = filesize($file_path);
    for ($i = 0; $i < $file_size; $i += strlen($pattern)) {
        fseek($fp, $i);
        fwrite($fp, $pattern);
    }
    fclose($fp);
    unlink($file_path);
}
//use
secure_delete_file_x("file.txt");

function secureDelete($filePath) {
    $fp = fopen($filePath, 'r+');
    $fileSize = filesize($filePath);
    for ($i = 0; $i < $fileSize; $i++) {
        fwrite($fp, "\0");
    }
    fflush($fp);
    fclose($fp);
    unlink($filePath);
    clearstatcache(true, $filePath);
}
//use
secureDelete("file.txt");

function secure_delete_file($file_path) {
    $fp = fopen($file_path, "r+");
    $pattern = str_repeat(chr(0xff), rand(1, 3)) . str_repeat(chr(0x00), rand(1, 3));
    $file_size = filesize($file_path);
    for ($i = 0; $i < $file_size; $i += strlen($pattern)) {
        fseek($fp, $i);
        fwrite($fp, $pattern);
    }
    fclose($fp);
    unlink($file_path);
}
//use
secure_delete_file("file.txt");

function deleteFile($filePath) {
    if (file_exists($filePath)) {
        $fileSize = filesize($filePath);
        $fileHandle = fopen($filePath, "r+");
        $fileContent = fread($fileHandle, $fileSize);
        $secureContent = str_repeat("x", $fileSize);
        fseek($fileHandle, 0);
        fwrite($fileHandle, $secureContent);
        fflush($fileHandle);
        fclose($fileHandle);
        unlink($filePath);
    }
}
//use
deleteFile("file.txt");

function deleteFileWithPseudorandomData($filename) {
    if (file_exists($filename)) {
        $handle = fopen($filename, "wb");
        $filesize = filesize($filename);
        $prData = openssl_random_pseudo_bytes($filesize);
        fwrite($handle, $prData);
        fclose($handle);
        unlink($filename);
    }
}
//use
deleteFileWithPseudorandomData("file.txt");

function deleteFileGutmann($file_path) {
    $passes = 35;
    $byteCount = filesize($file_path);
    $handle = fopen($file_path, "r+");
    if (!$handle) {
        return false;
    }
    for ($pass = 0; $pass < $passes; $pass++) {
        for ($i = 0; $i < $byteCount; $i++) {
            fseek($handle, $i);
            fwrite($handle, chr($pass));
        }
    }
    fclose($handle);
    return unlink($file_path);
}
//use
deleteFileGutmann("file.txt");

function secure_delete_file_c($file_path) {
    $fp = fopen($file_path, "r+");
    $pattern1 = str_repeat(chr(0x55), 1024);
    $pattern2 = str_repeat(chr(0xAA), 1024);
    $pattern3 = str_repeat(chr(0x92), 1024);
    $file_size = filesize($file_path);
    for ($i = 0; $i < $file_size; $i += strlen($pattern1)) {
        fseek($fp, $i);
        fwrite($fp, $pattern1);
        fflush($fp);
        fseek($fp, $i);
        fwrite($fp, $pattern2);
        fflush($fp);
        fseek($fp, $i);
        fwrite($fp, $pattern3);
        fflush($fp);
    }
    fclose($fp);
    unlink($file_path);
}
//use
secure_delete_file_c("file.txt");

function wipe_file($file_path){$patterns=array("1111111111111111111111111111111111111111111111111111111111111111","2222222222222222222222222222222222222222222222222222222222222222","3333333333333333333333333333333333333333333333333333333333333333","4444444444444444444444444444444444444444444444444444444444444444","5555555555555555555555555555555555555555555555555555555555555555","6666666666666666666666666666666666666666666666666666666666666666","7777777777777777777777777777777777777777777777777777777777777777","8888888888888888888888888888888888888888888888888888888888888888","9999999999999999999999999999999999999999999999999999999999999999","aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa","bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb","cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc","dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd","eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee","ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff","0000000000000000000000000000000000000000000000000000000000000000","0000000000000000000000000000000000000000000000000000000000000000");$handle=fopen($file_path,"a");$file_size=filesize($file_path);$iterations=intval(($file_size+511)/512);for($i=0;$i<$iterations;$i++){foreach($patterns as $pattern){fwrite($handle,$pattern,512);}}fclose($handle);unlink($file_path);}
//use
wipe_file("file.txt");
```

## ❯ End Note
This project is a student project. It's very safe, but don't expect flexibility. The producer produced this project when he was just starting high school. There is a big difference with the current knowledge of the producer.
