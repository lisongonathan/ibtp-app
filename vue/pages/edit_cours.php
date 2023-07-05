<?php 
    $page = "Cours";
?>

<?php ob_start(); ?> 
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area mt-t-30 mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="profile-info-inner">
                        <div class="profile-img">
                            <img src="vue/gabarit/img/courses/1.jpg" alt="" />
                        </div>
                        <div class="profile-details-hr">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr">
                                        <p><b>PROMOTION</b><br /> <?= $dataDescription['promotion']['classe'] ?> <?= $dataDescription['promotion']['designation'] ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                        <p><b>ECHECS</b><br /> <?= $dataDescription['echecs']['echecs'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr">
                                        <p><b>ETUDIANTS</b><br /> <?= $dataDescription['effectif'] ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                        <p><b>R&Eacute;USSITES</b><br /> <?= $dataDescription['reussites']['reussites'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="address-hr">
                                        <p><b>VOIR LA FICHE DE COTATION <?= (int) $_GET['editCours'] ?></b><br /> <a href="index.php?printFiche=<?= (int) $_GET['editCours'] ?>" class="btn btn-warning">IMPRIMER</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mg-b-15">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="skill-title">
                                                <p><b>STATISTIQUE (Moyenne Annuel)</b></p>
                                                <hr />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-skill">
                                        <?php
                                            $stat = (floatval($dataDescription['stat_1']['echecs']/$dataDescription['effectif']))*100
                                        ?>
                                        <h2>Cote &le; 2.5</h2>
                                        <div class="progress progress-mini">
                                            <div style="width: <?= $stat ?>%;" class="progress-bar progress-red"></div>
                                        </div>
                                    </div>
                                    <div class="progress-skill">
                                        <?php
                                            $stat = (floatval($dataDescription['echecs']['echecs']/$dataDescription['effectif']))*100
                                        ?>
                                        <h2>Cote &le; 5</h2>
                                        <div class="progress progress-mini">
                                            <div style="width: <?= $stat ?>%;" class="progress-bar progress-yellow"></div>
                                        </div>
                                    </div>
                                    <div class="progress-skill">
                                        <?php
                                            $stat = (floatval($dataDescription['stat_2']['echecs']/$dataDescription['effectif']))*100
                                        ?>
                                        <h2>Cote &le; 7.5</h2>
                                        <div class="progress progress-mini">
                                            <div style="width: <?= $stat ?>%;" class="progress-bar progress-green"></div>
                                        </div>
                                    </div>
                                    <div class="progress-skill">
                                        <?php
                                            $stat = (floatval($dataDescription['reussites']['reussites']/$dataDescription['effectif']))*100
                                        ?>
                                        <h2>Cote &le; 10</h2>
                                        <div class="progress progress-mini">
                                            <div style="width: <?= $stat ?>%;" class="progress-bar progress-blue"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                        <ul id="myTabedu1" class="tab-review-design">
                            <li class="active"><a href="#description">METTRE à JOUR</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div id="dropzone1" class="pro-ad addcoursepro">
                                     
                                                <form class="dropzone dropzone-custom needsclick" action="" method="POST" id="demo1-upload">
                                                    <?= $msg ?>
                                                    
                                                    <input type="hidden" name="id" value="<?= (int) $_GET['editCours'] ?>">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input name="cours-intitule" type="text" class="form-control" value="<?= $dataEC['intitule'] ?>" placeholder="Modifier l'Intitulé">
                                                            </div>
                                                            <div class="form-group">
                                                                <input name="cours-code" id="finish" type="text" class="form-control" value="<?= $dataEC['code'] ?>"  placeholder="Modifier le Code">
                                                            </div>
                                                            <div class="form-group">
                                                                <input name="cours-credit" type="number" class="form-control" value="<?= $dataEC['credit'] ?>" placeholder="Modifier le Credit">
                                                            </div>
                                                            <div class="form-group">
                                                                <select class="form-control" value="<?= $dataEC['statut'] ?>" name="cours-statut">
                                                                    <option>Modifier le statut</option>
                                                                    <option value="NON VU" <?= $retVal = ($dataEC['statut'] == 'NON VU') ? 'selected' : '' ; ?>>Non vu</option>
                                                                    <option value="VU" <?= $retVal = ($dataEC['statut'] == 'VU') ? 'selected' : '' ; ?>>Vu</option>
                                                                    <option value="EN COURS" <?= $retVal = ($dataEC['statut'] == 'EN COURS') ? 'selected' : '' ; ?>>En cours</option>
                                                                </select>
                                                            </div>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select data-placeholder="Choisissez le titulaire..." name="cours-titulaire"  value="<?= $dataEC['id_titulaire'] ?>" class="chosen-select" tabindex="-1">
                                                                    <option value=""></option>
                                                                <?php
                                                                foreach ($dataEnseignant as $key => $value) {
                                                                    # code...
                                                                ?>
                                                                    <option value="<?= $value['id'] ?>" <?= $retVal = ($dataEC['id_titulaire'] == $value['id']) ? 'selected' : '' ; ?>><?= $value['grade'] ?> <?= $value['nom'] ?> <?= $value['post_nom'] ?> (<?= $value['code_access'] ?>)</option>
                                                                <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select data-placeholder="Choisissez le semestre..." name="cours-semestre" value="<?= $dataEC['semestre'] ?>" class="chosen-select" tabindex="-1">
                                                                    <option value="Premier" <?= $retVal = ($dataEC['semestre'] == 'Premier') ? 'dafault' : '' ; ?>>Premier</option>
                                                                    <option value="Second" <?= $retVal = ($dataEC['semestre'] == 'Second') ? 'dafault' : '' ; ?>>Second</option>
                                                                </select>
                                                            </div>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select data-placeholder="Choisissez l'unité d'enseignement..." name="cours-unite"  value="<?= $dataEC['modif'] ?>" class="chosen-select" tabindex="-1">
                                                                    <option value=""></option>
                                                                <?php
                                                                foreach ($dataUE as $key => $value) {
                                                                    # code...
                                                                ?>
                                                                    <option value="<?= $value['id'] ?>" <?= $retVal = ($dataEC['designation'] == $value['designation']) ? 'selected' : '' ?> ><?= $value['designation'] ?> (<?= $value['code'] ?>)</option>
                                                                <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="">
                                                                <input type="submit" class="btn btn-primary waves-effect waves-light" value="Enregistrer" name="updateCours">
                                                                <button class="btn btn-default annulerBtn">Annuler</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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