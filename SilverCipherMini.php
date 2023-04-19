<?php
class SilverCiphermini
{
    private $key;
    public function __construct($key=null) {
        if ($key === null) {
            $this->key = "123456789";
        } else {
            $this->key = $key;
        }

    }
    static function uni8array_base64_encode($arr) {
        $str = '';
        for ($i = 0; $i < count($arr); $i++) {
          $str .= chr($arr[$i]);
        }
        return base64_encode($str);
      }
      
      static function uni8array_base64_decode($str) {
        $decoded_str = base64_decode($str);
        $arr = new SplFixedArray(strlen($decoded_str));
        for ($i = 0; $i < strlen($decoded_str); $i++) {
          $arr[$i] = ord($decoded_str[$i]);
        }
        return $arr;
      }
    static function uint8ArrayToString($uint8Array) {
        $charArray = array_map('chr', iterator_to_array($uint8Array));
        return implode('', $charArray);
    }
    
    static function stringToUint8Array($str) {
        return array_map("ord", str_split(utf8_encode($str)));
    }
    static function hexToUint8Array($hexString) {
        $length = strlen($hexString) / 2;
        $uint8Array = new SplFixedArray($length);
        for ($i = 0; $i < $length; ++$i) {
            $uint8Array[$i] = hexdec(substr($hexString, $i * 2, 2));
        }
        return $uint8Array;
    }
    static function uint8ArrayToHex($uint8Array) {
        $hexString = "";
        for ($i = 0; $i < count($uint8Array); $i++) {
            $hex = dechex($uint8Array[$i]);
            $hexString .= str_pad($hex, 2, "0", STR_PAD_LEFT);
        }
        return $hexString;
    }
    static function adler32($data) {
        $a = 1;
        $b = 0;
        $len = strlen($data);
        for ($i = 0; $i < $len; $i++) {
            $a = ($a + ord($data[$i])) % 65521;
            $b = ($b + $a) % 65521;
        }
        return sprintf("%08x", ($b << 16) | $a);
    }
    public function Encrypt($e)
    {
        $a=$this->key;
        $f = self::settingsgenerator(self::adler32($a));
        $g = str_split($e, 256);
        $b = '';
        $c = '';
        $a = hash("sha512", $a);
        foreach ($g as $h) {
            $c = self::Enc($h, $a, $f);
            $a = hash("SHA512", $a . $c[1]);
            $b = $b . $c[0] . ":";
        }
        $b = substr($b, 0, -1);
        return $b;
    }
    public function Decrypt($f)
    {
        $a=$this->key;
        $g = self::settingsgenerator(self::adler32( $a));
        $b = explode(":", $f);
        $c = '';
        $i = count($b);
        $a = hash("sha512", $a);
        foreach ($b as $h) {
            $d = self::Dec($h, $a, $g);
            $a = hash("SHA512", $a . $d[1]);
            $c = $c.$d[0];
        }
        return $c;
    }
    static function Enc($f, $b, $g)
    {
        $c = $b;
        $h = str_split($f, 128);
        $a = false;
        $e = false;
        foreach ($h as $i) {
            $d = self::Crypt($i, "e", $b);
            $b = hash("sha512", $b);
            //echo "FlushX değeri:".$i."<br>";
            $a = $a . $d[0] . ".";
            $e = $e . $d[1];
        }
        $d = '';
        $j = $e;
        $c = hash("sha512", $c);
        $a = self::E_death_round(substr($a, 0, -1), $g, $c);
        $a = strrev($a);
        return array($a, $j);
    }
    static function Dec($e, $b, $f)
    {
        $a = trim($e);
        $a = strrev($a);
        $g = hash("sha512", $b);
        $a = self::D_death_round($a, $f, $g);
        $h = explode(".", $a);
        $a = '';
        $d = '';
        foreach ($h as $i) {
            $c = self::Crypt($i, "d", $b);
            $b = hash("sha512", $b);
            $a = $a.$c[0];
            $d = $d.$c[1];
        }
        $c = '';
        $j = $d;
        return array($a, $j);
    }
    static function Crypt($n, $v, $d)
    {
        $q = self::stringToUint8Array($d);
        $d = hash('sha512', $d);
        $k = self::hexToUint8Array($d);
        $p = self::hexToUint8Array(self::E_hex_1($d));
        $m = self::XOREncrypt($k, $p);
        $g = self::hashtoXcode($d);
        if ($v == "e") {
            //echo "ENC Start:" . $n . "\n";
            $n = self::StringTouint8Array($n);
            $b = self::XOREncrypt($n, $m);
            //echo "1. XOR: " . self::uint8ArrayToHex($b) . "\n";
            $b = self::XOREncrypt($b, self::XOREncrypt($k, $m));
            //echo "2. XOR: " . self::uint8ArrayToHex($b) . "\n";
            $b = self::uint8ArrayToHex($b);
            //echo "bin2hex: " . $b . "\n";
            for ($o = 1; $o <= 10; $o++) {
            $b = self::E_hex_1($b);
            }
            //echo "E-HEX1B: " . $b . "\n";
            $i = $d;
            $a = 0;
            $c = '';
            $l = str_split($b);
            $h = '';
            foreach ($l as $f) {
            if ($a == 128) {
                $a = 0;
                $i = $d;
                $d = hash('sha512', $d);
                $g = self::hashtoXcode($d);
            }
            if ($g[$a] == 0) {
                $c .= self::E_hex_1($f) . $i[$a];
                $h .= $i[$a];
            } elseif ($g[$a] == 1) {
                $c .= $i[$a] . self::E_hex_1($f);
                $h .= $i[$a];
            } elseif ($g[$a] == 2) {
                $c .= self::E_hex_1($f) . self::hashtohash_1($i[$a]);
                $h .= self::hashtohash_1($i[$a]);
            }
            $a++;
            }
            //echo "EncC: " . $c . "\n";
            //echo "EncH: " . $h . "\n";
            $s = $h;
            $l = '';
            $f = '';
            $c = self::E_hex_1($c);
            //echo "E-HEX1: " . $c . "\n";
            $e = self::hexToUint8Array($c);
            //echo "HEX2BIN: " . self::uint8ArrayToHex($e) . "\n";
            //echo "K-Q XOR: " . self::uint8ArrayToHex(self::XOREncrypt($k, $q)) . "\n";
            $e = self::XOREncrypt($e, self::XOREncrypt($k, $q));
            //echo "SXOR1: " . self::uint8ArrayToHex($e) . "\n";
            $e = self::XOREncrypt($e, $k);
            //echo "SXOR2: " . self::uint8ArrayToHex($e) . "\n";
            $j = self::uni8array_base64_encode($e);
            $t = str_replace("=", "", $j);
            //$t=$j;
            //echo "ENC END B64: " . $t . "\n";
        } else {
            if ($v == "d") {
                $n = trim($n);
                $c = $n;
                //echo "DEC START: " . $n . "<br>";
                $b = self::uni8array_base64_decode($c);
                //echo "UNI8ARRAY B64 DEC: " . self::uint8ArrayToHex($b) . "<br>";
                $b = self::XORDecrypt($b, $k);
                //echo "DXOR2: " . self::uint8ArrayToHex($b) . "<br>";
                $b = self::XORDecrypt($b, self::XOREncrypt($k, $q));
                //echo "DXOR1: " . self::uint8ArrayToHex($b) . "<br>";
                $e = self::uint8ArrayToHex($b);
                //echo "BIN2HEX: " . $e . "<br>";
                $e = self::D_hex_1($e);
                //echo "D-HEX1: " . $e . "<br>";
                $l = array();
                for ($i = 0; $i < strlen($e); $i += 2) {
                array_push($l, substr($e, $i, 2));
                }
                $c = '';
                $u = '';
                $a = 0;
                $g = self::hashtoXcode($d);
                $r = '';
                foreach ($l as $f) {
                if ($a === 128) {
                    $a = 0;
                    $d = hash('sha512',$d);
                    $g = self::hashtoXcode($d);
                }
                if ($g[$a] == 0 || $g[$a] == 2) {
                    $u = self::D_hex_1(substr($f, 0, 1));
                    $h = substr($f, -1, 1);
                } else if ($g[$a] == 1) {
                    $u = self::D_hex_1(substr($f, -1, 1));
                    $h = substr($f, 0, 1);
                }
                $a++;
                $c .= $u;
                $r .= $h;
                }
                //echo "C: " . $c . "<br>";
                //echo "H,(R): " . $r . "<br>";
                $s = $r;
                $l = '';
                $f = '';
                for ($o = 1; $o <= 10; $o++) {
                $c = self::D_hex_1($c);
                }
                //echo "D-HEX1B: " . $c . "<br>";
                $j = self::hexToUint8Array($c);
                //echo "hex2bin: " . self::uint8ArrayToHex($j) . "<br>";
                $j = self::XORDecrypt($j, self::XOREncrypt($k, $m));
                //echo "2. XOR: " . self::uint8ArrayToHex($j) . "<br>";
                $j = self::XORDecrypt($j, $m);
                //echo "1. XOR: " . self::uint8ArrayToHex($j) . "<br>";
                if ($j === "") {
                exit;
                }
                $j = self::uint8ArrayToString($j);
                //echo "DEC END:" . $n . "<br>";
                $t = $j;
            }
        }
        return array($t, $s);
    }
    static function encrypt_key($a,$c){$a=hash("md5",$a);$b=0;$d=false;for($e=0;$e<=strlen($c)-1;$e++){if($b==32){$b=0;$a=hash("md5",$a);}
$d=$d.self::Hash_Key($a[$b],$c[$e]);$b++;}
return $d;}
static function decrypt_key($a,$c){$a=hash("md5",$a);$b=0;$d=false;for($e=0;$e<=strlen($c)-1;$e++){if($b==32){$b=0;$a=hash("md5",$a);}
$d=$d.self::Key_Hash($a[$b],$c[$e]);$b++;}
return $d;}
static function bk_kb($a){$c="";for($b=0;$b<=strlen($a)-1;$b++){if(strtolower($a[$b])==$a[$b]){$d="0";}
if(strtoupper($a[$b])==$a[$b]){$d="1";}
if($d=="1"){$c=$c.strtolower($a[$b]);}else{if($d=="0"){$c=$c.strtoupper($a[$b]);}}}
return $c;}
static function XOREncrypt($data, $key) {
    $result = new SplFixedArray(count($data));
    $keyLength = count($key);
    for ($i = 0; $i < count($data); ++$i) {
        $result[$i] = $data[$i] ^ $key[$i % $keyLength];
    }
    return $result;
}

static function XORDecrypt($data, $key) {
    return self::XOREncrypt($data, $key);
}
static function E_death_round($a,$c,$d){$a=strrev($a);$f=str_split(trim($c));for($e=0;$e<=strlen(trim($c))-1;$e++){$b=$f[$e];if($b=="E"){$a=self::encrypt_key($d,$a);}
if($b=="1"){$a=self::E_rot13_1($a);}
if($b=="2"){$a=self::E_rot13_2($a);}
if($b=="3"){$a=self::E_rot13_3($a);}
if($b=="4"){$a=self::E_rot13_4($a);}
if($b=="C"){$a=self::bk_kb($a);}}
$a=self::encrypt_key($d,$a);return $a;}
static function D_death_round($a,$c,$d){$a=self::decrypt_key($d,$a);$f=str_split(strrev($c));for($e=0;$e<=strlen(strrev($c))-1;$e++){$b=$f[$e];if($b=="E"){$a=self::decrypt_key($d,$a);}
if($b=="1"){$a=self::D_rot13_1($a);}
if($b=="2"){$a=self::D_rot13_2($a);}
if($b=="3"){$a=self::D_rot13_3($a);}
if($b=="4"){$a=self::D_rot13_4($a);}
if($b=="C"){$a=self::bk_kb($a);}}
$a=strrev($a);return $a;}
static function E_hex_1($a){$b=self::$hex_characters;$c=self::$hex_1;$d=strtr($a,$b,$c);return $d;}
static function D_hex_1($a){$b=self::$hex_1;$c=self::$hex_characters;$d=strtr($a,$b,$c);return $d;}

static function settingsgenerator($a){$b=self::$hex_characters;$c=self::$sg;$d=strtr($a,$b,$c);return $d;}

static function hashtoXcode($a){$b=self::$hex_characters;$c=self::$hXc;$d=strtr($a,$b,$c);return $d;}
static function hashtohash_1($a){$b=self::$hex_characters;$c=self::$hth_1;$d=strtr($a,$b,$c);return $d;}
static function E_rot13_1($a){$b=self::$base64_characters;$c=self::$rot13_1;$d=strtr($a,$b,$c);return $d;}
static function D_rot13_1($a){$b=self::$rot13_1;$c=self::$base64_characters;$d=strtr($a,$b,$c);return $d;}
static function E_rot13_2($a){$b=self::$base64_characters;$c=self::$rot13_2;$d=strtr($a,$b,$c);return $d;}
static function D_rot13_2($a){$b=self::$rot13_2;$c=self::$base64_characters;$d=strtr($a,$b,$c);return $d;}
static function E_rot13_3($a){$b=self::$base64_characters;$c=self::$rot13_3;$d=strtr($a,$b,$c);return $d;}
static function D_rot13_3($a){$b=self::$rot13_3;$c=self::$base64_characters;$d=strtr($a,$b,$c);return $d;}
static function E_rot13_4($a){$b=self::$base64_characters;$c=self::$rot13_4;$d=strtr($a,$b,$c);return $d;}
static function D_rot13_4($a){$b=self::$rot13_4;$c=self::$base64_characters;$d=strtr($a,$b,$c);return $d;}
static function Hash_Key($b,$c){$d=self::$base64_characters;if($b=="0"){$a=self::$hash0;}else{if($b=="1"){$a=self::$hash1;}else{if($b=="2"){$a=self::$hash2;}else{if($b=="3"){$a=self::$hash3;}else{if($b=="4"){$a=self::$hash4;}else{if($b=="5"){$a=self::$hash5;}else{if($b=="6"){$a=self::$hash6;}else{if($b=="7"){$a=self::$hash7;}else{if($b=="8"){$a=self::$hash8;}else{if($b=="9"){$a=self::$hash9;}else{if($b=="a"){$a=self::$hasha;}else{if($b=="b"){$a=self::$hashb;}else{if($b=="c"){$a=self::$hashc;}else{if($b=="d"){$a=self::$hashd;}else{if($b=="e"){$a=self::$hashe;}else{if($b=="f"){$a=self::$hashf;}}}}}}}}}}}}}}}}
$e=strtr($c,$d,$a);return $e;}
static function Key_Hash($b,$c){if($b=="0"){$a=self::$hash0;}else{if($b=="1"){$a=self::$hash1;}else{if($b=="2"){$a=self::$hash2;}else{if($b=="3"){$a=self::$hash3;}else{if($b=="4"){$a=self::$hash4;}else{if($b=="5"){$a=self::$hash5;}else{if($b=="6"){$a=self::$hash6;}else{if($b=="7"){$a=self::$hash7;}else{if($b=="8"){$a=self::$hash8;}else{if($b=="9"){$a=self::$hash9;}else{if($b=="a"){$a=self::$hasha;}else{if($b=="b"){$a=self::$hashb;}else{if($b=="c"){$a=self::$hashc;}else{if($b=="d"){$a=self::$hashd;}else{if($b=="e"){$a=self::$hashe;}else{if($b=="f"){$a=self::$hashf;}}}}}}}}}}}}}}}}
$d=self::$base64_characters;$e=strtr($c,$a,$d);return $e;}
private static $hex_characters="abcdef0123456789";private static $base64_characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";private static $hex_1="549e30c67ba2f81d";private static $sg="C1C2C3C4E1324412";private static $hXc="0201110202211102";private static $hth_1="61fa2bed734890c5";private static $rot13_1="4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";private static $rot13_2="wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";private static $rot13_3="h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";private static $rot13_4="JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";private static $hash0="Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";private static $hash1="752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";private static $hash2="4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";private static $hash3="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";private static $hash4="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";private static $hash5="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";private static $hash6="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";private static $hash7="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";private static $hash8="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";private static $hash9="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";private static $hasha="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";private static $hashb="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";private static $hashc="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";private static $hashd="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";private static $hashe="hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";private static $hashf="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
?>
