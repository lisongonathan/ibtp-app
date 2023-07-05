<?php 
    $page = "Signin";
    ob_start();
?>
<div class="error-pagewrap">
    <div class="error-page-int">
        <div class="text-center custom-login">
            <h3>INSCRIPTION</h3>
            <p>Veuillez renseigner tous les informations svp</p>
        </div>
        <div class="content-error">
            <div class="hpanel">
                <div class="panel-body">
                    <form action="#" id="loginForm">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Code d'accès</label>
                                <div class="chosen-select-single mg-b-20">
                                    <select data-placeholder="Rechercher votre nom..." class="form-control chosen-select" tabindex="-1">
										<option value=""></option>	
										<?php
										foreach ($data as $key => $value) {
										?>
										<option value="<?= $value['id']; ?>"><?= $value['nom']; ?> <?= $value['post_nom']; ?> => <strong><?= $value['code_access']; ?></strong></option>
										<?php
										}
										?>
                                        </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control mdp-user">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Repeter le mot de passe</label>
                                <input type="password" class="form-control cmdp-user">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Votre Addresse</label>
                                <input class="form-control addr-user">
                                <span class="help-block small">(Obligatoire)</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Votre N° TEL.</label>
                                <input class="form-control tel-user">
                                <span class="help-block small">(Obligatoire)</span>
                            </div>
                            
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success loginbtn signinBtn" type="submit">S'inscrire</button>
                            <button class="btn btn-default quitSigninBtn">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>   
</div>

<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/auth.php"; ?>