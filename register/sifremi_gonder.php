<?php
require 'Medoo.php';
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
    <title>Şifremi Hatırlat</title>
</head>

<body>
<h1>Şifre Hatırlatma</h1>

    <form action="" method="post">
        Mail: <input type="email" name="email">
        <input type="submit" value="Şifremi Gönder"><br>
    </form>
</body>
<br><a href="index.php">Giriş Sayfasına Git</a><br>

</html>

<?php
if (isset($_POST["email"])) {
    if ($_POST["email"] != "") {
        $email = $database->get("400432_tbl_kayitlar", "sifre", [
            "email" => $_POST["email"]
        ]);
        if (is_null($email)) {
            echo 'mail adresiniz veritabanında bulunamadı';
        } else {
            echo sendMail($_POST["email"], "", "", "Şifreniz: {$email}");
        }
    }
}



?>