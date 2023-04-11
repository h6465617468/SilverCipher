# ❯ AntaresCrypt
It is an advanced symmetric encryption algorithm that can be used on PHP, inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It produces different results each time. The strength of this encryption algorithm is stronger than AES. It drives the attacker crazy because it consumes a lot of processor power when encrypting, contains many different encryption methods, and has too many loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of breaking the encryption increase abnormally. This encryption algorithm is run on PHP only.

## ❯ How to use?

### Latest Version
### [ ❯ AC v.1.17](https://github.com/XPROCION/AntaresCrypt/blob/main/AntaresCrypt.php)

```php
// How to use AntaresCrypt

// Put 'AntaresCrypt.php' in your project file, then require(),require_once() it in your own file

require_once "AntaresCrypt.php";

$plain_text="Hello World"; // Unlimited Text Size

$key="123"; // Unlimited Key Size

$encrypted_text=AntaresCrypt::Encrypt($plain_text,$key);

$decrypted_text=AntaresCrypt::Decrypt($encrypted_text,$key);

echo $encrypted_text;
echo "<br>";
echo $decrypted_text;
```
### [ ❯ Encryption Tool](https://github.com/XPROCION/AntaresCrypt/blob/main/encryption_tool.php)

## ❯ Developer Note
If you're into encryption, you should take a look at file shredders.(DoD 5220.22-M,Pseudorandom Data,Random Data,Write Zeroes) It will be more secure if you use it together with RSA or Elliptic-curve cryptography algorithm. When using this encryption algorithm in your project, I recommend you to use it by adding or changing different functions.

# ❯ Encryption Transactions

If you are using this encryption algorithm, you should know them.

## ❯ Secure DoD 5220.22-M, AntaresCrypt, AES-256-CBC Folder Encryption And Decryption
```php
// DoD 5220.22-M 
function secureDelete($file) {
    $fileSize = filesize($file);
    $fileHandle = fopen($file, 'r+');
    for($i=0; $i<$fileSize; $i++) {
        fwrite($fileHandle, random_int(0, 255));
    }
    fclose($fileHandle);
    unlink($file);
}
//AntaresCrypt
function encryptFolder($dir, $password) {
    $files = scandir($dir);
    foreach($files as $file) {
        if($file !== '.' && $file !== '..') {
            if(is_dir("$dir/$file")) {
                encryptFolder("$dir/$file", $password);
            } else {
                // encrypt file
                $fileContents = file_get_contents("$dir/$file");
                $encryptedContents = AntaresCrypt::encrypt($fileContents, $password);
                file_put_contents("$dir/$file", $encryptedContents);
                
                // delete file securely
                $fileSize = filesize("$dir/$file");
                $fileHandle = fopen("$dir/$file", 'r+');
                for($i=0; $i<$fileSize; $i++) {
                    fwrite($fileHandle, random_int(0, 255));
                }
                fclose($fileHandle);
                unlink("$dir/$file");
            }
        }
    }
}
//AES-256-CBC
function encryptDirectory($source, $key) {
    $dirIterator = new RecursiveDirectoryIterator($source);
    $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);
    
    while ($iterator->valid()) {
      if (!$iterator->isDot()) {
        if ($iterator->isFile()) {
          $file = $iterator->getPathName();
          $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
          $encryptedFile = $file . ".enc";
          $encrypted = openssl_encrypt(file_get_contents($file), 'aes-256-cbc', $key, 0, $iv);
          file_put_contents($encryptedFile, $encrypted . $iv);
          // Bu kısımda secureDelete() kullanılabilir
          $shred = "shred -z -u -n 3 $file";
          exec($shred);
        
        } elseif ($iterator->isDir()) {
          $dir = $iterator->getPath() . '/' . $iterator->getFileName();
          mkdir($dir . ".enc");
        }
      }
      $iterator->next();
    }
  }
$source = '/path/to/folder';
$key = 'YourSecretEncryptionKey';
encryptDirectory($source, $key);
//Decrypt AES-256-CBC
function decrypt_files($key, $dir) {
    // Get list of files in directory
    $files = scandir($dir);

    // Loop through files
    foreach($files as $file) {
        // Skip hidden files
        if ($file === '.' || $file === '..') continue;

        // Check if file is a directory
        if (is_dir("$dir/$file")) {
            // Recursively decrypt files in subdirectory
            decrypt_files($key, "$dir/$file");
        } else {
            // Read file contents
            $encrypted_data = file_get_contents("$dir/$file");

            // Decrypt file contents
            $decrypted_data = openssl_decrypt($encrypted_data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, substr($key, 0, 16));

            // Remove padding from decrypted data
            $padding_length = ord(substr($decrypted_data, -1));
            $decrypted_data = substr($decrypted_data, 0, -$padding_length);

            // Write decrypted data back to file
            file_put_contents("$dir/$file", $decrypted_data);
        }
    }
}
```
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
## ❯ PHP Disable Cache
```php
header("Expires: on, 01 Jan 1 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
```
## ❯ PHPSECLIB3/OPENSSL RSA Verify, Generate Key / JS Encrypt Sign, Generate Key
### i like these
### [ ❯ PHPSECLIB3](https://github.com/phpseclib/phpseclib)
```php
// OPENSSL Verify
$result = openssl_verify($asdasdasd1["text"], base64_decode($asdasdasd1["sign"]), "-----BEGIN PUBLIC KEY-----...", OPENSSL_ALGO_SHA256);
// PHPSECLIB3 Verify
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php'; /* Composer */
use phpseclib3\Crypt\RSA;
$rsa = RSA::loadFormat('PKCS8',"-----BEGIN PUBLIC KEY-----...");
$signature = "aHjYxLoHga..";
$result = $rsa->verify(hash("sha256",$signtext,true), $signature) ? "OK" : "INCORRECT";
// PHPSECLIB3 RSA Generator /* Composer */
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use phpseclib3\Crypt\RSA;
/* RSA::setSmallestPrime(256); fast speed */
$private = RSA::createKey((int)$_POST["size"]);
$public = $private->getPublicKey();
```
### i like these
### [ ❯ JSEncrypt](https://github.com/travist/jsencrypt)
```javascript
// JSEncrypt Generate Key
/* <input id="olusturrsa" style="padding:16px;margin:0;font-size:16px;font-weight:1000;width:%5;border:0;background-color:transparent;margin-left:0;border-bottom:2.5px solid dimgrey;padding:16px;margin:0;color:white!important;" type="button" value="Browser Kullanarak Oluştur"> */
/*
<textarea id="privkey" style="padding:15px;margin:0;font-size:16px;font-weight:1000;width:80%;background-color:transparent;max-width:600px;height:300px;border:2.5px solid dimgrey;margin:0;padding:16px;color:white!important;" placeholder="Private Key"></textarea><br>
<textarea id="pubkey" style="padding:15px;margin:0;font-size:16px;font-weight:1000;width:80%;background-color:transparent;max-width:600px;height:300px;border:2.5px solid dimgrey;margin:0;padding:16px;color:white!important;" placeholder="Public Key"></textarea><br>
<p id="rsatime" name="rsatime" style="color:white;"></p>
<input type="number" name="rsabit" id="rsabit" style="padding:15px;margin:0;font-size:16px;font-weight:1000;width:80%;border:0;background-color:transparent;max-width:600px;height:auto;border:0;border-bottom:2.5px solid dimgrey;margin:0;padding:16px;color:white!important;" value="4096" placeholder="Rsa Bit Size" autocomplete="off" required><br>
*/
function opencpuload(){
// Loading page
return true;
}
function changedurum(text){
// Loading text
return true;
}
$('#olusturrsa').on( "click",( () => {
  var crypt = new JSEncrypt({default_key_size: parseInt($('#rsabit').val())});
  $('cachew').html($('#rsabit').val());opencpuload();changedurum("RSA Key Oluşturuluyor: "+$('#rsabit').val()+" Bit");
  var dt123 = new Date();var timeaaa=-(dt123.getTime());
  new Promise((resolve)=>{setTimeout(resolve, 100);}).then( ()=>{
    crypt.getKey();
  }).finally(() => {closecpuload();
    $('#privkey').html(crypt.getPrivateKey());
    $('#pubkey').html(crypt.getPublicKey());changedurum("RSA Key Oluşturuldu: "+$('#rsabit').val()+" Bit");    dt123 = new Date();
    timeaaa += (dt123.getTime());$('#rsatime').html(timeaaa+" ms");(async()=>{await document.getElementById('rsabit').scrollIntoView();})()});
  }));
$('#olusturrsaserver').click(server_rsa_generate);
// JSEncrypt Sign
var cryptx = new JSEncrypt();
cryptx.setPrivateKey("-----BEGIN RSA PRIVATE KEY-----");
cache_signp=cryptx.sign(plaintext, CryptoJS.SHA256, "sha256");
```
## ❯ AES Encrypt Decrypt CryptoJS
### i like these
### [ ❯ Stackoverflow CryptoJS](https://stackoverflow.com/questions/24337317/encrypt-with-php-decrypt-with-javascript-cryptojs)
```php
// PHP
function cryptoJsAesDecrypt($passphrase, $jsonString){
    $jsondata = json_decode(base64_decode($jsonString), true);
    $salt = hex2bin($jsondata["s"]);
    $ct = base64_decode($jsondata["ct"]);
    $iv  = hex2bin($jsondata["iv"]);
    $concatedPassphrase = $passphrase.$salt;
    $md5 = array();
    $md5[0] = md5($concatedPassphrase, true);
    $result = $md5[0];
    for ($i = 1; $i < 3; $i++) {
        $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
        $result .= $md5[$i];
    }
    $key = substr($result, 0, 32);
    $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
    return json_decode($data, true);
}
function cryptoJsAesEncrypt($passphrase, $value){
    $salt = openssl_random_pseudo_bytes(8);
    $salted = '';
    $dx = '';
    while (strlen($salted) < 48) {
        $dx = md5($dx.$passphrase.$salt, true);
        $salted .= $dx;
    }
    $key = substr($salted, 0, 32);
    $iv  = substr($salted, 32,16);
    $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
    $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
    return base64_encode(json_encode($data));
}
```
```javascript
// Javascript
var CryptoJSAesJson = {
    stringify: function (cipherParams) {
        var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
        if (cipherParams.iv) j.iv = cipherParams.iv.toString();
        if (cipherParams.salt) j.s = cipherParams.salt.toString();
        return JSON.stringify(j);
    },
    parse: function (jsonStr) {
        var j = JSON.parse(jsonStr);
        var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
        if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
        if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
        return cipherParams;
    }
}
function crypto_encrypt_AES(text_crypto_AES,passAES){
  var enc = CryptoJS.AES.encrypt(JSON.stringify(text_crypto_AES), passAES, {format: CryptoJSAesJson}).toString();
  return Base64.encode(enc);
}
function crypto_decrypt_AES(encrypted,passAES){
  var dec = JSON.parse(CryptoJS.AES.decrypt(Base64.decode(encrypted), passAES, {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8));
  return dec;
}
```
## ❯ Javascript RSA Message POST Begin Public Key Encrypt
```php
<!DOCTYPE html>
<html>
<head>
	<title>RSA ile Şifrelenmiş Mesaj Gönderme</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.0.0/jsencrypt.min.js"></script>
</head>
<body>
	<h1>RSA ile Şifrelenmiş Mesaj Gönderme</h1>
	
	<label for="mesaj">Gönderilecek Mesaj:</label>
	<textarea id="mesaj" rows="5" cols="50"></textarea>
	
	<button onclick="sifrele()">Mesajı Şifrele ve Gönder</button>

	<script>
		// Alıcının public key'i
		var aliciPublicKey = "-----BEGIN PUBLIC KEY-----\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCdc8fu37FbkLq3pMsFt93zmxZg\nrZ9XoZquvmMFDgLbG2fIjCyzScvDmVxpOJdHiQ8mTjsF/bvXHs4A/ZsVyGcAk4w4\nvO7Nvy23dZlL5I5z5wmq1r3A1SZmHw+8xtaJh56eY2ZeuIoXxUH0L0FwbEFLS2yv\nGK0Bcv/rUc0q3OETjwIDAQAB\n-----END PUBLIC KEY-----";
		
		function sifrele() {
			// Mesajı al
			var mesaj = document.getElementById("mesaj").value;
			
			// RSA şifreleme nesnesi oluştur
			var rsa = new JSEncrypt();
			
			// Alıcının public key'ini kullanarak RSA şifreleme nesnesini ayarla
			rsa.setPublicKey(aliciPublicKey);
			
			// Mesajı RSA ile şifrele
			var sifreliMesaj = rsa.encrypt(mesaj);
			
			// Şifreli mesajı gönder
			// Burada mesajı alıcıya nasıl göndereceğinizle ilgili bir kod yazmanız gerekiyor
			// Örneğin, bir HTTP POST isteği kullanarak bir web servisine gönderebilirsiniz
			
			alert("Mesaj başarıyla şifrelendi ve gönderildi!");
		}
	</script>
</body>
</html>
```
## ❯ PHP  RSA Message POST Begin Private Key Decrypt
```php
// Özel anahtar dosyası
$private_key = openssl_pkey_get_private("file:///path/to/private.key");
// OR
// $private_key = "-----BEGIN RSA PRIVATE KEY----- MIIkKgIBAAKCCAEAnMn9HFvxxXQI0Nq9+0lth...";

// Şifreli mesaj
$encrypted_message = base64_decode($_POST['message']);

// RSA ile deşifreleme
openssl_private_decrypt($encrypted_message, $decrypted_message, $private_key);

// Deşifrelenmiş mesaj
echo $decrypted_message;
```
## ❯ Javascript RSA Message AJAX POST (Generate Key)
```php
// jsencrypt kütüphanesini yükleyin
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.0.0-rc.1/jsencrypt.min.js"></script>

// RSA anahtarı oluşturun
var encrypt = new JSEncrypt({default_key_size: 2048});
var publicKey = '-----BEGIN PUBLIC KEY----- ... -----END PUBLIC KEY-----';
encrypt.setPublicKey(publicKey);

// Şifrelenecek mesajı belirleyin
var message = "Merhaba dünya";

// Mesajı RSA ile şifreleyin
var encrypted = encrypt.encrypt(message);

// Şifreli mesajı sunucuya gönderin (örneğin, AJAX kullanarak)
$.ajax({
  type: "POST",
  url: "sunucu_url",
  data: {message: encrypted},
  success: function(response) {
    // Sunucudan gelen yanıtı işleyin
    console.log(response);
  }
});
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

## ❯ End Note
This project is a student project. It's very safe, but don't expect flexibility. The producer produced this project when he was just starting high school. There is a big difference with the current knowledge of the producer.
