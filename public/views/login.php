<?php $title = "LOGIN"; ?>
<?php $stylesheets = "<link rel=\"stylesheet\" href=\"public/css/login.css\">" ?>
<?php $scripts = "" ?>

<?php $banner_menu = "" ?>

<?php ob_start(); ?>

<article id="login">

    <form action="index.php?action=login" method="post">
        <div>
            <?= $error ?>
        </div>
        <div id="login-email">
            <label for="email-field">Enter your email address: </label>
            <input type="email" name="email" id="email-field" required>
        </div>
        <div id="login-password">
            <label for="password-field">Enter your password: </label>
            <input name="password" id="password-field" required>
        </div>
        <Button type="submit">S’authentifier</button>
    </form>

</article>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>