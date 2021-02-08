<?php
require 'Medoo.php';

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
    <title>Giriş Sayfası</title>
</head>

<body>
    <form action="" method="post">
        <h1>Giriş Sayfası</h1>
        Mail: <input type="email" name="mail">
        Şifre: <input type="password" name="sifre">
        <input type="submit" value="Giriş Yap"><br><br>
        <a href="uye_kayit.php">KAYIT OL</a><br>
        <a href="sifremi_gonder.php">Şifremi Hatırlat</a>
    </form>

</body>

</html>

<?php
if (isset($_POST["mail"]) && isset($_POST["sifre"])) {
    if ($_POST["mail"] != "" && $_POST["sifre"] != "") {

        $kullanici = $database->get("400432_tbl_kayitlar", "*", ["AND" => ["email" => $_POST["mail"], "sifre" => $_POST["sifre"]]]);
        if ($kullanici['id'] != "") {
            
            
            if ($kullanici['durum'] == 1) {
                
                
                $_SESSION["kullaniciID"] = $kullanici['id'];
                header('Location: panel.php');
                exit;
            } else {
                
                
                echo '<script>alert("Hesap aktif değil.")</script>';
                
            }
        } else {
            
            
            echo '<script>alert("Bilgileri yanlış girdiniz, tekrar deneyin.")</script>';
        }
    }
}

?>