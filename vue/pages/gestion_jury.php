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
                                    <h1>GESTION DES <span class="basic-ds-n"> BUREAUX JURY</span></h1>
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
                                                                if(count($listJury)){
                                                                ?>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="form-select-list">
                                                                    <select class="form-control custom-select-value" id="current-jury">

                                                                    <?php
                                                                        foreach ($listJury as $key => $value) {
                                                                    ?>                                                          
                                                                        <option value="<?= $value['id'] ?>" <?= ($key == 1)? 'selected' : '' ?>><?= $value['designation'] ?></option>                                                                
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                    </select> 
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="inline-remember-me form-check">
                                                                    <label><input type="checkbox" class="form-check-input" id="authorisation-jury"> Autorisation </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="login-horizental lg-hz-mg"><button class="btn btn-sm btn-primary login-submit-cs" type="submit" id="update-jury">CODE DE DELIBERATION</button></div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="login-horizental lg-hz-mg"><button class="btn btn-sm btn-danger login-submit-cs" type="submit" id="supp-jury">SUPPRIMER</button></div>
                                                            </div>
                                                            <?php                                                             
                                                            }else {
                                                            ?>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <div class="form-select-list">
                                                                    <select class="form-control custom-select-value" name="list_jury">
                                                                        <option value="" selected>Aucun bureau disponible</option>
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
                                    <h1>DEFINIR UN NOUVEAU <span class="basic-ds-n">JURY</span></h1>
                                </div>
                            </div>
                            <div class="sparkline11-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="modal-bootstrap modal-login-form">
                                                <a class="zoomInDown mg-t" href="#" data-toggle="modal" data-target="#zoomInDown1">AJOUTER UN BUREAU</a>
                                            </div>
                                            <div id="zoomInDown1" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="modal-login-form-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="basic-login-inner modal-basic-inner">
                                                                            <h3>NOUVEAU BUREAU DU JURY</h3>
                                                                            <p id='msg-jury'>Veuillez remplir tous les champs</p>
                                                                            <form action="#">
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">NOM</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="text" class="form-control" id='nom-jury' placeholder="Nom du jury" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">MOT DE PASSE</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <input type="password" class="form-control" id='mdp-jury' placeholder="Mot de passe" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">PRESIDENT</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="chosen-select-single mg-b-20">
                                                                                                <select data-placeholder="Rechercher le président du jury" id='pres-jury' class="form-control chosen-select" tabindex="-1">
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
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">SECRETAIRE</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="chosen-select-single mg-b-20">
                                                                                                <select data-placeholder="Rechercher le secrétaire du jury" id='sec-jury' class="form-control chosen-select" tabindex="-1">
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
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                            <label class="login2">PROMOTIONS</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="chosen-select-single">
                                                                                                <select data-placeholder="Selectionner la promotion" class="chosen-select" id='promotions-jury' multiple="" tabindex="-1">
                                                                                                    <?php
                                                                                                    foreach ($listePromotions as $key => $value) {
                                                                                                    ?>
                                                                                                    <option value="<?= $value['id']; ?>"><?= $value['intitule']; ?> <?= $value['designation']; ?> <?= $value['orientation']; ?></option>
                                                                                                    <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="login-btn-inner">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <label><input type="checkbox" class="i-checks" id='statut-jury'> AUTORISATION </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                            <div class="login-horizental">
                                                                                                <button class="btn btn-sm btn-primary login-submit-cs" id='add-jury' type="submit">AJOUTER</button>
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
        if (count($listJury)) {
        ?>
            <div class="container-fluid">
                <div class="row">

        <?php
            foreach ($listJury as $key => $value) {
                $infos_president = getEnseignantInfos($value['id_president']);
                $infos_secretaire = getEnseignantInfos($value['id_secretaire']);
                $infos_promotions = getPromosJury($value['id']);
                $infos_membres = getEnseignantsByJury($value['id']);

                $tota_membres = 0;
                $permanants = 0;
                $visiteurs = 0;

                foreach ($infos_membres as $k => $v) {
                    $tota_membres++;

                    if($v['statut'] == 'VISITEUR'){
                        $visiteurs++;
                    }else{
                        $permanants++;
                    }

                }
        ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="vue/gabarit/img/contact/1.jpg">
                                <h3><a href=""><?= $value['designation'] ?></a></h3>
                                <p class="all-pro-ad"><?= ($value['code_auth']) ? $value['code_auth'] : "PAS DE CODE" ?></p>
                                <div class="course-des">
                                    <p><span><i class="fa fa-clock"></i></span> <b>PRESIDENT</b></p>
                                    <p><span><i class="fa fa-clock"></i></span> <b><?= $infos_president['grade'] ?> <?= $infos_president['nom'] ?> <?= $infos_president['post_nom'] ?> <?= $infos_president['prenom'] ?></b> (<?= $infos_president['statut'] ?>)<br /><?= $infos_president['telephone'] ?></p>
                                    <hr>
                                    <p><span><i class="fa fa-clock"></i></span> <b>SECRETAIRE</b></p>
                                    <p><span><i class="fa fa-clock"></i></span> <b><?= $infos_secretaire['grade'] ?> <?= $infos_secretaire['nom'] ?> <?= $infos_secretaire['post_nom'] ?> <?= $infos_secretaire['prenom'] ?></b> (<?= $infos_secretaire['statut'] ?>)<br /><?= $infos_secretaire['telephone'] ?></p>
                                    <hr>
                                    <p><span><i class="fa fa-clock"></i></span> <b>MEMBRES:</b> <span class="counter"><?= $tota_membres ?></span> </p>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-custon-four btn-warning dropdown-toggle1" data-toggle="dropdown">IMPRIMER LA GRILLE <i class="fa fa-angle-down"></i>
                                        </button>
                                    <ul class="dropdown-menu btn-dropdown-menu another-drop-pro-two dropdown-toggle1 sp-btn-dp-1" role="menu">
                                    <?php
                                    foreach ($infos_promotions as $key => $value) {
                                    ?>
                                        <li class="grille" data-id="<?= $value['id'] ?>"><a href="index.php?grille=<?= $value['id'] ?>"><?= $value['intitule'] ?> <?= $value['designation'] ?> <?= ($value['orientation']) ? '(' . $value['orientation'] . ')' : ''?></a></li>
                                    <?php
                                    }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <div class="panel-footer contact-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="contact-stat"><span>PERM.: </span> <strong class='counter'><?= $permanants ?></strong></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="contact-stat pull-right"><span>VISIT.: </span> <strong class='counter'><?= $visiteurs ?></strong></div>
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