<?php
class LavaCipher2
{
    private $key;
    public function __construct($key=null) {
        if ($key === null) {
            $this->key = "123456789";
        } else {
            $this->key = $key;
        }

    }
    public function Encrypt($d, $h = "no")
    {
        $a=$this->key;
        $e = self::settingsgenerator(hash("adler32", $a . chr(0x30) . chr(0x63) . chr(0xa4)));
        $f = str_split($d, 256);
        $c = false;
        $b = false;
        $a = hash("sha512", $a . chr(0x33) . chr(0xfb) . chr(0xa4), true);
        foreach ($f as $g) {
            $b = self::Enc($g, $a, $e);
            $a = hash("whirlpool", $a . chr(0x33) . chr(0xfb) . chr(0xa4) . $b[1], true);
            $c = $c . $b[0];
        }
        return $c . "==";
    }
    public function Decrypt($b, $h = "no")
    {
        $a=$this->key;
        $b = str_replace("=", "", $b);
        $e = self::settingsgenerator(hash("adler32", $a . chr(0x30) . chr(0x63) . chr(0xa4)));
        $f = str_split($b, 684);
        $c = false;
        $a = hash("sha512", $a . chr(0x33) . chr(0xfb) . chr(0xa4), true);
        foreach ($f as $g) {
            $d = self::Dec($g, $a, $e);
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
            $a = $a . $d[0];
            $e = $e . $d[1];
        }
        $d = false;
        $j = $e;
        $c = hash("sha512", $c, true);
        $a = self::E_death_round($a, $g, $c);
        $a = strrev($a);
        return array($a, $j);
    }
    static function Dec($e, $b, $f)
    {
        $a = trim($e);
        $a = strrev($a);
        $g = hash("sha512", $b, true);
        $a = self::D_death_round($a, $f, $g);
        $h = str_split($a, 342);
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
    static function Crypt($n, $x, $d)
    {
        $r = $d;
        $u = hex2bin(md5($r));
        $d = hash("sha512", $d . $u . chr(0x3f) . chr(0x6c) . chr(0x33));
        $k = hex2bin(hash("sha512", hex2bin($d)));
        $q = hex2bin(hash("sha512", hex2bin(self::E_hex_1($d))));
        $m = hex2bin(hash("sha512", hex2bin(md5(self::XOREncrypt(hex2bin($d), $q)))));
        $g = self::hashtoXcode($d);
        $p = hex2bin(hash("sha512", self::XOREncrypt($k, $r)));
        $o = hex2bin(hash("sha512", hex2bin(hash("sha512", $q))));
        if ($x == "e") {
            $c = self::XOREncrypt($n, $m);
            $c = self::XOREncrypt($c, self::XOREncrypt($k, $m));
            $c = bin2hex($c);
            $c = self::E_hex_1($c);
            $h = bin2hex(openssl_random_pseudo_bytes(64));
            $a = 0;
            $b = false;
            $l = str_split($c, 1);
            $i = false;
            foreach ($l as $f) {
                if ($a == 128) {
                    $a = 0;
                    $h = bin2hex(openssl_random_pseudo_bytes(64));
                    $d = hash("sha512", hex2bin($d) . $u . chr(0x33) . chr(0x99) . chr(0xb4));
                    $g = self::hashtoXcode($d);
                }
                if ($g[$a] == 0) {
                    $b = $b . self::E_hex_1(self::E_hex_1($f)) . $h[$a];
                    $i = $i . $h[$a];
                } else {
                    if ($g[$a] == 1) {
                        $b = $b . $h[$a] . self::E_hex_1($f);
                        $i = $i . $h[$a];
                    } else {
                        if ($g[$a] == 2) {
                            $b = $b . self::E_hex_1(self::E_hex_1($f)) . self::hashtohash_1(self::hashtohash_1($h[$a]));
                            $i = $i . self::hashtohash_1(self::hashtohash_1($h[$a]));
                        } else {
                            if ($g[$a] == 3) {
                                $b = $b . self::hashtohash_1($h[$a]) . self::E_hex_1($f);
                                $i = $i . self::hashtohash_1($h[$a]);
                            }
                        }
                    }
                }
                $a++;
            }
            $t = $i;
            $l = false;
            $f = false;
            $b = self::E_hex_1($b);
            $e = hex2bin($b);
            $e = self::XOREncrypt($e, $p);
            $e = self::XOREncrypt($e, $k);
            $e = self::XOREncrypt($e, $o);
            $j = str_replace("=", "", base64_encode($e));
            $v = $j;
        } else {
            if ($x == "d") {
                $n = trim($n);
                $b = $n;
                $c = base64_decode($b);
                $c = self::XORDecrypt($c, $o);
                $c = self::XORDecrypt($c, $k);
                $c = self::XORDecrypt($c, $p);
                $e = bin2hex($c);
                $e = self::D_hex_1($e);
                $l = str_split($e, 2);
                $b = false;
                $a = 0;
                $g = self::hashtoXcode($d);
                $s = false;
                foreach ($l as $f) {
                    if ($a == 128) {
                        $a = 0;
                        $d = hash("sha512", hex2bin($d) . $u . chr(0x33) . chr(0x99) . chr(0xb4));
                        $g = self::hashtoXcode($d);
                    }
                    if ($g[$a] == 0 or $g[$a] == 2) {
                        $w = self::D_hex_1(self::D_hex_1(substr($f, 0, 1)));
                        $i = substr($f, -1, 1);
                    } else {
                        if ($g[$a] == 1 or $g[$a] == 3) {
                            $w = self::D_hex_1(substr($f, -1, 1));
                            $i = substr($f, 0, 1);
                        }
                    }
                    $a++;
                    $b = $b . $w;
                    $s = $s . $i;
                }
                $t = $s;
                $l = false;
                $f = false;
                $b = self::D_hex_1($b);
                $j = hex2bin($b);
                $j = self::XORDecrypt($j, self::XOREncrypt($k, $m));
                $j = self::XORDecrypt($j, $m);
                if ($j == "") {
                    exit;
                }
                $v = $j;
            }
        }
        return array($v, $t);
    }
    static function encrypt_key($a,$c){$a=hash("md5",$a);$b=0;$d=false;for($e=0;$e<=strlen($c)-1;$e++){if($b==32){$b=0;$a=hash("md5",hex2bin($a));}
$d=$d.self::Hash_Key($a[$b],$c[$e]);$b++;}
return $d;}
static function decrypt_key($a,$c){$a=hash("md5",$a);$b=0;$d=false;for($e=0;$e<=strlen($c)-1;$e++){if($b==32){$b=0;$a=hash("md5",hex2bin($a));}
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
private static $hex_characters="abcdef0123456789";private static $base64_characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";private static $hex_1="549e30c67ba2f81d";private static $sg="C1C2C3C4E1324412";private static $hXc="0132102013201203";private static $hth_1="61fa2bed734890c5";private static $rot13_1="4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";private static $rot13_2="wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";private static $rot13_3="h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";private static $rot13_4="JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";private static $hash0="Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";private static $hash1="752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";private static $hash2="4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";private static $hash3="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";private static $hash4="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";private static $hash5="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";private static $hash6="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";private static $hash7="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";private static $hash8="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";private static $hash9="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";private static $hasha="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";private static $hashb="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";private static $hashc="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";private static $hashd="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";private static $hashe="hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";private static $hashf="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
?>