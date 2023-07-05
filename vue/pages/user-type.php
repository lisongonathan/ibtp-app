<?php 
    $page = "Signin";
    ob_start();
?>

<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="content-error">
				<h1>UTILISATEURS:<span class="counter"> 5</span></h1>
				<p>Si vous voulez rejoindre les autres et profiter de l'application <strong>IBTP-MATADI</strong>. <br /><strong>Premièrement</strong>, choisisez le type d'utilisateur ci - bas.<br /><strong>Deuxièment</strong>, récuperez votre code d'accèss.<br /> <strong>Enfin,</strong>definissez votre mot de passe (à garder secret)</p>
				<a href="index.html">ENSEIGNANT</a>
				<a href="#">ETUDIANT</a>
			</div>
			<div class="text-center login-footer">
				<p><a href="loginApp.html">J'ai déjà un compte...</a></p>
			</div>
		</div>   
    </div>

<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/auth.php"; ?>