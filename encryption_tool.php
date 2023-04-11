<?php
    header("Expires: on, 01 Jan 1 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    function randomstr($length = 4)
    {
        $str = "";
        $characters = array_merge(range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++)
        {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="description" content="AntaresCrypt Encryption Tool">
        <meta name="author" content="">
        <meta name="robots" content="index, follow">
        <meta http-equiv="content-type" content="text/html;UTF-8">
        <meta http-equiv="content-language" content="tr">
        <meta http-equiv="expires" content="Mon,08 Apr 2019 13:26:49 GMT">
        <meta http-equiv="revisit-after" content="1 days">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AntaresCrypt Encryption Tool</title>
        <link rel="shortcut icon" href="icon.jpg" />
        <style>*{color:grey;}</style>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>a:hover, a:visited, a:link, a:active{text-decoration: none;}</style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <a id="error1" href="index.php" style="font-size:64px;color:#221e1e;">Refresh Page</a>
            <?php
                include "ac17.php";
                $temel=false;
                if(isset($_POST["enc"]))
                {
                    $data=$_POST["data"];
                    if(isset($_POST["data_mode"]))
                    {
                        if($_POST["data_mode"]=="hex")
                        {
                            if(strlen(trim($data))%2==0)
                            {
                                $data=hex2bin(trim($data));
                            }
                            else
                            {
                                ?>
                                    <script>window.location=''</script>
                                <?php
                            }
                        }
                    }
                    $key=$_POST["key"];
                    if(isset($_POST["key_mode"]))
                    {
                        if($_POST["key_mode"]=="hex")
                        {
                            $key_mode="hex";
                        }
                        if($_POST["key_mode"]=="b64")
                        {
                            $key_mode="b64";
                        }
                    }
                    else
                    {
                        $key_mode="no";
                    }
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
                        if(strlen(trim($key))%2==0)
                        {
                            $key=hex2bin(trim($key));
                        }
                        else
                        {
                            ?>
                                <script>window.location=''</script>
                            <?php
                        }
                    }
                            $start=microtime(true);
                            $temel=AntaresCrypt_Core::Encrypt($data,$key);
                            $end=microtime(true);

                }
                if(isset($_POST["dec"]))
                {
                    $key=$_POST["key"];
                    if(isset($_POST["key_mode"]))
                    {
                        if($_POST["key_mode"]=="hex")
                        {
                            $key_mode="hex";
                        }
                        if($_POST["key_mode"]=="b64")
                        {
                            $key_mode="b64";
                        }
                    }
                    else
                    {
                        $key_mode="no";
                    }
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
                        if(strlen(trim($key))%2==0)
                        {
                            $key=hex2bin(trim($key));
                        }
                        else
                        {
                            ?>
                                <script>window.location=''</script>
                            <?php
                        }
                    }

                        $start=microtime(true);
                        $temel=AntaresCrypt_Core::Decrypt($_POST["data"],$key);
                        $end=microtime(true);
                        if(isset($_POST["data_mode"]))
                        {
                            if($_POST["data_mode"]=="hex")
                            {
                                $temel=bin2hex($temel);
                            }
                        }



                }
            ?>
    <body style='background-color:#221e1e;color:darkred;'>
    <script>document.getElementById("error1").style.display = "none";</script>
    <?php
?>
        <div style="word-wrap: break-word;margin:auto;text-align:center;">
        <h1>AC17 Encryption Tool</h1>
            <form  action="" method="post">
                <label>
            <?php
                $lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if($lang=="tr"){echo "Metin";}
                else if($lang=="en"){echo "Text";}
                else{echo "Text";}
            ?>
             & Hexadecimal <input type="checkbox" name="data_mode" value="hex" style="padding:0;margin:0;width:0;height:10;" <?php if(isset($_POST["data_mode"])){if($_POST["data_mode"]=="hex"){echo "checked";}}?>>&nbsp;</label></label><br>
                <script>document.addEventListener('DOMContentLoaded', function() {document.getElementById('k').onclick = calistir;function calistir() {var kopyala = document.getElementById('kopyala');kopyala.select();document.execCommand('copy');}});</script>
                <input type="button" value="<?php
                $lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if($lang=="tr"){echo "Kopyala";}
                else if($lang=="en"){echo "Copy";}
                else{echo "Copy";}?>" id="k" style="width:200px;height:42;background-color:#3e3938;color:#dd674a;border:1px solid black;"><br>   
                <textarea name="data" id="kopyala" placeholder="<?php
                $lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if($lang=="tr"){echo "Metin";}
                else if($lang=="en"){echo "Text";}
                else{echo "Text";}
            ?>" style="color:black;width: 95%; height: 250px;background-color:#3e3938;color:#dd674a;border:1px solid black;" autocomplete="off" required><?php if(isset($_POST["cryptographic-database"])){echo $_POST["data"];}echo htmlspecialchars($temel, ENT_QUOTES, 'UTF-8');?></textarea><br><?php                 if(isset($start)){echo round($end-$start,4)." Second/Saniye";}else{echo "<x style='visibility:hidden;'>AntaresCrypt</x>";}?><br>
                <label>
                <?php
                $lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if($lang=="tr"){echo "Parola";}
                else if($lang=="en"){echo "Password";}
                else{echo "Password";}
            ?> & Base64 <input type="checkbox" name="key_mode" value="b64" style="padding:0;margin:0;width:0;height:10;" <?php if(isset($_POST["key_mode"])){if($_POST["key_mode"]=="b64"){echo "checked";}}?>>&nbsp;& Hexadecimal <input type="checkbox" name="key_mode" value="hex" style="padding:0;margin:0;width:0;height:10;" <?php if(isset($_POST["key_mode"])){if($_POST["key_mode"]=="hex"){echo "checked";}}?>>&nbsp;</label>
                <br>
                <textarea placeholder="<?php
                $lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if($lang=="tr"){echo "Parola";}
                else if($lang=="en"){echo "Password";}
                else{echo "Password";}
            ?>"  name="key" autocomplete="off" style="width: 95%; height: 60px;background-color:#3e3938;color:#dd674a;border:1px solid black;" required><?php if(isset($_POST["key"])) {echo htmlspecialchars($_POST["key"], ENT_QUOTES, 'UTF-8');}?></textarea>
                <br>
                <button type="submit" style="background-color:#3e3938;color:#dd674a;border:1px solid black;" name="enc">
                <?php
                $lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if($lang=="tr"){echo "Şifrele";}
                else if($lang=="en"){echo "Encrypt";}
                else{echo "Encrypt";}
            ?>
                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" style="background-color:#3e3938;color:#dd674a;border:1px solid black;" name="dec">
                <?php
                $lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if($lang=="tr"){echo "Deşifrele";}
                else if($lang=="en"){echo "Decrypt";}
                else{echo "Decrypt";}
            ?>
                </button>
            </form>
            <br>
            <div style="margin:0 auto;color:black;width: 95%; height: auto;background-color:#3e3938;color:#dd674a;border:1px solid black;">

<div class="container-fluid text-center">
<div class="row slideanim">
<div class="col-sm-6">
<h3 style="color:#dd674a;display:block;">TEXT - QR - CODE</h3>
<?php
if(isset($_POST["enc"]))
{
            ?>
            <a style="display:block;" target="_blank" href="https://chart.googleapis.com/chart?chs=545x545&cht=qr&chl=<?php 
            if(isset($_POST["enc"]))
            {echo urlencode(str_replace("CryptoGeneric-","",$temel));}
            else {echo urlencode("");}
            ?>"><img style="height:400px;width:100%;max-width:400px;" src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=<?php 
            if(isset($_POST["enc"]))
            {echo urlencode(str_replace("CryptoGeneric-","",$temel));}
            else {echo urlencode("");}
            ?>&choe=UTF-8" title="Link to Google.com" /></a>
            <?php
}
else {echo "Henüz şifreleme yapılmadı...";}
            ?>
</div>
<div class="col-sm-6">
<h3 style="color:#dd674a;display:block;">PASS - QR - CODE</h3>
<?php
if(isset($_POST["enc"]))
{
            ?>
                <a style="display:block;" target="_blank" href="https://chart.googleapis.com/chart?chs=545x545&cht=qr&chl=<?php 
            if(isset($_POST["enc"]))
            {echo urlencode($_POST["key"]);}
            else {echo urlencode("");}
            ?>"><img style="height:400px;width:100%;max-width:400px;" src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=<?php 
            if(isset($_POST["enc"]))
            {echo urlencode($_POST["key"]);}
            else {echo urlencode("");}
            ?>&choe=UTF-8" title="Link to Google.com" /></a>
            <?php
}
else {echo "Henüz şifreleme yapılmadı...";}
            ?>
</div>
</div>
</div>
<br><br></div>
        </div>
        </div>
        <br><br>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>