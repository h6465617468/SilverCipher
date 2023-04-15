<?php 
class SilverCipher3
{
    private $key;
    public function __construct($key=null) {
        if ($key === null) {
            $this->key = "123456789";
        } else {
            $this->key = $key;
        }

    }
    public function Encrypt($j)
    {
        $b=$this->key;
        $a = chr(0x33) . chr(0xfb) . chr(0xa4);
        $c = self::numHash($b, 1);
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $g = self::settingsgenerator(self::Hex_Dont_Count(hash("whirlpool", $b . $a)));
        $h = str_split($j, 256);
        $i = false;
        $d = false;
        $a = chr(0x33) . chr(0xfb) . chr(0xa4);
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $b = hex2bin(self::Hex_Dont_Count(hash("sha512", $b . $a)));
        $m = count($h);
        $k = 1;
        $e = 1;
        $f = 1;
        foreach ($h as $l) {
            $d = self::Enc($l, $b, $g);
            if ($k != $m) {
                $a = false;
                $a = chr(self::$salt_1_dat[$f]);
                $c = self::numHash($b, 1);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
                }
                if ($f == 9) {
                    $f = 0;
                }
                $a = self::XOREncrypt($b, hex2bin(self::Hex_Dont_Count(hash("sha512", $b . $a))));
                $b = hex2bin(self::Hex_Dont_Count(hash("whirlpool", $b . $a . $d[1])));
                $a = false;
                $a = chr(self::$salt_st_dat[$e]);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_st_dat[$c]));
                }
                if ($e == 9) {
                    $e = 0;
                }
                $g = self::settingsgenerator2(self::Hex_Dont_Count(hash("snefru", $b . $a)));
            }
            $i = $i . $d[0];
            $k++;
            $e++;
            $f++;
        }
        return $i;
    }
    public function Decrypt($d)
    {
        $b=$this->key;
        $d = str_replace(" ", "", trim(str_replace("=", "", $d)));
        $a = chr(0x33) . chr(0xfb) . chr(0xa4);
        $c = self::numHash($b, 1);
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $g = self::settingsgenerator(self::Hex_Dont_Count(hash("whirlpool", $b . $a)));
        $h = str_split($d, 684);
        $i = false;
        $a = chr(0x33) . chr(0xfb) . chr(0xa4);
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $b = hex2bin(self::Hex_Dont_Count(hash("sha512", $b . $a)));
        $m = count($h);
        $k = 1;
        $e = 1;
        $f = 1;
        foreach ($h as $l) {
            $j = self::Dec($l, $b, $g);
            if ($k != $m) {
                $a = false;
                $a = chr(self::$salt_1_dat[$f]);
                $c = self::numHash($b, 1);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
                }
                if ($f == 9) {
                    $f = 0;
                }
                $a = self::XOREncrypt($b, hex2bin(self::Hex_Dont_Count(hash("sha512", $b . $a))));
                $b = hex2bin(self::Hex_Dont_Count(hash("whirlpool", $b . $a . $j[1])));
                $a = false;
                $a = chr(self::$salt_st_dat[$e]);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_st_dat[$c]));
                }
                if ($e == 9) {
                    $e = 0;
                }
                $g = self::settingsgenerator2(self::Hex_Dont_Count(hash("snefru", $b . $a)));
            }
            $i = $i . $j[0];
            $k++;
            $e++;
            $f++;
        }
        return $i;
    }
    static function Enc($g, $d, $j)
    {
        $e = $d;
        $k = str_split($g, 128);
        $a = false;
        $h = false;
        $f = 1;
        foreach ($k as $l) {
            $b = self::Crypt($l, "e", $d);
            if (strlen($g) > 128) {
                $c = false;
                $c = chr(self::$salt_2_dat[$f]);
                $i = self::numHash($d, 1);
                if ($i != 0) {
                    $c = self::XOREncrypt($c, chr(self::$salt_2_dat[$i]));
                }
                if ($f == 9) {
                    $f = 0;
                }
                $f++;
                $d = hex2bin(self::Hex_Dont_Count(hash("sha512", self::XOREncrypt(strrev(self::XOREncrypt($d . chr(0xb5) . chr(0xb9), $c)), $b[1]) . $c . $b[1])));
            }
            $a = $a . $b[0];
            $h = $h . $b[1];
        }
        $b = false;
        $m = $h;
        $e = hex2bin(self::Hex_Dont_Count(hash("sha512", $e)));
        $a = self::E_death_round($a, $j, $e);
        $a = strrev($a);
        return array($a, $m);
    }
    static function Dec($g, $d, $j)
    {
        $a = trim($g);
        $a = strrev($a);
        $e = $d;
        $e = hex2bin(self::Hex_Dont_Count(hash("sha512", $e)));
        $a = self::D_death_round($a, $j, $e);
        $k = str_split($a, 342);
        $a = false;
        $h = false;
        $f = 1;
        foreach ($k as $l) {
            $b = self::Crypt($l, "d", $d);
            if (strlen($g) > 128) {
                $c = false;
                $c = chr(self::$salt_2_dat[$f]);
                $i = self::numHash($d, 1);
                if ($i != 0) {
                    $c = self::XOREncrypt($c, chr(self::$salt_2_dat[$i]));
                }
                if ($f == 9) {
                    $f = 0;
                }
                $f++;
                $d = hex2bin(self::Hex_Dont_Count(hash("sha512", self::XOREncrypt(strrev(self::XOREncrypt($d . chr(0xb5) . chr(0xb9), $c)), $b[1]) . $c . $b[1])));
            }
            $a = $a . $b[0];
            $h = $h . $b[1];
        }
        $b = false;
        $m = $h;
        return array($a, $m);
    }
    static function Crypt($x, $af, $f)
    {
        $k = $f;
        $s = hex2bin(self::Hex_Dont_Count(hash("sha512", md5($k))));
        $f = self::Hex_Dont_Count(hash("sha512", $f . $s . chr(0x3f) . chr(0x6c) . chr(0x33)));
        $n = hex2bin(self::Hex_Dont_Count(hash("sha512", hex2bin($f))));
        $r = hex2bin(self::Hex_Dont_Count(hash("whirlpool", hex2bin(self::E_hex_1($f)))));
        $o = hex2bin(self::Hex_Dont_Count(hash("whirlpool", hex2bin(md5(self::XOREncrypt(hex2bin($f), $r))))));
        $h = self::hashtoXcode($f);
        $ab = hex2bin(self::Hex_Dont_Count(hash("sha512", self::XOREncrypt($n, $k))));
        $q = hex2bin(self::Hex_Dont_Count(hash("sha512", hex2bin(hash("whirlpool", $r)))));
        if ($af == "e") {
            $a = $x;
            for ($l = 1; $l <= 1; $l++) {
                $a = hex2bin(self::Hex_Encrypt_Key(bin2hex($a), $k));
                $a = self::Raw_hexrev($a);
                $a = hex2bin(strtr(bin2hex($a), self::$hex_char, self::$change_5));
                $a = hex2bin(self::E_hex_3(bin2hex($a)));
                for ($aa = 1; $aa <= 2; $aa++) {
                    $a = hex2bin(self::Hex_Encrypt_Key(bin2hex($a), $q));
                    for ($z = 1; $z <= 2; $z++) {
                        $a = self::XOREncrypt(strrev($a), $o);
                        $a = hex2bin(strtr(bin2hex($a), self::$hex_char, self::$change_a));
                    }
                    $a = hex2bin(strtr(bin2hex($a), self::$hex_char, self::$change_f));
                    $a = hex2bin(self::E_hex_1(bin2hex($a)));
                    $a = hex2bin(self::Hex_Encrypt_Key(bin2hex($a), $k));
                }
                $a = self::XOREncrypt(strrev($a), self::XOREncrypt($n, $o));
                $a = hex2bin(self::E_hex_2(bin2hex($a)));
                $a = self::Raw_hexrev($a);
                for ($m = 1; $m <= 3; $m++) {
                    $a = hex2bin(self::Hex_Encrypt_Key(bin2hex($a), $o));
                }
            }
            $a = strrev(bin2hex($a));
            $a = self::E_hex_1($a);
            $j = self::Hex_Dont_Count(bin2hex(openssl_random_pseudo_bytes(64)));
            $d = 0;
            $e = false;
            $p = str_split($a, 1);
            $i = false;
            foreach ($p as $g) {
                if ($d == 128) {
                    $d = 0;
                    $j = self::Hex_Dont_Count(bin2hex(openssl_random_pseudo_bytes(64)));
                    $f = self::Hex_Dont_Count(hash("sha512", hex2bin($f) . $s . chr(0x33) . chr(0x99) . chr(0xb4)));
                    $h = self::hashtoXcode($f);
                }
                if ($h[$d] == 0) {
                    $e = $e . self::E_hex_1($g) . $j[$d];
                    $i = $i . $j[$d];
                } else {
                    if ($h[$d] == 1) {
                        $e = $e . $j[$d] . self::E_hex_2($g);
                        $i = $i . $j[$d];
                    } else {
                        if ($h[$d] == 2) {
                            $e = $e . self::E_hex_1($g) . self::hashtohash_1(self::hashtohash_1($j[$d]));
                            $i = $i . self::hashtohash_1(self::hashtohash_1($j[$d]));
                        } else {
                            if ($h[$d] == 3) {
                                $e = $e . self::hashtohash_1($j[$d]) . self::E_hex_2($g);
                                $i = $i . self::hashtohash_1($j[$d]);
                            }
                        }
                    }
                }
                $d++;
            }
            $t = $i;
            $p = false;
            $g = false;
            $e = self::E_hex_1($e);
            $b = hex2bin($e);
            for ($l = 1; $l <= 1; $l++) {
                for ($y = 1; $y <= 3; $y++) {
                    $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $s));
                    for ($w = 1; $w <= 8; $w++) {
                        $b = hex2bin(self::E_hex_2(bin2hex($b)));
                        $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $n));
                        $b = hex2bin(self::E_hex_1(bin2hex($b)));
                    }
                    $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $r));
                    $b = hex2bin(self::E_Shift(bin2hex($b), 1));
                }
                for ($v = 1; $v <= 2; $v++) {
                    $b = hex2bin(self::E_hex_2(bin2hex($b)));
                    for ($u = 1; $u <= 2; $u++) {
                        $b = hex2bin(self::E_Shift(bin2hex($b), 3));
                        $b = self::Raw_hexrev($b);
                        $b = self::XOREncrypt(strrev($b), $ab);
                        $b = hex2bin(self::E_Shift(bin2hex($b), 2));
                        $b = hex2bin(self::E_hex_3(bin2hex($b)));
                        $b = self::XOREncrypt(strrev($b), $n);
                    }
                    $b = hex2bin(self::E_hex_1(bin2hex($b)));
                    $b = self::XOREncrypt(strrev($b), $q);
                    $b = hex2bin(self::E_Shift(bin2hex($b), 3));
                }
                for ($m = 1; $m <= 2; $m++) {
                    $b = hex2bin(self::E_hex_2(bin2hex($b)));
                    $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $k));
                }
            }
            $c = strtr(self::bk_kb(str_replace("=", "", base64_encode($b))), self::$base64_characters, self::$rot13_1);
            $ad = $c;
        } else {
            if ($af == "d") {
                $x = trim($x);
                $e = $x;
                $a = base64_decode(self::bk_kb(strtr($e, self::$rot13_1, self::$base64_characters)));
                for ($l = 1; $l <= 1; $l++) {
                    for ($m = 1; $m <= 2; $m++) {
                        $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $k));
                        $a = hex2bin(self::D_hex_2(bin2hex($a)));
                    }
                    for ($v = 1; $v <= 2; $v++) {
                        $a = hex2bin(self::D_Shift(bin2hex($a), 3));
                        $a = strrev(self::XORDecrypt($a, $q));
                        $a = hex2bin(self::D_hex_1(bin2hex($a)));
                        for ($u = 1; $u <= 2; $u++) {
                            $a = strrev(self::XORDecrypt($a, $n));
                            $a = hex2bin(self::D_hex_3(bin2hex($a)));
                            $a = hex2bin(self::D_Shift(bin2hex($a), 2));
                            $a = strrev(self::XORDecrypt($a, $ab));
                            $a = self::Raw_hexrev($a);
                            $a = hex2bin(self::D_Shift(bin2hex($a), 3));
                        }
                        $a = hex2bin(self::D_hex_2(bin2hex($a)));
                    }
                    for ($y = 1; $y <= 3; $y++) {
                        $a = hex2bin(self::D_Shift(bin2hex($a), 1));
                        $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $r));
                        for ($w = 1; $w <= 8; $w++) {
                            $a = hex2bin(self::D_hex_1(bin2hex($a)));
                            $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $n));
                            $a = hex2bin(self::D_hex_2(bin2hex($a)));
                        }
                        $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $s));
                    }
                }
                $b = bin2hex($a);
                $b = self::D_hex_1($b);
                $p = str_split($b, 2);
                $e = false;
                $d = 0;
                $h = self::hashtoXcode($f);
                $ac = false;
                foreach ($p as $g) {
                    if ($d == 128) {
                        $d = 0;
                        $f = self::Hex_Dont_Count(hash("sha512", hex2bin($f) . $s . chr(0x33) . chr(0x99) . chr(0xb4)));
                        $h = self::hashtoXcode($f);
                    }
                    if ($h[$d] == 0 or $h[$d] == 2) {
                        $ae = self::D_hex_1(substr($g, 0, 1));
                        $i = substr($g, -1, 1);
                    } else {
                        if ($h[$d] == 1 or $h[$d] == 3) {
                            $ae = self::D_hex_2(substr($g, -1, 1));
                            $i = substr($g, 0, 1);
                        }
                    }
                    $d++;
                    $e = $e . $ae;
                    $ac = $ac . $i;
                }
                $t = $ac;
                $p = false;
                $g = false;
                $e = self::D_hex_1($e);
                $c = hex2bin(strrev($e));
                for ($l = 1; $l <= 1; $l++) {
                    for ($m = 1; $m <= 3; $m++) {
                        $c = hex2bin(self::Hex_Decrypt_Key(bin2hex($c), $o));
                    }
                    $c = self::Raw_hexrev($c);
                    $c = hex2bin(self::D_hex_2(bin2hex($c)));
                    $c = strrev(self::XORDecrypt($c, self::XOREncrypt($n, $o)));
                    for ($aa = 1; $aa <= 2; $aa++) {
                        $c = hex2bin(self::Hex_Decrypt_Key(bin2hex($c), $k));
                        $c = hex2bin(self::D_hex_1(bin2hex($c)));
                        $c = hex2bin(strtr(bin2hex($c), self::$change_f, self::$hex_char));
                        for ($z = 1; $z <= 2; $z++) {
                            $c = hex2bin(strtr(bin2hex($c), self::$change_a, self::$hex_char));
                            $c = strrev(self::XORDecrypt($c, $o));
                        }
                        $c = hex2bin(self::Hex_Decrypt_Key(bin2hex($c), $q));
                    }
                    $c = hex2bin(self::D_hex_3(bin2hex($c)));
                    $c = hex2bin(strtr(bin2hex($c), self::$change_5, self::$hex_char));
                    $c = self::Raw_hexrev($c);
                    $c = hex2bin(self::Hex_Decrypt_Key(bin2hex($c), $k));
                }
                if ($c == "") {
                    exit;
                }
                $ad = $c;
            }
        }
        $t = hex2bin($t);
        return array($ad, $t);
    }
    static function numHash($d,$a=null){$e=md5($d,true);$c=unpack('N2',$e);$b=$c[1].$c[2];if($a&&is_int($a)){$b=substr($b,0,$a);}
return $b;}
static function Raw_hexrev($a){$b=str_split(bin2hex($a),2);$a=null;foreach($b as $c){$a=$a.strrev($c);}
return hex2bin($a);}
static function E_Shift($b,$e){if(strlen($b)%4==0){if($e==1){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[1].$a[2].$a[3].$a[0];$b=$b.$d;}}else{if($e==2){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[2].$a[3].$a[0].$a[1];$b=$b.$d;}}else{if($e==3){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[3].$a[0].$a[1].$a[2];$b=$b.$d;}}}}}else{$b=null;}
return $b;}
static function D_Shift($b,$e){if(strlen($b)%4==0){if($e==1){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[3].$a[0].$a[1].$a[2];$b=$b.$d;}}else{if($e==2){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[2].$a[3].$a[0].$a[1];$b=$b.$d;}}else{if($e==3){$c=str_split($b,4);$b=null;foreach($c as $a){$d=$a[1].$a[2].$a[3].$a[0];$b=$b.$d;}}}}}else{$b=null;}
return $b;}
static function Hex_Dont_Count($a){$a=trim($a);$e=strlen($a);if($e==32){$d=self::$change_9;}else{if($e==64){$d=self::$change_2;}else{if($e==128){$d=self::$change_5;}else{$d=self::$change_4;}}}
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
static function E_death_round($a,$d,$b){$a=strrev($a);$f=str_split(trim($d));for($e=0;$e<=strlen(trim($d))-1;$e++){$c=$f[$e];if($c=="0"){$a=strtr($a,self::$base64_characters,self::$rot13_2);$a=strtr($a,self::$base64_characters,self::$hashb);$a=self::Hex_Encrypt_Key($a,$b);$a=self::encrypt_key($b,$a);$a=strtr($a,self::$base64_characters,self::$hash2);}
if($c=="1"){$a=strtr($a,self::$base64_characters,self::$hashf);$a=self::encrypt_key($b,$a);$a=strtr($a,self::$base64_characters,self::$hash6);$a=self::Hex_Encrypt_Key($a,$b);$a=strtr($a,self::$base64_characters,self::$hash1);}
if($c=="2"){$a=strtr($a,self::$base64_characters,self::$hashd);$a=strtr($a,self::$base64_characters,self::$rot13_1);$a=strtr($a,self::$base64_characters,self::$hash0);$a=self::encrypt_key($b,$a);$a=strtr($a,self::$base64_characters,self::$hash3);}
if($c=="3"){$a=self::Hex_Encrypt_Key($a,$b);$a=strtr($a,self::$base64_characters,self::$hash4);$a=self::bk_kb($a);$a=self::Hex_Encrypt_Key($a,$b);$a=strrev($a);}
if($c=="4"){$a=strtr($a,self::$base64_characters,self::$rot13_3);$a=strtr($a,self::$base64_characters,self::$hash8);$a=strtr($a,self::$base64_characters,self::$hash9);$a=strtr($a,self::$base64_characters,self::$hasha);$a=self::encrypt_key($b,$a);}
if($c=="5"){$a=self::Hex_Encrypt_Key($a,$b);$a=strtr($a,self::$base64_characters,self::$rot13_4);$a=strrev($a);$a=self::encrypt_key($b,$a);$a=self::bk_kb($a);}
if($c=="6"){$a=strtr($a,self::$base64_characters,self::$hash5);$a=self::bk_kb($a);$a=strrev($a);$a=strtr($a,self::$base64_characters,self::$hashe);$a=strtr($a,self::$base64_characters,self::$rot13_4);}
if($c=="7"){$a=self::Hex_Encrypt_Key($a,$b);$a=strtr($a,self::$base64_characters,self::$hash7);$a=strtr($a,self::$base64_characters,self::$hashc);$a=strrev($a);$a=self::encrypt_key($b,$a);}}
$a=self::encrypt_key($b,$a);return $a;}
static function D_death_round($a,$d,$b){$a=self::decrypt_key($b,$a);$f=str_split(strrev($d));for($e=0;$e<=strlen(strrev($d))-1;$e++){$c=$f[$e];if($c=="0"){$a=strtr($a,self::$hash2,self::$base64_characters);$a=self::decrypt_key($b,$a);$a=self::Hex_Decrypt_Key($a,$b);$a=strtr($a,self::$hashb,self::$base64_characters);$a=strtr($a,self::$rot13_2,self::$base64_characters);}
if($c=="1"){$a=strtr($a,self::$hash1,self::$base64_characters);$a=self::Hex_Decrypt_Key($a,$b);$a=strtr($a,self::$hash6,self::$base64_characters);$a=self::decrypt_key($b,$a);$a=strtr($a,self::$hashf,self::$base64_characters);}
if($c=="2"){$a=strtr($a,self::$hash3,self::$base64_characters);$a=self::decrypt_key($b,$a);$a=strtr($a,self::$hash0,self::$base64_characters);$a=strtr($a,self::$rot13_1,self::$base64_characters);$a=strtr($a,self::$hashd,self::$base64_characters);}
if($c=="3"){$a=strrev($a);$a=self::Hex_Decrypt_Key($a,$b);$a=self::bk_kb($a);$a=strtr($a,self::$hash4,self::$base64_characters);$a=self::Hex_Decrypt_Key($a,$b);}
if($c=="4"){$a=self::decrypt_key($b,$a);$a=strtr($a,self::$hasha,self::$base64_characters);$a=strtr($a,self::$hash9,self::$base64_characters);$a=strtr($a,self::$hash8,self::$base64_characters);$a=strtr($a,self::$rot13_3,self::$base64_characters);}
if($c=="5"){$a=self::bk_kb($a);$a=self::decrypt_key($b,$a);$a=strrev($a);$a=strtr($a,self::$rot13_4,self::$base64_characters);$a=self::Hex_Decrypt_Key($a,$b);}
if($c=="6"){$a=strtr($a,self::$rot13_4,self::$base64_characters);$a=strtr($a,self::$hashe,self::$base64_characters);$a=strrev($a);$a=self::bk_kb($a);$a=strtr($a,self::$hash5,self::$base64_characters);}
if($c=="7"){$a=self::decrypt_key($b,$a);$a=strrev($a);$a=strtr($a,self::$hashc,self::$base64_characters);$a=strtr($a,self::$hash7,self::$base64_characters);$a=self::Hex_Decrypt_Key($a,$b);}}
$a=strrev($a);return $a;}
static function Hex_Encrypt_Key($a,$c){$c=self::Hex_Dont_Count(md5($c));$d=0;for($b=0;$b<=strlen($a)-1;$b++){if($d==32){$d=0;$c=strtr($c,self::$hex_char,self::$hashchan);}
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
static function Hex_Decrypt_Key($a,$c){$c=self::Hex_Dont_Count(md5($c));$d=0;for($b=0;$b<=strlen($a)-1;$b++){if($d==32){$d=0;$c=strtr($c,self::$hex_char,self::$hashchan);}
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
static function encrypt_key($c,$a){$c=self::Hex_Dont_Count(hash("md5",$c));$d=0;for($b=0;$b<=strlen($a)-1;$b++){if($d==32){$d=0;$c=strtr($c,self::$hex_char,self::$hashchan1);}
if($c[$d]=="0"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash0);}else{if($c[$d]=="1"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash1);}else{if($c[$d]=="2"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash2);}else{if($c[$d]=="3"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash3);}else{if($c[$d]=="4"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash4);}else{if($c[$d]=="5"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash5);}else{if($c[$d]=="6"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash6);}else{if($c[$d]=="7"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash7);}else{if($c[$d]=="8"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash8);}else{if($c[$d]=="9"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hash9);}else{if($c[$d]=="a"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hasha);}else{if($c[$d]=="b"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashb);}else{if($c[$d]=="c"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashc);}else{if($c[$d]=="d"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashd);}else{if($c[$d]=="e"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashe);}else{if($c[$d]=="f"){$a[$b]=strtr($a[$b],self::$base64_characters,self::$hashf);}}}}}}}}}}}}}}}}
$d++;}
return $a;}
static function decrypt_key($c,$a){$c=self::Hex_Dont_Count(hash("md5",$c));$d=0;for($b=0;$b<=strlen($a)-1;$b++){if($d==32){$d=0;$c=strtr($c,self::$hex_char,self::$hashchan1);}
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
private static $salt_1_dat=array(null,0xb6344e,0xe33dae,0xeb4899,0x661e23,0xe3af62,0x100c42,0x36ce98,0x46100f,0x91a745);private static $salt_2_dat=array(null,0xc6a44b,0xeeadaa,0xffcced,0x761926,0xe6cf52,0x500f4c,0x33df97,0x4f1101,0x92a855);private static $salt_st_dat=array(null,0xaf4dca,0x3094dd,0xdc4a65,0x751926,0x45dafc,0x500f4c,0x457158,0xc47842,0xdf4345);private static $hex_char="abcdef0123456789";private static $change_a="0951ab326c7f4e8d";private static $change_b="183daf026795ebc4";private static $change_c="53840edc67f1ba29";private static $change_d="9ac612fd74538e0b";private static $change_e="72c0fbe64d9531a8";private static $change_f="a10fe82cd746b593";private static $change_0="e7b8a246590c31df";private static $change_1="28b5ae9cd340617f";private static $change_2="17cf54839b062eda";private static $change_3="d98601f2bac4573e";private static $change_4="34b78915d0ae62fc";private static $change_5="5bef680329c1ad74";private static $change_6="df9b3a41c76e2580";private static $change_7="9374d21c50fe8b6a";private static $change_8="60f931edc7b5248a";private static $change_9="2173049b6cea85df";private static $hashchan="4f571ae03b9cd268";private static $hashchan1="94c37de51f80b6a2";private static $hex_characters="abcdef0123456789";private static $base64_characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";private static $hex_1="549e30c67ba2f81d";private static $hex_2="e326a51d04789fcb";private static $hex_3="3bd45206fec9a718";private static $sg="1052425130376674";private static $sg1="5106365247420137";private static $sg2="0760252675144331";private static $hXc="0132102013201203";private static $hth_1="61fa2bed734890c5";private static $rot13_1="4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";private static $rot13_2="wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";private static $rot13_3="h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";private static $rot13_4="JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";private static $hash0="Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";private static $hash1="752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";private static $hash2="4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";private static $hash3="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";private static $hash4="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";private static $hash5="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";private static $hash6="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";private static $hash7="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";private static $hash8="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";private static $hash9="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";private static $hasha="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";private static $hashb="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";private static $hashc="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";private static $hashd="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";private static $hashe="hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";private static $hashf="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
?>
