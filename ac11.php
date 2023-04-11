<?php
/*
AntaresCrypt
Sürüm:V.I.P++ Version
*/
Class Antares_Crypt
{
    Public Static Function Encrypt($string,$key=false,$key_mode="no")
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
                exit;
            }
        }
        $st=self::settingsgenerator(hash("adler32",$key.chr(0x30).chr(0x63).chr(0xa4)));
        $data_x_all=str_split($string,256);
        $data=false;
        $veri=false;
        $key=hash("sha512",$key.chr(0x33).chr(0xfb).chr(0xa4),true);
        foreach ($data_x_all as $str_x)
        {
            $veri=self::Enc($str_x,$key,$st);
            $key=hash("whirlpool",$key.chr(0x33).chr(0xfb).chr(0xa4).$veri[1],true);
            $data=$data.$veri[0].":";
        }
        $data=substr($data,0,-1);
        return $data;
    }
    Public Static Function Decrypt($string,$key=false,$key_mode="no")
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
                exit;
            }
        }
        $st=self::settingsgenerator(hash("adler32",$key.chr(0x30).chr(0x63).chr(0xa4)));
        $data_x_all=explode(":",$string);
        $data=false;
        $sayac=count($data_x_all);
        $key=hash("sha512",$key.chr(0x33).chr(0xfb).chr(0xa4),true);
        foreach ($data_x_all as $str_x)
        {
            $veri=self::Dec($str_x,$key,$st);
            $key=hash("whirlpool",$key.chr(0x33).chr(0xfb).chr(0xa4).$veri[1],true);
            $data=$data.$veri[0];
        }
        return $data;
    }
    Private Static Function Enc($string,$key,$st)
    {
        $keyx=$key;
        $data_x_all=str_split($string,128);
        $data=false;
        $nrk=false;
        foreach ($data_x_all as $str_x)
        {
            $veri=self::Crypt($str_x,"e",$key);
            $key=hash("sha512",$key.chr(0xb5).chr(0xb9),true);
            $data=$data.$veri[0].".";
            $nrk=$nrk.$veri[1];
        }
        $veri=false;
        $next_round_key=$nrk;
        $keyx=hash("sha512",$keyx,true);
        $data=self::E_death_round(substr($data,0,-1),$st,$keyx);
        $data=strrev($data);
        return array($data,$next_round_key);
    }
    Private Static Function Dec($string,$key,$st)
    {
        $data=trim($string);
        $data=strrev($data);
        $keyx=hash("sha512",$key,true);
        $data=self::D_death_round($data,$st,$keyx);
        $data_x_all=explode(".",$data);
        $data=false;
        $nrk=false;
        foreach ($data_x_all as $str_x)
        {
            $veri=self::Crypt($str_x,"d",$key);
            $key=hash("sha512",$key.chr(0xb5).chr(0xb9),true);
            $data=$data.$veri[0];
            $nrk=$nrk.$veri[1];
        }
        $veri=false;
        $next_round_key=$nrk;
        return array($data,$next_round_key);
    }
    Private Static Function encrypt_key($key,$data)
    {
        $key=hash("md5",$key);
        $sayac0=0;
        $veri=false;
        for ($i = 0; $i <= strlen($data)-1; $i++)
        {
            if($sayac0==32)
            {
                $sayac0=0;
                $key=hash("md5",$key);
            }
            $veri=$veri.self::Hash_Key($key[$sayac0],$data[$i]);
            $sayac0++;
        }
        return $veri;
    }
    Private Static Function decrypt_key($key,$data)
    {
        $key=hash("md5",$key);
        $sayac0=0;
        $veri=false;
        for ($i = 0; $i <= strlen($data)-1; $i++)
        {
            if($sayac0==32)
            {
                $sayac0=0;
                $key=hash("md5",$key);
            }
            $veri=$veri.self::Key_Hash($key[$sayac0],$data[$i]);
            $sayac0++;
        }
        return $veri;
    }
    Private Static Function bk_kb($data)
    {
        $str1="";
        for ($i = 0; $i <= strlen($data)-1; $i++)
        {
            if(strtolower($data[$i])==$data[$i])
            {
                $durum="0";
            }
            if(strtoupper($data[$i])==$data[$i])
            {
                $durum="1";
            }
            if($durum=="1") 
            {
                $str1=$str1.strtolower($data[$i]);
            }
            else if($durum=="0")
            {
                $str1=$str1.strtoupper($data[$i]);
            }
        }
        return $str1;
    }
    Private Static Function Crypt($str1,$action="e",$key)
    {
        $keyx=$key;
        $key=hash("sha512",$key.chr(0x3f).chr(0x6c).chr(0x33));
        $keyz=hex2bin($key);
        $keyy=hex2bin(self::E_hex_1($key));
        $keyxor=self::XOREncrypt(hex2bin($key),$keyy);
        $key444=self::hashtoXcode($key);
        if($action=="e")
        {
            $bolum1=self::XOREncrypt($str1,$keyxor);
            $bolum1=self::XOREncrypt($bolum1,self::XOREncrypt($keyz,$keyxor));
            $bolum1=bin2hex($bolum1);
            for ($x = 1; $x <= 10; $x++)
            {
                $bolum1=self::E_hex_1($bolum1);
            }
            $hashed_key=$key;
            $sayac1=0;
            $harf=false;
            $harfler=str_split($bolum1,1);
            $harf_keyx=false;
            foreach($harfler as $harfx)
            {
                if($sayac1==128)
                {
                    $sayac1=0;
                    $hashed_key=$key;
                    $key=hash("sha512",hex2bin($key).chr(0x33).chr(0x99).chr(0xb4));
                    $key444=self::hashtoXcode($key);
                }
                if($key444[$sayac1]==0)
                {
                    $harf=$harf.self::E_hex_1($harfx).$hashed_key[$sayac1];
                    $harf_keyx=$harf_keyx.$hashed_key[$sayac1];
                }
                else if($key444[$sayac1]==1)
                {
                    $harf=$harf.$hashed_key[$sayac1].self::E_hex_1($harfx);
                    $harf_keyx=$harf_keyx.$hashed_key[$sayac1];
                }
                else if($key444[$sayac1]==2)
                {
                    $harf=$harf.self::E_hex_1($harfx).self::hashtohash_1($hashed_key[$sayac1]);
                    $harf_keyx=$harf_keyx.self::hashtohash_1($hashed_key[$sayac1]);
                }
                $sayac1++;
            }
            $next_round_key=$harf_keyx;
            $harfler=false;
            $harfx=false; 
            $harf=self::E_hex_1($harf);
            $bolum2=hex2bin($harf);
            $bolum2=self::XOREncrypt($bolum2,self::XOREncrypt($keyz,$keyx));
            $bolum2=self::XOREncrypt($bolum2,$keyz);
            $bolum2=self::XOREncrypt($bolum2,hex2bin(hash("sha512",$keyy)));
            $bolum3=str_replace("=","",base64_encode($bolum2));
            $sonuc=$bolum3;
        }
        
        else if($action=="d")
        {
            $str1=trim($str1);
            $harf=$str1;
            $bolum1=base64_decode($harf);
            $bolum1=self::XORDecrypt($bolum1,hex2bin(hash("sha512",$keyy)));
            $bolum1=self::XORDecrypt($bolum1,$keyz);
            $bolum1=self::XORDecrypt($bolum1,self::XOREncrypt($keyz,$keyx));
            $bolum2=bin2hex($bolum1);
            $bolum2=self::D_hex_1($bolum2);
            $harfler=str_split($bolum2,2);
            $harf=false;
            $sayac1=0;
            $key444=self::hashtoXcode($key);
            $harf_key=false;
            foreach($harfler as $harfx)
            {
                if($sayac1==128)
                {
                    $sayac1=0;
                    $key=hash("sha512",hex2bin($key).chr(0x33).chr(0x99).chr(0xb4));
                    $key444=self::hashtoXcode($key);
                }
                if($key444[$sayac1]==0 or $key444[$sayac1]==2)
                {
                    $harf_sc=self::D_hex_1(substr($harfx,0,1));
                    $harf_keyx=substr($harfx,-1,1);
                }
                else if($key444[$sayac1]==1)
                {
                    $harf_sc=self::D_hex_1(substr($harfx,-1,1));
                    $harf_keyx=substr($harfx,0,1);
                }
                $sayac1++;
                $harf=$harf.$harf_sc;
                $harf_key=$harf_key.$harf_keyx;
            }
            $next_round_key=$harf_key;
            $harfler=false;
            $harfx=false;
            for ($x = 1; $x <= 10; $x++)
            {
                $harf=self::D_hex_1($harf);
            }
            $bolum3=hex2bin($harf);
            $bolum3=self::XORDecrypt($bolum3,self::XOREncrypt($keyz,$keyxor));
            $bolum3=self::XORDecrypt($bolum3,$keyxor);
            if($bolum3=="")
            {
                exit;
            }
            $sonuc=$bolum3;
        }
        return array($sonuc,$next_round_key);
    }
    Private Static Function XOREncryption($InputString, $Key)
    {
        $KeyLength = strlen($Key);  
        for ($i = 0; $i < strlen($InputString); $i++)
        {
            $rPos = $i % $KeyLength;
            $r = ord($InputString[$i]) ^ ord($Key[$rPos]);
            $InputString[$i] = chr($r);
        }
        return $InputString;
    }
    Private Static Function XOREncrypt($InputString, $Key)
    {
        $InputString = self::XOREncryption($InputString, $Key);
        return $InputString;
    }
    Private Static Function XORDecrypt($InputString, $Key)
    {
        $InputString = self::XOREncryption($InputString, $Key);
        return $InputString;
    }
    Private Static Function E_death_round($data,$settings,$keyx)
    {
        $data=strrev($data);
        $settingsx=str_split(trim($settings));
        for ($i = 0; $i <= strlen(trim($settings))-1; $i++)
        {
            $a=$settingsx[$i];
            if($a=="E")
            {
                $data=self::encrypt_key($keyx,$data);
            }
            if($a=="1")
            {
                $data=self::E_rot13_1($data);  
            }
            if($a=="2")
            {
                $data=self::E_rot13_2($data);
            }
            if($a=="3")
            {
                $data=self::E_rot13_3($data);  
            }
            if($a=="4")
            {
                $data=self::E_rot13_4($data);  
            }
            if($a=="C")
            {
                $data=self::bk_kb($data);  
            }
        }
        $data=self::encrypt_key($keyx,$data);
        return $data;
    }
    Private Static Function D_death_round($data,$settings,$key)
    {
        $data=self::decrypt_key($key,$data);
        $settingsx=str_split(strrev($settings));
        for ($i = 0; $i <= strlen(strrev($settings))-1; $i++)
        {
            $a=$settingsx[$i];
            if($a=="E")
            {
                $data=self::decrypt_key($key,$data);
            }
            if($a=="1")
            {
                $data=self::D_rot13_1($data);  
            }
            if($a=="2")
            {
                $data=self::D_rot13_2($data);
            }
            if($a=="3")
            {
                $data=self::D_rot13_3($data);  
            }
            if($a=="4")
            {
                $data=self::D_rot13_4($data);  
            }
            if($a=="C")
            {
                $data=self::bk_kb($data);  
            }
        }
        $data=strrev($data);
        return $data;
    }
    Private Static Function E_hex_1($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$hex_1;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_hex_1($sifrelenecek)
    {
        $kaynak = self::$hex_1;
        $hedef =  self::$hex_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function settingsgenerator($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$sg;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function hashtoXcode($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$hXc;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function hashtohash_1($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$hth_1;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function E_rot13_1($sifrelenecek)
    {
        $kaynak = self::$base64_characters;
        $hedef =  self::$rot13_1;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_rot13_1($sifrelenecek)
    {
        $kaynak = self::$rot13_1;
        $hedef =  self::$base64_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function E_rot13_2($sifrelenecek)
    {
        $kaynak = self::$base64_characters;
        $hedef =  self::$rot13_2;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_rot13_2($sifrelenecek)
    {
        $kaynak = self::$rot13_2;
        $hedef =  self::$base64_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function E_rot13_3($sifrelenecek)
    {
        $kaynak = self::$base64_characters;
        $hedef =  self::$rot13_3;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_rot13_3($sifrelenecek)
    {
        $kaynak = self::$rot13_3;
        $hedef =  self::$base64_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function E_rot13_4($sifrelenecek)
    {
        $kaynak = self::$base64_characters;
        $hedef =  self::$rot13_4;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_rot13_4($sifrelenecek)
    {
        $kaynak = self::$rot13_4;
        $hedef =  self::$base64_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function Hash_Key($hash,$data)
    {
        $kaynak = self::$base64_characters;
        if($hash=="0")
        {
            $hedef=self::$hash0;
        }
        else if($hash=="1")
        {
            $hedef=self::$hash1;
        }
        else if($hash=="2")
        {
            $hedef=self::$hash2;
        }
        else if($hash=="3")
        {
            $hedef=self::$hash3;
        }
        else if($hash=="4")
        {
            $hedef=self::$hash4;
        }
        else if($hash=="5")
        {
            $hedef=self::$hash5;
        }
        else if($hash=="6")
        {
            $hedef=self::$hash6;
        }
        else if($hash=="7")
        {
            $hedef=self::$hash7;
        }
        else if($hash=="8")
        {
            $hedef=self::$hash8;
        }
        else if($hash=="9")
        {
            $hedef=self::$hash9;
        }
        else if($hash=="a")
        {
            $hedef=self::$hasha;
        }
        else if($hash=="b")
        {
            $hedef=self::$hashb;
        }
        else if($hash=="c")
        {
            $hedef=self::$hashc;
        }
        else if($hash=="d")
        {
            $hedef=self::$hashd;
        }
        else if($hash=="e")
        {
            $hedef=self::$hashe;
        }
        else if($hash=="f")
        {
            $hedef=self::$hashf;
        }
        $yenikelime = strtr($data, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function Key_Hash($hash,$data)
    {
        if($hash=="0")
        {
            $kaynak=self::$hash0;
        }
        else if($hash=="1")
        {
            $kaynak=self::$hash1;
        }
        else if($hash=="2")
        {
            $kaynak=self::$hash2;
        }
        else if($hash=="3")
        {
            $kaynak=self::$hash3;
        }
        else if($hash=="4")
        {
            $kaynak=self::$hash4;
        }
        else if($hash=="5")
        {
            $kaynak=self::$hash5;
        }
        else if($hash=="6")
        {
            $kaynak=self::$hash6;
        }
        else if($hash=="7")
        {
            $kaynak=self::$hash7;
        }
        else if($hash=="8")
        {
            $kaynak=self::$hash8;
        }
        else if($hash=="9")
        {
            $kaynak=self::$hash9;
        }
        else if($hash=="a")
        {
            $kaynak=self::$hasha;
        }
        else if($hash=="b")
        {
            $kaynak=self::$hashb;
        }
        else if($hash=="c")
        {
            $kaynak=self::$hashc;
        }
        else if($hash=="d")
        {
            $kaynak=self::$hashd;
        }
        else if($hash=="e")
        {
            $kaynak=self::$hashe;
        }
        else if($hash=="f")
        {
            $kaynak=self::$hashf;
        }
        $hedef =  self::$base64_characters;
        $yenikelime = strtr($data, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static $hex_characters="abcdef0123456789";
    Private Static $base64_characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
    Private Static $hex_1="549e30c67ba2f81d";
    Private Static $sg="C1C2C3C4E1324412";
    Private Static $hXc="0201110202211102";
    Private Static $hth_1="61fa2bed734890c5";
    Private Static $rot13_1="4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
    Private Static $rot13_2="wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
    Private Static $rot13_3="h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
    Private Static $rot13_4="JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
    Private Static $hash0="Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";
    Private Static $hash1="752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";
    Private Static $hash2="4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";
    Private Static $hash3="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
    Private Static $hash4="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
    Private Static $hash5="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
    Private Static $hash6="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
    Private Static $hash7="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
    Private Static $hash8="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
    Private Static $hash9="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
    Private Static $hasha="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
    Private Static $hashb="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
    Private Static $hashc="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
    Private Static $hashd="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
    Private Static $hashe="hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";
    Private Static $hashf="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
?>