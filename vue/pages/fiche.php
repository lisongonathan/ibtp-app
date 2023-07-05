<?php 
    $page = "Etudiants";
?>

<?php ob_start(); ?> 
    <div class="admintab-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content-details shadow-reset">
                        <h2><?= $infoGrille['matiere'] ?></h2>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="sparkline10-list mt-b-30">
                        <div class="sparkline10-hd">
                            <div class="main-sparkline10-hd">
                                <h1><?= $infoGrille['titulaire'] ?></h1>
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
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><p><?= $infoGrille['promotion'] ?></p>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><p><span class="basic-ds-n"><?= $infoGrille['semestre'] ?></span></p>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
                                                                        <div class="inline-remember-me">
                                                                            <label><?= $infoGrille['ue'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                                        <div class="login-horizental lg-hz-mg"><button class="btn btn-sm btn-primary login-submit-cs unlock-exam" data-id="<?= $dataCours['statut'] ?>" type="button"><i class=" fa fa-key"></i></button></div>
                                                                    </div>
                                                                </div>
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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="sparkline11-list responsive-mg-b-30">
                        <div class="sparkline11-hd">
                            <div class="main-sparkline11-hd">
                                <h1>Les cotes ne peuvent plus être modifier une fois enregistrer</h1>
                            </div>
                        </div>
                        <div class="sparkline11-graph">
                            <div class="basic-login-form-ad">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <a class="btn btn-danger mg-t valid-cote" href="#"><strong>ENREGISTRER</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">                  
                    <div class="admintab-wrap edu-tab1 mg-t-30 ">
                        <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1 tab-menu-right">
                            <li class="active"><a data-toggle="tab" href="#TabDetails2"><span class="edu-icon edu-analytics tab-custon-ic"></span>FICHE DE COTATION</a>
                            </li>
                            <li><a data-toggle="tab" href="#TabProject2"><span class="edu-icon edu-analytics-arrow tab-custon-ic"></span>FICHE AJAC</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="TabDetails2" class="tab-pane in active animated flipInY custon-tab-style1">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="product-status-wrap drp-lst">
                                            <div class="datatable-dashv1-list custom-datatable-overright">
                                                <table id="table" data-toggle="table" data-pagination="true" data-search="true">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="id">#</th>
                                                            <th>ETUDIANT</th>
                                                            <th>TP</th>
                                                            <th>TD</th>
                                                            <th>TOT.ANNUEL</th>
                                                            <th>EXAMEN</th>
                                                            <th>RATTRAPAE</th>
                                                            <th>TOTAL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach ($dataStudents as $key => $value) {
                                                    ?>
                                                    <tr class="etudiant-id" data-id="<?= $value['id'] ?>">
                                                       <td> <?= $key + 1 ?></td>
                                                       <td><a href="#" class="description"><?= $value['nom'] ?> <?= $value['post_nom'] ?> <?= $value['prenom'] ?></a></td>
                                                    <?php
                                                        $data = getCoteEtudiant($value['id'], $matiere);
                                                        if(isset($data['tp'])){
                                                            $tp = (float) $data['tp'];
                                                    ?>
                                                        <td><?= $tp ?></td>

                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td>
                                                            <input type="text" class="form-control m-tp">
                                                        </td>

                                                    <?php
                                                        }

                                                        if(isset($data['td'])){
                                                            $td = (float) $data['td'];
                                                    ?>
                                                        <td><?= $td ?></td>

                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td>
                                                            <input type="text" class="form-control m-td">
                                                        </td>
                                                    <?php
                                                        }

                                                        if(isset($data['tp']) AND isset($data['td'])){
                                                    ?>
                                                        <td class="inbox-small-cells"><?= $data['tp'] + $data['td']?></td>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td class="inbox-small-cells"> - </td>
                                                        
                                                    <?php
                                                        }

                                                        if(isset($data['examen'])){
                                                            $examen =(float) $data['examen'];
                                                    ?>
                                                        <td><?= $examen ?></td>

                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td>
                                                            <input type="text" class="form-control cote-examen" placeholder="<?= $dataCours['statut']; ?>" disabled>
                                                        </td>

                                                    <?php
                                                        }
                                                        if(isset($data['ratrapage'])){
                                                            $ratrapage =(float) $data['ratrapage'];
                                                    ?>
                                                        <td><?= $ratrapage ?></td>

                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td>
                                                            <input type="text" class="form-control rat-e" placeholder="<?= $dataCours['statut']; ?>" disabled>
                                                        </td>

                                                    <?php
                                                        }
                                            
                                                        if(isset($data['ratrapage'])){
                                                    ?>
                                                                <td class="inbox-small-cells"><?= ($data['ratrapage']) ?></td>
                                                    <?php
                                                        }else{
                                                            if(isset($data['tp']) AND isset($data['td']) AND isset($data['examen'])){
                                                    ?>
                                                                <td class="inbox-small-cells"><?= $tp + $td + $examen ?></td>
                                                    <?php

                                                            }else{
                                                    ?>
                                                                <td class="inbox-small-cells"> - </td>
                                                    <?php
                                                            }
                                                        }
                                        
                                                    ?>
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
                            <div id="TabProject2" class="tab-pane animated flipInY custon-tab-style1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-status mg-b-15">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="product-status-wrap drp-lst">
                                                            <h4>Departments List</h4>
                                                            <div class="add-product">
                                                                <a href="add-department.html">Add Departments</a>
                                                            </div>
                                                            <div class="asset-inner">
                                                                <table>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Name of Dept.</th>
                                                                        <th>Status</th>
                                                                        <th>Head</th>
                                                                        <th>Email</th>
                                                                        <th>Phone</th>
                                                                        <th>No. of Students</th>
                                                                        <th>Setting</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>Computer</td>
                                                                        <td>
                                                                            <button class="pd-setting">Active</button>
                                                                        </td>
                                                                        <td>John Alva</td>
                                                                        <td>admin@gmail.com</td>
                                                                        <td>01962067309</td>
                                                                        <td>1500</td>
                                                                        <td>
                                                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>Mechanical</td>
                                                                        <td>
                                                                            <button class="ps-setting">Paused</button>
                                                                        </td>
                                                                        <td>John Alva</td>
                                                                        <td>admin@gmail.com</td>
                                                                        <td>01962067309</td>
                                                                        <td>1700</td>
                                                                        <td>
                                                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3</td>
                                                                        <td>MBA</td>
                                                                        <td>
                                                                            <button class="ds-setting">Disabled</button>
                                                                        </td>
                                                                        <td>John Alva</td>
                                                                        <td>admin@gmail.com</td>
                                                                        <td>01962067309</td>
                                                                        <td>1500</td>
                                                                        <td>
                                                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>4</td>
                                                                        <td>BBA</td>
                                                                        <td>
                                                                            <button class="pd-setting">Active</button>
                                                                        </td>
                                                                        <td>John Alva</td>
                                                                        <td>admin@gmail.com</td>
                                                                        <td>01962067309</td>
                                                                        <td>1200</td>
                                                                        <td>
                                                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>5</td>
                                                                        <td>CSE</td>
                                                                        <td>
                                                                            <button class="pd-setting">Active</button>
                                                                        </td>
                                                                        <td>John Alva</td>
                                                                        <td>admin@gmail.com</td>
                                                                        <td>01962067309</td>
                                                                        <td>1800</td>
                                                                        <td>
                                                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>6</td>
                                                                        <td>MBA</td>
                                                                        <td>
                                                                            <button class="ps-setting">Paused</button>
                                                                        </td>
                                                                        <td>John Alva</td>
                                                                        <td>admin@gmail.com</td>
                                                                        <td>01962067309</td>
                                                                        <td>1000</td>
                                                                        <td>
                                                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="custom-pagination">
                                                                <nav aria-label="Page navigation example">
                                                                    <ul class="pagination">
                                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                                    </ul>
                                                                </nav>
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
    
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/main.php"; ?>