# ❯ EuclidBox Cryptography
It is an advanced symmetric encryption algorithm that can be used on PHP, inspired by the AES and XOR encryption algorithm. You can take an example to design your own encryption algorithm by looking at the source code. It produces different results each time. The strength of this encryption algorithm is stronger than AES. It drives the attacker crazy because it consumes a lot of processor power when encrypting, contains many different encryption methods, and has too many loops. It is in no way affected by the Brute Force attack. According to the length of the data to be encrypted, the encryption time and the difficulty of breaking the encryption increase abnormally. This encryption algorithm is run on PHP only.

## ❯ Getting Started
Invoke the EuclidBox library you are using with require(),require_once() at the project file.
### [ ❯ Latest Version EuclidBox](https://github.com/eenonde/EuclidBox/blob/main/EuclidBox.php)
### [ ❯ Latest Version EuclidBox5 Unique Encryption Algorithm](https://github.com/eenonde/EuclidBox/blob/main/EuclidBox5.php)
### ❯ Other Unique Encryption Algorithm
#### [ ❯ EuclidBox4](https://github.com/eenonde/EuclidBox/blob/main/EuclidBox4.php) , [ ❯ EuclidBox3](https://github.com/eenonde/EuclidBox/blob/main/EuclidBox3.php) , [ ❯ EuclidBox2](https://github.com/eenonde/EuclidBox/blob/main/EuclidBox2.php) , [ ❯ EuclidBox1](https://github.com/eenonde/EuclidBox/blob/main/EuclidBox1.php)
# ❯ Usage
## ❯ EuclidBox Text Encryption
Encrypt with EuclidBox's own unique encryption algorithm
```php
// Encrypt with EuclidBox's own unique encryption algorithm
// How to use EuclidBox Latest Version
// How to Encrypt with EuclidBox
// How to Decrypt with EuclidBox

// Put 'EuclidBox.php' in your project file, then require(),require_once() it in your own file

require_once "EuclidBox5.php";
//require_once "EuclidBox4.php";
//require_once "EuclidBox3.php";
//require_once "EuclidBox2.php";
//require_once "EuclidBox1.php";

$plain_text = "Hello World"; // Unlimited Text Size

$key = "123"; // Unlimited Key Size

$ht = new EuclidBox5($key); // Best
//$ht = new EuclidBox4($key);
//$ht = new EuclidBox3($key);
//$ht = new EuclidBox2($key);
//$ht = new EuclidBox1($key); // Fast

$encrypted_text=$ht->Encrypt($plain_text);
$encrypted_text=$ht->Decrypt($encrypted_text);

echo $encrypted_text;
echo "<br>";
echo $decrypted_text;
```

#### [ ❯ Encryption Tool](https://github.com/eenonde/EuclidBox/blob/main/encryption_tool.php)

## ❯ EuclidBox Military Level Folder/File/Text Encryption
#### ❯ Uses the [Gutmann](https://en.wikipedia.org/wiki/Gutmann_method) file shredding method
Encrypts all subfolders and files. Before encrypting, it takes the data and parts it so that it cannot be recovered. It does not re-encrypt the previously encrypted file. Appends '_enc' to the end of the encrypted file.
```php
// Put 'EuclidBox.php' in your project file, then require(),require_once() it in your own file

require_once "EuclidBox.php";
/*
Supported Encryption Algorithms:
AES-128-CBC, AES-128-CFB, AES-128-CTR, AES-128-ECB, AES-128-OFB, AES-192-CBC, AES-192-CFB, AES-192-CTR, AES-192-ECB, AES-192-OFB, AES-256-CBC, AES-256-CFB, AES-256-CTR, AES-256-ECB, AES-256-OFB, BF-CBC, BF-CFB, BF-ECB, BF-OFB, CAMELLIA-128-CBC, CAMELLIA-128-CFB, CAMELLIA-128-CTR, CAMELLIA-128-ECB, CAMELLIA-128-OFB, CAMELLIA-192-CBC, CAMELLIA-192-CFB, CAMELLIA-192-CTR, CAMELLIA-192-ECB, CAMELLIA-192-OFB, CAMELLIA-256-CBC, CAMELLIA-256-CFB, CAMELLIA-256-CTR, CAMELLIA-256-ECB, CAMELLIA-256-OFB, CAST5-CBC, CAST5-CFB, CAST5-ECB, CAST5-OFB, CHACHA20, CHACHA20-POLY1305, DES-CBC, DES-CFB, DES-CFB1, DES-CFB8, DES-ECB, DES-EDE, DES-EDE-CBC, DES-EDE-CFB, DES-EDE-OFB, DES-EDE3, DES-EDE3-CBC, DES-EDE3-CFB, DES-EDE3-OFB, DES-OFB, IDEA-CBC, IDEA-CFB, IDEA-ECB, IDEA-OFB, RC2-40-CBC, RC2-64-CBC, RC2-CBC, RC2-CFB, RC2-ECB, RC2-OFB, RC4, RC4-40, SEED-CBC, SEED-CFB, SEED-CTR, SEED-ECB, SEED-OFB
*/
// FOLDER ENCRYPTION
$key="my_key";
$iv = "1234567890123456";
$dir = "/path";
// OR
// $dir = __DIR__."/path";
$algo="AES-256-CBC";
$ht = new EuclidBox($key,$iv); // $key,$iv required
// encrypt a folder
$ht->encrypt_data("folder", null, $algo, $dir);

// decrypt the encrypted folder
$ht->decrypt_data("folder", null, $algo, $dir);

// Note: All files in the folder will be encrypted and saved with '_enc' suffix.
// The decrypted files will have the same name as the encrypted files without the '_enc' suffix.

// FILE ENCRYPTION
$key="my_key";
$iv = "1234567890123456";
$encrypt_file_path="file_to_encrypt.txt";
$decrypt_file_path="file_to_encrypt.txt_enc";
$algo="AES-256-CBC";
$ht = new EuclidBox($key,$iv); // $key,$iv required

// encrypt a file
$ht->encrypt_data("file", $encrypt_file_path, $algo);

// decrypt the encrypted file
$ht->decrypt_data("file", $decrypt_file_path, $algo);

// Note: The encrypted file will be saved as 'file_to_encrypt.txt_enc'
// and the decrypted file will be saved as 'file_to_encrypt.txt'

// TEXT ENCRYPTION
$key="my_key";
$iv = "1234567890123456";
$plain_text="my secret data";
$algo="AES-256-CBC";
$ht = new EuclidBox($key,$iv); // $key,$iv required
// encrypt a text
$encrypted_text = $ht->encrypt_data("text", $plain_text, $algo);

// decrypt the encrypted text
$decrypted_text = $ht->decrypt_data("text", $encrypted_text, $algo);

echo $decrypted_text; // output: my secret data
```
## ❯ EuclidBox File Shredder
Operations such as file shredding require data to be written directly into memory areas, and therefore low-level programming languages are better suited for these operations. The use of these languages can increase the processing speed of files and minimize memory usage.
PHP is unfortunately a high level programming language.
```php
// Put 'EuclidBox.php' in your project file, then require(),require_once() it in your own file

require_once "EuclidBox.php";

EuclidBoxEraser::Eraser1($file_path);
EuclidBoxEraser::Eraser2($file_path);
EuclidBoxEraser::Eraser3($file_path); // Best
EuclidBoxEraser::Eraser4($file_path);
EuclidBoxEraser::Eraser5($file_path);
EuclidBoxEraser::Eraser6($file_path);
EuclidBoxEraser::Eraser7($file_path);
EuclidBoxEraser::Eraser8($file_path);
EuclidBoxEraser::Eraser9($file_path);
EuclidBoxEraser::Eraser10($file_path);
EuclidBoxEraser::Eraser11($file_path);
EuclidBoxEraser::Eraser12($file_path);
```

## ❯ Developer Note
If you're into encryption, you should take a look at file shredders.(DoD 5220.22-M,Pseudorandom Data,Random Data,Write Zeroes) It will be more secure if you use it together with RSA or Elliptic-curve cryptography algorithm. When using this encryption algorithm in your project, I recommend you to use it by adding or changing different functions.

# ❯ Encryption Transactions

If you are using this encryption algorithm, you should know them.

## ❯ PHP Disable Cache
```php
header("Expires: on, 01 Jan 1 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
```
## ❯ Secure DoD 5220.22-M, AES-256-CBC Folder Upload Encryption
```php
function encryptFile($inputFile, $outputFile, $key, $iv) {
    $inputHandle = fopen($inputFile, 'rb');
    $outputHandle = fopen($outputFile, 'wb');
    $header = openssl_random_pseudo_bytes(512);
    fwrite($outputHandle, $header);
    while (!feof($inputHandle)) {
        $plaintext = fread($inputHandle, 16 * 1024);
        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        fwrite($outputHandle, $ciphertext);
    }
    fclose($inputHandle);
    fclose($outputHandle);
    return true;
}
function overwriteFile($filename) {
    $filesize = filesize($filename);
    $fp = fopen($filename, "w");
    if (!$fp) {
        return false;
    }
    for ($i = 0; $i < $filesize; $i++) {
        fwrite($fp, chr(mt_rand(0, 255)));
    }
    fclose($fp);
    return true;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $key = 'mysecretkey';
    $iv = openssl_random_pseudo_bytes(16);
    $folderPath = $_POST['folderPath'];
    $outputFolderPath = 'encrypted_folder';
    if (!file_exists($outputFolderPath)) {
        mkdir($outputFolderPath);
    }
    $files = scandir($folderPath);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $inputFilePath = $folderPath . '/' . $file;
            $outputFilePath = $outputFolderPath . '/' . $file;
            encryptFile($inputFilePath, $outputFilePath, $key, $iv);
            overwriteFile($inputFilePath);
            chmod($outputFilePath, 0644);
        }
    }

    echo 'Tüm dosyalar başarıyla şifrelendi ve öğütüldü!';
}
```
## ❯ Secure DoD 5220.22-M, AES-256-CBC Folder Upload Decryption
```php
$encrypted_folder = $_POST['encrypted_folder'];
$decrypted_folder = $_POST['decrypted_folder'];
$encryption_key = $_POST['encryption_key'];
decryptFolder($encrypted_folder, $decrypted_folder, $encryption_key);
function decryptFolder($encrypted_folder, $decrypted_folder, $encryption_key) {
    $files = glob($encrypted_folder . '/*');
    foreach ($files as $file) {
        $decrypted_file = $decrypted_folder . '/' . basename($file);
        if (strpos($file, '.enc') !== false) {
            $encrypted_data = file_get_contents($file);
            $decrypted_data = openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, substr($encryption_key, 0, 16));
            file_put_contents($decrypted_file, $decrypted_data);
        } else {
            copy($file, $decrypted_file);
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
## ❯ Best File Shredder
```php
// Most compliant with Gutmann
function gutmann_delete_file($filename) {
    $file = fopen($filename, "w");
    for ($i = 0; $i < 35; $i++) {
        $data = '';
        for ($j = 0; $j < filesize($filename); $j++) {
            $data .= chr(mt_rand(0, 255));
        }
        fwrite($file, $data);
        fflush($file);
        fseek($file, 0);
    }
    for ($i = 0; $i < filesize($filename); $i++) {
        fwrite($file, "\x00");
        fflush($file);
        fseek($file, 0);
    }
    for ($i = 0; $i < filesize($filename); $i++) {
        fwrite($file, "\xFF");
        fflush($file);
        fseek($file, 0);
    }
    fclose($file);
    unlink($filename);
}
//use
gutmann_delete_file("file.txt");
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
## ❯ PHPSECLIB3 Elliptic Curve Encryption, Decryption, Generate Key, Load Key
### i like these
### [ ❯ PHPSECLIB3](https://github.com/phpseclib/phpseclib)
```php
// Generate Key
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

use phpseclib3\Crypt\EC;
$private = EC::createKey('secp256k1');

$private->toString('PKCS8', ['namedCurve' => false]);
$private->getPublicKey()->toString('PKCS8', ['namedCurve' => false]);
echo "$private?$public";
// Encryption, Decryption
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

use phpseclib3\Crypt\EC;
use phpseclib3\Crypt\Random;

$curve = new EC('secp256k1');

$key = $curve->createKey();

$publicKey = $key['publicKey']->toString('PEM');
$privateKey = $key['privateKey']->toString('PEM');

$message = 'This is a secret message.';

$ciphertext = $curve->encrypt($message, $publicKey);

$decryptedMessage = $curve->decrypt($ciphertext, $privateKey);

echo $decryptedMessage;
// Load Key, Encryption, Decryption
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use phpseclib3\Crypt\EC;
use phpseclib3\Crypt\Common\PrivateKey;
use phpseclib3\File\ASN1;
use phpseclib3\Math\BigInteger;

$key = file_get_contents('/path/to/private_key.pem');

$asn1 = new ASN1();
$decoded = $asn1->decodeBER($key);
$parsed = $asn1->asn1map($decoded[0], PrivateKey::MAP);

$privateKey = new BigInteger($parsed['privateKey']);

$ec = new EC('curve_name');
$ec->setPrivateKey($privateKey);

$plaintext = 'Hello, World!';
$ciphertext = $ec->encrypt($plaintext);
$decrypted = $ec->decrypt($ciphertext);
```
## ❯ PHPSECLIB3/OPENSSL RSA Verify, Generate Key / JS Encrypt Sign, Generate Key
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
// Loading div
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
