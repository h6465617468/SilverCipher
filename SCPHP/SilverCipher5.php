<?php
class SilverCipher5
{
    private $key;
    public function __construct($key=null) {
        if ($key === null) {
            $this->key = "123456789";
        } else {
            $this->key = $key;
        }

    }
    public function Encrypt($d = null, $j = null)
    {
        $b=$this->key;
        if ($j == true) {
            $d = gzcompress($d, 9);
        }
        $d = self::XOREncrypt(self::Raw_hexrev($d), hex2bin(hash("sha512", $b)));
        $a = chr(0x33) . chr(0xfb) . chr(0xa4) . chr(0x90) . exp(pow(2, 6));
        $a = self::XOREncrypt($a, $a . chr(0xaf) . chr(0xf2) . chr(0xcc) . chr(0x45) . exp(pow(2, 8)));
        $a = self::Raw_hexrev(self::XOREncrypt($a, $a . chr(0xa3) . chr(0x96) . chr(0x64) . chr(0x32) . exp(pow(2, 10))));
        $a = self::XOREncrypt($a, base64_decode(self::$hash0 . self::$hash1 . self::$hash2 . self::$hash3 . self::$hash4 . self::$hash5 . self::$hash6 . self::$hash7 . self::$hash8 . self::$hash9 . self::$hasha . self::$hashb . self::$hashc . self::$hashd . self::$hashe . self::$hashf) . self::Raw_hexrev(hex2bin(md5($b . sin(fmod(strlen($b), exp(0.2) / strlen($b))) . cos(fmod(strlen($b), exp(0.2) / strlen($b))) . tan(fmod(strlen($b), exp(0.2) / strlen($b)))))));
        $c = self::numHash($b . hex2bin(sha1(strlen(hash("whirlpool", hex2bin(sha1($a . pow(2, 32))))) * 64 + pow(2, 84))), 1);
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $i = str_split($d, pow(2, 8));
        $e = false;
        $f = false;
        $a = self::Raw_hexrev(base64_decode(self::$hash0 . self::$hash1 . self::$hash2 . self::$hash3 . self::$hash4 . self::$hash5 . self::$hash6 . self::$hash7 . self::$hash8 . self::$hash9 . self::$hasha . self::$hashb . self::$hashc . self::$hashd . self::$hashe . self::$hashf) . chr(0x12) . chr(0x69) . chr(0xf9) . chr(0x45) . exp(pow(2, 5)));
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $b = hex2bin(self::Hex_Dont_Count(hash("sha512", $b . $a)));
        $m = count($i);
        $k = 1;
        $g = 1;
        $h = 1;
        foreach ($i as $l) {
            $f = self::Enc($l, $b);
            if ($k != $m) {
                $a = false;
                $a = chr(self::$salt_1_dat[$h]);
                $c = self::numHash($b, 1);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
                }
                if ($h == 48) {
                    $h = 0;
                }
                $a = self::XOREncrypt($b, hex2bin(hash("sha512", $b . $a)));
                $b = hex2bin(sha1(strrev(utf8_encode($a))) . hash("gost", base64_decode(self::$hash0 . self::$hash1 . self::$hash2 . self::$hash3 . self::$hash4 . self::$hash5 . self::$hash6 . self::$hash7 . self::$hash8 . self::$hash9 . self::$hasha . self::$hashb . self::$hashc . self::$hashd . self::$hashe . self::$hashf) . $b . $a . substr(0, 8, self::numHash(hex2bin(self::Hex_Dont_Count(hash("whirlpool", $b . $a . $f[1]))), 8))));
                $a = false;
                $a = chr(self::$salt_st_dat[$g]);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_st_dat[$c]));
                }
                if ($g == 48) {
                    $g = 0;
                }
            }
            $e = $e . $f[0];
            $k++;
            $g++;
            $h++;
        }
        $e .= "==";
        if ($j == true) {
            $e = base64_decode($e);
        }
        return $e;
    }
    public function Decrypt($e = null, $j = null)
    {
        $b=$this->key;
        if ($j == true) {
            $e = base64_encode($e);
        }
        $k = $b;
        $e = str_replace(" ", "", trim(str_replace("=", "", $e)));
        $a = chr(0x33) . chr(0xfb) . chr(0xa4) . chr(0x90) . exp(pow(2, 6));
        $a = self::XOREncrypt($a, $a . chr(0xaf) . chr(0xf2) . chr(0xcc) . chr(0x45) . exp(pow(2, 8)) . tan(pow(2, 34)));
        $a = self::Raw_hexrev(self::XOREncrypt($a, $a . tan(pow(2, 33)) . chr(0xa3) . chr(0x96) . chr(0x64) . chr(0x32) . exp(pow(2, 10))));
        $a = self::XOREncrypt($a, base64_decode(self::$hash0 . self::$hash1 . self::$hash2 . self::$hash3 . self::$hash4 . self::$hash5 . self::$hash6 . self::$hash7 . self::$hash8 . self::$hash9 . self::$hasha . self::$hashb . self::$hashc . self::$hashd . self::$hashe . self::$hashf) . self::Raw_hexrev(hex2bin(md5($b . sin(fmod(strlen($b), exp(0.2) / strlen($b))) . cos(fmod(strlen($b), exp(0.2) / strlen($b))) . tan(fmod(strlen($b), exp(0.2) / strlen($b)))))));
        $c = self::numHash($b . hex2bin(sha1(strlen(hash("whirlpool", hex2bin(sha1($a . pow(2, 32))))) * 64 + pow(2, 84))), 1);
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $h = str_split($e, 684);
        $d = false;
        $a = self::Raw_hexrev(base64_decode(self::$hash0 . self::$hash1 . self::$hash2 . self::$hash3 . self::$hash4 . self::$hash5 . self::$hash6 . self::$hash7 . self::$hash8 . self::$hash9 . self::$hasha . self::$hashb . self::$hashc . self::$hashd . self::$hashe . self::$hashf) . chr(0x12) . chr(0x69) . chr(0xf9) . chr(0x45) . exp(pow(2, 5)));
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $b = hex2bin(self::Hex_Dont_Count(hash("sha512", $b . $a)));
        $n = count($h);
        $l = 1;
        $f = 1;
        $g = 1;
        foreach ($h as $m) {
            $i = self::Dec($m, $b);
            if ($l != $n) {
                $a = false;
                $a = chr(self::$salt_1_dat[$g]);
                $c = self::numHash($b, 1);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
                }
                if ($g == 48) {
                    $g = 0;
                }
                $a = self::XOREncrypt($b, hex2bin(hash("sha512", $b . $a)));
                $b = hex2bin(sha1(strrev(utf8_encode($a))) . hash("gost", base64_decode(self::$hash0 . self::$hash1 . self::$hash2 . self::$hash3 . self::$hash4 . self::$hash5 . self::$hash6 . self::$hash7 . self::$hash8 . self::$hash9 . self::$hasha . self::$hashb . self::$hashc . self::$hashd . self::$hashe . self::$hashf) . $b . $a . substr(0, 8, self::numHash(hex2bin(self::Hex_Dont_Count(hash("whirlpool", $b . $a . $i[1]))), 8))));
                $a = false;
                $a = chr(self::$salt_st_dat[$f]);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_st_dat[$c]));
                }
                if ($f == 48) {
                    $f = 0;
                }
            }
            $d = $d . $i[0];
            $l++;
            $f++;
            $g++;
        }
        $d = self::Raw_hexrev(self::XORDecrypt($d, hex2bin(hash("sha512", $k))));
        if ($j == true) {
            $d = gzuncompress($d);
        }
        return $d;
    }
    static function Enc($f = null, $c = null)
    {
        $g = $c;
        $j = str_split($f, pow(2, 7));
        $d = false;
        $h = false;
        $e = 1;
        foreach ($j as $k) {
            $a = self::Crypt($k, "e", $c);
            if (strlen($f) > pow(2, 7)) {
                $b = false;
                $b = chr(self::$salt_2_dat[$e]);
                $i = self::numHash($c, 1);
                if ($i != 0) {
                    $b = self::XOREncrypt($b, chr(self::$salt_2_dat[$i]));
                }
                if ($e == 48) {
                    $e = 0;
                }
                $e++;
                $c = hex2bin(self::Hex_Dont_Count(hash("sha512", self::XOREncrypt(strrev(self::XOREncrypt($c . chr(0xb5) . chr(0xb9), $b)), $a[1]) . $b . $a[1])));
            }
            $d = $d . $a[0];
            $h = $h . $a[1];
        }
        $a = false;
        $l = $h;
        $g = hex2bin(self::Hex_Dont_Count(hash("sha512", $g)));
        $d = strrev($d);
        return array($d, $l);
    }
    static function Dec($f, $d)
    {
        $a = trim($f);
        $a = strrev($a);
        $g = $d;
        $g = hex2bin(self::Hex_Dont_Count(hash("sha512", $g)));
        $j = str_split($a, 342);
        $a = false;
        $h = false;
        $e = 1;
        foreach ($j as $k) {
            $b = self::Crypt($k, "d", $d);
            if (strlen($f) > pow(2, 7)) {
                $c = false;
                $c = chr(self::$salt_2_dat[$e]);
                $i = self::numHash($d, 1);
                if ($i != 0) {
                    $c = self::XOREncrypt($c, chr(self::$salt_2_dat[$i]));
                }
                if ($e == 48) {
                    $e = 0;
                }
                $e++;
                $d = hex2bin(self::Hex_Dont_Count(hash("sha512", self::XOREncrypt(strrev(self::XOREncrypt($d . chr(0xb5) . chr(0xb9), $c)), $b[1]) . $c . $b[1])));
            }
            $a = $a . $b[0];
            $h = $h . $b[1];
        }
        $b = false;
        $l = $h;
        return array($a, $l);
    }
    static function Crypt($r, $x, $f)
    {
        $k = $f;
        $t = hex2bin(self::Hex_Dont_Count(hash("sha512", md5($k))));
        $f = self::Hex_Dont_Count(hash("sha512", $f . $t . chr(0x3f) . chr(0x6c) . chr(0x33)));
        $l = self::Raw_hexrev(hex2bin(self::Hex_Dont_Count(hash("sha512", hex2bin($f)))));
        $q = self::Raw_hexrev(hex2bin(self::Hex_Dont_Count(hash("whirlpool", hex2bin(self::E_hex_1($f))))));
        $m = hex2bin(self::Hex_Dont_Count(hash("whirlpool", hex2bin(md5(self::XOREncrypt(hex2bin($f), $q))))));
        $g = self::hashtoXcode($f);
        $o = hex2bin(self::Hex_Dont_Count(hash("sha512", self::Raw_hexrev(exp(pow(2, 2)) . self::XOREncrypt($l, $k)))));
        $p = hex2bin(self::Hex_Dont_Count(hash("sha512", hex2bin(hash("whirlpool", $q)))));
        if ($x == "e") {
            $a = self::Raw_hexrev($r);
            $a = hex2bin(self::Hex_Encrypt_Key(bin2hex($a), $k));
            $a = self::Raw_hexrev($a);
            $a = hex2bin(strtr(bin2hex($a), self::$hex_char, self::$change_5));
            $a = hex2bin(self::E_hex_3(bin2hex($a)));
            $a = hex2bin(self::Hex_Encrypt_Key(bin2hex($a), $p));
            $a = self::Raw_hexrev($a);
            $a = self::XOREncrypt(strrev($a), $m);
            $a = hex2bin(strtr(bin2hex($a), self::$hex_char, self::$change_a));
            $a = hex2bin(strtr(bin2hex($a), self::$hex_char, self::$change_f));
            $a = hex2bin(self::E_hex_1(bin2hex($a)));
            $a = hex2bin(self::Hex_Encrypt_Key(bin2hex($a), $k));
            $a = self::XOREncrypt(strrev($a), self::XOREncrypt($l, $m));
            $a = hex2bin(self::E_hex_2(bin2hex($a)));
            $a = self::Raw_hexrev($a);
            $a = hex2bin(self::Hex_Encrypt_Key(bin2hex($a), $m));
            $a = strrev(bin2hex($a));
            $a = self::E_hex_1($a);
            $i = self::Hex_Dont_Count(bin2hex(openssl_random_pseudo_bytes(pow(4, 5))));
            $d = 0;
            $e = false;
            $n = str_split($a, 1);
            $j = false;
            foreach ($n as $h) {
                if ($d == pow(2, 7)) {
                    $d = 0;
                    $i = self::Hex_Dont_Count(bin2hex(openssl_random_pseudo_bytes(pow(4, 5))));
                    $f = self::Hex_Dont_Count(hash("sha512", hex2bin($f) . $t . chr(0x33) . chr(0x99) . chr(0xb4)));
                    $g = self::hashtoXcode($f);
                }
                if ($g[$d] == 0) {
                    $e = $e . self::E_hex_1($h) . $i[$d];
                    $j = $j . $i[$d];
                } else {
                    if ($g[$d] == 1) {
                        $e = $e . $i[$d] . self::E_hex_2($h);
                        $j = $j . $i[$d];
                    } else {
                        if ($g[$d] == 2) {
                            $e = $e . self::E_hex_1($h) . self::hashtohash_1(self::hashtohash_1($i[$d]));
                            $j = $j . self::hashtohash_1(self::hashtohash_1($i[$d]));
                        } else {
                            if ($g[$d] == 3) {
                                $e = $e . self::hashtohash_1($i[$d]) . self::E_hex_2($h);
                                $j = $j . self::hashtohash_1($i[$d]);
                            }
                        }
                    }
                }
                $d++;
            }
            $s = $j;
            $n = false;
            $h = false;
            $e = self::E_hex_1($e);
            $b = hex2bin($e);
            $b = hex2bin(self::E_Shift(bin2hex($b), 3));
            $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $t));
            $b = hex2bin(self::E_hex_2(bin2hex($b)));
            $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $l));
            $b = hex2bin(self::E_hex_1(bin2hex($b)));
            $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $q));
            $b = hex2bin(self::E_Shift(bin2hex($b), 1));
            $b = hex2bin(self::E_hex_2(bin2hex($b)));
            $b = hex2bin(self::E_Shift(bin2hex($b), 3));
            $b = hex2bin(self::E_hex_1(bin2hex($b)));
            $b = self::Raw_hexrev($b);
            $b = self::XOREncrypt(strrev($b), $o);
            $b = hex2bin(self::E_Shift(bin2hex($b), 2));
            $b = hex2bin(self::E_hex_3(bin2hex($b)));
            $b = self::XOREncrypt(strrev($b), $l);
            $b = hex2bin(self::E_Shift(bin2hex($b), 1));
            $b = self::XOREncrypt(strrev($b), $o);
            $b = hex2bin(self::E_hex_1(bin2hex($b)));
            $b = self::XOREncrypt(strrev($b), $p);
            $b = hex2bin(self::E_Shift(bin2hex($b), 3));
            $b = hex2bin(self::E_hex_2(bin2hex($b)));
            $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $k));
            $c = strtr(self::bk_kb(str_replace("=", "", base64_encode($b))), self::$base64_characters, self::$rot13_1);
            $v = $c;
        } else {
            if ($x == "d") {
                $r = trim($r);
                $e = $r;
                $a = base64_decode(self::bk_kb(strtr($e, self::$rot13_1, self::$base64_characters)));
                $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $k));
                $a = hex2bin(self::D_hex_2(bin2hex($a)));
                $a = hex2bin(self::D_Shift(bin2hex($a), 3));
                $a = strrev(self::XORDecrypt($a, $p));
                $a = hex2bin(self::D_hex_1(bin2hex($a)));
                $a = strrev(self::XORDecrypt($a, $o));
                $a = hex2bin(self::D_Shift(bin2hex($a), 1));
                $a = strrev(self::XORDecrypt($a, $l));
                $a = hex2bin(self::D_hex_3(bin2hex($a)));
                $a = hex2bin(self::D_Shift(bin2hex($a), 2));
                $a = strrev(self::XORDecrypt($a, $o));
                $a = self::Raw_hexrev($a);
                $a = hex2bin(self::D_hex_1(bin2hex($a)));
                $a = hex2bin(self::D_Shift(bin2hex($a), 3));
                $a = hex2bin(self::D_hex_2(bin2hex($a)));
                $a = hex2bin(self::D_Shift(bin2hex($a), 1));
                $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $q));
                $a = hex2bin(self::D_hex_1(bin2hex($a)));
                $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $l));
                $a = hex2bin(self::D_hex_2(bin2hex($a)));
                $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $t));
                $a = hex2bin(self::D_Shift(bin2hex($a), 3));
                $b = bin2hex($a);
                $b = self::D_hex_1($b);
                $n = str_split($b, 2);
                $e = false;
                $d = 0;
                $g = self::hashtoXcode($f);
                $u = false;
                foreach ($n as $h) {
                    if ($d == pow(2, 7)) {
                        $d = 0;
                        $f = self::Hex_Dont_Count(hash("sha512", hex2bin($f) . $t . chr(0x33) . chr(0x99) . chr(0xb4)));
                        $g = self::hashtoXcode($f);
                    }
                    if ($g[$d] == 0 or $g[$d] == 2) {
                        $w = self::D_hex_1(substr($h, 0, 1));
                        $j = substr($h, -1, 1);
                    } else {
                        if ($g[$d] == 1 or $g[$d] == 3) {
                            $w = self::D_hex_2(substr($h, -1, 1));
                            $j = substr($h, 0, 1);
                        }
                    }
                    $d++;
                    $e = $e . $w;
                    $u = $u . $j;
                }
                $s = $u;
                $n = false;
                $h = false;
                $e = self::D_hex_1($e);
                $c = hex2bin(strrev($e));
                $c = hex2bin(self::Hex_Decrypt_Key(bin2hex($c), $m));
                $c = self::Raw_hexrev($c);
                $c = hex2bin(self::D_hex_2(bin2hex($c)));
                $c = strrev(self::XORDecrypt($c, self::XOREncrypt($l, $m)));
                $c = hex2bin(self::Hex_Decrypt_Key(bin2hex($c), $k));
                $c = hex2bin(self::D_hex_1(bin2hex($c)));
                $c = hex2bin(strtr(bin2hex($c), self::$change_f, self::$hex_char));
                $c = hex2bin(strtr(bin2hex($c), self::$change_a, self::$hex_char));
                $c = strrev(self::XORDecrypt($c, $m));
                $c = self::Raw_hexrev($c);
                $c = hex2bin(self::Hex_Decrypt_Key(bin2hex($c), $p));
                $c = hex2bin(self::D_hex_3(bin2hex($c)));
                $c = hex2bin(strtr(bin2hex($c), self::$change_5, self::$hex_char));
                $c = self::Raw_hexrev($c);
                $c = hex2bin(self::Hex_Decrypt_Key(bin2hex($c), $k));
                $v = self::Raw_hexrev($c);
            }
        }
        $s = hex2bin($s);
        return array($v, $s);
    }
static function numHash($d,$a=null){$e=md5($d,true);$c=unpack('N2',$e);$b=$c[1].$c[2];if($a&&is_int($a)){$b=substr($b,0,$a);}
return $b;}
static function Raw_hexrev($a){$b=str_split(bin2hex($a),2);$a=null;foreach($b as $c){$a=$a.strrev($c);}
return hex2bin($a);}
static function E_Shift($b,$e){if(strlen($b)%4==0){if($e==1){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[1].$a[2].$a[3].$a[0];$b=$b.$d;}}else{if($e==2){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[2].$a[3].$a[0].$a[1];$b=$b.$d;}}else{if($e==3){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[3].$a[0].$a[1].$a[2];$b=$b.$d;}}}}}else{$b=null;}
return $b;}
static function D_Shift($b,$e){if(strlen($b)%4==0){if($e==1){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[3].$a[0].$a[1].$a[2];$b=$b.$d;}}else{if($e==2){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[2].$a[3].$a[0].$a[1];$b=$b.$d;}}else{if($e==3){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[1].$a[2].$a[3].$a[0];$b=$b.$d;}}}}}else{$b=null;}
return $b;}
static function Hex_Dont_Count($a){$a=trim($a);$e=strlen($a);if($e==pow(2,5)){$d=self::$change_9;}else{if($e==pow(2,6)){$d=self::$change_2;}else{if($e==pow(2,7)){$d=self::$change_5;}else{$d=self::$change_4;}}}
for($b=0;$b<=$e;$b++){if($b+1<$e){if($a[$b]==$a[$b+1]){if($a[$b]=="a"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_a);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="b"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_b);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="c"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_c);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="d"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_d);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="e"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_e);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="f"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_f);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="0"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_0);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="1"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_1);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="2"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_2);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="3"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_3);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="4"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_4);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="5"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_5);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="6"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_6);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="7"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_7);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="8"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_8);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}else{if($a[$b]=="9"){$c=$a[$b];$a[$b]=strtr($a[$b],self::$hex_char,self::$change_9);if($a[$b]==$c){$a[$b]=strtr($a[$b],self::$hex_char,$d);}}}}}}}}}}}}}}}}}
$a[$b+1]=strtr($a[$b+1],self::$hex_char,$d);$a[$b+1]=strtr($a[$b+1],self::$hex_char,$d);$a[$b+1]=strtr($a[$b+1],self::$hex_char,$d);}}}
return $a;}
static function XOREncryption($a,$c){$f=strlen($c);for($b=0;$b<strlen($a);$b++){$d=$b%$f;$e=ord($a[$b])^ord($c[$d]);$a[$b]=chr($e);}
return $a;}
static function XOREncrypt($a,$b){$a=self::XOREncryption($a,$b);return $a;}
static function XORDecrypt($a,$b){$a=self::XOREncryption($a,$b);return $a;}
static function bk_kb($a){$c="";for($b=0;$b<=strlen($a)-1;$b++){if(strtolower($a[$b])==$a[$b]){$d="0";}else{if(strtoupper($a[$b])==$a[$b]){$d="1";}}
if($d=="1"){$c=$c.strtolower($a[$b]);}else{if($d=="0"){$c=$c.strtoupper($a[$b]);}}}
return $c;}
static function Hex_Encrypt_Key($a,$c){$c=self::Hex_Dont_Count(md5($c));$d=0;for($b=0;$b<=strlen($a)-1;$b++){if($d==pow(2,5)){$d=0;$c=strtr($c,self::$hex_char,self::$hashchan);}
if($c[$d]=="a"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_a);}
if($c[$d]=="b"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_b);}
if($c[$d]=="c"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_c);}
if($c[$d]=="d"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_d);}
if($c[$d]=="e"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_e);}
if($c[$d]=="f"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_f);}
if($c[$d]=="0"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_0);}
if($c[$d]=="1"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_1);}
if($c[$d]=="2"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_2);}
if($c[$d]=="3"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_3);}
if($c[$d]=="4"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_4);}
if($c[$d]=="5"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_5);}
if($c[$d]=="6"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_6);}
if($c[$d]=="7"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_7);}
if($c[$d]=="8"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_8);}
if($c[$d]=="9"){$a[$b]=strtr($a[$b],self::$hex_char,self::$change_9);}
$d++;}
return $a;}
static function Hex_Decrypt_Key($a,$c){$c=self::Hex_Dont_Count(md5($c));$d=0;for($b=0;$b<=strlen($a)-1;$b++){if($d==pow(2,5)){$d=0;$c=strtr($c,self::$hex_char,self::$hashchan);}
if($c[$d]=="a"){$a[$b]=strtr($a[$b],self::$change_a,self::$hex_char);}
if($c[$d]=="b"){$a[$b]=strtr($a[$b],self::$change_b,self::$hex_char);}
if($c[$d]=="c"){$a[$b]=strtr($a[$b],self::$change_c,self::$hex_char);}
if($c[$d]=="d"){$a[$b]=strtr($a[$b],self::$change_d,self::$hex_char);}
if($c[$d]=="e"){$a[$b]=strtr($a[$b],self::$change_e,self::$hex_char);}
if($c[$d]=="f"){$a[$b]=strtr($a[$b],self::$change_f,self::$hex_char);}
if($c[$d]=="0"){$a[$b]=strtr($a[$b],self::$change_0,self::$hex_char);}
if($c[$d]=="1"){$a[$b]=strtr($a[$b],self::$change_1,self::$hex_char);}
if($c[$d]=="2"){$a[$b]=strtr($a[$b],self::$change_2,self::$hex_char);}
if($c[$d]=="3"){$a[$b]=strtr($a[$b],self::$change_3,self::$hex_char);}
if($c[$d]=="4"){$a[$b]=strtr($a[$b],self::$change_4,self::$hex_char);}
if($c[$d]=="5"){$a[$b]=strtr($a[$b],self::$change_5,self::$hex_char);}
if($c[$d]=="6"){$a[$b]=strtr($a[$b],self::$change_6,self::$hex_char);}
if($c[$d]=="7"){$a[$b]=strtr($a[$b],self::$change_7,self::$hex_char);}
if($c[$d]=="8"){$a[$b]=strtr($a[$b],self::$change_8,self::$hex_char);}
if($c[$d]=="9"){$a[$b]=strtr($a[$b],self::$change_9,self::$hex_char);}
$d++;}
return $a;}
static function encrypt_key($c,$a){$c=self::Hex_Dont_Count(hash("md5",$c));$d=0;for($b=0;$b<=strlen($a)-1;$b++){if($d==pow(2,5)){$d=0;$c=strtr($c,self::$hex_char,self::$hashchan1);}
if($c[$d]=="0"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash0);}else{if($c[$d]=="1"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash1);}else{if($c[$d]=="2"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash2);}else{if($c[$d]=="3"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash3);}else{if($c[$d]=="4"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash4);}else{if($c[$d]=="5"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash5);}else{if($c[$d]=="6"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash6);}else{if($c[$d]=="7"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash7);}else{if($c[$d]=="8"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash8);}else{if($c[$d]=="9"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash9);}else{if($c[$d]=="a"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hasha);}else{if($c[$d]=="b"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashb);}else{if($c[$d]=="c"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashc);}else{if($c[$d]=="d"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashd);}else{if($c[$d]=="e"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashe);}else{if($c[$d]=="f"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashf);}}}}}}}}}}}}}}}}
$d++;}
return $a;}
static function decrypt_key($c,$a){$c=self::Hex_Dont_Count(hash("md5",$c));$d=0;for($b=0;$b<=strlen($a)-1;$b++){if($d==pow(2,5)){$d=0;$c=strtr($c,self::$hex_char,self::$hashchan1);}
if($c[$d]=="0"){$a[$b]=strtr($a[$b],self::$hash0,self::$base64_characters);}else{if($c[$d]=="1"){$a[$b]=strtr($a[$b],self::$hash1,self::$base64_characters);}else{if($c[$d]=="2"){$a[$b]=strtr($a[$b],self::$hash2,self::$base64_characters);}else{if($c[$d]=="3"){$a[$b]=strtr($a[$b],self::$hash3,self::$base64_characters);}else{if($c[$d]=="4"){$a[$b]=strtr($a[$b],self::$hash4,self::$base64_characters);}else{if($c[$d]=="5"){$a[$b]=strtr($a[$b],self::$hash5,self::$base64_characters);}else{if($c[$d]=="6"){$a[$b]=strtr($a[$b],self::$hash6,self::$base64_characters);}else{if($c[$d]=="7"){$a[$b]=strtr($a[$b],self::$hash7,self::$base64_characters);}else{if($c[$d]=="8"){$a[$b]=strtr($a[$b],self::$hash8,self::$base64_characters);}else{if($c[$d]=="9"){$a[$b]=strtr($a[$b],self::$hash9,self::$base64_characters);}else{if($c[$d]=="a"){$a[$b]=strtr($a[$b],self::$hasha,self::$base64_characters);}else{if($c[$d]=="b"){$a[$b]=strtr($a[$b],self::$hashb,self::$base64_characters);}else{if($c[$d]=="c"){$a[$b]=strtr($a[$b],self::$hashc,self::$base64_characters);}else{if($c[$d]=="d"){$a[$b]=strtr($a[$b],self::$hashd,self::$base64_characters);}else{if($c[$d]=="e"){$a[$b]=strtr($a[$b],self::$hashe,self::$base64_characters);}else{if($c[$d]=="f"){$a[$b]=strtr($a[$b],self::$hashf,self::$base64_characters);}}}}}}}}}}}}}}}}
$d++;}
return $a;}
static function E_hex_1($a){$b=self::$hex_characters;$c=self::$hex_1;$d=strtr($a,$b,$c);return $d;}
static function D_hex_1($a){$b=self::$hex_1;$c=self::$hex_characters;$d=strtr($a,$b,$c);return $d;}
static function E_hex_2($a){$b=self::$hex_characters;$c=self::$hex_2;$d=strtr($a,$b,$c);return $d;}
static function D_hex_2($a){$b=self::$hex_2;$c=self::$hex_characters;$d=strtr($a,$b,$c);return $d;}
static function E_hex_3($a){$b=self::$hex_characters;$c=self::$hex_2;$d=strtr($a,$b,$c);return $d;}
static function D_hex_3($a){$b=self::$hex_2;$c=self::$hex_characters;$d=strtr($a,$b,$c);return $d;}
static function settingsgenerator($a){$b=self::$hex_characters;$c=self::$sg;$d=strtr($a,$b,$c);return $d;}
static function settingsgenerator1($a){$b=self::$hex_characters;$c=self::$sg1;$d=strtr($a,$b,$c);return $d;}
static function settingsgenerator2($a){$b=self::$hex_characters;$c=self::$sg2;$d=strtr($a,$b,$c);return $d;}
static function hashtoXcode($a){$b=self::$hex_characters;$c=self::$hXc;$d=strtr($a,$b,$c);return $d;}
static function hashtohash_1($a){$b=self::$hex_characters;$c=self::$hth_1;$d=strtr($a,$b,$c);return $d;}
static function D_rot13_4($a){$b=self::$rot13_4;$c=self::$base64_characters;$d=strtr($a,$b,$c);return $d;}
    private static $salt_1_dat = array(null, 0.0, 0.0, 0.0, 0x661e23ca76af0334, 0.0, 0x100c42c3c9c7e9f3, 0x36ce98d6b199e785, 0x46100fe3f934b034, 0.0, 0x79daa5c944cbc586, 0x684ac13d4b307b9c, 0x13e9fab383110056, 0x457f532f932a162f, 0x182f3c17cfe4a06f, 0.0, 0x28bc4718ed57a1b4, 9.944646148322077, 0.0, 0x6afcf7fc8cf8ca81, 9.327748711822305, 1.8124095923182973, 0.0, 0x4310246e397ec0b4, 0x49e64a595583d7b1, 0.0, 0x3094ddda78aa529a, 0.0, 0x751926ac201a0ad9, 0x45dafc4ba4cbcd64, 0x675b05f9500f4cfa, 0x45713a1ec18c58c8, 1.4099206458880573, 0x6cbe789bdf4345bb, 0x180b595d20d8b103, 0x1f293f00b67ed388, 1.4112369965704587, 0.0, 0x331bc8e42cc3cef1, 0x76baf2bd606a8794, 0x234943b6f873bc3a, 0.0, 0x632ec44657aafee4, 0.0, 1.2806216388053064, 0x663d7c64a4aa625c, 0x1dae4ebd43023921, 0x7fbc88b1426813a9, 0xbf4c3738f049d40);
    private static $salt_2_dat = array(null, 0.0, 0.0, 0.0, 0x761926cf04adcf77, 0.0, 0x500f4cc3af2f6f47, 0x33df970e6a77391b, 0x4f1101a7bba453e7, 0.0, 1.5800107239009522, 0x5dc4c44ec99af427, 0.0, 0.0, 0x45cb8453364691f5, 0x7e3f24bcbdfc86af, 0.0, 0x2f2ca5da3f2fc753, 0.0, 0.0, 1.4479770205178526, 0x14b9498a8c79287a, 0.0, 0x13ae81f0691f32b5, 0.0, 0.0, 0.0, 0.0, 0x661e23ca76af0334, 0.0, 0x100c42c3c9c7e9f3, 0x36ce98d6b199e785, 0x46100fe3f934b034, 0.0, 0x79daa5c944cbc586, 0x684ac13d4b307b9c, 0x13e9fab383110056, 0x457f532f932a162f, 0x182f3c17cfe4a06f, 0.0, 0x28bc4718ed57a1b4, 9.944646148322077, 0.0, 0x6afcf7fc8cf8ca81, 9.327748711822305, 1.8124095923182973, 0.0, 0x4310246e397ec0b4, 0x49e64a595583d7b1);
    private static $salt_st_dat = array(null, 0.0, 0x3094ddda78aa529a, 0.0, 0x751926ac201a0ad9, 0x45dafc4ba4cbcd64, 0x675b05f9500f4cfa, 0x45713a1ec18c58c8, 1.4099206458880573, 0x6cbe789bdf4345bb, 0x180b595d20d8b103, 0x1f293f00b67ed388, 1.4112369965704587, 0.0, 0x331bc8e42cc3cef1, 0x76baf2bd606a8794, 0x234943b6f873bc3a, 0.0, 0x632ec44657aafee4, 0.0, 1.2806216388053064, 0x663d7c64a4aa625c, 0x1dae4ebd43023921, 0x7fbc88b1426813a9, 0xbf4c3738f049d40, 0.0, 0.0, 0.0, 0x761926cf04adcf77, 0.0, 0x500f4cc3af2f6f47, 0x33df970e6a77391b, 0x4f1101a7bba453e7, 0.0, 1.5800107239009522, 0x5dc4c44ec99af427, 0.0, 0.0, 0x45cb8453364691f5, 0x7e3f24bcbdfc86af, 0.0, 0x2f2ca5da3f2fc753, 0.0, 0.0, 1.4479770205178526, 0x14b9498a8c79287a, 0.0, 0x13ae81f0691f32b5, 0.0);
    private static $hex_char="abcdef0123456789";private static $change_a="0951ab326c7f4e8d";private static $change_b="183daf026795ebc4";private static $change_c="53840edc67f1ba29";private static $change_d="9ac612fd74538e0b";private static $change_e="72c0fbe64d9531a8";private static $change_f="a10fe82cd746b593";private static $change_0="e7b8a246590c31df";private static $change_1="28b5ae9cd340617f";private static $change_2="17cf54839b062eda";private static $change_3="d98601f2bac4573e";private static $change_4="34b78915d0ae62fc";private static $change_5="5bef680329c1ad74";private static $change_6="df9b3a41c76e2580";private static $change_7="9374d21c50fe8b6a";private static $change_8="60f931edc7b5248a";private static $change_9="2173049b6cea85df";private static $hashchan="4f571ae03b9cd268";private static $hashchan1="94c37de51f80b6a2";private static $hex_characters="abcdef0123456789";private static $base64_characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";private static $hex_1="549e30c67ba2f81d";private static $hex_2="e326a51d04789fcb";private static $hex_3="3bd45206fec9a718";private static $hXc="0132102013201203";private static $hth_1="61fa2bed734890c5";private static $rot13_1="4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";private static $rot13_2="wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";private static $rot13_3="h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";private static $rot13_4="JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";private static $hash0="Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";private static $hash1="752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";private static $hash2="4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";private static $hash3="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";private static $hash4="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";private static $hash5="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";private static $hash6="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";private static $hash7="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";private static $hash8="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";private static $hash9="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";private static $hasha="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";private static $hashb="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";private static $hashc="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";private static $hashd="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";private static $hashe="hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";private static $hashf="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
?>
