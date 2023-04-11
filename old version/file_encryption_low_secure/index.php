<?php 
$files6 = glob('file/*');
foreach($files6 as $file6){
  if(is_file($file6))
    unlink($file6);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="robots" content="index, follow">
        <meta http-equiv="content-type" content="text/html;UTF-8">
        <meta http-equiv="content-language" content="tr">
        <meta http-equiv="expires" content="Mon,08 Apr 2019 13:26:49 GMT">
        <meta http-equiv="revisit-after" content="1 days">
        <style>
        @charset "UTF-8";
* {
    padding:0;
    margin:0;
    color:grey;
}
body {
    background: url("../background.jpg");
}

h1
{
    padding-left: 15px;
    text-align:center;
}
.f6a4f711dd79aecf1259e5e74ecfbc26 {background: #444;background: rgba(0,0,0,.2);border-radius: 10px;margin:auto;padding: 15px;width: 450px;}
.d330a23d22185973ee4b18d3ac2015a8{
    width:100%;
    height:100%;
}
.xwq2rewrt34t {
    background: #d83c3c;border-radius: 0 3px 3px 0;border: 0;color: #fff;cursor: pointer;float: right;font: bold 15px/40px 'lucida sans', 'trebuchet MS', 'Tahoma';height: 40px;overflow: visible;padding: 0;position: relative;text-shadow: 0 -1px 0 rgba(0, 0 ,0, .3);text-transform: uppercase;width: 110px;
}
.zf5b44c8574b6ec187007583bbe85052 {
    font-size:32px;color:darkred;
    word-wrap: break-word;
    max-width: 1200px;
    margin:auto;
    text-align:center;
}
    </style>
    </head>
    <body style='background-color:#221e1e;color:darkred;'>
        <div class="d330a23d22185973ee4b18d3ac2015a8">
        <br><br><br>
        <form class="f6a4f711dd79aecf1259e5e74ecfbc26 a0695f1e11fd62d66011ecd509308f18">
        <h1>AntaresCrypt <strong style="color:darkred;">Flex</strong> Version</h1>
        </form>
        <br>  
        <form class="f6a4f711dd79aecf1259e5e74ecfbc26 a0695f1e11fd62d66011ecd509308f18" action="" method="post" enctype="multipart/form-data">
        <label>File/Dosya</label><br>
        <input type="file" class="" style="background-color:#3e3938;color:#dd674a;border:1px solid black;" name="dosya_enc"><br>
        <label>Password/Parola & Base64 <input type="checkbox" name="key_mode" value="b64" style="padding:0;margin:0;width:0;height:10;">&nbsp;& Hexadecimal <input type="checkbox" name="key_mode" value="hex" style="padding:0;margin:0;width:0;height:10;">&nbsp;</label>
        <br>
        <textarea placeholder="Password/Parola"  name="dosya_enc_key" autocomplete="off" style="width: 95%; height: 60px;background-color:#3e3938;color:#dd674a;border:1px solid black;" required></textarea>
        <br>
        <button type="submit" style="background-color:#3e3938;color:#dd674a;border:1px solid black;padding:5px;">Encrypt/Şifrele</button>
        </form>
        <br>
        <form class="f6a4f711dd79aecf1259e5e74ecfbc26 a0695f1e11fd62d66011ecd509308f18" action="" method="post" enctype="multipart/form-data">
        <label>File/Dosya</label><br>
        <input type="file" class="" style="background-color:#3e3938;color:#dd674a;border:1px solid black;" name="dosya_dec"><br>
        <label>Password/Parola & Base64 <input type="checkbox" name="key_mode" value="b64" style="padding:0;margin:0;width:0;height:10;" >&nbsp;& Hexadecimal <input type="checkbox" name="key_mode" value="hex" style="padding:0;margin:0;width:0;height:10;">&nbsp;</label>
        <br>
        <textarea placeholder="Password/Parola"  name="dosya_dec_key" autocomplete="off" style="width: 95%; height: 60px;background-color:#3e3938;color:#dd674a;border:1px solid black;" required></textarea>
        <br>
        <button type="submit" style="background-color:#3e3938;color:#dd674a;border:1px solid black;padding:5px;">Decrypt/Çöz</button>
        </form>
<?php
include "flex.php";
$cifttırnak = '"';
$tektırnak = "'";
function replace_tr($text) {
    $text = trim($text);
    $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü');
    $replace = array('C','c','G','g','i','I','O','o','S','s','U','u');
    $new_text = str_replace($search,$replace,$text);
    return $new_text;
}
    if(isset($_FILES['dosya_enc']))
    {
        if(isset($_POST["key_mode"]))
        {
            if($_POST["key_mode"]=="b64")
            {
                $key_mode="b64";
            }
            if($_POST["key_mode"]=="hex")
            {
                $key_mode="hex";
            }
        }
        else
        {
            $key_mode="no";
        }
        $v = "file/"."Encrypted_".replace_tr($_FILES['dosya_enc']['name']);
        $dosya = $_FILES['dosya_enc']['tmp_name'];
        copy($dosya,$v);  
        $dosya=$v;
        $z0 = fopen($dosya, 'r');
        $dex="";
        while(! feof($z0))
        {
            $dex .= fgets($z0);
        }
        fclose($z0);
        $start=microtime(true);
        $aa4=Antares_Crypt::Raw_Encrypt($dex,$_POST["dosya_enc_key"],$key_mode);
        $end=microtime(true);
        $xx9 = fopen($dosya,"w");
        fwrite($xx9,$aa4);
        fclose($xx9);
        $name=replace_tr($_FILES['dosya_enc']['name']);
        $yazi=$name;
    }
        if(isset($_FILES['dosya_dec']))
        {
            if(isset($_POST["key_mode"]))
            {
                if($_POST["key_mode"]=="b64")
                {
                    $key_mode="b64";
                }
                if($_POST["key_mode"]=="hex")
                {
                    $key_mode="hex";
                }
            }
            else
            {
                $key_mode="no";
            }
            $v = replace_tr($_FILES['dosya_dec']['name']);
            $z=strlen($v);
            $v=substr($v,10,$z);
            $v="file/".$v;
                $dosya = $_FILES['dosya_dec']['tmp_name'];
                copy($dosya,$v);  
                $dosya=$v;
                $z0 = fopen($dosya, 'r');
                $dex="";
                while(! feof($z0))
                {
                    $dex .= fgets($z0);
                }
                fclose($z0); 
                $start=microtime(true);
                $aa4=Antares_Crypt::Raw_Decrypt($dex,$_POST["dosya_dec_key"],$key_mode);
                $end=microtime(true);
                $xx9 = fopen($dosya,"w");
                fwrite($xx9,$aa4);
                fclose($xx9);
                $name=replace_tr($_FILES['dosya_dec']['name']);
                $lenght=strlen($name);
                $yazi=substr($name,10,$lenght);
                }
if (isset($yazi))
{
    if (isset($dosya)) {

            echo "<div class='zf5b44c8574b6ec187007583bbe85052'><a href='".$dosya."' download>".$yazi."</a></div>";
            if(isset($start)){echo "<div class='zf5b44c8574b6ec187007583bbe85052' style='color:grey;'>".round($end-$start,4)." Second/Saniye</div>";}else{echo "<x style='visibility:hidden;'>AntaresCrypt</x>";}
    }
}
?>
        </div>
    </body>
</html>