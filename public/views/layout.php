<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <!-- Metadata -->
    <title><?= $title ?></title>
    <meta name="author" content="Dorian Larouziere, Gatien Vilain">
    <!-- Page Layout-->
    <meta name="theme-color" content="white">
    <meta name="color-scheme" content="normal">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Style Sheets -->
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <header id="banner">
        <a title="Revenir à la page d’accueil" href="/" class="logo">
            Home
        </a>

        <!-- Quand on est connecté -->
        <?= $banner_menu ?>
    </header>

    <article id="login">
        <form action="index.php?action=login" method="post">
            <div>
                <?= $error ?>
            </div>
            <div id="login-email">
                <label for="email-field">Put your email address: </label>
                <input name="email" id="email-field" required>
            </div>
        </form>
    </article>

</body>

</html>