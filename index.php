<?php

require_once("components/Controllers/UsersModeration.php");
require_once("components/Models/User.php");

use Application\Controllers\UsersModeration;
use Application\Models\User;

# ----------------------------------
// * Database correction informations
$host = "localhost";
$dbname = "drive";
$username = "root";
$password = "";
# ----------------------------------


try
{
    $error = "";
    if ( (new User())->is_connected() )
    {
        if ( isset($_GET['action']) && $_GET['action'] !== '' )
        {
            // * ---------- Broken Access Control ----------------

            if ((new User())->is_admin())
            {
                // if ($_GET['action'] === 'admin')
                // {
                    (new UsersModeration())->execute();
                // }
            }

            // * ---------------------------------------------------

            elseif ($_GET['action'] === 'logout')
            {
                (new User())->logout();
            }
            else {
                header('Location: /');
            }
        }
        else
        {
            $email = $_SESSION['email'];
            $role = ( $_SESSION['admin'] ) ? 'admin' : 'basic user';
            $description = $_SESSION['description'];
            require('public/views/homepage.php');
        }

        require('public/views/banner-menu.php');
    }
    elseif ( !empty($_POST['email']) )
    {
        // * ----------- SQL Injection ----------------

        $email = $_POST['email'];
        $passwd = $_POST['password'];

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        # UNSECURE
        $query = "SELECT prenom,nom,descriptif,role,mot_de_passe FROM utilisateur WHERE email = '$email' AND mot_de_passe = '$passwd'";
        $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        // ! Can login with this expression : ' OR '1'='1

        // # SECURE
        // $query = $pdo->prepare("SELECT prenom,nom,descriptif,role,date_inscription,compte_supprime FROM utilisateur WHERE email = :email AND mot_de_passe = :passwd");
        // $query->bindValue(':email', $email, PDO::PARAM_STR);
        // $query->bindValue(':passwd', $passwd, PDO::PARAM_STR);
        // $query->execute();
        // $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // * -------------------------------------------

        // * ----------- Identification and Authentification failures ----------------
        # UNSECURE
        if ( $result != NULL )

        # SECURE
        # 

        // if ( $result != NULL && password_verify($passwd, $result[0]['mot_de_passe']) )

        // # Hash for Briques_Rouges2022 -> $2y$10$DEl5PsVTQ73aO/T04UNO8.P16kUE4KVHCz05T4z.kivNFlRU0NkO.
        // * -------------------------------------------------------------------------
        {
            $_SESSION['connected'] = 1;
            $_SESSION['admin'] = ( $result[0]["role"] == "admin" ) ? 1 : 0;
            $_SESSION['email'] = $email;
            $_SESSION['description'] = $result[0]["descriptif"];
            header('Location: /');
        }
        else
        {
            $error = "The login credentials provided are incorrect.";
            $title = "login";
            require('public/views/login.php');
        }
    }
    else {
        $title = "login";
        $_SESSION['connected'] = 0;
        require('public/views/login.php');
    }
}
catch (Exception $e)
{
    echo "Error : " . $e->getMessage();
}
