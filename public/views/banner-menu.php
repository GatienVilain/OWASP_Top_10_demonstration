<?php if ( !empty($_SESSION["admin"]) )
{
    require('public/views/admin_banner_menu.php');
}
else { $admin_navbar = ""; } ?>


<?php ob_start(); ?>

<button title="Ouvrir la barre de navigation"  id="navbar-button"></button>
<nav id="navbar">
    <a title="Se déconnecter et revenir à la page de connexion" href="index.php?action=logout">Logout</a>

    <!-- Admin Only -->
    <?= $admin_navbar ?>
</nav>

<?php $banner_menu = ob_get_clean(); ?>