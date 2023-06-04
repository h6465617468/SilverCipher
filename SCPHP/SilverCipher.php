<?php 
set_time_limit(0);
class SilverCipher
{
    private $iv;
    private $key;
    private $algo;
    public function __construct($key = null, $iv = null,$algo = null) {
        if ($algo == null || $algo == "" || $algo == false) {
            $this->algo = "AES-256-CBC";
        } else {
            $this->algo = $algo;
        }
        if ($key == null || $key == "" || $key == false) {
            $this->key = $this->generateKey($this->algo);
        } else {
            $this->key = $key;
        }
        if ($iv == null || $iv == "" || $iv == false) {
            $this->iv = $this->generateIV($this->algo);
        } else {
            $this->iv = $iv;
        }
    }
    public function add_key($new_key) {
        $this->key = $new_key;
    }
    public function add_iv($new_iv) {
        $this->iv = $new_iv;
    }
    public function add_algorithm($algo) {
        $this->algo = $algo;
    }
    public function setKey($new_key) {
        $this->key = $new_key;
    }
    public function setIV($new_iv) {
        $this->iv = $new_iv;
    }
    public function setAlgorithm($algo) {
        $this->algo = $algo;
    }
    public function generateKey($algo) {
        if($algo == null || $algo == "" || $algo == false) {
            $algo=$this->algo;
        }
        $keyLength = openssl_cipher_iv_length($algo);
        $key = openssl_random_pseudo_bytes($keyLength);
        $this->key = $key;
        return $key;
    }
    public function generateIV($algo) {
        if($algo == null || $algo == "" || $algo == false) {
            $algo=$this->algo;
        }
        $ivLength = openssl_cipher_iv_length($algo);
        $iv = openssl_random_pseudo_bytes($ivLength);
        $this->iv = $iv;
        return $iv;
    }
    public function testKey($key) {
        if ($key == null || $key == "" || $key == false) {
            if($this->key == null || $this->key == "" || $this->key == false) {
                $this->generateKey($this->algo);
            }
        } else {
            $this->key = $key;
        }
    }
    public function testIV($iv) {
        if ($iv == null || $iv == "" || $iv == false) {
            if ($this->iv == null || $this->iv == "" || $this->iv == false) {
                $this->generateIV($this->algo);
            }
        } else {
            $this->iv = $iv;
        }
    }
    public function nullkillKey($key) {
        if ($key == null || $key == "" || $key == false) {
            if($this->key == null || $this->key == "" || $this->key == false) {
                return false;
            }
        }else {
            $this->key = $key;
        }
        return true;
    }
    public function nullkillIV($iv) {
        if ($iv == null || $iv == "" || $iv == false) {
            if($this->iv == null || $this->iv == "" || $this->iv == false) {
                return false;
            }
        }else {
            $this->iv = $iv;
        }
        return true;
    }
    public function Encrypt($data, $key=null, $iv=null) {
        $this->testKey($key);
        $this->testIV($key);
        $algo=$this->algo;
        if(is_dir($data) || is_dir(__DIR__.$data)) {
            return $this->encrypt_data("folder", null, $algo, $data);
        } else if(file_exists($data)) {
            return $this->encrypt_data("file", $data, $algo);
        } else {
            return base64_encode($this->encrypt_data("text", $data, $algo));
        }
    }
    public function Decrypt($data, $key=null, $iv=null) {
        if($this->nullkillKey($key)!=true || $this->nullkillIV($iv)!=true){
            return false;
        }
        $algo=$this->algo;
        if(is_dir($data) || is_dir(__DIR__.$data)) {
            return $this->decrypt_data("folder", null, $algo, $data);
        } else if(file_exists($data)) {
            return $this->decrypt_data("file", $data, $algo);
        } else {
            return $this->decrypt_data("text", base64_decode($data), $algo);
        }
    }
    public function EncryptText($data, $key=null, $iv=null) {
        $this->testKey($key);
        $this->testIV($key);
        $algo=$this->algo;
        return base64_encode($this->encrypt_data("text", $data, $algo));
    }
    public function DecryptText($data, $key=null, $iv=null) {
        if($this->nullkillKey($key)!=true || $this->nullkillIV($iv)!=true){
            return false;
        }
        $algo=$this->algo;
        return $this->decrypt_data("text", base64_decode($data), $algo);
    }
    public function EncryptFile($data, $key=null, $iv=null) {
        $this->testKey($key);
        $this->testIV($key);
        $algo=$this->algo;
        if(file_exists($data)) {
            return $this->encrypt_data("file", $data, $algo);
        } else {
            return false;
        }
    }
    public function DecryptFile($data, $key=null, $iv=null) {
        if($this->nullkillKey($key)!=true || $this->nullkillIV($iv)!=true){
            return false;
        }
        $algo=$this->algo;
        if(file_exists($data)) {
            return $this->decrypt_data("file", $data, $algo);
        } else {
            return false;
        }
    }
    public function EncryptDirectory($data, $key=null, $iv=null) {
        $this->testKey($key);
        $this->testIV($key);
        $algo=$this->algo;
        if(is_dir($data)) {
            return $this->encrypt_data("folder", null, $algo, $data);
        } else {
            if(is_dir(__DIR__.$data)) {
                return $this->encrypt_data("folder", null, $algo, __DIR__.$data);
            } else {
                return false;
            }
        }
    }
    public function DecryptDirectory($data, $key=null, $iv=null) {
        if($this->nullkillKey($key)!=true || $this->nullkillIV($iv)!=true){
            return false;
        }
        $algo=$this->algo;
        if(is_dir($data)) {
            return $this->decrypt_data("folder", null, $algo, $data);
        } else {
            if(is_dir(__DIR__.$data)) {
                return $this->decrypt_data("folder", null, $algo, __DIR__.$data);
            } else {
                return false;
            }
        }
    }
    public function encrypt_data($type, $data, $algorithm, $dir = null) {
        if($algorithm == null || $algorithm == "" || $algorithm == false) {
            $algorithm=$this->algo;
        }
        $options = OPENSSL_RAW_DATA;
        if ($type == "folder") {
            if (!is_dir($dir)) {
                if (!is_dir(__DIR__.$dir)) {
                    return "Error: The directory does not exist! __DIR__".$dir." and ".$dir;
                } else {
                    $dir = __DIR__.$dir;
                }
            }
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                $file_path = $dir . DIRECTORY_SEPARATOR . $file;

                if (is_dir($file_path)) {
                    $ht1 = new SilverCipher($this->key, $this->iv);
                    $ht1->encrypt_data("folder", null, $algorithm, $file_path);
                } else {
                    if (substr($file, -4) === "_enc") {
                        continue;
                    }
                    $file_content = file_get_contents($file_path);
                    if (empty($file_content)) {
                        file_put_contents($file_path . "_enc","");
                        SilverCipherEraser::Eraser12($file_path);
                        continue;
                    } else {
                        $encrypted_content = openssl_encrypt($file_content, $algorithm, $this->key, $options, $this->iv);
                        file_put_contents($file_path . "_enc", $encrypted_content);
                        SilverCipherEraser::Eraser14($file_path);
                    }
                }
            }
        }else if ($type == "file") {
            if(file_exists($data) && substr($data, -4) !== "_enc"){
                $file_content = file_get_contents($data);
                if (empty($file_content)) {
                    file_put_contents($data . "_enc","");
                    SilverCipherEraser::Eraser12($data);
                    return true;
                } else {
                    $encrypted_content = openssl_encrypt($file_content, $algorithm, $this->key, $options, $this->iv);
                    file_put_contents($data . "_enc", $encrypted_content);
                    SilverCipherEraser::Eraser14($data);
                }
            } else {
                return "Error: The file does not exist!";
            }
        } else if ($type == "text") {
            $encrypted_content = openssl_encrypt($data, $algorithm, $this->key, $options, $this->iv);
            return $encrypted_content;
        }
        return true;
    }
    public function decrypt_data($type, $data, $algorithm, $dir=null) {
        if($algorithm == null || $algorithm == "" || $algorithm == false) {
            $algorithm=$this->algo;
        }
        $options = OPENSSL_RAW_DATA;
        if ($type == "folder") {
            if (!is_dir($dir)) {
                if (!is_dir(__DIR__.$dir)) {
                    return "Error: The directory does not exist! __DIR__".$dir." and ".$dir;
                } else {
                    $dir = __DIR__.$dir;
                }
            }
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                $file_path = $dir . DIRECTORY_SEPARATOR . $file;
                if (is_dir($file_path)) {
                    $ht2 = new SilverCipher($this->key, $this->iv);
                    $ht2->decrypt_data("folder", null, $algorithm, $file_path);
                } else {
                    if (substr($file, -4) !== "_enc") {
                        continue;
                    }
                    $file_content = file_get_contents($file_path);
                    if (empty($file_content)) {
                        file_put_contents(substr($file_path, 0, -4), "");
                        SilverCipherEraser::Eraser12($file_path);
                        continue;
                    } else {
                        try {
                            $decrypted_content = openssl_decrypt($file_content, $algorithm, $this->key, $options, $this->iv);
                            if ($decrypted_content === false) {
                                throw new Exception("Failed to decrypt file content");
                            }
                        } catch (Exception $e) {
                            return "Error decrypting file $file_path: " . $e->getMessage() . "\n";
                        }
                        file_put_contents(substr($file_path, 0, -4), $decrypted_content);
                        SilverCipherEraser::Eraser14($file_path);
                    }
                }
            }
        } else if ($type == "file") {
            if(file_exists($data)){
                $file_content = file_get_contents($data);
                if (empty($file_content)) {
                    file_put_contents(substr($data, 0, -4), "");
                    SilverCipherEraser::Eraser12($data);
                    return true;
                } else {
                    try {
                        $decrypted_content = openssl_decrypt($file_content, $algorithm, $this->key, $options, $this->iv);
                        if ($decrypted_content === false) {
                            throw new Exception("Failed to decrypt file content");
                        }
                    } catch (Exception $e) {
                        return "Error decrypting file $data: " . $e->getMessage() . "\n";
                    }
                    file_put_contents(substr($data, 0, -4), $decrypted_content);
                    SilverCipherEraser::Eraser14($data);
                }
            } else {
                return "Error: The file does not exist!";
            }
        } else if ($type == "text") {
            if (empty($data)) {
                throw new Exception("Data content is empty");
            }
            try {
                $decrypted_content = openssl_decrypt($data, $algorithm, $this->key, $options, $this->iv);
                if ($decrypted_content === false) {
                    throw new Exception("Failed to decrypt content");
                }
            } catch (Exception $e) {
                return "Error decrypting : " . $e->getMessage() . "\n";
            }
            return $decrypted_content;
        }
        return true;
    }
    public static function Hash($b, $length=1024)
    {
        $a = '';
        $dx = 0;
        $data=$b;
        while (strlen($a) < $length) {
            $key=hash('gost', $a.$b);
            $salt=hash('gost', $a.$b);
            $hash1 = hash('sha3-512', $data . $salt . $key);
            $hash2 = hash('ripemd160', $data . $salt . $key);
            $hash3 = hash('tiger128,3', $data . $salt . $key);
            $hash4 = hash('gost', $data . $salt . $key);
            $hash5 = hash('adler32', $data . $salt . $key);
            $hash6 = hash('crc32', $data . $salt . $key);
            $hash7 = hash('crc32b', $data . $salt . $key);
            $hash8 = hash('snefru', $data . $salt . $key);
            $hash9 = hash('fnv132', $data . $salt . $key);
            $hash10 = hash('fnv1a32', $data . $salt . $key);
            $hash11 = hash('fnv164', $data . $salt . $key);
            $hash12 = hash('fnv1a64', $data . $salt . $key);
            $hash13 = hash('joaat', $data . $salt . $key);
            $hash14 = hash('haval128,3', $data . $salt . $key);
            $hash15 = hash('haval160,3', $data . $salt . $key);
            $hash16 = hash('haval192,3', $data . $salt . $key);
            $hash17 = hash('haval224,3', $data . $salt . $key);
            $hash18 = hash('haval256,3', $data . $salt . $key);
            $hash19 = hash('ripemd256', $data . $salt . $key);
            $hash20 = hash('sha256', $data . $salt . $key);
            $hash21 = hash('sha512', $data . $salt . $key);
            $hash22 = hash('whirlpool', $data . $salt . $key);
            $hash23 = hash('sha3-256', $data . $salt . $key);
            $concatenatedHash = $hash1 . $hash2 . $hash3 . $hash4 . $hash5 . $hash6 . $hash7 . $hash8 . $hash9 . $hash10 . $hash11 . $hash12 . $hash13 . $hash14 . $hash15 . $hash16 . $hash17 . $hash18 . $hash19 . $hash20 . $hash21 . $hash22 . $hash23;
            $b = bin2hex(openssl_encrypt($concatenatedHash, "AES-256-CBC", hex2bin(hash("sha256",$salt)), OPENSSL_RAW_DATA, hex2bin(hash("tiger128,3",$a."x"))));
            $data=$b;
            $a .= $b;
        }
        return substr($a, 0, $length);
    }
}
class SilverCipherEraser
{
public static function Eraser0($filename){$filesize=filesize($filename);for($k=0;$k<1;$k++){$pattern=pack("H*","FF");$handle=fopen($filename,'r+');for($i=0;$i<$filesize;$i++){fwrite($handle,$pattern);}fclose($handle);$pattern=pack("H*","00");$handle=fopen($filename,'r+');for($i=0;$i<$filesize;$i++){fwrite($handle,$pattern);}fclose($handle);$patterns=array(pack("H*","00"),pack("H*","FF"),pack("H*","11"),pack("H*","22"),pack("H*","33"),pack("H*","44"),pack("H*","55"),pack("H*","66"),pack("H*","77"),pack("H*","88"),pack("H*","99"),pack("H*","AA"),pack("H*","BB"),pack("H*","CC"),pack("H*","DD"),pack("H*","EE"),pack("H*","FF"));foreach($patterns as $pattern){$handle=fopen($filename,'r+');for($i=0;$i<$filesize;$i++){fwrite($handle,$pattern);}fclose($handle);}$patterns=array(pack("H*","55"),pack("H*","AA"),pack("H*","92"),pack("H*","49"),pack("H*","24"),pack("H*","12"),pack("H*","09"),pack("H*","49"),pack("H*","24"),pack("H*","12"),pack("H*","09"),pack("H*","6D"),pack("H*","B6"),pack("H*","DB"),pack("H*","6D"),pack("H*","B6"),pack("H*","DB"),pack("H*","FF"),pack("H*","00"),pack("H*","11"),pack("H*","22"),pack("H*","33"),pack("H*","44"),pack("H*","55"),pack("H*","66"),pack("H*","77"),pack("H*","88"),pack("H*","99"),pack("H*","AA"),pack("H*","BB"),pack("H*","CC"),pack("H*","DD"),pack("H*","EE"),pack("H*","FF"));foreach($patterns as $pattern){$handle=fopen($filename,'r+');for($i=0;$i<5;$i++){fwrite($handle,$pattern);}fclose($handle);}$pattern=openssl_random_pseudo_bytes($filesize);$handle=fopen($filename,'w');fwrite($handle,$pattern);fclose($handle);$patterns=array(pack("H*","00"),pack("H*","FF"));foreach($patterns as $pattern){$handle=fopen($filename,'r+');for($i=0;$i<$filesize;$i++){fwrite($handle,$pattern);}for($i=0;$i<$filesize;$i++){fwrite($handle,$pattern,$filesize-$i-1);}fclose($handle);}$patterns=array(pack("H*","00"),pack("H*","FF"));foreach($patterns as $pattern){$handle=fopen($filename,'r+');for($i=0;$i<$filesize;$i+=2){fwrite($handle,$pattern);}fclose($handle);$handle=fopen($filename,'r+');for($i=1;$i<$filesize;$i+=2){fwrite($handle,$pattern);}fclose($handle);}}unlink($filename);}
public static function Eraser1($filename){if(!file_exists($filename)){return false;}$file=fopen($filename,"w");for($i=0;$i<5;$i++){$data='';for($j=0;$j<filesize($filename);$j++){$data.=chr(mt_rand(0,255));}fwrite($file,$data);fflush($file);fseek($file,0);}for($i=0;$i<filesize($filename);$i++){fwrite($file,"\x00");fflush($file);fseek($file,0);}for($i=0;$i<filesize($filename);$i++){fwrite($file,"\xFF");fflush($file);fseek($file,0);}fclose($file);unlink($filename);}
public static function Eraser2($filename){if(!file_exists($filename)){return false;}$size=filesize($filename);if(!$size||!is_writable($filename)){return false;}$patterns=array("\x00\xFF","\xFF\x00","\x55\xAA","\xAA\x55","\x92\x49","\x49\x92","\x24\x92","\x92\x24","\x6D\xB6","\xB6\x6D","\xDB\xDB","\x6D\xB6","\xFF\xFF","\x00\x00","\x11\x11","\x22\x22","\x33\x33","\x44\x44","\x55\x55","\x66\x66","\x77\x77","\x88\x88","\x99\x99","\xAA\xAA","\xBB\xBB","\xCC\xCC","\xDD\xDD","\xEE\xEE","\xFF\xFF","\x00\x00","\x00\x00","\xFF\xFF","\xAA\xAA","\x55\x55","\x00\x00","\xFF\xFF","\x00\x00","\xFF\xFF","\x55\x55","\xAA\xAA","\xFF\xFF","\x00\x00","\xAA\xAA","\x55\x55","\xFF\xFF","\x00\x00","\x55\x55","\xAA\xAA");$pattern_count=count($patterns);for($i=0;$i<5;$i++){$pattern=$patterns[$i%$pattern_count];$handle=fopen($filename,"w");for($j=0;$j<$size;$j+=strlen($pattern)){fwrite($handle,$pattern,strlen($pattern));}fclose($handle);}unlink($filename);return true;}
public static function Eraser3($file_path){if(!file_exists($file_path)){return false;}$file_handle=fopen($file_path,'r+');$file_size=filesize($file_path);for($i=0;$i<$file_size;$i++){fwrite($file_handle,chr(0));}$half_file_size=intval($file_size/2);for($i=0;$i<3;$i++){fseek($file_handle,0);for($j=0;$j<$half_file_size;$j++){$rand_num=rand(0,255);fwrite($file_handle,chr($rand_num));}}fseek($file_handle,$half_file_size);for($i=0;$i<3;$i++){for($j=$half_file_size;$j<$file_size;$j++){$rand_num=rand(0,255);fwrite($file_handle,chr($rand_num));}}fclose($file_handle);unlink($file_path);}
public static function Eraser4($file_path){if(!file_exists($file_path)){return false;}$fp=fopen($file_path,"r+");$file_size=filesize($file_path);$passes=array(str_repeat(chr(0x00),$file_size),str_repeat(chr(0xFF),$file_size),str_repeat(chr(0x55),$file_size),str_repeat(chr(0xAA),$file_size),str_repeat(chr(0x92),$file_size),str_repeat(chr(0x49),$file_size),str_repeat(chr(0xB6),$file_size),str_repeat(chr(0xDB),$file_size),str_repeat(chr(0xE5),$file_size),str_repeat(chr(0x24),$file_size),str_repeat(chr(0x6D),$file_size),str_repeat(chr(0x8C),$file_size),str_repeat(chr(0xB2),$file_size),str_repeat(chr(0xCC),$file_size),str_repeat(chr(0xE1),$file_size),str_repeat(chr(0xF0),$file_size));foreach($passes as $pass){fseek($fp,0);fwrite($fp,$pass);fflush($fp);}fclose($fp);unlink($file_path);}
public static function Eraser5($file_path){if(!file_exists($file_path)){return false;}$fp=fopen($file_path,"r+");$pattern=pack("H*","55").pack("H*","AA").pack("H*","FF");$file_size=filesize($file_path);for($i=0;$i<$file_size;$i+=strlen($pattern)){fseek($fp,$i);fwrite($fp,$pattern);}fclose($fp);unlink($file_path);}
public static function Eraser6($filePath){if(!file_exists($filePath)){return false;}$fp=fopen($filePath,'r+');$fileSize=filesize($filePath);for($i=0;$i<$fileSize;$i++){fwrite($fp,"\0");}fflush($fp);fclose($fp);unlink($filePath);clearstatcache(true,$filePath);}
public static function Eraser7($file_path){if(!file_exists($file_path)){return false;}$fp=fopen($file_path,"r+");$pattern=str_repeat(chr(0xff),rand(1,3)).str_repeat(chr(0x00),rand(1,3));$file_size=filesize($file_path);for($i=0;$i<$file_size;$i+=strlen($pattern)){fseek($fp,$i);fwrite($fp,$pattern);}fclose($fp);unlink($file_path);}
public static function Eraser8($filePath){if(!file_exists($filePath)){return false;}$fileSize=filesize($filePath);$fileHandle=fopen($filePath,"r+");$fileContent=fread($fileHandle,$fileSize);$secureContent=str_repeat("x",$fileSize);fseek($fileHandle,0);fwrite($fileHandle,$secureContent);fflush($fileHandle);fclose($fileHandle);unlink($filePath);}
public static function Eraser9($filename){if(!file_exists($filename)){return false;}$handle=fopen($filename,"wb");$filesize=filesize($filename);$prData=openssl_random_pseudo_bytes($filesize);fwrite($handle,$prData);fclose($handle);unlink($filename);}
public static function Eraser10($file_path){if(!file_exists($file_path)){return false;}$passes=35;$byteCount=filesize($file_path);$handle=fopen($file_path,"r+");if(!$handle){return false;}for($pass=0;$pass<$passes;$pass++){for($i=0;$i<$byteCount;$i++){fseek($handle,$i);fwrite($handle,chr($pass));}}fclose($handle);return unlink($file_path);}
public static function Eraser11($file_path){if(!file_exists($file_path)){return false;}$fp=fopen($file_path,"r+");$pattern1=str_repeat(chr(0x55),1024);$pattern2=str_repeat(chr(0xAA),1024);$pattern3=str_repeat(chr(0x92),1024);$file_size=filesize($file_path);for($i=0;$i<$file_size;$i+=strlen($pattern1)){fseek($fp,$i);fwrite($fp,$pattern1);fflush($fp);fseek($fp,$i);fwrite($fp,$pattern2);fflush($fp);fseek($fp,$i);fwrite($fp,$pattern3);fflush($fp);}fclose($fp);unlink($file_path);}
public static function Eraser12($file_path){if(!file_exists($file_path)){return false;}$patterns=array("1111111111111111111111111111111111111111111111111111111111111111","2222222222222222222222222222222222222222222222222222222222222222","3333333333333333333333333333333333333333333333333333333333333333","4444444444444444444444444444444444444444444444444444444444444444","5555555555555555555555555555555555555555555555555555555555555555","6666666666666666666666666666666666666666666666666666666666666666","7777777777777777777777777777777777777777777777777777777777777777","8888888888888888888888888888888888888888888888888888888888888888","9999999999999999999999999999999999999999999999999999999999999999","aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa","bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb","cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc","dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd","eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee","ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff","0000000000000000000000000000000000000000000000000000000000000000","0000000000000000000000000000000000000000000000000000000000000000");$handle=fopen($file_path,"a");$file_size=filesize($file_path);$iterations=intval(($file_size+511)/512);for($i=0;$i<$iterations;$i++){foreach($patterns as $pattern){fwrite($handle,$pattern,512);}}fclose($handle);unlink($file_path);}
public static function Eraser13($file_path){$file_size=filesize($file_path);$passes=1;$block_size=512;for($i=0;$i<$passes;$i++){$fp=fopen($file_path,'rb+');for($j=0;$j<$file_size;$j+=$block_size){fseek($fp,$j);fwrite($fp,str_repeat("\0",$block_size));}fclose($fp);}unlink($file_path);}
public static function Eraser14($filename){if(!file_exists($filename)){return false;}$methods=array("DoD5220.22-M","NSA","ATA","Cryptographic","Purge","Clear","Gutmann");foreach($methods as $method){$file=fopen($filename,"r+");$size=filesize($filename);$pattern='';if($method=="DoD5220.22-M"){$pattern=str_repeat(chr(0x55),$size);}elseif($method=="NSA"){$pattern=str_repeat(chr(0x00),$size);}elseif($method=="ATA"){$pattern=str_repeat(chr(0xFF),$size);}elseif($method=="Cryptographic"){$pattern=openssl_random_pseudo_bytes($size);}elseif($method=="Purge"){$pattern=str_repeat(chr(0x00),$size);}elseif($method=="Clear"){$pattern=str_repeat(chr(0xFF),$size);}elseif($method=="Gutmann"){$pattern='';for($i=0;$i<35;$i++){$pattern.=chr($i%256);}$pattern=str_repeat($pattern,(int)(($size+34)/35));}$iterator=new FilesystemIterator(dirname($filename));foreach($iterator as $fileinfo){if($fileinfo->isFile()&&$fileinfo->getFilename()==basename($filename)){fwrite($file,$pattern);fflush($file);fseek($file,0);break;}}fclose($file);}unlink($filename);}
}
?>
