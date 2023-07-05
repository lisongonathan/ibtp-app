<?php 
    $page = "Erreur";
    ob_start();
?>

<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="content-error">
				<h1>Oops!</h1>
				<p><?php echo $msgErreur; ?></p>
				<a href="index.php">Acceuil</a>
				<a href="#" onclick="rtn()">Retour</a>
			</div>
		</div>  
    
<script>
function rtn() {
   window.history.back();
}
</script>

<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/auth.php"; ?>
