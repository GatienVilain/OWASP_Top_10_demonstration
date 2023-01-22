<?php

namespace Application\Models;

class User
{
    public function is_connected() : bool
    {
        if (session_status() === PHP_SESSION_NONE){
            session_start();

        }

        return !empty($_SESSION['connected']);
    }

    public function is_admin(): bool
    {
        if ( isset($_SESSION['admin']) )
        {
            return $_SESSION['admin'];
        }
        else {
            $role = "";
            if ($role == "admin")
            {
                $_SESSION["admin"] = 1;
                return True;
            }
            else {
                $_SESSION["admin"] = 0;
                return false;
            }
        }
    }

    public function logout(): void
    {
        unset($_SESSION['connected']);
        session_destroy();

        header('Location: index.php');
        exit();
    }

}