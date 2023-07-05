<?php 
    $page = "Signin";
    ob_start();
?>

<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="content-error">
				<h3>Pour s'inscrire</h3>
				<p>Si vous voulez rejoindre les autres utilisateurs et profiter de l'application WEB <strong>IBTP-MATADI</strong>. <br /><strong>Premièrement</strong>, choisisez le type d'utilisateur ci - bas.<br /><strong>Deuxièment</strong>, récuperez votre code d'accèss.<br /> <strong>Enfin,</strong>definissez votre mot de passe (à garder secret)</p>
				<a class="user-type" data-id="1" href="index.php?enseignants">ENSEIGNANT</a>
				<a class="user-type" data-id="2" href="index.php?etudiants">ETUDIANT</a>
			</div>
			<div class="text-center login-footer">
				<p><a href="index.php">J'ai déjà un compte...</a></p>
			</div>
		</div>   
    </div>
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/auth.php"; ?>