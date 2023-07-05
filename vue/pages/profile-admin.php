<?php 
    $page = "Profile";
?>

<?php ob_start(); ?> 

        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="profile-info-inner">
                            <div class="profile-img">
                                <img src="vue/gabarit/img/profile/coges.jpg" alt="" />
                            </div>
                            <div class="profile-details-hr">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>GRADE</b><br /> <?= $_SESSION['qualite'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>NOM</b><br /> <?= $_SESSION['nom'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>SEXE</b><br /> <?= $_SESSION['sexe'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>POST-NOM</b><br /> <?= $_SESSION['post_nom'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="address-hr">
                                            <p><b>POSTE</b><br /> <?= $_SESSION['grade'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-solid fa-key"></i></a>
                                            <h3><?= $_SESSION['code_access'] ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-user-secret"></i></a>
                                            <h3><?= $_SESSION['login'] ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">CHANGER DE MOT DE PASSE</a></li>
                                <li><a href="#operateurs"> OPERATEURS</a></li>
                                <li><a href="#reviews"> FINANCE</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="sparkline12-graph">
                                                <div class="basic-login-form-ad">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="all-form-element-inner">
                                                                <form action="#">
                                                                    <p class="msg-admin"></p>
                                                                    <div class="form-group-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <label class="login2 pull-right pull-right-pro">ANCIEN MOT DE PASSE</label>
                                                                            </div>
                                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                                <input type="password" class="form-control current-mdp-admin" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <label class="login2 pull-right pull-right-pro">NOUVEAU MOT DE PASSE</label>
                                                                            </div>
                                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                                <input type="password" class="form-control mdp-admin" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <label class="login2 pull-right pull-right-pro">CONFIRMER MOT DE PASSE</label>
                                                                            </div>
                                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                                <input type="password" class="form-control cmdp-admin" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-primary pull-right login-submit-cs updatePassAdmin" data-id="<?= $_SESSION['id'] ?>">METTRE A JOUR</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="operateurs">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#operateur-add">AJOUTER UN OPERATEUR</a>
                                            <div class="modal fade" id="operateur-add" tabindex="-1" role="dialog" aria-labelledby="affectation_operateur" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="affectation_operateur">NOUVEAU OPERATEUR</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="msg-operateur"></p>
                                                            <div class="admintab-wrap edu-tab1 mg-t-30">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <label for="mdp-agent" class="col-form-label">MOT DE PASSE:</label>
                                                                        <input type="text" class="form-control" id="mdp-agent">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="grade-agent" class="col-form-label">GRADE:</label>
                                                                        <select class="form-control" id="grade-agent">
                                                                            <option value="APPARITEUR">APPARITEUR</option>
                                                                            <option value="SECTION">SECTION</option>
                                                                            <option value="CAISSE">CAISSE</option>
                                                                            <option value="PERCEPTION">PERCEPTION</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="chosen-select-single mg-b-20 form-group">
                                                                        <label for="operateur-agent" class="col-form-label">OPERATEUR:</label>
                                                                        <select data-placeholder="CHOISIR UN AGENT..." class="chosen-select form-control" tabindex="-1"  id="operateur-agent">                                                                                
                                                                            <?php
                                                                            foreach ($list_agents as $key => $value) {
                                                                            ?>
                                                                            <option value="<?= $value['id'] ?>"><?= $value['code_access'] ?> - <?= $value['nom'] ?> <?= $value['post_nom'] ?></option>
                                                                            
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                                                                <button type="button" class="btn btn-danger add-operateur">AJOUTER</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-status-wrap">
                                                <div class="asset-inner">
                                                    <table>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NOM</th>
                                                            <th>POST-NOM</th>
                                                            <th>ROLE</th>
                                                            <th>ACTION</th>
                                                        </tr>
                                                <?php
                                                if (count($liste_operateurs)) {                                                    
                                                    foreach ($liste_operateurs as $key => $value) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td><?= $value['nom'] ?></td>
                                                            <td><?= $value['post_nom'] ?></td>
                                                            <td>
                                                                <button class="pd-setting"><?= $value['operateur'] ?></button>
                                                            </td>
                                                            <td>
                                                                <button data-toggle="tooltip" title="Modifier" class="pd-setting-ed modifier" data-id="<?= $value['id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                <button data-toggle="tooltip" title="Supprimer" class="pd-setting-ed supprimer" data-id="<?= $value['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                            </td>
                                                        </tr>

                                                    <?php
                                                    }
                                                } else {
                                                ?>
                                                        <tr>  
                                                            <td colspan='5'><h3>Aucune information...</h3></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="reviews">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="product-status-wrap">
                                                <div class="row">
                                                    <?php
                                                    if ($_SESSION['grade'] != 'SECRETAIRE GENERAL ADMINISTRATIF & AB') {
                                                    ?>
                                                    <div class="col-lg-12">
                                                        <div class="chosen-select-single mg-b-20">
                                                            <label>RUBRIQUES</label>
                                                            <select data-placeholder="LISTE DES RUBRIQUES" class="chosen-select" tabindex="-1" id="currentRubrique">
                                                        <?php
                                                        foreach ($liste_rubriques as $key => $value) {
                                                        ?>
                                                                <option value="<?= $value['rubrique'] ?>"><?= $value['designation'] . ' - ' . $value['montant'] . ' ' . $value['monnaie'] ?> (<?= $value['semestre'] ?>) : <?= $value['intitule'] ?></option>

                                                        <?php
                                                        }
                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <div class="col-lg-4">
                                                        <div class="chosen-select-single mg-b-20">
                                                            <label>RUBRIQUES</label>
                                                            <select data-placeholder="LISTE DES RUBRIQUES" class="chosen-select" tabindex="-1" id="currentRubrique">
                                                        <?php
                                                        foreach ($liste_rubriques as $key => $value) {
                                                        ?>
                                                                <option value="<?= $value['rubrique'] ?>"><?= $value['designation'] . ' - ' . $value['montant'] . ' ' . $value['monnaie'] ?> (<?= $value['semestre'] ?>) : <?= $value['nom'] ?> <?= $value['post_nom'] ?>/<?= $value['statut'] ?> - <?= $value['intitule'] ?></option>

                                                        <?php
                                                        }
                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="add-product">
                                                            <a href="#"  data-toggle="modal" data-target="#grade">AJOUTER UNE RUBRIQUE</a>
                                                        </div>
                                                        <div class="modal fade" id="grade" tabindex="-1" role="dialog" aria-labelledby="labelAjoutRubrique" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="labelAjoutRubrique">AJOUTER UNE RUBRIQUE</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="msg-rubrique"></p>
                                                                        <div class="admintab-wrap edu-tab1 mg-t-30">
                                                                            <form>
                                                                                <div class="form-group">
                                                                                    <label for="designation-rubrique" class="col-form-label">DESIGNATION:</label>
                                                                                    <input type="text" class="form-control" id="designation-frais">
                                                                                </div>
                                                                            </form>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                                                                            <button type="button" class="btn btn-primary add-rubrique">AJOUTER</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="add-product">
                                                            <a href="#"  data-toggle="modal" data-target="#montant">FIXER LE MONTANT</a>
                                                        </div>
                                                        <div class="modal fade" id="montant" tabindex="-1" role="dialog" aria-labelledby="labelAjoutRubrique" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="labelAjoutRubrique">FIXATION</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="msg-rubrique"></p>
                                                                        <div class="admintab-wrap edu-tab1 mg-t-30">
                                                                            <form>
                                                                                <div class="chosen-select-single mg-b-20 form-group">
                                                                                    <label for="operateur-rubrique" class="col-form-label">OPERATEUR:</label>
                                                                                    <select data-placeholder="CHOISIR UN AGENT..." class="chosen-select form-control" tabindex="-1"  id="designation-rubrique">
                                                                                    
                                                                                    <?php
                                                                                    foreach ($liste_frais as $key => $value) {
                                                                                    ?>
                                                                                    <option value="<?= $value['id'] ?>"><?= $value['designation'] ?></option>
                                                                                    
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="montant-rubrique" class="col-form-label">MONTANT:</label>
                                                                                    <input type="text" class="form-control" id="montant-rubrique">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="monnaie-rubrique" class="col-form-label">MONNAIE:</label>
                                                                                    <select class="form-control" id="monnaie-rubrique">
                                                                                        <option value="USD">USD</option>
                                                                                        <option value="CDF">CDF</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="semestre-rubrique" class="col-form-label">SEMESTRE:</label>
                                                                                    <select class="form-control" id="semestre-rubrique">
                                                                                        <option value="Premier">PREMIER</option>
                                                                                        <option value="Second">SECOND</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="chosen-select-single mg-b-20 form-group">
                                                                                    <label for="operateur-rubrique" class="col-form-label">OPERATEUR:</label>
                                                                                    <select data-placeholder="CHOISIR UN AGENT..." class="chosen-select form-control" tabindex="-1"  id="operateur-rubrique">
                                                                                    
                                                                                    <?php
                                                                                    foreach ($liste_operateurs as $key => $value) {
                                                                                    ?>
                                                                                    <option value="<?= $value['id'] ?>"><?= $value['operateur'] ?> - <?= $value['nom'] ?> <?= $value['post_nom'] ?></option>
                                                                                    
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="chosen-select-single form-group">
                                                                                    <label for="classes-rubrique">NIVEAU</label>
                                                                                    <select id="classes-rubrique" data-placeholder="CLASSES..." class="chosen-select form-control" multiple="" tabindex="-1">
                                                                                    <?php
                                                                                    foreach ($list_classes as $key => $value) {
                                                                                    ?>
                                                                                    <option value="<?= $value['id'] ?>"><?= $value['intitule'] ?></option>

                                                                                    <?php
                                                                                    }

                                                                                    ?>
                                                                                    </select>
                                                                                </div>
                                                                            </form>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                                                                            <button type="button" class="btn btn-primary add-fixation" data-id="<?= $_SESSION['id'] ?>">AJOUTER</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="col-lg-12">
                                                        <div class="datatable-dashv1-list custom-datatable-overright">
                                                            <table id="table" data-toggle="table" data-pagination="true" data-search="true">
                                                                <thead>
                                                                    <tr>
                                                                        <th data-field="id">#</th>
                                                                        <th>ETUDIANT</th>
                                                                        <th>TOTAL</th>
                                                                        <th>DETTES</th>
                                                                        <th>SEMESTRE</th>
                                                                        <th>DETAIL</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id='details_recettes'>                                                                                                                                   
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/main.php"; ?>