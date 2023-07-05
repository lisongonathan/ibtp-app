<?php 
    $page = "Promotion";
?>

<?php ob_start(); ?> 
    <div class="admintab-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">                  
                    <div class="admintab-wrap edu-tab1 mg-t-30 ">
                        <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1 tab-menu-right">
                            <li class="active"><a data-toggle="tab" href="#TabProject2"><span class="edu-icon edu-analytics tab-custon-ic"></span>TOUS LES ECs</a>
                            </li>
                            <li><a data-toggle="tab" href="#TabDetails2"><span class="edu-icon edu-analytics-arrow tab-custon-ic"></span>TOUS LES UEs</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="TabProject2" class="tab-pane in active animated flipInY custon-tab-style1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-status-wrap drp-lst">
                                                    <?php
                                                    $totalCreditOfPromotion = 0;

                                                    foreach ($dataUE as $key => $value) {

                                                        //Données UEs
                                                        $detailsPromo = getDetailUES($value['id']);
                                                        $totalCreditOfPromotion += $detailsPromo['credits'];
                                                    }
                                                    ?>
                                            <h4>Total Credit : <?= $totalCreditOfPromotion ?></h4>
                                            <div class="add-product">
                                                <a href="index.php?add_cours=1&class=<?= (int) $_GET['promotion'] ?>">Ajouter un EC</a>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                <?php
                                foreach ($dataEC as $key => $value) {

                                    $etudiantTitulaire = getStudentsTitulaire($value['id_titulaire']);
                                    $effectEtudiant = 0;

                                    foreach ($etudiantTitulaire as $k => $v) {
                                        # code...
                                        $effectEtudiant++;
                                    }
                                    $totalPromo = getEffByPromo((int) $_GET['promotion']);
                                    $propoFiche = round(( (float) $totalPromo['participant']/(float) $effectEtudiant) * 100,2);
                                ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        
                                        <div class="courses-inner res-mg-b-30">
                                            <div class="courses-title">
                                                <a href="#"><img src="vue/gabarit/img/courses/1.jpg" alt=""></a>
                                                <h2><?= $value['intitule'] ?></h2>
                                            </div>
                                            <div class="courses-alaltic">
                                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-star"></i></span> <?= $value['credit'] ?></span>
                                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-solid fa-trophy"></i></span> <?= $value['code'] ?></span>
                                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-heart"></i></span> <?= $value['ucode'] ?></span>
                                            </div>
                                            <div class="course-des">
                                                <p><span><i class="fa fa-clock"></i></span> <b>SEMESTRE:</b> <?= $value['semestre'] ?></p>
                                                <p><span><i class="fa fa-clock"></i></span> <b>TIT.:</b> <?= $value['grade'] ?> <?= $value['nom'] ?> <?= $value['post_nom'] ?></p>
                                                <p><span><i class="fa fa-clock"></i></span> <b>ETUDIANTS:</b> <?= $effectEtudiant ?></p>
                                                <p><span><i class="fa fa-clock"></i></span> <b>STATUT:</b> <?= $value['statut'] ?></p>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft" data-progress="<?= $propoFiche ?>%" style="width: <?= $propoFiche ?>%;" data-wow-duration="1.5s" data-wow-delay="1.2s"> <span><?= $propoFiche ?></span></div>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-danger updateEC" data-id="<?= $value['id'] ?>">Modifier</button>
                                                <button type="button" class="btn btn-primary delEC" data-id="<?= $value['id'] ?>">Supprimer</button>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div id="TabDetails2" class="tab-pane animated flipInY custon-tab-style1">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="product-status-wrap drp-lst">
                                            <a href="index.php?add_cours=2" class="btn btn-primary">Ajouter une UE</a>
                                            <div class="datatable-dashv1-list custom-datatable-overright">
                                                <table id="table" data-toggle="table" data-pagination="true" data-search="true">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="id">ID</th>
                                                            <th>DESIGNATION</th>
                                                            <th>CODE</th>
                                                            <th>CREDIT</th>
                                                            <th>ECS</th>
                                                            <th>STATUT</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach ($dataUE as $key => $value) {

                                                        //Données UEs
                                                        $detailsPromo = getDetailUES($value['id']);
                                                        $metrique = geUEbyECsVue($value['id']);
                                                     ?>
                                                     <tr>
                                                        <td><?= $key+1 ?></td>
                                                        <td><?= $value['designation'] ?></td>
                                                        <td><?= $value['code'] ?></td>
                                                        <td><?= $detailsPromo['credits'] ?></td>
                                                        <td><?= $detailsPromo['ecs'] ?></td>
                                                        <td class="datatable-ct"><span class="pie"><?= $metrique['total'] ?>/<?= $detailsPromo['ecs'] ?></span>
                                                        </td>
                                                        <td class="datatable-ct">    
                                                            <div class="button-ap-list responsive-btn">
                                                                <div class="btn-group btn-custom-groups btn-custom-groups-one">
                                                                    <button type="button" class="btn btn-primary updateUe" id="<?= $value['id'] ?>"><i class="fa fa-info-circle edu-informatio" aria-hidden="true"></i></button>
                                                                    <a type="button" class="btn btn-danger" href="index.php?delUE=<?= $value['id'] ?>"><i class="fa fa-times edu-danger-error" aria-hidden="true"></i></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                        
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
    
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/main.php"; ?>