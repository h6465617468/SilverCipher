<?php 
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/* AntaresCrypt Encryption Algorithm                                                              */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
set_time_limit(0);
class AntaresCrypt_Core
{
    static function Encrypt($b = null, $a = null)
    {
        if($b==""){return "";}
        $c = null;
        $e = base64_decode(self::$salt);
        foreach (hash_algos() as $i) {
            $f = hash($i, $a, true);
            $c = $c . base64_decode(self::aes256cbc($f, "e", $e));
            $c = $c . base64_decode(self::aes192cbc($f, "e", $e));
            $c = $c . base64_decode(self::aes128cbc($f, "e", $e));
            $c = $c . base64_decode(self::aes256cfb($f, "e", $e));
            $c = $c . base64_decode(self::aes192cfb($f, "e", $e));
            $c = $c . base64_decode(self::aes128cfb($f, "e", $e));
            $c = self::Kiyim(hash("sha512", $c, true),"e",hash("sha512", $f, true));
        }
        $a = base64_decode(trim(self::$salt)) . $c . hex2bin(Antares_Crypt_v1_5::Hex_Dont_Count(self::Antares_Crypt_HASH(hex2bin(hash("whirlpool", $a)), 1024)));
        $b = self::Kiyim($b, "e", $a);
        $j = str_split($b);
        $b = null;
        $g = strtr(md5($a), self::$st_hex_chars, self::$st_hex_chang);
        $d = 0;
        foreach ($j as $h) {
            if ($d == 32) {
                $g = strtr(md5($a), self::$st_hex_chars, self::$st_hex_chang);
                $d = 0;
            }
            if ($g[$d] == 0) {
                $b = $b . str_replace("=", "", Antares_Crypt_v1_1::Encrypt($h, $a, "no"));
            } else {
                if ($g[$d] == 1) {
                    $b = $b . str_replace("=", "", Antares_Crypt_v1_2::Encrypt($h, $a, "no"));
                } else {
                    if ($g[$d] == 2) {
                        $b = $b . str_replace("=", "", Antares_Crypt_v1_3_no_compress::Encrypt($h, $a));
                    } else {
                        if ($g[$d] == 3) {
                            $b = $b . str_replace("=", "", Antares_Crypt_v1_4::Encrypt($h, $a));
                        } else {
                            if ($g[$d] == 4) {
                                $b = $b . str_replace("=", "", Antares_Crypt_v1_5::Encrypt($h, $a));
                            } else {
                            }
                        }
                    }
                }
            }
            $a = hex2bin(hash("whirlpool", $a));
            $d++;
        }
        return $b;
    }
    static function Decrypt($a = null, $b = null)
    {
        if($a==""){return "";}
        $a = str_replace("CryptoGeneric-","",$a);
        $c = null;
        $e = base64_decode(self::$salt);
        foreach (hash_algos() as $i) {
            $f = hash($i, $b, true);
            $c = $c . base64_decode(self::aes256cbc($f, "e", $e));
            $c = $c . base64_decode(self::aes192cbc($f, "e", $e));
            $c = $c . base64_decode(self::aes128cbc($f, "e", $e));
            $c = $c . base64_decode(self::aes256cfb($f, "e", $e));
            $c = $c . base64_decode(self::aes192cfb($f, "e", $e));
            $c = $c . base64_decode(self::aes128cfb($f, "e", $e));
            $c = self::Kiyim(hash("sha512", $c, true),"e",hash("sha512", $f, true));
        }
        $b = base64_decode(trim(self::$salt)) . $c . hex2bin(Antares_Crypt_v1_5::Hex_Dont_Count(self::Antares_Crypt_HASH(hex2bin(hash("whirlpool", $b)), 1024)));
        $j = $b;
        $a = str_replace(" ", "", trim($a));
        $k = str_split($a, 3);
        $a = null;
        $g = strtr(md5($b), self::$st_hex_chars, self::$st_hex_chang);
        $d = 0;
        foreach ($k as $h) {
            if ($d == 32) {
                $g = strtr(md5($b), self::$st_hex_chars, self::$st_hex_chang);
                $d = 0;
            }
            if ($g[$d] == 0) {
                $a = $a . Antares_Crypt_v1_1::Decrypt($h, $b, "no");
            } else {
                if ($g[$d] == 1) {
                    $a = $a . Antares_Crypt_v1_2::Decrypt($h, $b, "no");
                } else {
                    if ($g[$d] == 2) {
                        $a = $a . Antares_Crypt_v1_3_no_compress::Decrypt($h, $b);
                    } else {
                        if ($g[$d] == 3) {
                            $a = $a . Antares_Crypt_v1_4::Decrypt($h, $b);
                        } else {
                            if ($g[$d] == 4) {
                                $a = $a . Antares_Crypt_v1_5::Decrypt($h, $b);
                            } else {
                            }
                        }
                    }
                }
            }
            $b = hex2bin(hash("whirlpool", $b));
            $d++;
        }
        $a = self::Kiyim($a, "d", $j);
        return $a;
    }
    static function Antares_Crypt_HASH($b, $c = 64)
    {
        $a = null;
        $d = 0;
        while ($d <= $c / 64) {
            if($a==null){$a = $a . hash("gost", $b);}else{
            $a = $a . hash("gost", $b . hex2bin($a));
            }
            $d++;
        }
        $b = substr($a, 0, $c);
        return $b;
    }
    static function Kiyim($k, $l, $e)
    {
        $d = $e;
        $m = hex2bin(Antares_Crypt_v1_5::Hex_Dont_Count(hash("sha512", md5($d))));
        $g = Antares_Crypt_v1_5::Hex_Dont_Count(hash("sha512", $e . $m . chr(0x3f) . chr(0x6c) . chr(0x33)));
        $f = Antares_Crypt_v1_5::Raw_hexrev(hex2bin(Antares_Crypt_v1_5::Hex_Dont_Count(hash("sha512", $e))));
        $h = Antares_Crypt_v1_5::Raw_hexrev(hex2bin(Antares_Crypt_v1_5::Hex_Dont_Count(hash("whirlpool", hex2bin(Antares_Crypt_v1_5::E_hex_1($g))))));
        $c = hex2bin(Antares_Crypt_v1_5::Hex_Dont_Count(hash("whirlpool", hex2bin(md5(Antares_Crypt_v1_5::XOREncrypt(hex2bin($g), $h))))));
        $n = Antares_Crypt_v1_5::hashtoXcode($e);
        $o = hex2bin(Antares_Crypt_v1_5::Hex_Dont_Count(hash("sha512", Antares_Crypt_v1_5::Raw_hexrev(exp(pow(2, 2)) . Antares_Crypt_v1_5::XOREncrypt($f, $d)))));
        $i = hex2bin(Antares_Crypt_v1_5::Hex_Dont_Count(hash("sha512", hex2bin(hash("whirlpool", $h)))));
        if ($l == "e") {
            $b = $k;
            $b = hex2bin(Antares_Crypt_v1_5::Hex_Encrypt_Key(bin2hex($b), $d));
            $b = Antares_Crypt_v1_5::Raw_hexrev($b);
            $b = hex2bin(strtr(bin2hex($b), self::$st_hex_chars, self::$change_5));
            $b = hex2bin(Antares_Crypt_v1_5::E_hex_3(bin2hex($b)));
            $b = hex2bin(Antares_Crypt_v1_5::Hex_Encrypt_Key(bin2hex($b), $i));
            $b = Antares_Crypt_v1_5::Raw_hexrev($b);
            $b = Antares_Crypt_v1_5::XOREncrypt(strrev($b), $c);
            $b = hex2bin(strtr(bin2hex($b), self::$st_hex_chars, self::$change_a));
            $b = hex2bin(strtr(bin2hex($b), self::$st_hex_chars, self::$change_f));
            $b = hex2bin(Antares_Crypt_v1_5::E_hex_1(bin2hex($b)));
            $b = hex2bin(Antares_Crypt_v1_5::Hex_Encrypt_Key(bin2hex($b), $d));
            $b = Antares_Crypt_v1_5::XOREncrypt(strrev($b), Antares_Crypt_v1_5::XOREncrypt($f, $c));
            $b = hex2bin(Antares_Crypt_v1_5::E_hex_2(bin2hex($b)));
            $b = Antares_Crypt_v1_5::Raw_hexrev($b);
            $b = hex2bin(Antares_Crypt_v1_5::Hex_Encrypt_Key(bin2hex($b), $c));
            $j = $b;
        } else {
            if ($l == "d") {
                $a = $k;
                $a = hex2bin(Antares_Crypt_v1_5::Hex_Decrypt_Key(bin2hex($a), $c));
                $a = Antares_Crypt_v1_5::Raw_hexrev($a);
                $a = hex2bin(Antares_Crypt_v1_5::D_hex_2(bin2hex($a)));
                $a = strrev(Antares_Crypt_v1_5::XORDecrypt($a, Antares_Crypt_v1_5::XOREncrypt($f, $c)));
                $a = hex2bin(Antares_Crypt_v1_5::Hex_Decrypt_Key(bin2hex($a), $d));
                $a = hex2bin(Antares_Crypt_v1_5::D_hex_1(bin2hex($a)));
                $a = hex2bin(strtr(bin2hex($a), self::$change_f, self::$st_hex_chars));
                $a = hex2bin(strtr(bin2hex($a), self::$change_a, self::$st_hex_chars));
                $a = strrev(Antares_Crypt_v1_5::XORDecrypt($a, $c));
                $a = Antares_Crypt_v1_5::Raw_hexrev($a);
                $a = hex2bin(Antares_Crypt_v1_5::Hex_Decrypt_Key(bin2hex($a), $i));
                $a = hex2bin(Antares_Crypt_v1_5::D_hex_3(bin2hex($a)));
                $a = hex2bin(strtr(bin2hex($a), self::$change_5, self::$st_hex_chars));
                $a = Antares_Crypt_v1_5::Raw_hexrev($a);
                $a = hex2bin(Antares_Crypt_v1_5::Hex_Decrypt_Key(bin2hex($a), $d));
                $j = $a;
            }
        }
        return $j;
    }
    static function aes256cbc($c, $f, $a)
    {
        $g = $a;
        $h = $a;
        $b = false;
        $d = "AES-256-CBC";
        $a = hash('sha256', $g);
        $e = substr(hash('sha256', $h), 0, 16);
        if ($f == 'e') {
            $b = base64_encode(openssl_encrypt($c, $d, $a, 0, $e));
        } else {
            if ($f == 'd') {
                $b = openssl_decrypt(base64_decode($c), $d, $a, 0, $e);
            }
        }
        return $b;
    }
    static function aes192cbc($c, $f, $a)
    {
        $g = $a;
        $h = $a;
        $b = false;
        $d = "AES-192-CBC";
        $a = hash('sha256', $g);
        $e = substr(hash('sha256', $h), 0, 16);
        if ($f == 'e') {
            $b = base64_encode(openssl_encrypt($c, $d, $a, 0, $e));
        } else {
            if ($f == 'd') {
                $b = openssl_decrypt(base64_decode($c), $d, $a, 0, $e);
            }
        }
        return $b;
    }
    static function aes128cbc($c, $f, $a)
    {
        $g = $a;
        $h = $a;
        $b = false;
        $d = "AES-128-CBC";
        $a = hash('sha256', $g);
        $e = substr(hash('sha256', $h), 0, 16);
        if ($f == 'e') {
            $b = base64_encode(openssl_encrypt($c, $d, $a, 0, $e));
        } else {
            if ($f == 'd') {
                $b = openssl_decrypt(base64_decode($c), $d, $a, 0, $e);
            }
        }
        return $b;
    }
    static function aes256cfb($c, $f, $a)
    {
        $g = $a;
        $h = $a;
        $b = false;
        $d = "AES-256-CFB";
        $a = hash('sha256', $g);
        $e = substr(hash('sha256', $h), 0, 16);
        if ($f == 'e') {
            $b = base64_encode(openssl_encrypt($c, $d, $a, 0, $e));
        } else {
            if ($f == 'd') {
                $b = openssl_decrypt(base64_decode($c), $d, $a, 0, $e);
            }
        }
        return $b;
    }
    static function aes192cfb($c, $f, $a)
    {
        $g = $a;
        $h = $a;
        $b = false;
        $d = "AES-192-CFB";
        $a = hash('sha256', $g);
        $e = substr(hash('sha256', $h), 0, 16);
        if ($f == 'e') {
            $b = base64_encode(openssl_encrypt($c, $d, $a, 0, $e));
        } else {
            if ($f == 'd') {
                $b = openssl_decrypt(base64_decode($c), $d, $a, 0, $e);
            }
        }
        return $b;
    }
    static function aes128cfb($c, $f, $a)
    {
        $g = $a;
        $h = $a;
        $b = false;
        $d = "AES-128-CFB";
        $a = hash('sha256', $g);
        $e = substr(hash('sha256', $h), 0, 16);
        if ($f == 'e') {
            $b = base64_encode(openssl_encrypt($c, $d, $a, 0, $e));
        } else {
            if ($f == 'd') {
                $b = openssl_decrypt(base64_decode($c), $d, $a, 0, $e);
            }
        }
        return $b;
    }
    static $change_a = "0951ab326c7f4e8d";
    static $change_f = "a10fe82cd746b593";
    static $change_5 = "5bef680329c1ad74";
    static $st_hex_chars = "abcdef0123456789";
    static $st_hex_chang = "1123413123411123";
    static $salt = "TDx1SkhFhmONvtotJRJogmnC2sQYVlGPutavJK7ckjZJ5KKVK2Xro0LuB/EavAT+p46pg+Lr93pVmgdCdQ8JrxXLv0ZewyVfQ27slmG0hhjbdKQ2mftzQbjOZxbOoGmAsC5AtpTQ1z4wFPJV7bIA0/9mWji5p/baXy5Yj3keTdrbAFRyc7LAEjdqrfUM4ERxATJ+jm57C0R+VlhdWBLoNp7JJ5FY31vAOHaKGwvYdme3901eF01QoJtYmF5DgSTpk00H+6T2AUWk3SG1oRFlzT/B4d5nVi931uyo3Mb2jrwiRU3LQx3SmroIvGJw9AP/QIZ8rPDFRqSRQoHS9QAmw7s4/yI1WxvLvyGsETNV+WL8wleFv3l+gVGr50xRkL/M4KjO8N/ao/2y7VakKFlHCzlJoYdd6ZbABqzsqzbq1iIOPjQXyWExcQQjaO2zlBCPaPcWD8o3WA7KY+WG4WNTDjj1Gml6LyrOFrO8cleL7za5xksEkO/z73CpfxTfWo8kkuCVgvcpif/WoRAv02R2mRBqoCfgKbbM3xH1muObaA/QUMoq01gwMM+8b3yfgSVG6FTd7aqEmFwMdwJt4zZNJVWmhA1gEGU1lPtwYmuU4rYd4/z3DhLQLYH9OAuSy8WhPepzR3xwFKQPnlGn2Z6cMaBAuezgPgs0VTIrxWZKwpDTqg9lTckibJ9DjKur/1VN7H4YpeWaay8t7jSXphs3aYE1vGLAjqlFOGKy8RMRQUW91yuGpcR6wx+6inmJgG+SlLme5HebJGByvmF1qzSGxe4v5/VWUln75IzbW4a4UF+8Vh+qS2rhVzQiJeGW1SdAmiHcDZJTyASzuPYExMSyq2ZVBlrHNak9nP7PJ/DEryEMJrVhU24ZPwvYr+byfWjCWsGGQ6IOPgIQPwxpPk2wUnHQOPHqR45fbSpuT2xKR82XS4vvtv3IldZ8hkRbIeR0oQY4LQdBVRAMnpgkPVdM7rjZelTeuh2moTs9BboYAoaeZc3Wx4vsYBjJwqivOIqe";
}
class Antares_Crypt_v1_5
{
    static function Encrypt($d = null, $b = null, $j = null)
    {
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
                $b = hex2bin(sha1(strrev(utf8_encode($a))) . hash("gost", base64_decode(self::$hash0 . self::$hash1 . self::$hash2 . self::$hash3 . self::$hash4 . self::$hash5 . self::$hash6 . self::$hash7 . self::$hash8 . self::$hash9 . self::$hasha . self::$hashb . self::$hashc . self::$hashd . self::$hashe . self::$hashf) . $b . $a . pow(2, 24) * substr(0, 8, self::numHash(hex2bin(self::Hex_Dont_Count(hash("whirlpool", $b . $a . $f[1]))), 8))));
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
    static function Decrypt($e = null, $b = null, $j = null)
    {
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
                $b = hex2bin(sha1(strrev(utf8_encode($a))) . hash("gost", base64_decode(self::$hash0 . self::$hash1 . self::$hash2 . self::$hash3 . self::$hash4 . self::$hash5 . self::$hash6 . self::$hash7 . self::$hash8 . self::$hash9 . self::$hasha . self::$hashb . self::$hashc . self::$hashd . self::$hashe . self::$hashf) . $b . $a . pow(2, 24) * substr(0, 8, self::numHash(hex2bin(self::Hex_Dont_Count(hash("whirlpool", $b . $a . $i[1]))), 8))));
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
    static function numHash($d, $a = null)
    {
        $e = md5($d, true);
        $c = unpack('N2', $e);
        $b = $c[1] . $c[2];
        if ($a && is_int($a)) {
            $b = substr($b, 0, $a);
        }
        return $b;
    }
    static function Raw_hexrev($a)
    {
        $b = str_split(bin2hex($a), 2);
        $a = null;
        foreach ($b as $c) {
            $a = $a . strrev($c);
        }
        return hex2bin($a);
    }
    static function E_Shift($b, $e)
    {
        if (strlen($b) % 4 == 0) {
            if ($e == 1) {
                $c = str_split($b, 4);
                $b = null;
                foreach ($c as $a) {
                    $d = $a[1] . $a[2] . $a[3] . $a[0];
                    $b = $b . $d;
                }
            } else {
                if ($e == 2) {
                    $c = str_split($b, 4);
                    $b = null;
                    foreach ($c as $a) {
                        $d = $a[2] . $a[3] . $a[0] . $a[1];
                        $b = $b . $d;
                    }
                } else {
                    if ($e == 3) {
                        $c = str_split($b, 4);
                        $b = null;
                        foreach ($c as $a) {
                            $d = $a[3] . $a[0] . $a[1] . $a[2];
                            $b = $b . $d;
                        }
                    }
                }
            }
        } else {
            $b = null;
        }
        return $b;
    }
    static function D_Shift($b, $e)
    {
        if (strlen($b) % 4 == 0) {
            if ($e == 1) {
                $c = str_split($b, 4);
                $b = null;
                foreach ($c as $a) {
                    $d = $a[3] . $a[0] . $a[1] . $a[2];
                    $b = $b . $d;
                }
            } else {
                if ($e == 2) {
                    $c = str_split($b, 4);
                    $b = null;
                    foreach ($c as $a) {
                        $d = $a[2] . $a[3] . $a[0] . $a[1];
                        $b = $b . $d;
                    }
                } else {
                    if ($e == 3) {
                        $c = str_split($b, 4);
                        $b = null;
                        foreach ($c as $a) {
                            $d = $a[1] . $a[2] . $a[3] . $a[0];
                            $b = $b . $d;
                        }
                    }
                }
            }
        } else {
            $b = null;
        }
        return $b;
    }
    static function Hex_Dont_Count($a)
    {
        $a = trim($a);
        $e = strlen($a);
        if ($e == pow(2, 5)) {
            $d = self::$change_9;
        } else {
            if ($e == pow(2, 6)) {
                $d = self::$change_2;
            } else {
                if ($e == pow(2, 7)) {
                    $d = self::$change_5;
                } else {
                    $d = self::$change_4;
                }
            }
        }
        for ($b = 0; $b <= $e; $b++) {
            if ($b + 1 < $e) {
                if ($a[$b] == $a[$b + 1]) {
                    if ($a[$b] == "a") {
                        $c = $a[$b];
                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_a);
                        if ($a[$b] == $c) {
                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                        }
                    } else {
                        if ($a[$b] == "b") {
                            $c = $a[$b];
                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_b);
                            if ($a[$b] == $c) {
                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                            }
                        } else {
                            if ($a[$b] == "c") {
                                $c = $a[$b];
                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_c);
                                if ($a[$b] == $c) {
                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                }
                            } else {
                                if ($a[$b] == "d") {
                                    $c = $a[$b];
                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_d);
                                    if ($a[$b] == $c) {
                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                    }
                                } else {
                                    if ($a[$b] == "e") {
                                        $c = $a[$b];
                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_e);
                                        if ($a[$b] == $c) {
                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                        }
                                    } else {
                                        if ($a[$b] == "f") {
                                            $c = $a[$b];
                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_f);
                                            if ($a[$b] == $c) {
                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                            }
                                        } else {
                                            if ($a[$b] == "0") {
                                                $c = $a[$b];
                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_0);
                                                if ($a[$b] == $c) {
                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                }
                                            } else {
                                                if ($a[$b] == "1") {
                                                    $c = $a[$b];
                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_1);
                                                    if ($a[$b] == $c) {
                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                    }
                                                } else {
                                                    if ($a[$b] == "2") {
                                                        $c = $a[$b];
                                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_2);
                                                        if ($a[$b] == $c) {
                                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                        }
                                                    } else {
                                                        if ($a[$b] == "3") {
                                                            $c = $a[$b];
                                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_3);
                                                            if ($a[$b] == $c) {
                                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                            }
                                                        } else {
                                                            if ($a[$b] == "4") {
                                                                $c = $a[$b];
                                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_4);
                                                                if ($a[$b] == $c) {
                                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                }
                                                            } else {
                                                                if ($a[$b] == "5") {
                                                                    $c = $a[$b];
                                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_5);
                                                                    if ($a[$b] == $c) {
                                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                    }
                                                                } else {
                                                                    if ($a[$b] == "6") {
                                                                        $c = $a[$b];
                                                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_6);
                                                                        if ($a[$b] == $c) {
                                                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                        }
                                                                    } else {
                                                                        if ($a[$b] == "7") {
                                                                            $c = $a[$b];
                                                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_7);
                                                                            if ($a[$b] == $c) {
                                                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                            }
                                                                        } else {
                                                                            if ($a[$b] == "8") {
                                                                                $c = $a[$b];
                                                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_8);
                                                                                if ($a[$b] == $c) {
                                                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                                }
                                                                            } else {
                                                                                if ($a[$b] == "9") {
                                                                                    $c = $a[$b];
                                                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_9);
                                                                                    if ($a[$b] == $c) {
                                                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                }
            }
        }
        return $a;
    }
    static function XOREncryption($a, $c)
    {
        $f = strlen($c);
        for ($b = 0; $b < strlen($a); $b++) {
            $d = $b % $f;
            $e = ord($a[$b]) ^ ord($c[$d]);
            $a[$b] = chr($e);
        }
        return $a;
    }
    static function XOREncrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function XORDecrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function bk_kb($a)
    {
        $c = "";
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if (strtolower($a[$b]) == $a[$b]) {
                $d = "0";
            } else {
                if (strtoupper($a[$b]) == $a[$b]) {
                    $d = "1";
                }
            }
            if ($d == "1") {
                $c = $c . strtolower($a[$b]);
            } else {
                if ($d == "0") {
                    $c = $c . strtoupper($a[$b]);
                }
            }
        }
        return $c;
    }
    static function Hex_Encrypt_Key($a, $c)
    {
        $c = self::Hex_Dont_Count(md5($c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == pow(2, 5)) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan);
            }
            if ($c[$d] == "a") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_a);
            }
            if ($c[$d] == "b") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_b);
            }
            if ($c[$d] == "c") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_c);
            }
            if ($c[$d] == "d") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_d);
            }
            if ($c[$d] == "e") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_e);
            }
            if ($c[$d] == "f") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_f);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_0);
            }
            if ($c[$d] == "1") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_1);
            }
            if ($c[$d] == "2") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_2);
            }
            if ($c[$d] == "3") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_3);
            }
            if ($c[$d] == "4") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_4);
            }
            if ($c[$d] == "5") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_5);
            }
            if ($c[$d] == "6") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_6);
            }
            if ($c[$d] == "7") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_7);
            }
            if ($c[$d] == "8") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_8);
            }
            if ($c[$d] == "9") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_9);
            }
            $d++;
        }
        return $a;
    }
    static function Hex_Decrypt_Key($a, $c)
    {
        $c = self::Hex_Dont_Count(md5($c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == pow(2, 5)) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan);
            }
            if ($c[$d] == "a") {
                $a[$b] = strtr($a[$b], self::$change_a, self::$hex_char);
            }
            if ($c[$d] == "b") {
                $a[$b] = strtr($a[$b], self::$change_b, self::$hex_char);
            }
            if ($c[$d] == "c") {
                $a[$b] = strtr($a[$b], self::$change_c, self::$hex_char);
            }
            if ($c[$d] == "d") {
                $a[$b] = strtr($a[$b], self::$change_d, self::$hex_char);
            }
            if ($c[$d] == "e") {
                $a[$b] = strtr($a[$b], self::$change_e, self::$hex_char);
            }
            if ($c[$d] == "f") {
                $a[$b] = strtr($a[$b], self::$change_f, self::$hex_char);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$change_0, self::$hex_char);
            }
            if ($c[$d] == "1") {
                $a[$b] = strtr($a[$b], self::$change_1, self::$hex_char);
            }
            if ($c[$d] == "2") {
                $a[$b] = strtr($a[$b], self::$change_2, self::$hex_char);
            }
            if ($c[$d] == "3") {
                $a[$b] = strtr($a[$b], self::$change_3, self::$hex_char);
            }
            if ($c[$d] == "4") {
                $a[$b] = strtr($a[$b], self::$change_4, self::$hex_char);
            }
            if ($c[$d] == "5") {
                $a[$b] = strtr($a[$b], self::$change_5, self::$hex_char);
            }
            if ($c[$d] == "6") {
                $a[$b] = strtr($a[$b], self::$change_6, self::$hex_char);
            }
            if ($c[$d] == "7") {
                $a[$b] = strtr($a[$b], self::$change_7, self::$hex_char);
            }
            if ($c[$d] == "8") {
                $a[$b] = strtr($a[$b], self::$change_8, self::$hex_char);
            }
            if ($c[$d] == "9") {
                $a[$b] = strtr($a[$b], self::$change_9, self::$hex_char);
            }
            $d++;
        }
        return $a;
    }
    static function encrypt_key($c, $a)
    {
        $c = self::Hex_Dont_Count(hash("md5", $c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == pow(2, 5)) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan1);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash0);
            } else {
                if ($c[$d] == "1") {
                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash1);
                } else {
                    if ($c[$d] == "2") {
                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash2);
                    } else {
                        if ($c[$d] == "3") {
                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash3);
                        } else {
                            if ($c[$d] == "4") {
                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash4);
                            } else {
                                if ($c[$d] == "5") {
                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash5);
                                } else {
                                    if ($c[$d] == "6") {
                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash6);
                                    } else {
                                        if ($c[$d] == "7") {
                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash7);
                                        } else {
                                            if ($c[$d] == "8") {
                                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash8);
                                            } else {
                                                if ($c[$d] == "9") {
                                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash9);
                                                } else {
                                                    if ($c[$d] == "a") {
                                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hasha);
                                                    } else {
                                                        if ($c[$d] == "b") {
                                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashb);
                                                        } else {
                                                            if ($c[$d] == "c") {
                                                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashc);
                                                            } else {
                                                                if ($c[$d] == "d") {
                                                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashd);
                                                                } else {
                                                                    if ($c[$d] == "e") {
                                                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashe);
                                                                    } else {
                                                                        if ($c[$d] == "f") {
                                                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashf);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $d++;
        }
        return $a;
    }
    static function decrypt_key($c, $a)
    {
        $c = self::Hex_Dont_Count(hash("md5", $c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == pow(2, 5)) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan1);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$hash0, self::$base64_characters);
            } else {
                if ($c[$d] == "1") {
                    $a[$b] = strtr($a[$b], self::$hash1, self::$base64_characters);
                } else {
                    if ($c[$d] == "2") {
                        $a[$b] = strtr($a[$b], self::$hash2, self::$base64_characters);
                    } else {
                        if ($c[$d] == "3") {
                            $a[$b] = strtr($a[$b], self::$hash3, self::$base64_characters);
                        } else {
                            if ($c[$d] == "4") {
                                $a[$b] = strtr($a[$b], self::$hash4, self::$base64_characters);
                            } else {
                                if ($c[$d] == "5") {
                                    $a[$b] = strtr($a[$b], self::$hash5, self::$base64_characters);
                                } else {
                                    if ($c[$d] == "6") {
                                        $a[$b] = strtr($a[$b], self::$hash6, self::$base64_characters);
                                    } else {
                                        if ($c[$d] == "7") {
                                            $a[$b] = strtr($a[$b], self::$hash7, self::$base64_characters);
                                        } else {
                                            if ($c[$d] == "8") {
                                                $a[$b] = strtr($a[$b], self::$hash8, self::$base64_characters);
                                            } else {
                                                if ($c[$d] == "9") {
                                                    $a[$b] = strtr($a[$b], self::$hash9, self::$base64_characters);
                                                } else {
                                                    if ($c[$d] == "a") {
                                                        $a[$b] = strtr($a[$b], self::$hasha, self::$base64_characters);
                                                    } else {
                                                        if ($c[$d] == "b") {
                                                            $a[$b] = strtr($a[$b], self::$hashb, self::$base64_characters);
                                                        } else {
                                                            if ($c[$d] == "c") {
                                                                $a[$b] = strtr($a[$b], self::$hashc, self::$base64_characters);
                                                            } else {
                                                                if ($c[$d] == "d") {
                                                                    $a[$b] = strtr($a[$b], self::$hashd, self::$base64_characters);
                                                                } else {
                                                                    if ($c[$d] == "e") {
                                                                        $a[$b] = strtr($a[$b], self::$hashe, self::$base64_characters);
                                                                    } else {
                                                                        if ($c[$d] == "f") {
                                                                            $a[$b] = strtr($a[$b], self::$hashf, self::$base64_characters);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $d++;
        }
        return $a;
    }
    static function E_hex_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_1($a)
    {
        $b = self::$hex_1;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_hex_2($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_2($a)
    {
        $b = self::$hex_2;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_hex_3($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_3($a)
    {
        $b = self::$hex_2;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator1($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator2($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtoXcode($a)
    {
        $b = self::$hex_characters;
        $c = self::$hXc;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtohash_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hth_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_4($a)
    {
        $b = self::$rot13_4;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    private static $salt_1_dat = array(null, 0.0, 0.0, 0.0, 0x661e23ca76af0334, 0.0, 0x100c42c3c9c7e9f3, 0x36ce98d6b199e785, 0x46100fe3f934b034, 0.0, 0x79daa5c944cbc586, 0x684ac13d4b307b9c, 0x13e9fab383110056, 0x457f532f932a162f, 0x182f3c17cfe4a06f, 0.0, 0x28bc4718ed57a1b4, 9.944646148322077, 0.0, 0x6afcf7fc8cf8ca81, 9.327748711822305, 1.8124095923182973, 0.0, 0x4310246e397ec0b4, 0x49e64a595583d7b1, 0.0, 0x3094ddda78aa529a, 0.0, 0x751926ac201a0ad9, 0x45dafc4ba4cbcd64, 0x675b05f9500f4cfa, 0x45713a1ec18c58c8, 1.4099206458880573, 0x6cbe789bdf4345bb, 0x180b595d20d8b103, 0x1f293f00b67ed388, 1.4112369965704587, 0.0, 0x331bc8e42cc3cef1, 0x76baf2bd606a8794, 0x234943b6f873bc3a, 0.0, 0x632ec44657aafee4, 0.0, 1.2806216388053064, 0x663d7c64a4aa625c, 0x1dae4ebd43023921, 0x7fbc88b1426813a9, 0xbf4c3738f049d40);
    private static $salt_2_dat = array(null, 0.0, 0.0, 0.0, 0x761926cf04adcf77, 0.0, 0x500f4cc3af2f6f47, 0x33df970e6a77391b, 0x4f1101a7bba453e7, 0.0, 1.5800107239009522, 0x5dc4c44ec99af427, 0.0, 0.0, 0x45cb8453364691f5, 0x7e3f24bcbdfc86af, 0.0, 0x2f2ca5da3f2fc753, 0.0, 0.0, 1.4479770205178526, 0x14b9498a8c79287a, 0.0, 0x13ae81f0691f32b5, 0.0, 0.0, 0.0, 0.0, 0x661e23ca76af0334, 0.0, 0x100c42c3c9c7e9f3, 0x36ce98d6b199e785, 0x46100fe3f934b034, 0.0, 0x79daa5c944cbc586, 0x684ac13d4b307b9c, 0x13e9fab383110056, 0x457f532f932a162f, 0x182f3c17cfe4a06f, 0.0, 0x28bc4718ed57a1b4, 9.944646148322077, 0.0, 0x6afcf7fc8cf8ca81, 9.327748711822305, 1.8124095923182973, 0.0, 0x4310246e397ec0b4, 0x49e64a595583d7b1);
    private static $salt_st_dat = array(null, 0.0, 0x3094ddda78aa529a, 0.0, 0x751926ac201a0ad9, 0x45dafc4ba4cbcd64, 0x675b05f9500f4cfa, 0x45713a1ec18c58c8, 1.4099206458880573, 0x6cbe789bdf4345bb, 0x180b595d20d8b103, 0x1f293f00b67ed388, 1.4112369965704587, 0.0, 0x331bc8e42cc3cef1, 0x76baf2bd606a8794, 0x234943b6f873bc3a, 0.0, 0x632ec44657aafee4, 0.0, 1.2806216388053064, 0x663d7c64a4aa625c, 0x1dae4ebd43023921, 0x7fbc88b1426813a9, 0xbf4c3738f049d40, 0.0, 0.0, 0.0, 0x761926cf04adcf77, 0.0, 0x500f4cc3af2f6f47, 0x33df970e6a77391b, 0x4f1101a7bba453e7, 0.0, 1.5800107239009522, 0x5dc4c44ec99af427, 0.0, 0.0, 0x45cb8453364691f5, 0x7e3f24bcbdfc86af, 0.0, 0x2f2ca5da3f2fc753, 0.0, 0.0, 1.4479770205178526, 0x14b9498a8c79287a, 0.0, 0x13ae81f0691f32b5, 0.0);
    private static $hex_char = "abcdef0123456789";
    private static $change_a = "0951ab326c7f4e8d";
    private static $change_b = "183daf026795ebc4";
    private static $change_c = "53840edc67f1ba29";
    private static $change_d = "9ac612fd74538e0b";
    private static $change_e = "72c0fbe64d9531a8";
    private static $change_f = "a10fe82cd746b593";
    private static $change_0 = "e7b8a246590c31df";
    private static $change_1 = "28b5ae9cd340617f";
    private static $change_2 = "17cf54839b062eda";
    private static $change_3 = "d98601f2bac4573e";
    private static $change_4 = "34b78915d0ae62fc";
    private static $change_5 = "5bef680329c1ad74";
    private static $change_6 = "df9b3a41c76e2580";
    private static $change_7 = "9374d21c50fe8b6a";
    private static $change_8 = "60f931edc7b5248a";
    private static $change_9 = "2173049b6cea85df";
    private static $hashchan = "4f571ae03b9cd268";
    private static $hashchan1 = "94c37de51f80b6a2";
    private static $hex_characters = "abcdef0123456789";
    private static $base64_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
    private static $hex_1 = "549e30c67ba2f81d";
    private static $hex_2 = "e326a51d04789fcb";
    private static $hex_3 = "3bd45206fec9a718";
    private static $hXc = "0132102013201203";
    private static $hth_1 = "61fa2bed734890c5";
    private static $rot13_1 = "4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
    private static $rot13_2 = "wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
    private static $rot13_3 = "h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
    private static $rot13_4 = "JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
    private static $hash0 = "Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";
    private static $hash1 = "752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";
    private static $hash2 = "4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";
    private static $hash3 = "p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
    private static $hash4 = "HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
    private static $hash5 = "fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
    private static $hash6 = "mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
    private static $hash7 = "EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
    private static $hash8 = "opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
    private static $hash9 = "mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
    private static $hasha = "VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
    private static $hashb = "08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
    private static $hashc = "D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
    private static $hashd = "3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
    private static $hashe = "hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";
    private static $hashf = "fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
class Antares_Crypt_v1_4
{
    static function Encrypt($d = null, $b = null, $j = null)
    {
        if ($j == true) {
            $d = gzcompress($d, 9);
        }
        $d = self::XOREncrypt($d, hex2bin(hash("sha512", $b)));
        $a = chr(0x33) . chr(0xfb) . chr(0xa4);
        $c = self::numHash($b, 1);
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $i = str_split($d, 256);
        $e = false;
        $f = false;
        $a = chr(0x12) . chr(0x69) . chr(0xf9);
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
                if ($h == 9) {
                    $h = 0;
                }
                $a = self::XOREncrypt($b, hex2bin(hash("sha512", $b . $a)));
                $b = hex2bin(self::Hex_Dont_Count(hash("whirlpool", $b . $a . $f[1])));
                $a = false;
                $a = chr(self::$salt_st_dat[$g]);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_st_dat[$c]));
                }
                if ($g == 9) {
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
    static function Decrypt($e = null, $b = null, $j = null)
    {
        if ($j == true) {
            $e = base64_encode($e);
        }
        $k = $b;
        $e = str_replace(" ", "", trim(str_replace("=", "", $e)));
        $a = chr(0x33) . chr(0xfb) . chr(0xa4);
        $c = self::numHash($b, 1);
        if ($c != 0) {
            $a = self::XOREncrypt($a, chr(self::$salt_1_dat[$c]));
        }
        $h = str_split($e, 684);
        $d = false;
        $a = chr(0x12) . chr(0x69) . chr(0xf9);
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
                if ($g == 9) {
                    $g = 0;
                }
                $a = self::XOREncrypt($b, hex2bin(hash("sha512", $b . $a)));
                $b = hex2bin(self::Hex_Dont_Count(hash("whirlpool", $b . $a . $i[1])));
                $a = false;
                $a = chr(self::$salt_st_dat[$f]);
                if ($c != 0) {
                    $a = self::XOREncrypt($a, chr(self::$salt_st_dat[$c]));
                }
                if ($f == 9) {
                    $f = 0;
                }
            }
            $d = $d . $i[0];
            $l++;
            $f++;
            $g++;
        }
        $d = self::XORDecrypt($d, hex2bin(hash("sha512", $k)));
        if ($j == true) {
            $d = gzuncompress($d);
        }
        return $d;
    }
    static function Enc($f, $c)
    {
        $g = $c;
        $j = str_split($f, 128);
        $d = false;
        $h = false;
        $e = 1;
        foreach ($j as $k) {
            $a = self::Crypt($k, "e", $c);
            if (strlen($f) > 128) {
                $b = false;
                $b = chr(self::$salt_2_dat[$e]);
                $i = self::numHash($c, 1);
                if ($i != 0) {
                    $b = self::XOREncrypt($b, chr(self::$salt_2_dat[$i]));
                }
                if ($e == 9) {
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
            if (strlen($f) > 128) {
                $c = false;
                $c = chr(self::$salt_2_dat[$e]);
                $i = self::numHash($d, 1);
                if ($i != 0) {
                    $c = self::XOREncrypt($c, chr(self::$salt_2_dat[$i]));
                }
                if ($e == 9) {
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
    static function Crypt($t, $x, $f)
    {
        $k = $f;
        $r = hex2bin(self::Hex_Dont_Count(hash("sha512", md5($k))));
        $f = self::Hex_Dont_Count(hash("sha512", $f . $r . chr(0x3f) . chr(0x6c) . chr(0x33)));
        $l = hex2bin(self::Hex_Dont_Count(hash("sha512", hex2bin($f))));
        $q = hex2bin(self::Hex_Dont_Count(hash("whirlpool", hex2bin(self::E_hex_1($f)))));
        $m = hex2bin(self::Hex_Dont_Count(hash("whirlpool", hex2bin(md5(self::XOREncrypt(hex2bin($f), $q))))));
        $h = self::hashtoXcode($f);
        $o = hex2bin(self::Hex_Dont_Count(hash("sha512", self::XOREncrypt($l, $k))));
        $p = hex2bin(self::Hex_Dont_Count(hash("sha512", hex2bin(hash("whirlpool", $q)))));
        if ($x == "e") {
            $a = $t;
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
            $i = self::Hex_Dont_Count(bin2hex(openssl_random_pseudo_bytes(64)));
            $d = 0;
            $e = false;
            $n = str_split($a, 1);
            $j = false;
            foreach ($n as $g) {
                if ($d == 128) {
                    $d = 0;
                    $i = self::Hex_Dont_Count(bin2hex(openssl_random_pseudo_bytes(64)));
                    $f = self::Hex_Dont_Count(hash("sha512", hex2bin($f) . $r . chr(0x33) . chr(0x99) . chr(0xb4)));
                    $h = self::hashtoXcode($f);
                }
                if ($h[$d] == 0) {
                    $e = $e . self::E_hex_1($g) . $i[$d];
                    $j = $j . $i[$d];
                } else {
                    if ($h[$d] == 1) {
                        $e = $e . $i[$d] . self::E_hex_2($g);
                        $j = $j . $i[$d];
                    } else {
                        if ($h[$d] == 2) {
                            $e = $e . self::E_hex_1($g) . self::hashtohash_1(self::hashtohash_1($i[$d]));
                            $j = $j . self::hashtohash_1(self::hashtohash_1($i[$d]));
                        } else {
                            if ($h[$d] == 3) {
                                $e = $e . self::hashtohash_1($i[$d]) . self::E_hex_2($g);
                                $j = $j . self::hashtohash_1($i[$d]);
                            }
                        }
                    }
                }
                $d++;
            }
            $s = $j;
            $n = false;
            $g = false;
            $e = self::E_hex_1($e);
            $b = hex2bin($e);
            $b = hex2bin(self::E_Shift(bin2hex($b), 3));
            $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $r));
            $b = hex2bin(self::E_hex_2(bin2hex($b)));
            $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $l));
            $b = hex2bin(self::E_hex_1(bin2hex($b)));
            $b = hex2bin(self::Hex_Encrypt_Key(bin2hex($b), $q));
            $b = hex2bin(self::E_Shift(bin2hex($b), 1));
            $b = hex2bin(self::E_hex_2(bin2hex($b)));
            $b = hex2bin(self::E_Shift(bin2hex($b), 3));
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
                $t = trim($t);
                $e = $t;
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
                $a = hex2bin(self::D_Shift(bin2hex($a), 3));
                $a = hex2bin(self::D_hex_2(bin2hex($a)));
                $a = hex2bin(self::D_Shift(bin2hex($a), 1));
                $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $q));
                $a = hex2bin(self::D_hex_1(bin2hex($a)));
                $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $l));
                $a = hex2bin(self::D_hex_2(bin2hex($a)));
                $a = hex2bin(self::Hex_Decrypt_Key(bin2hex($a), $r));
                $a = hex2bin(self::D_Shift(bin2hex($a), 3));
                $b = bin2hex($a);
                $b = self::D_hex_1($b);
                $n = str_split($b, 2);
                $e = false;
                $d = 0;
                $h = self::hashtoXcode($f);
                $u = false;
                foreach ($n as $g) {
                    if ($d == 128) {
                        $d = 0;
                        $f = self::Hex_Dont_Count(hash("sha512", hex2bin($f) . $r . chr(0x33) . chr(0x99) . chr(0xb4)));
                        $h = self::hashtoXcode($f);
                    }
                    if ($h[$d] == 0 or $h[$d] == 2) {
                        $w = self::D_hex_1(substr($g, 0, 1));
                        $j = substr($g, -1, 1);
                    } else {
                        if ($h[$d] == 1 or $h[$d] == 3) {
                            $w = self::D_hex_2(substr($g, -1, 1));
                            $j = substr($g, 0, 1);
                        }
                    }
                    $d++;
                    $e = $e . $w;
                    $u = $u . $j;
                }
                $s = $u;
                $n = false;
                $g = false;
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
                $v = $c;
            }
        }
        $s = hex2bin($s);
        return array($v, $s);
    }
    static function numHash($d, $a = null)
    {
        $e = md5($d, true);
        $c = unpack('N2', $e);
        $b = $c[1] . $c[2];
        if ($a && is_int($a)) {
            $b = substr($b, 0, $a);
        }
        return $b;
    }
    static function Raw_hexrev($a)
    {
        $b = str_split(bin2hex($a), 2);
        $a = null;
        foreach ($b as $c) {
            $a = $a . strrev($c);
        }
        return hex2bin($a);
    }
    static function E_Shift($b, $e)
    {
        if (strlen($b) % 4 == 0) {
            if ($e == 1) {
                $c = str_split($b, 4);
                $b = null;
                foreach ($c as $a) {
                    $d = $a[1] . $a[2] . $a[3] . $a[0];
                    $b = $b . $d;
                }
            } else {
                if ($e == 2) {
                    $c = str_split($b, 4);
                    $b = null;
                    foreach ($c as $a) {
                        $d = $a[2] . $a[3] . $a[0] . $a[1];
                        $b = $b . $d;
                    }
                } else {
                    if ($e == 3) {
                        $c = str_split($b, 4);
                        $b = null;
                        foreach ($c as $a) {
                            $d = $a[3] . $a[0] . $a[1] . $a[2];
                            $b = $b . $d;
                        }
                    }
                }
            }
        } else {
            $b = null;
        }
        return $b;
    }
    static function D_Shift($b, $e)
    {
        if (strlen($b) % 4 == 0) {
            if ($e == 1) {
                $c = str_split($b, 4);
                $b = null;
                foreach ($c as $a) {
                    $d = $a[3] . $a[0] . $a[1] . $a[2];
                    $b = $b . $d;
                }
            } else {
                if ($e == 2) {
                    $c = str_split($b, 4);
                    $b = null;
                    foreach ($c as $a) {
                        $d = $a[2] . $a[3] . $a[0] . $a[1];
                        $b = $b . $d;
                    }
                } else {
                    if ($e == 3) {
                        $c = str_split($b, 4);
                        $b = null;
                        foreach ($c as $a) {
                            $d = $a[1] . $a[2] . $a[3] . $a[0];
                            $b = $b . $d;
                        }
                    }
                }
            }
        } else {
            $b = null;
        }
        return $b;
    }
    static function Hex_Dont_Count($a)
    {
        $a = trim($a);
        $e = strlen($a);
        if ($e == 32) {
            $d = self::$change_9;
        } else {
            if ($e == 64) {
                $d = self::$change_2;
            } else {
                if ($e == 128) {
                    $d = self::$change_5;
                } else {
                    $d = self::$change_4;
                }
            }
        }
        for ($b = 0; $b <= $e; $b++) {
            if ($b + 1 < $e) {
                if ($a[$b] == $a[$b + 1]) {
                    if ($a[$b] == "a") {
                        $c = $a[$b];
                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_a);
                        if ($a[$b] == $c) {
                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                        }
                    } else {
                        if ($a[$b] == "b") {
                            $c = $a[$b];
                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_b);
                            if ($a[$b] == $c) {
                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                            }
                        } else {
                            if ($a[$b] == "c") {
                                $c = $a[$b];
                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_c);
                                if ($a[$b] == $c) {
                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                }
                            } else {
                                if ($a[$b] == "d") {
                                    $c = $a[$b];
                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_d);
                                    if ($a[$b] == $c) {
                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                    }
                                } else {
                                    if ($a[$b] == "e") {
                                        $c = $a[$b];
                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_e);
                                        if ($a[$b] == $c) {
                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                        }
                                    } else {
                                        if ($a[$b] == "f") {
                                            $c = $a[$b];
                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_f);
                                            if ($a[$b] == $c) {
                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                            }
                                        } else {
                                            if ($a[$b] == "0") {
                                                $c = $a[$b];
                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_0);
                                                if ($a[$b] == $c) {
                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                }
                                            } else {
                                                if ($a[$b] == "1") {
                                                    $c = $a[$b];
                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_1);
                                                    if ($a[$b] == $c) {
                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                    }
                                                } else {
                                                    if ($a[$b] == "2") {
                                                        $c = $a[$b];
                                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_2);
                                                        if ($a[$b] == $c) {
                                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                        }
                                                    } else {
                                                        if ($a[$b] == "3") {
                                                            $c = $a[$b];
                                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_3);
                                                            if ($a[$b] == $c) {
                                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                            }
                                                        } else {
                                                            if ($a[$b] == "4") {
                                                                $c = $a[$b];
                                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_4);
                                                                if ($a[$b] == $c) {
                                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                }
                                                            } else {
                                                                if ($a[$b] == "5") {
                                                                    $c = $a[$b];
                                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_5);
                                                                    if ($a[$b] == $c) {
                                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                    }
                                                                } else {
                                                                    if ($a[$b] == "6") {
                                                                        $c = $a[$b];
                                                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_6);
                                                                        if ($a[$b] == $c) {
                                                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                        }
                                                                    } else {
                                                                        if ($a[$b] == "7") {
                                                                            $c = $a[$b];
                                                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_7);
                                                                            if ($a[$b] == $c) {
                                                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                            }
                                                                        } else {
                                                                            if ($a[$b] == "8") {
                                                                                $c = $a[$b];
                                                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_8);
                                                                                if ($a[$b] == $c) {
                                                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                                }
                                                                            } else {
                                                                                if ($a[$b] == "9") {
                                                                                    $c = $a[$b];
                                                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_9);
                                                                                    if ($a[$b] == $c) {
                                                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                }
            }
        }
        return $a;
    }
    static function XOREncryption($a, $c)
    {
        $f = strlen($c);
        for ($b = 0; $b < strlen($a); $b++) {
            $d = $b % $f;
            $e = ord($a[$b]) ^ ord($c[$d]);
            $a[$b] = chr($e);
        }
        return $a;
    }
    static function XOREncrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function XORDecrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function bk_kb($a)
    {
        $c = "";
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if (strtolower($a[$b]) == $a[$b]) {
                $d = "0";
            } else {
                if (strtoupper($a[$b]) == $a[$b]) {
                    $d = "1";
                }
            }
            if ($d == "1") {
                $c = $c . strtolower($a[$b]);
            } else {
                if ($d == "0") {
                    $c = $c . strtoupper($a[$b]);
                }
            }
        }
        return $c;
    }
    static function Hex_Encrypt_Key($a, $c)
    {
        $c = self::Hex_Dont_Count(md5($c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == 32) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan);
            }
            if ($c[$d] == "a") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_a);
            }
            if ($c[$d] == "b") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_b);
            }
            if ($c[$d] == "c") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_c);
            }
            if ($c[$d] == "d") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_d);
            }
            if ($c[$d] == "e") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_e);
            }
            if ($c[$d] == "f") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_f);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_0);
            }
            if ($c[$d] == "1") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_1);
            }
            if ($c[$d] == "2") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_2);
            }
            if ($c[$d] == "3") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_3);
            }
            if ($c[$d] == "4") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_4);
            }
            if ($c[$d] == "5") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_5);
            }
            if ($c[$d] == "6") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_6);
            }
            if ($c[$d] == "7") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_7);
            }
            if ($c[$d] == "8") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_8);
            }
            if ($c[$d] == "9") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_9);
            }
            $d++;
        }
        return $a;
    }
    static function Hex_Decrypt_Key($a, $c)
    {
        $c = self::Hex_Dont_Count(md5($c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == 32) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan);
            }
            if ($c[$d] == "a") {
                $a[$b] = strtr($a[$b], self::$change_a, self::$hex_char);
            }
            if ($c[$d] == "b") {
                $a[$b] = strtr($a[$b], self::$change_b, self::$hex_char);
            }
            if ($c[$d] == "c") {
                $a[$b] = strtr($a[$b], self::$change_c, self::$hex_char);
            }
            if ($c[$d] == "d") {
                $a[$b] = strtr($a[$b], self::$change_d, self::$hex_char);
            }
            if ($c[$d] == "e") {
                $a[$b] = strtr($a[$b], self::$change_e, self::$hex_char);
            }
            if ($c[$d] == "f") {
                $a[$b] = strtr($a[$b], self::$change_f, self::$hex_char);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$change_0, self::$hex_char);
            }
            if ($c[$d] == "1") {
                $a[$b] = strtr($a[$b], self::$change_1, self::$hex_char);
            }
            if ($c[$d] == "2") {
                $a[$b] = strtr($a[$b], self::$change_2, self::$hex_char);
            }
            if ($c[$d] == "3") {
                $a[$b] = strtr($a[$b], self::$change_3, self::$hex_char);
            }
            if ($c[$d] == "4") {
                $a[$b] = strtr($a[$b], self::$change_4, self::$hex_char);
            }
            if ($c[$d] == "5") {
                $a[$b] = strtr($a[$b], self::$change_5, self::$hex_char);
            }
            if ($c[$d] == "6") {
                $a[$b] = strtr($a[$b], self::$change_6, self::$hex_char);
            }
            if ($c[$d] == "7") {
                $a[$b] = strtr($a[$b], self::$change_7, self::$hex_char);
            }
            if ($c[$d] == "8") {
                $a[$b] = strtr($a[$b], self::$change_8, self::$hex_char);
            }
            if ($c[$d] == "9") {
                $a[$b] = strtr($a[$b], self::$change_9, self::$hex_char);
            }
            $d++;
        }
        return $a;
    }
    static function encrypt_key($c, $a)
    {
        $c = self::Hex_Dont_Count(hash("md5", $c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == 32) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan1);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash0);
            } else {
                if ($c[$d] == "1") {
                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash1);
                } else {
                    if ($c[$d] == "2") {
                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash2);
                    } else {
                        if ($c[$d] == "3") {
                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash3);
                        } else {
                            if ($c[$d] == "4") {
                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash4);
                            } else {
                                if ($c[$d] == "5") {
                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash5);
                                } else {
                                    if ($c[$d] == "6") {
                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash6);
                                    } else {
                                        if ($c[$d] == "7") {
                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash7);
                                        } else {
                                            if ($c[$d] == "8") {
                                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash8);
                                            } else {
                                                if ($c[$d] == "9") {
                                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash9);
                                                } else {
                                                    if ($c[$d] == "a") {
                                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hasha);
                                                    } else {
                                                        if ($c[$d] == "b") {
                                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashb);
                                                        } else {
                                                            if ($c[$d] == "c") {
                                                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashc);
                                                            } else {
                                                                if ($c[$d] == "d") {
                                                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashd);
                                                                } else {
                                                                    if ($c[$d] == "e") {
                                                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashe);
                                                                    } else {
                                                                        if ($c[$d] == "f") {
                                                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashf);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $d++;
        }
        return $a;
    }
    static function decrypt_key($c, $a)
    {
        $c = self::Hex_Dont_Count(hash("md5", $c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == 32) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan1);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$hash0, self::$base64_characters);
            } else {
                if ($c[$d] == "1") {
                    $a[$b] = strtr($a[$b], self::$hash1, self::$base64_characters);
                } else {
                    if ($c[$d] == "2") {
                        $a[$b] = strtr($a[$b], self::$hash2, self::$base64_characters);
                    } else {
                        if ($c[$d] == "3") {
                            $a[$b] = strtr($a[$b], self::$hash3, self::$base64_characters);
                        } else {
                            if ($c[$d] == "4") {
                                $a[$b] = strtr($a[$b], self::$hash4, self::$base64_characters);
                            } else {
                                if ($c[$d] == "5") {
                                    $a[$b] = strtr($a[$b], self::$hash5, self::$base64_characters);
                                } else {
                                    if ($c[$d] == "6") {
                                        $a[$b] = strtr($a[$b], self::$hash6, self::$base64_characters);
                                    } else {
                                        if ($c[$d] == "7") {
                                            $a[$b] = strtr($a[$b], self::$hash7, self::$base64_characters);
                                        } else {
                                            if ($c[$d] == "8") {
                                                $a[$b] = strtr($a[$b], self::$hash8, self::$base64_characters);
                                            } else {
                                                if ($c[$d] == "9") {
                                                    $a[$b] = strtr($a[$b], self::$hash9, self::$base64_characters);
                                                } else {
                                                    if ($c[$d] == "a") {
                                                        $a[$b] = strtr($a[$b], self::$hasha, self::$base64_characters);
                                                    } else {
                                                        if ($c[$d] == "b") {
                                                            $a[$b] = strtr($a[$b], self::$hashb, self::$base64_characters);
                                                        } else {
                                                            if ($c[$d] == "c") {
                                                                $a[$b] = strtr($a[$b], self::$hashc, self::$base64_characters);
                                                            } else {
                                                                if ($c[$d] == "d") {
                                                                    $a[$b] = strtr($a[$b], self::$hashd, self::$base64_characters);
                                                                } else {
                                                                    if ($c[$d] == "e") {
                                                                        $a[$b] = strtr($a[$b], self::$hashe, self::$base64_characters);
                                                                    } else {
                                                                        if ($c[$d] == "f") {
                                                                            $a[$b] = strtr($a[$b], self::$hashf, self::$base64_characters);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $d++;
        }
        return $a;
    }
    static function E_hex_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_1($a)
    {
        $b = self::$hex_1;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_hex_2($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_2($a)
    {
        $b = self::$hex_2;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_hex_3($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_3($a)
    {
        $b = self::$hex_2;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator1($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator2($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtoXcode($a)
    {
        $b = self::$hex_characters;
        $c = self::$hXc;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtohash_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hth_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_4($a)
    {
        $b = self::$rot13_4;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    private static $salt_1_dat = array(null, 0xb6344e, 0xe33dae, 0xeb4899, 0x661e23, 0xe3af62, 0x100c42, 0x36ce98, 0x46100f, 0x91a745);
    private static $salt_2_dat = array(null, 0xc6a44b, 0xeeadaa, 0xffcced, 0x761926, 0xe6cf52, 0x500f4c, 0x33df97, 0x4f1101, 0x92a855);
    private static $salt_st_dat = array(null, 0xaf4dca, 0x3094dd, 0xdc4a65, 0x751926, 0x45dafc, 0x500f4c, 0x457158, 0xc47842, 0xdf4345);
    private static $hex_char = "abcdef0123456789";
    private static $change_a = "0951ab326c7f4e8d";
    private static $change_b = "183daf026795ebc4";
    private static $change_c = "53840edc67f1ba29";
    private static $change_d = "9ac612fd74538e0b";
    private static $change_e = "72c0fbe64d9531a8";
    private static $change_f = "a10fe82cd746b593";
    private static $change_0 = "e7b8a246590c31df";
    private static $change_1 = "28b5ae9cd340617f";
    private static $change_2 = "17cf54839b062eda";
    private static $change_3 = "d98601f2bac4573e";
    private static $change_4 = "34b78915d0ae62fc";
    private static $change_5 = "5bef680329c1ad74";
    private static $change_6 = "df9b3a41c76e2580";
    private static $change_7 = "9374d21c50fe8b6a";
    private static $change_8 = "60f931edc7b5248a";
    private static $change_9 = "2173049b6cea85df";
    private static $hashchan = "4f571ae03b9cd268";
    private static $hashchan1 = "94c37de51f80b6a2";
    private static $hex_characters = "abcdef0123456789";
    private static $base64_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
    private static $hex_1 = "549e30c67ba2f81d";
    private static $hex_2 = "e326a51d04789fcb";
    private static $hex_3 = "3bd45206fec9a718";
    private static $hXc = "0132102013201203";
    private static $hth_1 = "61fa2bed734890c5";
    private static $rot13_1 = "4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
    private static $rot13_2 = "wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
    private static $rot13_3 = "h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
    private static $rot13_4 = "JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
    private static $hash0 = "Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";
    private static $hash1 = "752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";
    private static $hash2 = "4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";
    private static $hash3 = "p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
    private static $hash4 = "HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
    private static $hash5 = "fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
    private static $hash6 = "mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
    private static $hash7 = "EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
    private static $hash8 = "opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
    private static $hash9 = "mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
    private static $hasha = "VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
    private static $hashb = "08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
    private static $hashc = "D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
    private static $hashd = "3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
    private static $hashe = "hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";
    private static $hashf = "fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
class Antares_Crypt_v1_3_no_compress
{
    static function Encrypt($j, $b)
    {
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
    static function Decrypt($d, $b)
    {
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
    static function numHash($d, $a = null)
    {
        $e = md5($d, true);
        $c = unpack('N2', $e);
        $b = $c[1] . $c[2];
        if ($a && is_int($a)) {
            $b = substr($b, 0, $a);
        }
        return $b;
    }
    static function Raw_hexrev($a)
    {
        $b = str_split(bin2hex($a), 2);
        $a = null;
        foreach ($b as $c) {
            $a = $a . strrev($c);
        }
        return hex2bin($a);
    }
    static function E_Shift($b, $e)
    {
        if (strlen($b) % 4 == 0) {
            if ($e == 1) {
                $c = str_split($b, 4);
                $b = null;
                foreach ($c as $a) {
                    $d = $a[1] . $a[2] . $a[3] . $a[0];
                    $b = $b . $d;
                }
            } else {
                if ($e == 2) {
                    $c = str_split($b, 4);
                    $b = null;
                    foreach ($c as $a) {
                        $d = $a[2] . $a[3] . $a[0] . $a[1];
                        $b = $b . $d;
                    }
                } else {
                    if ($e == 3) {
                        $c = str_split($b, 4);
                        $b = null;
                        foreach ($c as $a) {
                            $d = $a[3] . $a[0] . $a[1] . $a[2];
                            $b = $b . $d;
                        }
                    }
                }
            }
        } else {
            $b = null;
        }
        return $b;
    }
    static function D_Shift($b, $e)
    {
        if (strlen($b) % 4 == 0) {
            if ($e == 1) {
                $c = str_split($b, 4);
                $b = null;
                foreach ($c as $a) {
                    $d = $a[3] . $a[0] . $a[1] . $a[2];
                    $b = $b . $d;
                }
            } else {
                if ($e == 2) {
                    $c = str_split($b, 4);
                    $b = null;
                    foreach ($c as $a) {
                        $d = $a[2] . $a[3] . $a[0] . $a[1];
                        $b = $b . $d;
                    }
                } else {
                    if ($e == 3) {
                        $c = str_split($b, 4);
                        $b = null;
                        foreach ($c as $a) {
                            $d = $a[1] . $a[2] . $a[3] . $a[0];
                            $b = $b . $d;
                        }
                    }
                }
            }
        } else {
            $b = null;
        }
        return $b;
    }
    static function Hex_Dont_Count($a)
    {
        $a = trim($a);
        $e = strlen($a);
        if ($e == 32) {
            $d = self::$change_9;
        } else {
            if ($e == 64) {
                $d = self::$change_2;
            } else {
                if ($e == 128) {
                    $d = self::$change_5;
                } else {
                    $d = self::$change_4;
                }
            }
        }
        for ($b = 0; $b <= $e; $b++) {
            if ($b + 1 < $e) {
                if ($a[$b] == $a[$b + 1]) {
                    if ($a[$b] == "a") {
                        $c = $a[$b];
                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_a);
                        if ($a[$b] == $c) {
                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                        }
                    } else {
                        if ($a[$b] == "b") {
                            $c = $a[$b];
                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_b);
                            if ($a[$b] == $c) {
                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                            }
                        } else {
                            if ($a[$b] == "c") {
                                $c = $a[$b];
                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_c);
                                if ($a[$b] == $c) {
                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                }
                            } else {
                                if ($a[$b] == "d") {
                                    $c = $a[$b];
                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_d);
                                    if ($a[$b] == $c) {
                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                    }
                                } else {
                                    if ($a[$b] == "e") {
                                        $c = $a[$b];
                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_e);
                                        if ($a[$b] == $c) {
                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                        }
                                    } else {
                                        if ($a[$b] == "f") {
                                            $c = $a[$b];
                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_f);
                                            if ($a[$b] == $c) {
                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                            }
                                        } else {
                                            if ($a[$b] == "0") {
                                                $c = $a[$b];
                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_0);
                                                if ($a[$b] == $c) {
                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                }
                                            } else {
                                                if ($a[$b] == "1") {
                                                    $c = $a[$b];
                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_1);
                                                    if ($a[$b] == $c) {
                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                    }
                                                } else {
                                                    if ($a[$b] == "2") {
                                                        $c = $a[$b];
                                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_2);
                                                        if ($a[$b] == $c) {
                                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                        }
                                                    } else {
                                                        if ($a[$b] == "3") {
                                                            $c = $a[$b];
                                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_3);
                                                            if ($a[$b] == $c) {
                                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                            }
                                                        } else {
                                                            if ($a[$b] == "4") {
                                                                $c = $a[$b];
                                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_4);
                                                                if ($a[$b] == $c) {
                                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                }
                                                            } else {
                                                                if ($a[$b] == "5") {
                                                                    $c = $a[$b];
                                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_5);
                                                                    if ($a[$b] == $c) {
                                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                    }
                                                                } else {
                                                                    if ($a[$b] == "6") {
                                                                        $c = $a[$b];
                                                                        $a[$b] = strtr($a[$b], self::$hex_char, self::$change_6);
                                                                        if ($a[$b] == $c) {
                                                                            $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                        }
                                                                    } else {
                                                                        if ($a[$b] == "7") {
                                                                            $c = $a[$b];
                                                                            $a[$b] = strtr($a[$b], self::$hex_char, self::$change_7);
                                                                            if ($a[$b] == $c) {
                                                                                $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                            }
                                                                        } else {
                                                                            if ($a[$b] == "8") {
                                                                                $c = $a[$b];
                                                                                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_8);
                                                                                if ($a[$b] == $c) {
                                                                                    $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                                }
                                                                            } else {
                                                                                if ($a[$b] == "9") {
                                                                                    $c = $a[$b];
                                                                                    $a[$b] = strtr($a[$b], self::$hex_char, self::$change_9);
                                                                                    if ($a[$b] == $c) {
                                                                                        $a[$b] = strtr($a[$b], self::$hex_char, $d);
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                    $a[$b + 1] = strtr($a[$b + 1], self::$hex_char, $d);
                }
            }
        }
        return $a;
    }
    static function XOREncryption($a, $c)
    {
        $f = strlen($c);
        for ($b = 0; $b < strlen($a); $b++) {
            $d = $b % $f;
            $e = ord($a[$b]) ^ ord($c[$d]);
            $a[$b] = chr($e);
        }
        return $a;
    }
    static function XOREncrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function XORDecrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function bk_kb($a)
    {
        $c = "";
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if (strtolower($a[$b]) == $a[$b]) {
                $d = "0";
            } else {
                if (strtoupper($a[$b]) == $a[$b]) {
                    $d = "1";
                }
            }
            if ($d == "1") {
                $c = $c . strtolower($a[$b]);
            } else {
                if ($d == "0") {
                    $c = $c . strtoupper($a[$b]);
                }
            }
        }
        return $c;
    }
    static function E_death_round($a, $d, $b)
    {
        $a = strrev($a);
        $f = str_split(trim($d));
        for ($e = 0; $e <= strlen(trim($d)) - 1; $e++) {
            $c = $f[$e];
            if ($c == "0") {
                $a = strtr($a, self::$base64_characters, self::$rot13_2);
                $a = strtr($a, self::$base64_characters, self::$hashb);
                $a = self::Hex_Encrypt_Key($a, $b);
                $a = self::encrypt_key($b, $a);
                $a = strtr($a, self::$base64_characters, self::$hash2);
            }
            if ($c == "1") {
                $a = strtr($a, self::$base64_characters, self::$hashf);
                $a = self::encrypt_key($b, $a);
                $a = strtr($a, self::$base64_characters, self::$hash6);
                $a = self::Hex_Encrypt_Key($a, $b);
                $a = strtr($a, self::$base64_characters, self::$hash1);
            }
            if ($c == "2") {
                $a = strtr($a, self::$base64_characters, self::$hashd);
                $a = strtr($a, self::$base64_characters, self::$rot13_1);
                $a = strtr($a, self::$base64_characters, self::$hash0);
                $a = self::encrypt_key($b, $a);
                $a = strtr($a, self::$base64_characters, self::$hash3);
            }
            if ($c == "3") {
                $a = self::Hex_Encrypt_Key($a, $b);
                $a = strtr($a, self::$base64_characters, self::$hash4);
                $a = self::bk_kb($a);
                $a = self::Hex_Encrypt_Key($a, $b);
                $a = strrev($a);
            }
            if ($c == "4") {
                $a = strtr($a, self::$base64_characters, self::$rot13_3);
                $a = strtr($a, self::$base64_characters, self::$hash8);
                $a = strtr($a, self::$base64_characters, self::$hash9);
                $a = strtr($a, self::$base64_characters, self::$hasha);
                $a = self::encrypt_key($b, $a);
            }
            if ($c == "5") {
                $a = self::Hex_Encrypt_Key($a, $b);
                $a = strtr($a, self::$base64_characters, self::$rot13_4);
                $a = strrev($a);
                $a = self::encrypt_key($b, $a);
                $a = self::bk_kb($a);
            }
            if ($c == "6") {
                $a = strtr($a, self::$base64_characters, self::$hash5);
                $a = self::bk_kb($a);
                $a = strrev($a);
                $a = strtr($a, self::$base64_characters, self::$hashe);
                $a = strtr($a, self::$base64_characters, self::$rot13_4);
            }
            if ($c == "7") {
                $a = self::Hex_Encrypt_Key($a, $b);
                $a = strtr($a, self::$base64_characters, self::$hash7);
                $a = strtr($a, self::$base64_characters, self::$hashc);
                $a = strrev($a);
                $a = self::encrypt_key($b, $a);
            }
        }
        $a = self::encrypt_key($b, $a);
        return $a;
    }
    static function D_death_round($a, $d, $b)
    {
        $a = self::decrypt_key($b, $a);
        $f = str_split(strrev($d));
        for ($e = 0; $e <= strlen(strrev($d)) - 1; $e++) {
            $c = $f[$e];
            if ($c == "0") {
                $a = strtr($a, self::$hash2, self::$base64_characters);
                $a = self::decrypt_key($b, $a);
                $a = self::Hex_Decrypt_Key($a, $b);
                $a = strtr($a, self::$hashb, self::$base64_characters);
                $a = strtr($a, self::$rot13_2, self::$base64_characters);
            }
            if ($c == "1") {
                $a = strtr($a, self::$hash1, self::$base64_characters);
                $a = self::Hex_Decrypt_Key($a, $b);
                $a = strtr($a, self::$hash6, self::$base64_characters);
                $a = self::decrypt_key($b, $a);
                $a = strtr($a, self::$hashf, self::$base64_characters);
            }
            if ($c == "2") {
                $a = strtr($a, self::$hash3, self::$base64_characters);
                $a = self::decrypt_key($b, $a);
                $a = strtr($a, self::$hash0, self::$base64_characters);
                $a = strtr($a, self::$rot13_1, self::$base64_characters);
                $a = strtr($a, self::$hashd, self::$base64_characters);
            }
            if ($c == "3") {
                $a = strrev($a);
                $a = self::Hex_Decrypt_Key($a, $b);
                $a = self::bk_kb($a);
                $a = strtr($a, self::$hash4, self::$base64_characters);
                $a = self::Hex_Decrypt_Key($a, $b);
            }
            if ($c == "4") {
                $a = self::decrypt_key($b, $a);
                $a = strtr($a, self::$hasha, self::$base64_characters);
                $a = strtr($a, self::$hash9, self::$base64_characters);
                $a = strtr($a, self::$hash8, self::$base64_characters);
                $a = strtr($a, self::$rot13_3, self::$base64_characters);
            }
            if ($c == "5") {
                $a = self::bk_kb($a);
                $a = self::decrypt_key($b, $a);
                $a = strrev($a);
                $a = strtr($a, self::$rot13_4, self::$base64_characters);
                $a = self::Hex_Decrypt_Key($a, $b);
            }
            if ($c == "6") {
                $a = strtr($a, self::$rot13_4, self::$base64_characters);
                $a = strtr($a, self::$hashe, self::$base64_characters);
                $a = strrev($a);
                $a = self::bk_kb($a);
                $a = strtr($a, self::$hash5, self::$base64_characters);
            }
            if ($c == "7") {
                $a = self::decrypt_key($b, $a);
                $a = strrev($a);
                $a = strtr($a, self::$hashc, self::$base64_characters);
                $a = strtr($a, self::$hash7, self::$base64_characters);
                $a = self::Hex_Decrypt_Key($a, $b);
            }
        }
        $a = strrev($a);
        return $a;
    }
    static function Hex_Encrypt_Key($a, $c)
    {
        $c = self::Hex_Dont_Count(md5($c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == 32) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan);
            }
            if ($c[$d] == "a") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_a);
            }
            if ($c[$d] == "b") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_b);
            }
            if ($c[$d] == "c") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_c);
            }
            if ($c[$d] == "d") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_d);
            }
            if ($c[$d] == "e") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_e);
            }
            if ($c[$d] == "f") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_f);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_0);
            }
            if ($c[$d] == "1") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_1);
            }
            if ($c[$d] == "2") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_2);
            }
            if ($c[$d] == "3") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_3);
            }
            if ($c[$d] == "4") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_4);
            }
            if ($c[$d] == "5") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_5);
            }
            if ($c[$d] == "6") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_6);
            }
            if ($c[$d] == "7") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_7);
            }
            if ($c[$d] == "8") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_8);
            }
            if ($c[$d] == "9") {
                $a[$b] = strtr($a[$b], self::$hex_char, self::$change_9);
            }
            $d++;
        }
        return $a;
    }
    static function Hex_Decrypt_Key($a, $c)
    {
        $c = self::Hex_Dont_Count(md5($c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == 32) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan);
            }
            if ($c[$d] == "a") {
                $a[$b] = strtr($a[$b], self::$change_a, self::$hex_char);
            }
            if ($c[$d] == "b") {
                $a[$b] = strtr($a[$b], self::$change_b, self::$hex_char);
            }
            if ($c[$d] == "c") {
                $a[$b] = strtr($a[$b], self::$change_c, self::$hex_char);
            }
            if ($c[$d] == "d") {
                $a[$b] = strtr($a[$b], self::$change_d, self::$hex_char);
            }
            if ($c[$d] == "e") {
                $a[$b] = strtr($a[$b], self::$change_e, self::$hex_char);
            }
            if ($c[$d] == "f") {
                $a[$b] = strtr($a[$b], self::$change_f, self::$hex_char);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$change_0, self::$hex_char);
            }
            if ($c[$d] == "1") {
                $a[$b] = strtr($a[$b], self::$change_1, self::$hex_char);
            }
            if ($c[$d] == "2") {
                $a[$b] = strtr($a[$b], self::$change_2, self::$hex_char);
            }
            if ($c[$d] == "3") {
                $a[$b] = strtr($a[$b], self::$change_3, self::$hex_char);
            }
            if ($c[$d] == "4") {
                $a[$b] = strtr($a[$b], self::$change_4, self::$hex_char);
            }
            if ($c[$d] == "5") {
                $a[$b] = strtr($a[$b], self::$change_5, self::$hex_char);
            }
            if ($c[$d] == "6") {
                $a[$b] = strtr($a[$b], self::$change_6, self::$hex_char);
            }
            if ($c[$d] == "7") {
                $a[$b] = strtr($a[$b], self::$change_7, self::$hex_char);
            }
            if ($c[$d] == "8") {
                $a[$b] = strtr($a[$b], self::$change_8, self::$hex_char);
            }
            if ($c[$d] == "9") {
                $a[$b] = strtr($a[$b], self::$change_9, self::$hex_char);
            }
            $d++;
        }
        return $a;
    }
    static function encrypt_key($c, $a)
    {
        $c = self::Hex_Dont_Count(hash("md5", $c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == 32) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan1);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash0);
            } else {
                if ($c[$d] == "1") {
                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash1);
                } else {
                    if ($c[$d] == "2") {
                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash2);
                    } else {
                        if ($c[$d] == "3") {
                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash3);
                        } else {
                            if ($c[$d] == "4") {
                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash4);
                            } else {
                                if ($c[$d] == "5") {
                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash5);
                                } else {
                                    if ($c[$d] == "6") {
                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash6);
                                    } else {
                                        if ($c[$d] == "7") {
                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash7);
                                        } else {
                                            if ($c[$d] == "8") {
                                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash8);
                                            } else {
                                                if ($c[$d] == "9") {
                                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hash9);
                                                } else {
                                                    if ($c[$d] == "a") {
                                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hasha);
                                                    } else {
                                                        if ($c[$d] == "b") {
                                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashb);
                                                        } else {
                                                            if ($c[$d] == "c") {
                                                                $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashc);
                                                            } else {
                                                                if ($c[$d] == "d") {
                                                                    $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashd);
                                                                } else {
                                                                    if ($c[$d] == "e") {
                                                                        $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashe);
                                                                    } else {
                                                                        if ($c[$d] == "f") {
                                                                            $a[$b] = strtr($a[$b], self::$base64_characters, self::$hashf);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $d++;
        }
        return $a;
    }
    static function decrypt_key($c, $a)
    {
        $c = self::Hex_Dont_Count(hash("md5", $c));
        $d = 0;
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if ($d == 32) {
                $d = 0;
                $c = strtr($c, self::$hex_char, self::$hashchan1);
            }
            if ($c[$d] == "0") {
                $a[$b] = strtr($a[$b], self::$hash0, self::$base64_characters);
            } else {
                if ($c[$d] == "1") {
                    $a[$b] = strtr($a[$b], self::$hash1, self::$base64_characters);
                } else {
                    if ($c[$d] == "2") {
                        $a[$b] = strtr($a[$b], self::$hash2, self::$base64_characters);
                    } else {
                        if ($c[$d] == "3") {
                            $a[$b] = strtr($a[$b], self::$hash3, self::$base64_characters);
                        } else {
                            if ($c[$d] == "4") {
                                $a[$b] = strtr($a[$b], self::$hash4, self::$base64_characters);
                            } else {
                                if ($c[$d] == "5") {
                                    $a[$b] = strtr($a[$b], self::$hash5, self::$base64_characters);
                                } else {
                                    if ($c[$d] == "6") {
                                        $a[$b] = strtr($a[$b], self::$hash6, self::$base64_characters);
                                    } else {
                                        if ($c[$d] == "7") {
                                            $a[$b] = strtr($a[$b], self::$hash7, self::$base64_characters);
                                        } else {
                                            if ($c[$d] == "8") {
                                                $a[$b] = strtr($a[$b], self::$hash8, self::$base64_characters);
                                            } else {
                                                if ($c[$d] == "9") {
                                                    $a[$b] = strtr($a[$b], self::$hash9, self::$base64_characters);
                                                } else {
                                                    if ($c[$d] == "a") {
                                                        $a[$b] = strtr($a[$b], self::$hasha, self::$base64_characters);
                                                    } else {
                                                        if ($c[$d] == "b") {
                                                            $a[$b] = strtr($a[$b], self::$hashb, self::$base64_characters);
                                                        } else {
                                                            if ($c[$d] == "c") {
                                                                $a[$b] = strtr($a[$b], self::$hashc, self::$base64_characters);
                                                            } else {
                                                                if ($c[$d] == "d") {
                                                                    $a[$b] = strtr($a[$b], self::$hashd, self::$base64_characters);
                                                                } else {
                                                                    if ($c[$d] == "e") {
                                                                        $a[$b] = strtr($a[$b], self::$hashe, self::$base64_characters);
                                                                    } else {
                                                                        if ($c[$d] == "f") {
                                                                            $a[$b] = strtr($a[$b], self::$hashf, self::$base64_characters);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $d++;
        }
        return $a;
    }
    static function E_hex_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_1($a)
    {
        $b = self::$hex_1;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_hex_2($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_2($a)
    {
        $b = self::$hex_2;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_hex_3($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_3($a)
    {
        $b = self::$hex_2;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator1($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator2($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtoXcode($a)
    {
        $b = self::$hex_characters;
        $c = self::$hXc;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtohash_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hth_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_4($a)
    {
        $b = self::$rot13_4;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    private static $salt_1_dat = array(null, 0xb6344e, 0xe33dae, 0xeb4899, 0x661e23, 0xe3af62, 0x100c42, 0x36ce98, 0x46100f, 0x91a745);
    private static $salt_2_dat = array(null, 0xc6a44b, 0xeeadaa, 0xffcced, 0x761926, 0xe6cf52, 0x500f4c, 0x33df97, 0x4f1101, 0x92a855);
    private static $salt_st_dat = array(null, 0xaf4dca, 0x3094dd, 0xdc4a65, 0x751926, 0x45dafc, 0x500f4c, 0x457158, 0xc47842, 0xdf4345);
    private static $hex_char = "abcdef0123456789";
    private static $change_a = "0951ab326c7f4e8d";
    private static $change_b = "183daf026795ebc4";
    private static $change_c = "53840edc67f1ba29";
    private static $change_d = "9ac612fd74538e0b";
    private static $change_e = "72c0fbe64d9531a8";
    private static $change_f = "a10fe82cd746b593";
    private static $change_0 = "e7b8a246590c31df";
    private static $change_1 = "28b5ae9cd340617f";
    private static $change_2 = "17cf54839b062eda";
    private static $change_3 = "d98601f2bac4573e";
    private static $change_4 = "34b78915d0ae62fc";
    private static $change_5 = "5bef680329c1ad74";
    private static $change_6 = "df9b3a41c76e2580";
    private static $change_7 = "9374d21c50fe8b6a";
    private static $change_8 = "60f931edc7b5248a";
    private static $change_9 = "2173049b6cea85df";
    private static $hashchan = "4f571ae03b9cd268";
    private static $hashchan1 = "94c37de51f80b6a2";
    private static $hex_characters = "abcdef0123456789";
    private static $base64_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
    private static $hex_1 = "549e30c67ba2f81d";
    private static $hex_2 = "e326a51d04789fcb";
    private static $hex_3 = "3bd45206fec9a718";
    private static $sg = "1052425130376674";
    private static $sg1 = "5106365247420137";
    private static $sg2 = "0760252675144331";
    private static $hXc = "0132102013201203";
    private static $hth_1 = "61fa2bed734890c5";
    private static $rot13_1 = "4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
    private static $rot13_2 = "wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
    private static $rot13_3 = "h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
    private static $rot13_4 = "JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
    private static $hash0 = "Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";
    private static $hash1 = "752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";
    private static $hash2 = "4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";
    private static $hash3 = "p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
    private static $hash4 = "HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
    private static $hash5 = "fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
    private static $hash6 = "mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
    private static $hash7 = "EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
    private static $hash8 = "opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
    private static $hash9 = "mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
    private static $hasha = "VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
    private static $hashb = "08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
    private static $hashc = "D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
    private static $hashd = "3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
    private static $hashe = "hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";
    private static $hashf = "fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
class Antares_Crypt_v1_2
{
    static function Encrypt($d, $a, $h = "no")
    {
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
    static function Decrypt($b, $a, $h = "no")
    {
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
    static function encrypt_key($a, $c)
    {
        $a = hash("md5", $a);
        $b = 0;
        $d = false;
        for ($e = 0; $e <= strlen($c) - 1; $e++) {
            if ($b == 32) {
                $b = 0;
                $a = hash("md5", hex2bin($a));
            }
            $d = $d . self::Hash_Key($a[$b], $c[$e]);
            $b++;
        }
        return $d;
    }
    static function decrypt_key($a, $c)
    {
        $a = hash("md5", $a);
        $b = 0;
        $d = false;
        for ($e = 0; $e <= strlen($c) - 1; $e++) {
            if ($b == 32) {
                $b = 0;
                $a = hash("md5", hex2bin($a));
            }
            $d = $d . self::Key_Hash($a[$b], $c[$e]);
            $b++;
        }
        return $d;
    }
    static function bk_kb($a)
    {
        $c = "";
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if (strtolower($a[$b]) == $a[$b]) {
                $d = "0";
            }
            if (strtoupper($a[$b]) == $a[$b]) {
                $d = "1";
            }
            if ($d == "1") {
                $c = $c . strtolower($a[$b]);
            } else {
                if ($d == "0") {
                    $c = $c . strtoupper($a[$b]);
                }
            }
        }
        return $c;
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
    static function XOREncryption($a, $c)
    {
        $f = strlen($c);
        for ($b = 0; $b < strlen($a); $b++) {
            $d = $b % $f;
            $e = ord($a[$b]) ^ ord($c[$d]);
            $a[$b] = chr($e);
        }
        return $a;
    }
    static function XOREncrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function XORDecrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function E_death_round($a, $c, $d)
    {
        $a = strrev($a);
        $f = str_split(trim($c));
        for ($e = 0; $e <= strlen(trim($c)) - 1; $e++) {
            $b = $f[$e];
            if ($b == "E") {
                $a = self::encrypt_key($d, $a);
            }
            if ($b == "1") {
                $a = self::E_rot13_1($a);
            }
            if ($b == "2") {
                $a = self::E_rot13_2($a);
            }
            if ($b == "3") {
                $a = self::E_rot13_3($a);
            }
            if ($b == "4") {
                $a = self::E_rot13_4($a);
            }
            if ($b == "C") {
                $a = self::bk_kb($a);
            }
        }
        $a = self::encrypt_key($d, $a);
        return $a;
    }
    static function D_death_round($a, $c, $d)
    {
        $a = self::decrypt_key($d, $a);
        $f = str_split(strrev($c));
        for ($e = 0; $e <= strlen(strrev($c)) - 1; $e++) {
            $b = $f[$e];
            if ($b == "E") {
                $a = self::decrypt_key($d, $a);
            }
            if ($b == "1") {
                $a = self::D_rot13_1($a);
            }
            if ($b == "2") {
                $a = self::D_rot13_2($a);
            }
            if ($b == "3") {
                $a = self::D_rot13_3($a);
            }
            if ($b == "4") {
                $a = self::D_rot13_4($a);
            }
            if ($b == "C") {
                $a = self::bk_kb($a);
            }
        }
        $a = strrev($a);
        return $a;
    }
    static function E_hex_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_1($a)
    {
        $b = self::$hex_1;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtoXcode($a)
    {
        $b = self::$hex_characters;
        $c = self::$hXc;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtohash_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hth_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_rot13_1($a)
    {
        $b = self::$base64_characters;
        $c = self::$rot13_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_1($a)
    {
        $b = self::$rot13_1;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_rot13_2($a)
    {
        $b = self::$base64_characters;
        $c = self::$rot13_2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_2($a)
    {
        $b = self::$rot13_2;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_rot13_3($a)
    {
        $b = self::$base64_characters;
        $c = self::$rot13_3;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_3($a)
    {
        $b = self::$rot13_3;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_rot13_4($a)
    {
        $b = self::$base64_characters;
        $c = self::$rot13_4;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_4($a)
    {
        $b = self::$rot13_4;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function Hash_Key($b, $c)
    {
        $d = self::$base64_characters;
        if ($b == "0") {
            $a = self::$hash0;
        } else {
            if ($b == "1") {
                $a = self::$hash1;
            } else {
                if ($b == "2") {
                    $a = self::$hash2;
                } else {
                    if ($b == "3") {
                        $a = self::$hash3;
                    } else {
                        if ($b == "4") {
                            $a = self::$hash4;
                        } else {
                            if ($b == "5") {
                                $a = self::$hash5;
                            } else {
                                if ($b == "6") {
                                    $a = self::$hash6;
                                } else {
                                    if ($b == "7") {
                                        $a = self::$hash7;
                                    } else {
                                        if ($b == "8") {
                                            $a = self::$hash8;
                                        } else {
                                            if ($b == "9") {
                                                $a = self::$hash9;
                                            } else {
                                                if ($b == "a") {
                                                    $a = self::$hasha;
                                                } else {
                                                    if ($b == "b") {
                                                        $a = self::$hashb;
                                                    } else {
                                                        if ($b == "c") {
                                                            $a = self::$hashc;
                                                        } else {
                                                            if ($b == "d") {
                                                                $a = self::$hashd;
                                                            } else {
                                                                if ($b == "e") {
                                                                    $a = self::$hashe;
                                                                } else {
                                                                    if ($b == "f") {
                                                                        $a = self::$hashf;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $e = strtr($c, $d, $a);
        return $e;
    }
    static function Key_Hash($b, $c)
    {
        if ($b == "0") {
            $a = self::$hash0;
        } else {
            if ($b == "1") {
                $a = self::$hash1;
            } else {
                if ($b == "2") {
                    $a = self::$hash2;
                } else {
                    if ($b == "3") {
                        $a = self::$hash3;
                    } else {
                        if ($b == "4") {
                            $a = self::$hash4;
                        } else {
                            if ($b == "5") {
                                $a = self::$hash5;
                            } else {
                                if ($b == "6") {
                                    $a = self::$hash6;
                                } else {
                                    if ($b == "7") {
                                        $a = self::$hash7;
                                    } else {
                                        if ($b == "8") {
                                            $a = self::$hash8;
                                        } else {
                                            if ($b == "9") {
                                                $a = self::$hash9;
                                            } else {
                                                if ($b == "a") {
                                                    $a = self::$hasha;
                                                } else {
                                                    if ($b == "b") {
                                                        $a = self::$hashb;
                                                    } else {
                                                        if ($b == "c") {
                                                            $a = self::$hashc;
                                                        } else {
                                                            if ($b == "d") {
                                                                $a = self::$hashd;
                                                            } else {
                                                                if ($b == "e") {
                                                                    $a = self::$hashe;
                                                                } else {
                                                                    if ($b == "f") {
                                                                        $a = self::$hashf;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $d = self::$base64_characters;
        $e = strtr($c, $a, $d);
        return $e;
    }
    private static $hex_characters = "abcdef0123456789";
    private static $base64_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
    private static $hex_1 = "549e30c67ba2f81d";
    private static $sg = "C1C2C3C4E1324412";
    private static $hXc = "0132102013201203";
    private static $hth_1 = "61fa2bed734890c5";
    private static $rot13_1 = "4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
    private static $rot13_2 = "wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
    private static $rot13_3 = "h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
    private static $rot13_4 = "JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
    private static $hash0 = "Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";
    private static $hash1 = "752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";
    private static $hash2 = "4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";
    private static $hash3 = "p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
    private static $hash4 = "HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
    private static $hash5 = "fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
    private static $hash6 = "mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
    private static $hash7 = "EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
    private static $hash8 = "opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
    private static $hash9 = "mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
    private static $hasha = "VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
    private static $hashb = "08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
    private static $hashc = "D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
    private static $hashd = "3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
    private static $hashe = "hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";
    private static $hashf = "fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
class Antares_Crypt_v1_1
{
    static function Encrypt($e, $a = false, $d = "no")
    {
        if ($d != "no") {
            $a = trim($a);
        }
        if ($d == "b64") {
            $a = base64_decode($a);
        }
        if ($d == "hex") {
            if (strlen($a) % 2 == 0) {
                $a = hex2bin($a);
            } else {
                exit;
            }
        }
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
    static function Decrypt($f, $a = false, $e = "no")
    {
        if ($e != "no") {
            $a = trim($a);
        }
        if ($e == "b64") {
            $a = base64_decode($a);
        }
        if ($e == "hex") {
            if (strlen($a) % 2 == 0) {
                $a = hex2bin($a);
            } else {
                exit;
            }
        }
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
    static function encrypt_key($a, $c)
    {
        $a = hash("md5", $a);
        $b = 0;
        $d = false;
        for ($e = 0; $e <= strlen($c) - 1; $e++) {
            if ($b == 32) {
                $b = 0;
                $a = hash("md5", $a);
            }
            $d = $d . self::Hash_Key($a[$b], $c[$e]);
            $b++;
        }
        return $d;
    }
    static function decrypt_key($a, $c)
    {
        $a = hash("md5", $a);
        $b = 0;
        $d = false;
        for ($e = 0; $e <= strlen($c) - 1; $e++) {
            if ($b == 32) {
                $b = 0;
                $a = hash("md5", $a);
            }
            $d = $d . self::Key_Hash($a[$b], $c[$e]);
            $b++;
        }
        return $d;
    }
    static function bk_kb($a)
    {
        $c = "";
        for ($b = 0; $b <= strlen($a) - 1; $b++) {
            if (strtolower($a[$b]) == $a[$b]) {
                $d = "0";
            }
            if (strtoupper($a[$b]) == $a[$b]) {
                $d = "1";
            }
            if ($d == "1") {
                $c = $c . strtolower($a[$b]);
            } else {
                if ($d == "0") {
                    $c = $c . strtoupper($a[$b]);
                }
            }
        }
        return $c;
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
    static function XOREncryption($a, $c)
    {
        $f = strlen($c);
        for ($b = 0; $b < strlen($a); $b++) {
            $d = $b % $f;
            $e = ord($a[$b]) ^ ord($c[$d]);
            $a[$b] = chr($e);
        }
        return $a;
    }
    static function XOREncrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function XORDecrypt($a, $b)
    {
        $a = self::XOREncryption($a, $b);
        return $a;
    }
    static function E_death_round($a, $c, $d)
    {
        $a = strrev($a);
        $f = str_split(trim($c));
        for ($e = 0; $e <= strlen(trim($c)) - 1; $e++) {
            $b = $f[$e];
            if ($b == "E") {
                $a = self::encrypt_key($d, $a);
            }
            if ($b == "1") {
                $a = self::E_rot13_1($a);
            }
            if ($b == "2") {
                $a = self::E_rot13_2($a);
            }
            if ($b == "3") {
                $a = self::E_rot13_3($a);
            }
            if ($b == "4") {
                $a = self::E_rot13_4($a);
            }
            if ($b == "C") {
                $a = self::bk_kb($a);
            }
        }
        $a = self::encrypt_key($d, $a);
        return $a;
    }
    static function D_death_round($a, $c, $d)
    {
        $a = self::decrypt_key($d, $a);
        $f = str_split(strrev($c));
        for ($e = 0; $e <= strlen(strrev($c)) - 1; $e++) {
            $b = $f[$e];
            if ($b == "E") {
                $a = self::decrypt_key($d, $a);
            }
            if ($b == "1") {
                $a = self::D_rot13_1($a);
            }
            if ($b == "2") {
                $a = self::D_rot13_2($a);
            }
            if ($b == "3") {
                $a = self::D_rot13_3($a);
            }
            if ($b == "4") {
                $a = self::D_rot13_4($a);
            }
            if ($b == "C") {
                $a = self::bk_kb($a);
            }
        }
        $a = strrev($a);
        return $a;
    }
    static function E_hex_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hex_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_hex_1($a)
    {
        $b = self::$hex_1;
        $c = self::$hex_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function settingsgenerator($a)
    {
        $b = self::$hex_characters;
        $c = self::$sg;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtoXcode($a)
    {
        $b = self::$hex_characters;
        $c = self::$hXc;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function hashtohash_1($a)
    {
        $b = self::$hex_characters;
        $c = self::$hth_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_rot13_1($a)
    {
        $b = self::$base64_characters;
        $c = self::$rot13_1;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_1($a)
    {
        $b = self::$rot13_1;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_rot13_2($a)
    {
        $b = self::$base64_characters;
        $c = self::$rot13_2;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_2($a)
    {
        $b = self::$rot13_2;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_rot13_3($a)
    {
        $b = self::$base64_characters;
        $c = self::$rot13_3;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_3($a)
    {
        $b = self::$rot13_3;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function E_rot13_4($a)
    {
        $b = self::$base64_characters;
        $c = self::$rot13_4;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function D_rot13_4($a)
    {
        $b = self::$rot13_4;
        $c = self::$base64_characters;
        $d = strtr($a, $b, $c);
        return $d;
    }
    static function Hash_Key($b, $c)
    {
        $d = self::$base64_characters;
        if ($b == "0") {
            $a = self::$hash0;
        } else {
            if ($b == "1") {
                $a = self::$hash1;
            } else {
                if ($b == "2") {
                    $a = self::$hash2;
                } else {
                    if ($b == "3") {
                        $a = self::$hash3;
                    } else {
                        if ($b == "4") {
                            $a = self::$hash4;
                        } else {
                            if ($b == "5") {
                                $a = self::$hash5;
                            } else {
                                if ($b == "6") {
                                    $a = self::$hash6;
                                } else {
                                    if ($b == "7") {
                                        $a = self::$hash7;
                                    } else {
                                        if ($b == "8") {
                                            $a = self::$hash8;
                                        } else {
                                            if ($b == "9") {
                                                $a = self::$hash9;
                                            } else {
                                                if ($b == "a") {
                                                    $a = self::$hasha;
                                                } else {
                                                    if ($b == "b") {
                                                        $a = self::$hashb;
                                                    } else {
                                                        if ($b == "c") {
                                                            $a = self::$hashc;
                                                        } else {
                                                            if ($b == "d") {
                                                                $a = self::$hashd;
                                                            } else {
                                                                if ($b == "e") {
                                                                    $a = self::$hashe;
                                                                } else {
                                                                    if ($b == "f") {
                                                                        $a = self::$hashf;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $e = strtr($c, $d, $a);
        return $e;
    }
    static function Key_Hash($b, $c)
    {
        if ($b == "0") {
            $a = self::$hash0;
        } else {
            if ($b == "1") {
                $a = self::$hash1;
            } else {
                if ($b == "2") {
                    $a = self::$hash2;
                } else {
                    if ($b == "3") {
                        $a = self::$hash3;
                    } else {
                        if ($b == "4") {
                            $a = self::$hash4;
                        } else {
                            if ($b == "5") {
                                $a = self::$hash5;
                            } else {
                                if ($b == "6") {
                                    $a = self::$hash6;
                                } else {
                                    if ($b == "7") {
                                        $a = self::$hash7;
                                    } else {
                                        if ($b == "8") {
                                            $a = self::$hash8;
                                        } else {
                                            if ($b == "9") {
                                                $a = self::$hash9;
                                            } else {
                                                if ($b == "a") {
                                                    $a = self::$hasha;
                                                } else {
                                                    if ($b == "b") {
                                                        $a = self::$hashb;
                                                    } else {
                                                        if ($b == "c") {
                                                            $a = self::$hashc;
                                                        } else {
                                                            if ($b == "d") {
                                                                $a = self::$hashd;
                                                            } else {
                                                                if ($b == "e") {
                                                                    $a = self::$hashe;
                                                                } else {
                                                                    if ($b == "f") {
                                                                        $a = self::$hashf;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $d = self::$base64_characters;
        $e = strtr($c, $a, $d);
        return $e;
    }
    private static $hex_characters = "abcdef0123456789";
    private static $base64_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
    private static $hex_1 = "549e30c67ba2f81d";
    private static $sg = "C1C2C3C4E1324412";
    private static $hXc = "0201110202211102";
    private static $hth_1 = "61fa2bed734890c5";
    private static $rot13_1 = "4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
    private static $rot13_2 = "wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
    private static $rot13_3 = "h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
    private static $rot13_4 = "JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
    private static $hash0 = "Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";
    private static $hash1 = "752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";
    private static $hash2 = "4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";
    private static $hash3 = "p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
    private static $hash4 = "HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
    private static $hash5 = "fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
    private static $hash6 = "mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
    private static $hash7 = "EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
    private static $hash8 = "opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
    private static $hash9 = "mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
    private static $hasha = "VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
    private static $hashb = "08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
    private static $hashc = "D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
    private static $hashd = "3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
    private static $hashe = "hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";
    private static $hashf = "fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
