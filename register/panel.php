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
if (isset($_POST['baslikEkle'])) {
    if (isset($_POST["baslik"]) && !empty($_POST['baslik'])) {
        $database->insert("400432_tbl_nbaslik", ["baslik" => $_POST["baslik"]]);
        echo '<script>alert("Başlık eklendi.");</script>';
    } else {
        echo '<script>alert("Hata, tekrar deneyin!");</script>';
    }
}
if (isset($_POST['detayEkle'])) {
    if (isset($_POST["detay"]) && !empty($_POST['detay'])) {
        $database->insert("400432_tbl_ndetay", ["detay" => $_POST["detay"]]);
        echo '<script>alert("Detay eklendi.");</script>';
    } else {
        echo '<script>alert("Hata, tekrar deneyin!");</script>';
    }
}

if (isset($_POST['eslestir'])) {

    if (empty($_POST['baslik1']) || empty($_POST['detay1'])) {
        echo '<script>alert("Hata, tekrar deneyin!");</script>';
    } else {

        $data = $database->update("400432_tbl_nbaslik", [
            "detayID" => $_POST['detay1']
        ], [
            "baslikID" => $_POST['baslik1']
        ]);
        echo '<script>alert("Eşleştirildi.");</script>';
    }
}

if (isset($_POST['silme'])) {
    if (empty($_POST['td_1'])) {
        echo '<script>alert("Hata, tekrar deneyin!");</script>';
    } else {
        $data = $database->update("400432_tbl_nbaslik", [
            "detayID" => null
        ], [
            "baslikID" => $_POST['td_1']
        ]);
        echo '<script>alert("Silindi.");</script>';
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Panel</title>
</head>

<body>
    <h1>Panel</h1> 
    <form action="" method="post">
        Not Başlığı: <input type="text" name="baslik">
        <input type="submit" name="baslikEkle" value="+ Ekle">
    </form>
    <br>
    <br>
    <form action="" method="post">
        Not Detayı: <input type="text" name="detay">
        <input type="submit" name="detayEkle" value="+ Ekle">
    </form>
    <br>
    <br>
    <form action="" method="post">
        <label>Başlık:</label>
        <select name="baslik1">
            <?php
            $baslik_ = $database->select("400432_tbl_nbaslik", "*");
            foreach ($baslik_ as $baslik_) {
                echo "<option value='" . $baslik_["baslikID"] . "'>" . $baslik_["baslik"] . "</option>";
            }
            ?>
        </select>

        <label>Detay:</label>
        <select name="detay1">
            <?php
            $detay = $database->select("400432_tbl_ndetay", "*");
            foreach ($detay as $detay) {
                echo "<option value='" . $detay["detayID"] . "'>" . $detay["detay"] . "</option>";
            }
            ?>
        </select>
        <input type="submit" name="eslestir" value="+ Eşleştir">
    </form>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>Not ID</th>
                <th>Not Başlığı</th>
                <th>Not Detayı</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $basliklar = $database->select("400432_tbl_nbaslik", "*", ["detayID[!]" => null]);
            
            foreach ($basliklar as $baslik) {
                
                $detay = $database->get("400432_tbl_ndetay", "*", ["detayID" => $baslik["detayID"]]);
                $id = $baslik['baslikID'];
                echo "<form action='' method='post'><tr><td><input type='hidden' name='td_1' value='$id'>" . $baslik["baslikID"] . "</td>
                    <td>" . $baslik["baslik"] . "</td>
                    <td>" . $detay["detay"] . "</td>
                    <td><input type='submit' name='silme' value='SİL'></td>
                    
                    </tr></form>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
