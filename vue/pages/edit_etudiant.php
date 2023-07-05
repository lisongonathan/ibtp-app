<?php 
    $page = "Etudiant";
?>

<?php ob_start(); ?> 
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area mt-t-30 mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="profile-info-inner">
                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                            <div class="panel-body">
                                <div class="text-center content-bg-pro">
                                    <h3><?= $infoStudent['nom'] ?> <?= $infoStudent['post_nom'] ?> <?= $infoStudent['prenom'] ?></h3>
                                    <p class="text-big font-light"><?= $infoStudent['code_access'] ?>
                                    </p>
                                    <small>ANNEE ACADEMIQUE : <?= $infoAnee['debut'] ?> - <?= $infoAnee['fin'] ?></small><hr />
                                    <small>PROMOTION :  <?= $infoPromotion['intitule'] ?> <?= $infoPromotion['lblSection'] ?></small><hr />
                                    <small>SYSTEME :  <?= $infoPromotion['systeme'] ?></small><hr />
                                    <small>TELEPHONE : <?= $retVal = (isset($infoStudent['telephone'])) ? $infoStudent['telephone'] : 'Pas d\'information' ?></small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="profile-details-hr">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="btn-group btn-custom-groups btn-custom-groups-one align-self-center align-middle">
                                        <button type="button" class="btn btn-primary releveStudent" data-id="<?= $_GET['editEtudiant'] ?>"><i class="fa fa-home edu-home-admin" aria-hidden="true"></i> Spécimen relevé des cotes </button>
                                        <button type="button" class="btn btn-primary suppStudent" data-id="<?= $_GET['editEtudiant'] ?>"><i class="fa fa-times edu-danger-error" aria-hidden="true"></i> Supprimer l'étudiant</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr">
                                        <p><b>NATIONALIE</b><br /> <?=  $infoStudent['nationalite'] ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                        <p><b>ORIGINE</b><br /> <?= $infoStudent['lieu_naiss'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr">
                                        <p><b>DATE DE NAISSANCE</b><br /> <?= $infoStudent['date_naiss'] ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                        <p><b>SEXE</b><br /> <?= $infoStudent['sexe'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="address-hr">
                                        <p><b>ADRESSE</b><br /> <?= ($infoStudent['adresse']) ? $infoStudent['adresse'] : 'Pas d\'information' ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mg-b-15">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="skill-title">
                                                <p><b>SITUATION FINANCIERE</b></p>
                                                <hr />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-skill">
                                        <?php
                                            //$stat = (floatval($dataDescription['stat_1']['echecs']/$dataDescription['effectif']))*100
                                        ?>
                                        <h2>FRAIS ACADEMIQUE (<?= (isset($infoStudent['acad_frais'])) ? $infoStudent['acad_frais'] . ' CDF' : '0 CDF' ?>) / <?= $frais_acad ?></h2>
                                        <div class="progress progress-mini">
                                            <div style="width: <?=  ($infoStudent['acad_frais']/$frais_acad)*100 ?>%;" class="progress-bar progress-red"></div>
                                        </div>
                                    </div>
                                    <div class="progress-skill">
                                        <?php
                                            //$stat = (floatval($dataDescription['echecs']['echecs']/$dataDescription['effectif']))*100
                                        ?>
                                        <h2>FRAIS CONNEXE 1er Semestre (<?= (isset($infoStudent['connexe_frais'])) ? $infoStudent['connexe_frais'] . ' CDF' : '0 CDF' ?>) / <?= 24000.0 ?></h2>
                                        <div class="progress progress-mini">
                                            <div style="width: <?=  ($infoStudent['connexe_frais']/24000.0)*100 ?>%;" class="progress-bar progress-yellow"></div>
                                        </div>
                                    </div>
                                    <div class="progress-skill">
                                        <?php
                                            //$stat = (floatval($dataDescription['stat_2']['echecs']/$dataDescription['effectif']))*100
                                        ?>
                                        <h2>FRAIS CONNEXE 2nd Semestre (<?= (isset($infoStudent['connexe_frais_s2'])) ? $infoStudent['connexe_frais_s2'] . ' CDF' : '0 CDF' ?>) / <?= 24000.0 ?></h2>
                                        <div class="progress progress-mini">
                                            <div style="width: <?=  ($infoStudent['connexe_frais_s2']/24000.0)*100 ?>%;" class="progress-bar progress-green"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php 
                                if ($infoPromotion['systeme'] == 'LMD') {
                                ?>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#">NCV</a>
                                            <h3><?= $metriqueCurrentPromo['ncv'] ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#">NCNV</a>
                                            <h3><?= $metriqueCurrentPromo['ncnv'] ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#">AJAC</i></a>
                                            <h3><?= $countAjac ?></h3>
                                        </div>
                                    </div>
                                </div> 
                                <?php
                                if($countAjac){
                                ?>
                                <hr />
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12">
                                        <ul class="country-state">
                                            <h2><span class="">LISTE DES AJACs</span></h2>
                                        <?php
                                        foreach ($infoAJAC as $key => $value) {
                                        ?>
                                            <li>
                                                <small><?= $value['designation'] ?></small>
                                                <div class="pull-right"><?= round(($value['echec']/20.0)*100,2) ?>%</i></div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-danger ctn-vs-1" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?= round(($value['echec']/20.0)*100,2) ?>%;"></div>
                                                </div>
                                            </li>
                                        <?
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                
                                <?php
                                }
                                ?>

                                <?php
                                } else {
                                ?>
                                <hr />
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="address-hr">
                                            <a href="#">ECHECS LEGERS</a>
                                            <h3><?= $metriqueCurrentPromo['legers'] ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="address-hr">
                                            <a href="#">ECHECS GRAVES</a>
                                            <h3><?= $metriqueCurrentPromo['graves'] ?></h3>
                                        </div>
                                    </div>
                                </div> 

                                <?php
                                }
                                
                                ?>                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                        <ul id="myTabedu1" class="tab-review-design">
                            <li class="active"><a href="#description">ADMINISTRATIF</a></li>
                        <?php
                        if ($infoPromotion['systeme'] == 'LMD') {
                        ?>
                        <li><a href="#reviews"> ACADEMIQUE</a></li>

                        <?php
                        }
                        ?>
                            <li><a href="#INFORMATION">FINANCIER</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="devit-card-custom">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control update_diplome" placeholder="Diplome d'état" value="<?= $infoStudent['diplome'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control update_pass" placeholder="<?= (!$infoStudent['mdp']) ? "L'étudiant n'a pas de mot de passe" : "L'étudiant a un mot de passe" ?>" <?= ($infoStudent['mdp']) ? "disabled" : "" ?>>
                                                                </div>
                                                                <div class="form-group">
                                                                    <select class="form-control update_promotion">
                                                                        <option value="" selected disabled>PROMOTIONS</option>
                                                                    <?php 
                                                                    foreach ($listPromotion as $key => $value) {
                                                                    ?>
                                                                    <option value="<?= $value['promo'] ?>" <?= ($value['promo'] == $infoStudent['id_promotion']) ? 'selected' : '' ?>><?= $value['class'] ?> <?= $value['designation'] ?> <?= $retVal = ($value['orientation']) ? $value['orientation'] : '' ; ?></option>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary waves-effect waves-light update_admin_etudiant" data-id="<?= $infoStudent['id'] ?>">METTRE A JOUR</button>
                                                        <button class="btn btn-default annulerBtn">ANNULER</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        if ($infoPromotion['systeme'] == 'LMD') {
                        ?>
                        <div class="product-tab-list tab-pane fade" id="reviews">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="admintab-wrap edu-tab1 mg-t-30">
                                        <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1">
                                            <li class="active"><a data-toggle="tab" href="#TabProject"><span class="edu-icon edu-analytics tab-custon-ic"></span>SUPPRIMER AJAC</a>
                                            </li>
                                            <li><a data-toggle="tab" href="#TabDetails"><span class="edu-icon edu-analytics-arrow tab-custon-ic"></span>AJOUTER AJAC</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <br />
                                            <div id="TabProject" class="tab-pane in active animated flipInX custon-tab-style1">
                                                
                                                <?php
                                                if(!$countAjac){
                                                ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h4>Aucune Information.</h4>
                                                    </div>
                                                </div>

                                                <?php
                                                }else{
                                                    foreach ($dataAjacsOfStudent as $key => $value) {
                                                ?>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <strong><?= $value['cours'] ?> (CREDIT : <?= $value['credit'] ?>) - <?= $value['ue_code'] ?></strong>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h4><?= $value['echec'] ?>/20</h4>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-primary waves-effect waves-light update_del_ajac_etudiant" data-id="<?=  $value['ajac'] ?>">SUPPRIMER</button>
                                                        <button class="btn btn-default annulerBtn">ANNULER</button>
                                                    </div>
                                                    
                                                </div><hr />
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div id="TabDetails" class="tab-pane animated flipInX custon-tab-style1">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <select class="form-control ec_ajac">
                                                                <option value="" selected disabled>LISTES DES ECs</option>
                                                            <?php 
                                                            foreach ($listECsAJAC as $key => $value) {
                                                            ?>
                                                            <option value="<?= $value['cours'] ?>"><?= $value['designation'] ?> (CREDIT: <?= $value['credit'] ?>), UE : <?= $value['code'] ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control cote_ajac" placeholder="Cote Obtenu /20">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-primary waves-effect waves-light update_add_ajac_etudiant" data-id="<?= $infoStudent['num_releve'] ?>">AJOUTER</button>
                                                        <button class="btn btn-default annulerBtn">ANNULER</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        }
                        ?>

                            <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="devit-card-custom">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control frais_acad_etudiant" placeholder="FRAIS ACADEMIQUE (CDF)">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control frais_connexe_s1" placeholder="FRAIS CONNEXE S1 (CDF)">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control frais_connexe_s2" placeholder="FRAIS CONNEXE S2 (CDF)">
                                                        </div>
                                                        <button class="btn btn-primary waves-effect waves-light update_add_ajac_etudiant">METTRE A JOU>R</button>
                                                        <button class="btn btn-default annulerBtn">ANNULER</button>
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