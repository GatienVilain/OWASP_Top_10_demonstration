<?php

require_once("components/Models/User.php");

use Application\Models\User;

# ----------------------------------
# Database correction informations
$host = "localhost";
$dbname = "drive";
$username = "test";
$password = "test";
# ----------------------------------


try
{
    // if ( (new User())->is_connected() )
    // {
    //     $error = "";
    //     $title = "Home";
    //     require('public/view/banner-menu.php');
    // }
    if ( !empty($_POST['email']) )
    {
        # ----------- SQL Injection ----------------

        $email = $_POST['email'];

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        # UNSECURE
        // $sql = "SELECT * FROM users WHERE email = $email";
        // $result = $pdo->query($sql);

        # SECURE
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("i", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            echo "ID: " . $row['id'] . "<br>";
            echo "Username: " . $row['username'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
        }

        # -------------------------------------------

        // $_SESSION['connected'] = 1;
        // require('public/view/banner-menu.php');
    }
    else {
        $error = "";
        $title = "login";
        $banner_menu = "";
        $_SESSION['connected'] = 0;
    }


    require('public/views/layout.php');
}
catch (Exception $e)
{
    echo "Error : " . $e->getMessage();
}