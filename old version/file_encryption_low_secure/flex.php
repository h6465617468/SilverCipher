<?php
/*
AntaresCrypt
Sürüm:Flex Version
*/
Class Antares_Crypt
{
    Public Static Function Encrypt($data,$key,$key_mode="no")
    {
        $key=self::Key($key,$key_mode);
        $data=bin2hex($data);
        $data=self::Encrypt_Key($data,$key);
        return $data;
    }
    Public Static Function Decrypt($data,$key,$key_mode="no")
    {
        $key=self::Key($key,$key_mode);
        $data=self::Decrypt_Key(trim($data),$key);
        $data=hex2bin($data);
        return $data;
    }
    Public Static Function Raw_Encrypt($data,$key,$key_mode="no")
    {
        $key=self::Key($key,$key_mode);
        $data=bin2hex($data);
        $data=self::Encrypt_Key($data,$key);
        $data=hex2bin($data);
        return $data;
    }
    Public Static Function Raw_Decrypt($data,$key,$key_mode="no")
    {
        $key=self::Key($key,$key_mode);
        $data=bin2hex($data);
        $data=self::Decrypt_Key($data,$key);
        $data=hex2bin($data);
        return $data;
    }
    Private Static Function Key($key,$key_mode)
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
        return $key;
    }
    Private Static Function Encrypt_Key($data,$key)
    {
        $key=md5($key);
        $counter=0;
        for ($i=0;$i<=strlen($data)-1;$i++)
        {
            if($counter==32)
            {
                $counter=0;
                $key=strtr($key,self::$hex_char,self::$hashchan);
            }
            if($key[$counter]=="a")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_a);
            }
            if($key[$counter]=="b")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_b);
            }
            if($key[$counter]=="c")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_c);
            }
            if($key[$counter]=="d")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_d);
            }
            if($key[$counter]=="e")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_e);
            }
            if($key[$counter]=="f")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_f);
            }
            if($key[$counter]=="0")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_0);
            }
            if($key[$counter]=="1")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_1);
            }
            if($key[$counter]=="2")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_2);
            }
            if($key[$counter]=="3")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_3);
            }
            if($key[$counter]=="4")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_4);
            }
            if($key[$counter]=="5")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_5);
            }
            if($key[$counter]=="6")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_6);
            }
            if($key[$counter]=="7")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_7);
            }
            if($key[$counter]=="8")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_8);
            }
            if($key[$counter]=="9")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_9);
            }
            $counter++;
        }
        return $data;
    }
    Private Static Function Decrypt_Key($data,$key)
    {
        $key=md5($key);
        $counter=0;
        for ($i=0;$i<=strlen($data)-1;$i++)
        {
            if($counter==32)
            {
                $counter=0;
                $key=strtr($key,self::$hex_char,self::$hashchan);
            }
            if($key[$counter]=="a")
            {
                $data[$i]=strtr($data[$i],self::$change_a,self::$hex_char);
            }
            if($key[$counter]=="b")
            {
                $data[$i]=strtr($data[$i],self::$change_b,self::$hex_char);
            }
            if($key[$counter]=="c")
            {
                $data[$i]=strtr($data[$i],self::$change_c,self::$hex_char);
            }
            if($key[$counter]=="d")
            {
                $data[$i]=strtr($data[$i],self::$change_d,self::$hex_char);
            }
            if($key[$counter]=="e")
            {
                $data[$i]=strtr($data[$i],self::$change_e,self::$hex_char);
            }
            if($key[$counter]=="f")
            {
                $data[$i]=strtr($data[$i],self::$change_f,self::$hex_char);
            }
            if($key[$counter]=="0")
            {
                $data[$i]=strtr($data[$i],self::$change_0,self::$hex_char);
            }
            if($key[$counter]=="1")
            {
                $data[$i]=strtr($data[$i],self::$change_1,self::$hex_char);
            }
            if($key[$counter]=="2")
            {
                $data[$i]=strtr($data[$i],self::$change_2,self::$hex_char);
            }
            if($key[$counter]=="3")
            {
                $data[$i]=strtr($data[$i],self::$change_3,self::$hex_char);
            }
            if($key[$counter]=="4")
            {
                $data[$i]=strtr($data[$i],self::$change_4,self::$hex_char);
            }
            if($key[$counter]=="5")
            {
                $data[$i]=strtr($data[$i],self::$change_5,self::$hex_char);
            }
            if($key[$counter]=="6")
            {
                $data[$i]=strtr($data[$i],self::$change_6,self::$hex_char);
            }
            if($key[$counter]=="7")
            {
                $data[$i]=strtr($data[$i],self::$change_7,self::$hex_char);
            }
            if($key[$counter]=="8")
            {
                $data[$i]=strtr($data[$i],self::$change_8,self::$hex_char);
            }
            if($key[$counter]=="9")
            {
                $data[$i]=strtr($data[$i],self::$change_9,self::$hex_char);
            }
            $counter++;
        }
        return $data;
    }
    Private Static $hex_char= "abcdef0123456789";
    Private Static $change_a= "0951ab326c7f4e8d";
    Private Static $change_b= "183daf026795ebc4";
    Private Static $change_c= "53840edc67f1ba29";
    Private Static $change_d= "9ac612fd74538e0b";
    Private Static $change_e= "72c0fbe64d9531a8";
    Private Static $change_f= "a10fe82cd746b593";
    Private Static $change_0= "e7b8a246590c31df";
    Private Static $change_1= "28b5ae9cd340617f";
    Private Static $change_2= "17cf54839b062eda";
    Private Static $change_3= "d98601f2bac4573e";
    Private Static $change_4= "34b78915d0ae62fc";
    Private Static $change_5= "5bef680329c1ad74";
    Private Static $change_6= "df9b3a41c76e2580";
    Private Static $change_7= "9374d21c50fe8b6a";
    Private Static $change_8= "60f931edc7b5248a";
    Private Static $change_9= "2173049b6cea85df";
    Private Static $hashchan= "4f571ae03b9cd268";
}
?>