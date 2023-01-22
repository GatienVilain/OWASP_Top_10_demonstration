<?php $title = "HOME"; ?>
<?php $stylesheets = "<link rel=\"stylesheet\" href=\"public/css/profile.css\">" ?>
<?php $scripts = "" ?>

<?php require('public/views/banner-menu.php'); ?>

<?php ob_start(); ?>

<!-- Page de Profil -->
<article id="profile">

<!-- Composant d’information du profil -->
    <section id="profile-information">
        <h3>
            <!-- remplacer par le nom du profil utilisateur -->
            <?= $email ?>
        </h3>
        <p class="role">
            <!-- ȑemplacer par le rôle de l’utilisateur -->
            <?= $role ?>
        </p>

        <form action="index.php?action=changeDescription" method="post">
            <textarea id="profile-description" name="description"  maxlength="256" required><?= $description ?></textarea>
            <button type="submit">Modifier</button>
        </form>
    </section>

</article>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>