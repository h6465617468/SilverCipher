# Other Info

## ❯ Secure DoD 5220.22-M, AES-256-CBC File Upload
```php
$error_msg = "Dosya yüklenirken bir hata oluştu.";
$encryption_key = 'my_secret_key';
$upload_file_name = basename($_FILES['fileToUpload']['name']);
$upload_file_path = '/var/www/html/uploads/' . $upload_file_name;
if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
    $upload_file = fopen($upload_file_path, 'wb');
    if ($upload_file !== false) {
        $input_file = fopen($_FILES['fileToUpload']['tmp_name'], 'rb');
        $iv = openssl_random_pseudo_bytes(16);
        fwrite($upload_file, $iv);
        while (!feof($input_file)) {
            $plaintext = fread($input_file, 4096);
            $ciphertext = openssl_encrypt($plaintext, 'AES-256-CBC', $encryption_key, OPENSSL_RAW_DATA, $iv);
            fwrite($upload_file, $ciphertext);
            $iv = substr($ciphertext, -16);
        }
        fclose($input_file);
        fclose($upload_file);
        $output = shell_exec('shred -u -n 3 -z ' . escapeshellarg($upload_file_path));
        echo "Dosya başarıyla yüklendi ve öğütüldü.";
    } else {
        echo $error_msg;
    }
} else {
    echo $error_msg;
}
```

## ❯ Secure DoD 5220.22-M, AES-256-CBC Image Upload
```php
$target_dir = "uploads/"; // yükleme dizini
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not a valid file.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    $encrypted_file = openssl_encrypt(file_get_contents($_FILES["fileToUpload"]["tmp_name"]), 'aes-256-cbc', 'mysecretkey');
    $hashed_file = hash('sha512', $encrypted_file);
    $hashed_filename = hash('sha512', basename($_FILES["fileToUpload"]["name"]));
    $fp = fopen('uploads/'.$hashed_filename.'.'.$imageFileType, 'wb');
    fwrite($fp, $encrypted_file);
    fclose($fp);
    $cmd = "/usr/bin/shred -vfzu -n 5 uploads/".$hashed_filename.'.'.$imageFileType;
    exec($cmd);
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
}
```

## ❯ Best File Shredder
```php
// Most compliant with DoD 5220.22-M standard
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
## ❯ Other File Shredder
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
