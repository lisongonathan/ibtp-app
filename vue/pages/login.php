<?php 
    $page = "Login";
    ob_start();
?>

<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<h3>IBTP-MATADI</h3>
				<p>Année - Academique 2022 - 2023</p>
			</div>
			<div class="content-error">
				<div class="hpanel">
          <div class="panel-body">
              <form action="#" id="loginForm">
                  <div class="form-group">
                      <label class="control-label" for="username">Code d'accèss</label>
                      <input type="text" placeholder="Veuillez entrer le code d'accèss" required name="code_access" id="code_access" class="form-control">
                      <span class="help-block small">(Matricule pour les étudiants)</span>
                  </div>
                  <div class="form-group">
                      <label class="control-label" for="password">Mot de passe</label>
                      <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="mdp" id="mdp" class="form-control">
                      <span class="help-block small">En cas d'oublier contacter la section</span>
                  </div>
                  
                  <div class="alert-title">
                      <h2>Modules</h2>
                  </div>
                  <div class="btn-group btn-custom-groups btn-custom-groups-one btn-mg-b-10">
                      
                      <button type="button" class="btn btn-primary moduleUser" data-id="1">Etudiant</button>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#grade">Financier</button>
                      <button type="button" class="btn btn-primary moduleUser" data-id="3">Jury</button>
                      <button type="button" class="btn btn-primary moduleUser" data-id="4">Section</button>
                      <button type="button" class="btn btn-primary moduleUser" data-id="5">Titulaire</button>
                  </div>
                  <hr>
                  <button class="btn btn-success btn-block loginbtn connexionBtn">Se connecter</button>
                  <a class="btn btn-default btn-block" href="index.php?subscrib">S'inscrire</a>
              </form>
          </div>
        </div>
      </div>              
    </div>   
</div>
<div class="modal fade" id="grade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AUTHENTIFICATION MODULE FINANCE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="msg-admin"></p>
                <div class="admintab-wrap edu-tab1 mg-t-30">
                    <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1">
                        <li class="active"><a data-toggle="tab" href="#TabProject"><span class="edu-icon edu-analytics tab-custon-ic"></span>INSCRIPTION</a>
                        </li>
                        <li><a data-toggle="tab" href="#TabDetails"><span class="edu-icon edu-analytics-arrow tab-custon-ic"></span>CONNEXION</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="TabProject" class="tab-pane in active animated flipInX custon-tab-style1">
                            <form>
                                <div class="form-group">
                                    <label for="code-admin-signin" class="col-form-label">CODE D'ACCESS:</label>
                                    <input type="password" class="form-control" id="code-admin-signin">
                                </div>
                                <div class="form-group">
                                    <label for="grade-admin-admin" class="col-form-label">GRADE:</label>
                                    <select class="form-control" id="grade-admin-admin">
                                        <option value="">SELECTIONNER L'UTILISATEUR</option>
                                        <option value="dg">DIRECTEUR GENERALE</option>
                                        <option value="sgcad">ACADEMIQUE</option>
                                        <option value="sgad">ADMINISTRATIF</option>
                                        <option value="op">OPERATEUR</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">MOT DE PASSE:</label>
                                    <input type="password" class="form-control" id="mdp-admin-signin">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">CONFIRMER MOT DE PASSE:</label>
                                    <input type="password" class="form-control" id="cmdp-admin-signin">
                                </div>                                
                            </form>                            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                            <button type="button" class="btn btn-primary signin-admin">CREER COMPTE</button>
                        </div>
                        <div id="TabDetails" class="tab-pane animated flipInX custon-tab-style1">
                            <form>
                                <div class="form-group">
                                    <label for="code-admin" class="col-form-label">LOGIN:</label>
                                    <input type="password" class="form-control" id="code-admin">
                                </div>
                                <div>
                                    <label for="telephone-admin" class="col-form-label">MOT DE PASSE:</label>
                                    <input type="password" class="form-control" id="mdp-admin">
                                </div>
                                <div class="form-group">
                                    <label for="grade-admin" class="col-form-label">GRADE:</label>
                                    <select class="form-control" id="grade-admin">
                                        <option value="">SELECTIONNER L'UTILISATEUR</option>
                                        <option value="dg">DIRECTEUR GENERALE</option>
                                        <option value="sgcad">ACADEMIQUE</option>
                                        <option value="sgad">ADMINISTRATIF</option>
                                        <option value="op">OPERATEUR</option>
                                    </select>
                                </div>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                            <button type="button" class="btn btn-primary login-admin">SE CONNECTER</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/auth.php"; ?>