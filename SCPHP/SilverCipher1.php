<?php
class SilverCipher1
{
    private $key;
    public function __construct($key=null) {
        if ($key === null) {
            $this->key = "123456789";
        } else {
            $this->key = $key;
        }

    }
    public function Encrypt($e)
    {
        $a=$this->key;
        $f = self::settingsgenerator(hash("adler32", $a . chr(0x30) . chr(0x63) . chr(0xa4)));
        $g = str_split($e, 256);
        $b = false;
        $c = false;
        $a = hash("sha512", $a . chr(0x33) . chr(0xfb) . chr(0xa4), true);
        foreach ($g as $h) {
            $c = self::Enc($h, $a, $f);
            $a = hash("whirlpool", $a . chr(0x33) . chr(0xfb) . chr(0xa4) . $c[1], true);
            $b = $b . $c[0] . ":";
        }
        $b = substr($b, 0, -1);
        return $b;
    }
    public function Decrypt($f)
    {
        $a=$this->key;
        $g = self::settingsgenerator(hash("adler32", $a . chr(0x30) . chr(0x63) . chr(0xa4)));
        $b = explode(":", $f);
        $c = false;
        $i = count($b);
        $a = hash("sha512", $a . chr(0x33) . chr(0xfb) . chr(0xa4), true);
        foreach ($b as $h) {
            $d = self::Dec($h, $a, $g);
            $a = hash("whirlpool", $a . chr(0x33) . chr(0xfb) . chr(0xa4) . $d[1], true);
            $c = $c . $d[0];
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
            $b = hash("sha512", $b . chr(0xb5) . chr(0xb9), true);
            $a = $a . $d[0] . ".";
            $e = $e . $d[1];
        }
        $d = false;
        $j = $e;
        $c = hash("sha512", $c, true);
        $a = self::E_death_round(substr($a, 0, -1), $g, $c);
        $a = strrev($a);
        return array($a, $j);
    }
    static function Dec($e, $b, $f)
    {
        $a = trim($e);
        $a = strrev($a);
        $g = hash("sha512", $b, true);
        $a = self::D_death_round($a, $f, $g);
        $h = explode(".", $a);
        $a = false;
        $d = false;
        foreach ($h as $i) {
            $c = self::Crypt($i, "d", $b);
            $b = hash("sha512", $b . chr(0xb5) . chr(0xb9), true);
            $a = $a . $c[0];
            $d = $d . $c[1];
        }
        $c = false;
        $j = $d;
        return array($a, $j);
    }
    static function Crypt($n, $v, $d)
    {
        $q = $d;
        $d = hash("sha512", $d . chr(0x3f) . chr(0x6c) . chr(0x33));
        $k = hex2bin($d);
        $p = hex2bin(self::E_hex_1($d));
        $m = self::XOREncrypt(hex2bin($d), $p);
        $g = self::hashtoXcode($d);
        if ($v == "e") {
            $b = self::XOREncrypt($n, $m);
            $b = self::XOREncrypt($b, self::XOREncrypt($k, $m));
            $b = bin2hex($b);
            for ($o = 1; $o <= 10; $o++) {
                $b = self::E_hex_1($b);
            }
            $i = $d;
            $a = 0;
            $c = false;
            $l = str_split($b, 1);
            $h = false;
            foreach ($l as $f) {
                if ($a == 128) {
                    $a = 0;
                    $i = $d;
                    $d = hash("sha512", hex2bin($d) . chr(0x33) . chr(0x99) . chr(0xb4));
                    $g = self::hashtoXcode($d);
                }
                if ($g[$a] == 0) {
                    $c = $c . self::E_hex_1($f) . $i[$a];
                    $h = $h . $i[$a];
                } else {
                    if ($g[$a] == 1) {
                        $c = $c . $i[$a] . self::E_hex_1($f);
                        $h = $h . $i[$a];
                    } else {
                        if ($g[$a] == 2) {
                            $c = $c . self::E_hex_1($f) . self::hashtohash_1($i[$a]);
                            $h = $h . self::hashtohash_1($i[$a]);
                        }
                    }
                }
                $a++;
            }
            $s = $h;
            $l = false;
            $f = false;
            $c = self::E_hex_1($c);
            $e = hex2bin($c);
            $e = self::XOREncrypt($e, self::XOREncrypt($k, $q));
            $e = self::XOREncrypt($e, $k);
            $e = self::XOREncrypt($e, hex2bin(hash("sha512", $p)));
            $j = str_replace("=", "", base64_encode($e));
            $t = $j;
        } else {
            if ($v == "d") {
                $n = trim($n);
                $c = $n;
                $b = base64_decode($c);
                $b = self::XORDecrypt($b, hex2bin(hash("sha512", $p)));
                $b = self::XORDecrypt($b, $k);
                $b = self::XORDecrypt($b, self::XOREncrypt($k, $q));
                $e = bin2hex($b);
                $e = self::D_hex_1($e);
                $l = str_split($e, 2);
                $c = false;
                $a = 0;
                $g = self::hashtoXcode($d);
                $r = false;
                foreach ($l as $f) {
                    if ($a == 128) {
                        $a = 0;
                        $d = hash("sha512", hex2bin($d) . chr(0x33) . chr(0x99) . chr(0xb4));
                        $g = self::hashtoXcode($d);
                    }
                    if ($g[$a] == 0 or $g[$a] == 2) {
                        $u = self::D_hex_1(substr($f, 0, 1));
                        $h = substr($f, -1, 1);
                    } else {
                        if ($g[$a] == 1) {
                            $u = self::D_hex_1(substr($f, -1, 1));
                            $h = substr($f, 0, 1);
                        }
                    }
                    $a++;
                    $c = $c . $u;
                    $r = $r . $h;
                }
                $s = $r;
                $l = false;
                $f = false;
                for ($o = 1; $o <= 10; $o++) {
                    $c = self::D_hex_1($c);
                }
                $j = hex2bin($c);
                $j = self::XORDecrypt($j, self::XOREncrypt($k, $m));
                $j = self::XORDecrypt($j, $m);
                if ($j == "") {
                    exit;
                }
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
static function XOREncryption($a,$c){$f=strlen($c);for($b=0;$b<strlen($a);$b++){$d=$b%$f;$e=ord($a[$b])^ord($c[$d]);$a[$b]=chr($e);}
return $a;}
static function XOREncrypt($a,$b){$a=self::XOREncryption($a,$b);return $a;}
static function XORDecrypt($a,$b){$a=self::XOREncryption($a,$b);return $a;}
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
