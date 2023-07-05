<?php 
    $page = "G_Jury";
?>

<?php ob_start(); ?> 
        <div class="contacts-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="sparkline10-list mt-b-30">
                            <div class="sparkline10-hd">
                                <div class="main-sparkline10-hd">
                                    <h1>GESTION DES <span class="basic-ds-n"> TITULAIRES</span></h1>
                                </div>
                            </div>
                            <div class="sparkline10-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="basic-login-inner inline-basic-form">
                                                <form action="#">
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                                <?php
                                                                if(count($listTitulaire)){
                                                                ?>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="form-select-list">
                                                                    <select class="form-control custom-select-value" id="current-titulaire">

                                                                    <?php
                                                                        foreach ($listTitulaire as $key => $value) {
                                                                    ?>                                                          
                                                                        <option value="<?= $value['id'] ?>" <?= ($key == 1)? 'selected' : '' ?>><?= $value['nom'] ?> <?= $value['post_nom'] ?> (<?= $value['grade'] ?>)</option>                                                                
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                    </select> 
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="inline-remember-me form-check">
                                                                    <label><input type="checkbox" class="form-check-input" id="statut-titulaire"> PERMANANT </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="login-horizental lg-hz-mg"><button class="btn btn-sm btn-primary login-submit-cs" type="submit" id="update-mdp-titulaire">REINITIALISER ACCESS</button></div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="login-horizental lg-hz-mg"><button class="btn btn-sm btn-danger login-submit-cs" type="submit" id="supp-titulaire">SUPPRIMER</button></div>
                                                            </div>
                                                            <?php                                                             
                                                            }else {
                                                            ?>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="form-select-list">
                                                                    <select class="form-control custom-select-value" name="list_jury">
                                                                        <option value="" selected>Aucun enseignant disponible</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
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

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="sparkline11-list responsive-mg-b-30">
                            <div class="sparkline11-hd">
                                <div class="main-sparkline11-hd">
                                    <h1>DEFINIR UN NOUVEAU <span class="basic-ds-n">ENSEINGNANT</span></h1>
                                </div>
                            </div>
                            <div class="sparkline11-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="modal-bootstrap modal-login-form">
                                                <a class="zoomInDown mg-t" href="#" data-toggle="modal" data-target="#zoomInDown1">AJOUTER UN ENSEIGNANT</a>
                                            </div>
                                            <div id="zoomInDown1" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="modal-login-form-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="basic-login-inner modal-basic-inner">
                                                                            <h3>NOUVEAU ENSEIGNANT</h3>
                                                                            <p id='msg-jury'>Veuillez remplir tous les champs (Pour la charge horaire, reportez vous à la section COURS)</p>
                                                                            <form action="#">
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">NOM</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="text" class="form-control" id='nom-enseignant' placeholder="Nom de l'enseignant" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">POST - NOM</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="text" class="form-control" id='post-nom-enseignant' placeholder="Post-nom de l'enseignant" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">PRENOM</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="text" class="form-control" id='prenom-enseignant' placeholder="Prenom de l'enseignant" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">SEXE</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="chosen-select-single mg-b-20">
                                                                                                <select data-placeholder="Sexe de l'enseignant" id='sexe-enseignant' class="form-control chosen-select" tabindex="-1">
                                                                                                    <option value="M">MASCULIN</option>
                                                                                                    <option value="F">FEMININ</option>	
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">GRADE</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="chosen-select-single mg-b-20">
                                                                                                <select data-placeholder="Sexe de l'enseignant" id='grade-enseignant' class="form-control chosen-select" tabindex="-1">
                                                                                                    <option value="ASS">ASSISTANT</option>
                                                                                                    <option value="CPP">CHARGE DES PRATIQUES PROFESSIONNELLES</option>	
                                                                                                    <option value="CT">CHEF DE TRAVAUX</option>	
                                                                                                    <option value="EXP">EXPERTS</option>
                                                                                                    <option value="PROF">PROFESSEURS</option>		
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">STATUT</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="chosen-select-single mg-b-20">
                                                                                                <select data-placeholder="Sexe de l'enseignant" id='statut-enseignant' class="form-control chosen-select" tabindex="-1">
                                                                                                    <option value="VISITEUR">VISITEUR</option>
                                                                                                    <option value="PERMANANT">PERMANANT</option>		
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="login-btn-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                            <div class="login-horizental">
                                                                                                <button class="btn btn-sm btn-primary login-submit-cs" id='add-enseignant' type="submit">AJOUTER</button>
                                                                                            </div>
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
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
        <div class="contacts-area mg-b-15">  
        <?php
        if (count($listTitulaire)) {
        ?>
            <div class="container-fluid">
                <div class="row">

        <?php
            foreach ($listTitulaire as $key => $value) {
                $infos_etudiants = getStudentsTitulaire($value['id']);
                $infos_credits = getCreditsTitulaire($value['id']);
                $infos_promotions =  getPromosListTitulaire($value['id']);
                $infos_matieres = getPromosTitulaire($value['id']);

                $tota_promotion = 0;
                $total_etudiants = 0;
                $total_matieres = 0;
                $total_AS = 0;
                $total_LMD = 0;

                foreach ($infos_promotions as $k => $v) {
                    $tota_promotion++;

                    if ($v['systeme'] == 'AS') {
                        # code...
                        $total_AS++;
                    } else {
                        # code...
                        $total_LMD++;
                    }                    

                }

                foreach ($infos_etudiants as $k => $v) {
                    # code...
                    $total_etudiants++;
                }

                foreach ($infos_matieres as $k => $v) {
                    # code...
                    $total_matieres++;
                }
        ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-2">
                        <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="vue/gabarit/img/contact/tit.jpg">
                                <h3><a href="#"><?= $value['nom'] ?> <?= $value['post_nom'] ?> <?= $value['prenom'] ?></a></h3>
                                <p class="all-pro-ad"><?= $value['grade'] ?> (<?= $value['code_access'] ?>) - <?= $value['statut'] ?></p>
                                <div class="course-des">
                                    <p><span><i class="fa fa-clock"></i></span> <b>TELEPHONE</b></p>
                                    <p><span><i class="fa fa-clock"></i></span> <b><?= $value['telephone'] ?></p>
                                    <hr>
                                    <p><span><i class="fa fa-clock"></i></span> <b>PROMOTIONS</b></p>
                                    <p><span><i class="fa fa-clock"></i></span> <b><?= $tota_promotion ?></p>
                                    <hr>
                                    <p><span><i class="fa fa-clock"></i></span> <b>ETUDIANTS:</b> <span class="counter"><?= $total_etudiants ?></span> </p>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12"><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#identites-<?= $value['id'] ?>" data-whatever="@mdo">Identites</button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#academique-<?= $value['id'] ?>" data-whatever="@fat">Academique</button>

                                    <div class="modal fade" id="identites-<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">IDENTITES</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">NOM:</label>
                                                            <input type="text" class="form-control" id="update-nom-enseignant" value="<?= $value['nom'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">POST NOM:</label>
                                                            <input type="text" class="form-control" id="update-post-nom-enseignant" value="<?= $value['post_nom'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">PRENOM:</label>
                                                            <input type="text" class="form-control" id="update-prenom-enseignant" value="<?= $value['prenom'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select data-placeholder="Sexe de l'enseignant" id='update-sexe-enseignant' value="<?= $value['sexe'] ?>" class="form-control chosen-select" tabindex="-1">
                                                                    <option value="M">MASCULIN</option>
                                                                    <option value="F">FEMININ</option>	
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                                                    <button type="button" class="btn btn-primary" data-id="<?= $value['id'] ?>" id='update-enseignant'>METTRE &Agrave; JOUR</button>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="modal fade" id="academique-<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">INFOS. ACADEMIQUE</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">GRADE</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="chosen-select-single mg-b-20">
                                                                    <select data-placeholder="Sexe de l'enseignant" id='update-grade-enseignant' class="form-control chosen-select" tabindex="-1">
                                                                        <option value="ASS" <?= ($value['grade'] == 'ASS') ? 'selected' : '' ?>>ASSISTANT</option>
                                                                        <option value="CPP" <?= ($value['grade'] == 'CPP') ? 'selected' : '' ?>>CHARGE DES PRATIQUES PROFESSIONNELLES</option>	
                                                                        <option value="CT" <?= ($value['grade'] == 'CT') ? 'selected' : '' ?>>CHEF DE TRAVAUX</option>	
                                                                        <option value="EXP" <?= ($value['grade'] == 'EXP') ? 'selected' : '' ?>>EXPERTS</option>
                                                                        <option value="PROF" <?= ($value['grade'] == 'PROF') ? 'selected' : '' ?>>PROFESSEURS</option>		
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">STATUT</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="chosen-select-single mg-b-20">
                                                                    <select data-placeholder="Sexe de l'enseignant" id='update-statut-enseignant' class="form-control chosen-select" tabindex="-1">
                                                                        <option value="VISITEUR" <?= ($value['statut'] == 'VISITEUR') ? 'selected' : '' ?>>VISITEUR</option>
                                                                        <option value="PERMANANT" <?= ($value['statut'] == 'PERMANANT') ? 'selected' : '' ?>>PERMANANT</option>		
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                                                    <button type="button" class="btn btn-primary" data-id="<?= $value['id'] ?>" id='update-acad-enseignant'>METTRE &Agrave; JOUR</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="panel-footer contact-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="contact-stat"><span>COURS.: </span> <strong class='counter'><?= $total_matieres ?></strong></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="contact-stat"><span>LMD.: </span> <strong class='counter'><?= $total_AS ?></strong></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="contact-stat pull-right"><span>AS.: </span> <strong class='counter'><?= $total_LMD ?></strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
            }
        ?>
                </div>
            </div>

        <?php
        } else {
        ?>
            <h2>Aucune information</h2>
        <?php
        }
        ?>
        </div>


<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/main.php"; ?>