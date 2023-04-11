<?php

/*
AntaresCrypt
Sürüm:V.I.P Version
*/

class crypto
{

    public static function Encrypt($string,$key=false,$settings,$r,$key_mode="no")
    {
        if($key_mode!="no")
        {
            $key=trim($key);
        }
        if($key_mode=="b64")
        {
            $key=base64_decode($key);
        }
        if($key_mode=="hex")
        {
            if(strlen($key)%2==0)
            {
                $key=hex2bin($key);
            }
            else
            {
                echo "[TR/Turkish] Hexadecimal bir değerin çift olması gerekiyor.<br>";
                echo "[USA/English] A hexadecimal value must be double.";
                exit;
            }
        }

        $keyx=$key;
        $data_x_all=str_split($string,64);
        $data=false;

        foreach ($data_x_all as $str_x)
        {
            $data=$data.crypto::Crypt($str_x,"e").base64_decode("2A==");
        }
        $data=str_replace("=","",base64_encode(substr($data,0,-1)));

        if($r==0 OR $r=="0")
        {
            $r=1;
        }
        for ($x = 1; $x <= $r; $x++)
        {
            $keyx=hash("sha512",$keyx);
            $data=crypto::E_death_round($data,$settings,$keyx);
        }
        $data=strrev($data)."==";
        $data=crypto::bk_kb($data);

        return $data;
    }
    
    public static function Decrypt($string,$key=false,$settings,$r,$key_mode="no")
    {
        if($key_mode!="no")
        {
            $key=trim($key);
        }
        if($key_mode=="b64")
        {
            $key=base64_decode($key);
        }
        if($key_mode=="hex")
        {
            if(strlen($key)%2==0)
            {
                $key=hex2bin($key);
            }
            else
            {
                echo "[TR/Turkish] Hexadecimal bir değerin çift olması gerekiyor.<br>";
                echo "[USA/English] A hexadecimal value must be double.";
                exit;
            }
        }

        $data=crypto::bk_kb(trim($string));
        $data=strrev(str_replace("=","",$data));
        
        if($r==0 OR $r=="0")
        {
            $r=1;
        }
        $sayac=$r;
        for ($x = 1; $x <= $r; $x++)
        {
            $keyx=crypto::hash_round($key,$sayac);
            $data=crypto::D_death_round($data,$settings,$keyx);
            $sayac--;
        }
        $data=base64_decode($data);
        $data_x_all=explode(base64_decode("2A=="),$data);
        $data=false;
        foreach ($data_x_all as $str_x)
        {
            $data=$data.crypto::Crypt($str_x,"d");
        }

        return $data;
    }
    
    protected static function hash_round($data,$round)
    {
        for ($x = 1; $x <= $round; $x++) {
            $data=hash("sha512",$data);
        }
        return $data;
    }
    protected static function encrypt_key($key,$data)
    {
        $key=hash("md5",$key);

        $veriler = str_split($data);
        $sayac0=0;
        $veri=false;
        foreach ($veriler as $dat)
        {
            if($sayac0==32)
            {
                $sayac0=0;
                $key=hash("md5",$key);
            }
            $veri=$veri.crypto::Hash_Key(substr($key,$sayac0,1),$dat);
            $sayac0++;
        }
        return $veri;
    }

    protected static function decrypt_key($key,$data)
    {
        $key=hash("md5",$key);

        $veriler = str_split($data);
        $sayac0=0;
        $veri="";
        foreach ($veriler as $dat)
        {
            if($sayac0==32)
            {
                $sayac0=0;
                $key=hash("md5",$key);
            }
            $veri=$veri.crypto::Key_Hash(substr($key,$sayac0,1),$dat);
            $sayac0++;
        }
        return $veri;
    }

    protected static function bk_kb($data)
    {
        $harfler=str_split($data);
        $str1="";
        foreach($harfler as $harfx)
        {
            if(strtolower($harfx)==$harfx) {$durum="0";}
            if(strtoupper($harfx)==$harfx) {$durum="1";}
            if($durum=="1") 
            {
                $str1=$str1.strtolower($harfx);
            }
            else if($durum=="0")
            {
                $str1=$str1.strtoupper($harfx);
            }
        }
        return $str1;
    }

    private static function Crypt($str1,$action="e")
    {

        if($action=="e")
        {
            $str1=crypto::E_rot13_4(crypto::E_rot13_3(crypto::E_rot13_2(crypto::E_rot13_1(str_replace("=","",base64_encode($str1))))));

            $bolum1=trim(bin2hex($str1));
            $hashed_key=hash("sha512",openssl_random_pseudo_bytes(64));
            $sayac1=0;
            $harf=false;
            $harfler=str_split($bolum1,1);
            $esx=0;
            
            foreach($harfler as $harfx)
            {
                if($sayac1==128)
                {
                    $sayac1=0;
                    $hashed_key=hash("sha512",$hashed_key);
                }
                if($esx==0)
                {
                    $harf=$harf.$harfx.substr($hashed_key,$sayac1,1);
                    $esx=1;
                }
                else if($esx==1)
                {
                    $harf=$harf.substr($hashed_key,$sayac1,1).$harfx;
                    $esx=0;
                }
                $sayac1++;
            }
            $harfler=false;
            $harfx=false;
            

            $bolum2=hex2bin($harf);
            $bolum3=str_replace("=","",base64_encode($bolum2));
            
            $harf="";

            $sonuc=$bolum3;
            $sonuc=crypto::bk_kb(crypto::E_rot13_1(crypto::E_rot13_2(crypto::E_rot13_3(crypto::E_rot13_4($sonuc)))));

        }
        
        else if($action=="d")
        {
            $str1=trim($str1);
            $harf3=crypto::D_rot13_4(crypto::D_rot13_3(crypto::D_rot13_2(crypto::D_rot13_1(crypto::bk_kb($str1)))));

            $bolum1=base64_decode($harf3);
            $bolum2=bin2hex($bolum1);
            $harf=false;
            $harfler=str_split($bolum2,2);
            $esx=0;
            foreach($harfler as $harfx)
            {
                if($esx==0)
                {
                    $harf_sc=substr($harfx,0,1);
                    $esx=1;
                }
                else if($esx==1)
                {
                    $harf_sc=substr($harfx,-1,1);
                    $esx=0;
                }
                
                $harf=$harf.$harf_sc;
            }
            $harfler=false;
            $harfx=false;

            $bolum3=hex2bin($harf);
            if($bolum3=="")
            {
                echo "[TR/Turkish] Anahtar veya tur sayısı yanlış.<br>";
                echo "[USA/English] Incorrect number of round or key.<br>";
                exit;
            }
            $bolum4=base64_decode(crypto::D_rot13_1(crypto::D_rot13_2(crypto::D_rot13_3(crypto::D_rot13_4($bolum3)))));  

            $sonuc=$bolum4;
        }
        
        return $sonuc;

    }

    protected static function E_rot13_1($sifrelenecek)
    {
        $kaynak = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $hedef =  "4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function D_rot13_1($sifrelenecek)
    {
        $kaynak = "4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
        $hedef =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function E_rot13_2($sifrelenecek)
    {
        $kaynak = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $hedef =  "wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function D_rot13_2($sifrelenecek)
    {
        $kaynak = "wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
        $hedef =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function E_rot13_3($sifrelenecek)
    {
        $kaynak = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $hedef =  "h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function D_rot13_3($sifrelenecek)
    {
        $kaynak = "h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
        $hedef =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function E_rot13_4($sifrelenecek)
    {
        $kaynak = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $hedef =  "JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function D_rot13_4($sifrelenecek)
    {
        $kaynak = "JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
        $hedef =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function Hash_Key($hash,$data)
    {
        $kaynak = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        
        if($hash=="0")
        {
            $hedef="gyVZzo/3lDe4J5AXsndPK70CUwbWfQmBvF6IrMShH81u2pck+YqGORi9NxjtaELT";
        }
        else if($hash=="1")
        {
            $hedef="H2Rmsa7wliTC3c68jVyuqtY5GOPWkJLDQ0bnNf9U1hZr/pxKgzESFvIeAXd+Mo4B";
        }
        else if($hash=="2")
        {
            $hedef="zsAdFgWDBNVSLuC1ZtGmUlyp6Qaqwx82c5M+OehnYXvr43KfiEkTj79R/oJHPIb0";
        }
        else if($hash=="3")
        {
            $hedef="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
        }
        else if($hash=="4")
        {
            $hedef="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
        }
        else if($hash=="5")
        {
            $hedef="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
        }
        else if($hash=="6")
        {
            $hedef="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
        }
        else if($hash=="7")
        {
            $hedef="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
        }
        else if($hash=="8")
        {
            $hedef="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
        }
        else if($hash=="9")
        {
            $hedef="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
        }
        else if($hash=="a")
        {
            $hedef="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
        }
        else if($hash=="b")
        {
            $hedef="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
        }
        else if($hash=="c")
        {
            $hedef="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
        }
        else if($hash=="d")
        {
            $hedef="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
        }
        else if($hash=="e")
        {
            $hedef="pvD6mThWuCO9iItaLZ3PQoKR2gcwrx+e8NyEJFkq1d/7bXHf5YGj0nUVMszBS4Al";
        }
        else if($hash=="f")
        {
            $hedef="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
        }

        $yenikelime = strtr($data, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function Key_Hash($hash,$data)
    {
        
        if($hash=="0")
        {
            $kaynak="gyVZzo/3lDe4J5AXsndPK70CUwbWfQmBvF6IrMShH81u2pck+YqGORi9NxjtaELT";
        }
        else if($hash=="1")
        {
            $kaynak="H2Rmsa7wliTC3c68jVyuqtY5GOPWkJLDQ0bnNf9U1hZr/pxKgzESFvIeAXd+Mo4B";
        }
        else if($hash=="2")
        {
            $kaynak="zsAdFgWDBNVSLuC1ZtGmUlyp6Qaqwx82c5M+OehnYXvr43KfiEkTj79R/oJHPIb0";
        }
        else if($hash=="3")
        {
            $kaynak="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
        }
        else if($hash=="4")
        {
            $kaynak="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
        }
        else if($hash=="5")
        {
            $kaynak="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
        }
        else if($hash=="6")
        {
            $kaynak="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
        }
        else if($hash=="7")
        {
            $kaynak="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
        }
        else if($hash=="8")
        {
            $kaynak="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
        }
        else if($hash=="9")
        {
            $kaynak="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
        }
        else if($hash=="a")
        {
            $kaynak="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
        }
        else if($hash=="b")
        {
            $kaynak="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
        }
        else if($hash=="c")
        {
            $kaynak="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
        }
        else if($hash=="d")
        {
            $kaynak="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
        }
        else if($hash=="e")
        {
            $kaynak="pvD6mThWuCO9iItaLZ3PQoKR2gcwrx+e8NyEJFkq1d/7bXHf5YGj0nUVMszBS4Al";
        }
        else if($hash=="f")
        {
            $kaynak="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
        }

        $hedef =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
        $yenikelime = strtr($data, $kaynak, $hedef);
        return $yenikelime;
    }

    protected static function E_death_round($data,$settings,$keyx)
    {
        $data=strrev($data);
        $settingsx=str_split(trim($settings));

        for ($i = 0; $i <= strlen(trim($settings))-1; $i++)
        {
            $a=$settingsx[$i];

            if($a=="E")
            {
                $data=crypto::encrypt_key($keyx,$data);
            }
            if($a=="1")
            {
                $data=crypto::E_rot13_1($data);  
            }
            if($a=="2")
            {
                $data=crypto::E_rot13_2($data);
            }
            if($a=="3")
            {
                $data=crypto::E_rot13_3($data);  
            }
            if($a=="4")
            {
                $data=crypto::E_rot13_4($data);  
            }
            if($a=="C")
            {
                $data=crypto::bk_kb($data);  
            }
        }

        $data=crypto::encrypt_key($keyx,$data);
        

        return $data;
    }

    protected static function D_death_round($data,$settings,$key)
    {
        $data=crypto::decrypt_key($key,$data);

        $settingsx=str_split(strrev($settings));

        for ($i = 0; $i <= strlen(strrev($settings))-1; $i++)
        {
            $a=$settingsx[$i];

            if($a=="E")
            {
                $data=crypto::decrypt_key($key,$data);
            }
            if($a=="1")
            {
                $data=crypto::D_rot13_1($data);  
            }
            if($a=="2")
            {
                $data=crypto::D_rot13_2($data);
            }
            if($a=="3")
            {
                $data=crypto::D_rot13_3($data);  
            }
            if($a=="4")
            {
                $data=crypto::D_rot13_4($data);  
            }
            if($a=="C")
            {
                $data=crypto::bk_kb($data);  
            }
        }

        $data=strrev($data);
        return $data;
    }

}
?>