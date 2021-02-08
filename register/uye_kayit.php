<?php
require 'Medoo.php';
// include mail function with phpmailer classes
require 'mail.php';

use Medoo\Medoo;

$database = new Medoo([
  // required
  'database_type' => 'mysql',
  'database_name' => 'register',
  'server' => 'localhost',
  'username' => 'root',
  'password' => '123456789',

  // [optional]
  'charset' => 'utf8mb4',
  'collation' => 'utf8mb4_general_ci',
  'port' => 3306
]);
?>
<!DOCTYPE html>

<head>
  <title>Kayıt</title>
</head>

<body>
  <h1>Kayıt Sayfası</h1> 
  <form action="" method="post" enctype="multipart/form-data">
    Ad: <input type="text" name="ad">
    Soyad: <input type="text" name="soyad"><br><br>
    Mail: <input type="email" name="email">
    Şifre: <input type="password" name="sifre"><br><br>
    Görsel:
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    <input type="submit" value="Hesabı Oluştur">
    <br>
    <a href="index.php">GİRİŞ YAP>></a>
  </form>

</body>

</html>
<?php

if (isset($_POST["ad"]) && isset($_POST["soyad"]) && isset($_POST["email"]) && isset($_POST["sifre"]) && isset($_FILES["fileToUpload"])) {
  if ($_POST["ad"] != "" && $_POST["soyad"] != "" && $_POST["email"] != "" && $_POST["sifre"] != "") {
    //Resim

    $target_dir = "resimler/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Aynı isimli görsel bulunmakta. Görselin ismi değiştirip yeniden yükleyin.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Görselin boyutu max değeri aştı.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sadece JPG, JPEG, PNG & GIF dosya uzantılarından birini yükleyebilirsiniz.";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    // resim bitiş

    
    
    $aCode = rand(0, 20000);
    $activationCode = md5($aCode);
    $database->insert("400432_tbl_kayitlar", ["ad" => $_POST["ad"], "soyad" => $_POST["soyad"], "email" => $_POST["email"], "sifre" => $_POST["sifre"], "resim_url" => $target_file, "kod" => $activationCode]);
    $kayit = $database->id();
    if ($kayit > 0) {
      
      echo '<script>alert("Başarıyla kayıt oldunuz.  ' . sendMail($_POST["email"], $_POST["ad"], $activationCode, "") . '")</script>';
    } else {
      echo '<script>alert("Hata, tekrar deneyin.")</script>';
    }
  } else {
    echo '<script>alert("Tüm alanları doldurun.")</script>';
  }
}







?>