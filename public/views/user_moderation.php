<?php $title = "ADMIN ONLY"; ?>
<?php $stylesheets = "<link rel=\"stylesheet\" href=\"public/css/user_moderation.css\">" ?>
<?php $scripts = "" ?>

<?php require('public/views/banner-menu.php'); ?>

<?php ob_start(); ?>

<!-- Content -->
<article>

	<h2>Users :</h2>

	<form action = "index.php?action=deleteUser" method= "post">
		<table>
			<tr></tr>
			<?php
			foreach ($users_table as $user)
			{	?>
				<tr>
					<td class="prenom">
						<?= $user['prenom']; ?>
					</td>
					<td class="nom">
						<?= $user['nom']; ?>
					</td>
					<td class="email">
						<?= $user['email']; ?>
					</td>
					<td class="description">
						<?= htmlspecialchars($user["descriptif"]); ?>
					</td>
					<td>
						<a title="Accède à la page pour modifier l’utilisateur <?= $user['prenom']." ".$user['nom']; ?>" href="index.php?action=editRights&for=<?= $user['email'];?>">🖉 Edit</a>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
	</form>


</article>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>