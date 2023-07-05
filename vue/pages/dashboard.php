<?php 
    $page = "Dashboard";
?>

<?php ob_start(); ?> 

    <?php
    if($_SESSION['module'] == 'Titulaire'){
        
        # IDCOURS TITULAIRE
        $listeCours = getEnseignant($_SESSION['id']);
    ?>
    <div class="dashtwo-order-area mg-tb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-edu-wrap ant-res-b-30 reso-mg-b-30">
                        <div class="skill-content-3 analytics-edu">
                            <div class="skill">
                                <div class="progress">
                                    <div class="lead-content">
                                        <h3><span class="counter"><?= $countStudentsOfTitulaire ?></span></h3>
                                        <p>ETUDIANT(S)</p>
                                    </div>
                                    <div class="progress-bar wow fadeInLeft" data-progress="<?= round(((float) $countStudentsOfTitulaire/$countStudents)*100,2) ?>%" style="width: <?= round(((float) $countStudentsOfTitulaire/$countStudents)*100,2) ?>%;" data-wow-duration="1.5s" data-wow-delay="1.2s"> <span><?= round(((float) $countStudentsOfTitulaire/$countStudents)*100,2) ?>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-edu-wrap reso-mg-b-30">
                        <div class="skill-content-3 analytics-edu analytics-edu4">
                            <div class="skill">
                                <div class="progress">
                                    <div class="lead-content">
                                        <h3><span class="counter"><?= $totalPromoOfTitulaire ?></span></h3>
                                        <p>PROMOTION(S)</p>
                                    </div>
                                    <div class="progress-bar wow fadeInLeft" data-progress="<?= round(((float) $totalPromoOfTitulaire/$countAllPromotions)*100,2) ?>%" style="width: <?= round(((float) $totalPromoOfTitulaire/$countAllPromotions)*100,2)?>%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span><?= round(((float) $totalPromoOfTitulaire/$countAllPromotions)*100,2) ?>%</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-edu-wrap reso-mg-b-30">
                        <div class="skill-content-3 analytics-edu analytics-edu4">
                            <div class="skill">
                                <div class="progress">
                                    <div class="lead-content">
                                        <h3><span class="counter"><?= $countMatieres ?></span></h3>
                                        <p>COUR(S)</p>
                                    </div>
                                    <div class="progress-bar wow fadeInLeft" data-progress="100%" style="width: <?= round(((float) $countMatieres/$countAllMatieres)*100,2) ?>%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span><?= round(((float) $countMatieres/$countAllMatieres)*100,2) ?>%</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-edu-wrap res-tablet-mg-t-30 dk-res-t-pro-30">
                        <div class="skill-content-3 analytics-edu analytics-edu2">
                            <div class="skill">
                                <div class="progress progress-bt">
                                    <div class="lead-content">
                                        <h3><span class="counter"><?= $sumOfCreditsTit ?></span></h3>
                                        <p>CREDIT(S) = PONDERATION(S)</p>
                                    </div>
                                    <div class="progress-bar wow fadeInLeft" data-progress="100%" style="width: <?= round(((float) $sumOfCreditsTit/$sumOfCredisIbtp)*100,2) ?>%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span><?= round(((float) $sumOfCreditsTit/$sumOfCredisIbtp)*100,2) ?>%</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    <?php
                        # IDCOURS TITULAIRE
                        $listeCours = getEnseignant($_SESSION['id']);
                        
                        $dataNotations = array(
                            "G" => 7,
                            "F" => 8,
                            "E" => 10,
                            "D" => 12,
                            "C" => 14,
                            "B" => 16,
                            "A" => 18
                        );

                        $data = array();

                        foreach ($dataNotations as $key => $value) {
                            $tmp['notation'] = $key;

                            $couleurAlea = array('progress-bar progress-bar-inverse', 'progress-bar progress-bar-success', 'progress-bar progress-bar-danger', 'progress-bar progress-bar-info');
                        ?>
                        
                    <div class="product-sales-area mg-tb-30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="white-box res-mg-t-30 table-mg-t-pro-n">
                                        <h3 class="box-title"><?= $tmp['notation'] ?> (cote &le; <?= $value ?>)</h3>
                                        <ul class="country-state">

                        <?php

                            foreach ($listeCours as $k => $v) {
                                $max =  getEffByPromo($v['promo']);
                                
                                $tmp['cours'] = $v['designation'];
                                
                                $tmp['promotion'] = $v['class'] . ' - ' . $v['section'] . ' ' . $v['orientation'];
                                
                                $tmp['num'] = getStatTitulaire($v['cours'], $value)['effEtudiants'];
                                
                                $tmp['den'] = $max['participant'];
                                if ($tmp['den']) {
                                    $etudiants_cotes = round((float) $tmp['num']/$tmp['den'], 2)*100;
                                } else {
                                    $etudiants_cotes = 0;
                                }

                            ?>
                            <li>
                                <h3>Etudiants cotés : <span class="counter"><?=  $tmp['num'] ?></span></h3> <small><?=  $tmp['cours'] ?> (<?= $tmp['promotion'] ?>) </small>
                                <div class="pull-right"><?= $etudiants_cotes ?></div>
                                <div class="progress">
                                    <div class=" <?= $couleurAlea[rand(0, count($couleurAlea) - 1)] ?> ctn-vs-1" role="progressbar" aria-valuenow="<?= $etudiants_cotes ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $etudiants_cotes ?>%;"> <span class="sr-only"><?= $etudiants_cotes ?>% Cotés</span></div>
                                </div>
                            </li>

                            <?php
                    
                                
                            }             
                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <?php
                    

                        }  

                    ?>

    <?php
    } elseif ($_SESSION['module'] == 'Etudiant') {
    ?>
    <!-- Small chart end-->
    <!-- custom chart start-->
    <div class="analysis-progrebar-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analysis-progrebar reso-mg-b-30">
                        <div class="analysis-progrebar-content">
                            <h5>MAXIMUM</h5>
                            <h2><span class="counter"><?= $maximum ?></span></h2>
                            <div class="progress progress-mini ug-1">
                                <div style="width: 100%;" class="progress-bar"></div>
                            </div>
                            <div class="m-t-sm small">
                                <p>Moyenne Annuelle</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analysis-progrebar reso-mg-b-30">
                        <div class="analysis-progrebar-content">
                            <h5>TOTAL OBTENU</h5>
                            <h2><span class="counter"><?= $total ?></span></h2>
                            <div class="progress progress-mini ug-2">
                                <div style="width: <?= ((float) $total/$maximum)*100 ?>%;" class="progress-bar"></div>
                            </div>
                            <div class="m-t-sm small">
                                <p>Moyenne Annuelle</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analysis-progrebar reso-mg-b-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                        <div class="analysis-progrebar-content">
                            <h5>REUSSITES</h5>
                            <h2><span class="counter"><?= $reussites ?></span></h2>
                            <div class="progress progress-mini ug-3">
                                <div style="width: <?= ((float) $reussites / ($reussites + $echecs))*100 ?>%;" class="progress-bar progress-bar-danger"></div>
                            </div>
                            <div class="m-t-sm small">
                                <p>Total Annuel</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analysis-progrebar res-tablet-mg-t-30 dk-res-t-pro-30">
                        <div class="analysis-progrebar-content">
                            <h5>ECHECS</h5>
                            <h2><span class="counter"><?= $echecs ?></span></h2>
                            <div class="progress progress-mini ug-4">
                                <div style="width: <?= ((float) $echecs / ($reussites + $echecs))*100 ?>%;" class="progress-bar progress-bar-danger"></div>
                            </div>
                            <div class="m-t-sm small">
                                <p>Total Annuel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="pie-bar-line-area mg-tb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline7-list responsive-mg-b-30">
                        <div class="sparkline7-hd">
                            <div class="main-spark7-hd">
                                <h1>Cotes annuelles <span class="c3-ds-n">PREMIER SEMESTRE </span></h1>
                            </div>
                        </div>
                        <div class="sparkline7-graph graph-sem1">
                            <div id="sem_1"></div>
                        </div>
                        <hr/>
                        <div class="sparkline7-hd">
                            <div class="main-spark7-hd">
                                <h1>Cotes annuelles <span class="c3-ds-n">SECOND SEMESTRE </span></h1>
                            </div>
                        </div>
                        <div class="sparkline7-graph graph-sem2">
                            <div id="sem_2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="pie-bar-line-area mg-tb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="hpanel widget-int-shape responsive-mg-b-30">
                        <div class="panel-body">
                            <div class="text-center content-box">
                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                    <div class="panel-body">
                                        <div class="text-center content-bg-pro">
                                            <br>
                                            <h3>1er SEMESTRE</h3>
                                            <p class="text-big font-light">
                                                <?= $mat_s1 ?> Matière(s)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="hpanel shadow-inner responsive-mg-b-30">
                                    <div class="panel-body">
                                        <div class="table-responsive wd-tb-cr">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>MATIERE</th>
                                                        <th>TP.</th>
                                                        <th>TD.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($matieres_s1 as $key => $value) {
                                                ?>
                                                    <tr>
                                                        <td align="left">
                                                            <span class="text-success font-bold"><?= $value['ec'] ?></span>
                                                        </td>
                                                        <td><?= $value['tp'] ?></td>
                                                        <td><?= $value['td'] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success widget-btn-1 btn-sm" data-toggle="modal" data-target=".bulletin-s1">BULLETIN S1</button>

                                <div class="modal fade bulletin-s1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">BULLE PREMIER SEMESTRE</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                <?php
                                                $max_s1 = 0;
                                                $obt_s1 = 0;
                                                $manques_s1 = 0;

                                                if ($infosPromotion['systeme'] == 'LMD') {
                                                    $ncv_s1 = 0;
                                                    $ncnv_s1 = 0;

                                                    foreach ($matieres_s1 as $key => $value) {
                                                        //MAXIMUM
                                                        $max_s1 += 20*$value['credit'];
    
                                                        //TOTAL OBTENU
                                                        if (is_numeric($value['tp']) AND is_numeric($value['td'])) {
                                                                                                                        
                                                            if (is_numeric($value['rattrapage'])) {
                                                                # code...
                                                                $obt_s1 += (float) ($value['rattrapage']*$value['credit']);

                                                                if ($value['rattrapage'] < 10) {
                                                                    $ncnv_s1++;                  
                                                                } else {
                                                                    $ncv_s1++;
                                                                }
                                                            } else {
                                                                # code...
                                                                if (is_numeric($value['examen'])) {
                                                                    # code...
                                                                    $obt_s1 += (float) (($value['tp'] + $value['td'] + $value['examen'])*$value['credit']);

                                                                    if ($value['examen'] + $value['tp'] + $value['td'] < 10) {
                                                                        $ncnv_s1++;                  
                                                                    } else {
                                                                        $ncv_s1++;
                                                                    }
                                                                }else {
                                                                    $manques_s1++;
                                                                }
                                                            }
                                                            
                                                        }else{
                                                            $manques_s1++;
                                                        }
    
                                                    }

                                                } else {
                                                    $legers_s1 = 0;
                                                    $graves_s1 = 0;
                                                }

                                                if (!$max_s1) {
                                                    $max_s1 = 1;
                                                }
                                                 
                                                ?>
                                                    <tr>
                                                        <th>MAXIMUM</th>
                                                        <td><?= $max_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>TOTAL OBTENU</th>
                                                        <td><?= $obt_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>POURCENTAGE</th>
                                                        <td><?= ($max_s1) ? round(100*($obt_s1/$max_s1),2) . '%' : 1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MANQUE DES COTES</th>
                                                        <td><?= $manques_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NCV</th>
                                                        <td><?= $ncv_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NCNV</th>
                                                        <td><?= $ncnv_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>DECISION DU JURY</th>
                                                        <td>A</td>
                                                    </tr>
                                                </table>
                                                <div class="product-status-wrap">
                                                    <div class="asset-inner">
                                                        <table>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>MATIERE</th>
                                                                <th>TP</th>
                                                                <th>TD</th>
                                                                <th>TOTAL AN.</th>
                                                                <th>EXAMEN</th>
                                                                <th>RATTRAPAGE</th>
                                                                <th>TOTAL</th>
                                                                <th>CREDIT</th>
                                                                <th>TOT. POND</th>
                                                            </tr>
                                                    <?php
                                                    foreach ($matieres_s1 as $key => $value) {
                                                    ?>
                                                            <tr>
                                                                <td><?= $key+1 ?></td>
                                                                <td><?= $value['ec'] ?></td>
                                                                <td><?= $value['tp'] ?></td>
                                                                <td><?= $value['td'] ?></td>
                                                                <td><?= (is_numeric($value['tp']) AND is_numeric($value['tp'])) ? $value['tp'] + $value['td'] : '' ?></td>
                                                                <td><?= $value['examen'] ?></td>
                                                                <td><?= $value['rattrapage'] ?></td>
                                                                <td><?= (is_numeric($value['tp']) AND is_numeric($value['tp']) AND is_numeric($value['examen'])) ? $value['examen'] + $value['tp'] + $value['td'] : '' ?></td>
                                                                <td><?= $value['credit'] ?></td>
                                                                <td><?= (is_numeric($value['tp']) AND is_numeric($value['tp']) AND is_numeric($value['examen'])) ? (is_numeric($value['rattrapage'])) ? $value['rattrapage']*$value['credit'] : ($value['examen'] + $value['tp'] + $value['td'])*$value['credit'] : '' ?></td>
                                                            </tr>

                                                    <?php
                                                    }
                                                    ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success widget-btn-1 btn-sm">IMPRIMER</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="hpanel widget-int-shape responsive-mg-b-30">
                        <div class="panel-body">
                            <div class="text-center content-box">
                                <div class="hpanel shadow-inner hbgblue bg-2 responsive-mg-b-30">
                                    <div class="panel-body">
                                        <div class="text-center content-bg-pro">
                                            <br>
                                            <h3>2nd SEMESTRE</h3>
                                            <p class="text-big font-light">
                                            <?= $mat_s2 ?> Matière(s)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="hpanel shadow-inner responsive-mg-b-30">
                                    <div class="panel-body">
                                        <div class="table-responsive wd-tb-cr">
                                            <table class="table table-striped">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>MATIERE</th>
                                                        <th>TP.</th>
                                                        <th>TD.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($matieres_s2 as $key => $value) {
                                                ?>
                                                    <tr>
                                                        <td align="left">
                                                            <span class="text-success font-bold"><?= $value['ec'] ?></span>
                                                        </td>
                                                        <td><?= $value['tp'] ?></td>
                                                        <td><?= $value['td'] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-info widget-btn-2 btn-sm"  data-toggle="modal" data-target=".bulletin-s2">BULLETIN S2</button>
                                <div class="modal fade bulletin-s2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">BULLETIN SECOND SEMESTRE</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                <?php
                                                $max_s1 = 0;
                                                $obt_s1 = 0;
                                                $manques_s1 = 0;

                                                if ($infosPromotion['systeme'] == 'LMD') {
                                                    $ncv_s1 = 0;
                                                    $ncnv_s1 = 0;

                                                    foreach ($matieres_s2 as $key => $value) {
                                                        //MAXIMUM
                                                        $max_s1 += 20*$value['credit'];
    
                                                        //TOTAL OBTENU
                                                        if (is_numeric($value['tp']) AND is_numeric($value['td'])) {
                                                                                                                        
                                                            if (is_numeric($value['rattrapage'])) {
                                                                # code...
                                                                $obt_s1 += (float) ($obt_s1 + $value['rattrapage']*$value['credit']);

                                                                if ($value['rattrapage'] < 10) {
                                                                    $ncnv_s1++;                  
                                                                } else {
                                                                    $ncv_s1++;
                                                                }
                                                            } else {
                                                                # code...
                                                                if (is_numeric($value['examen'])) {
                                                                    # code...
                                                                    $obt_s1 += (float) ($obt_s1 + ($value['tp'] + $value['td'] + $value['examen'])*$value['credit']);

                                                                    if ($value['examen'] + $value['tp'] + $value['td'] < 10) {
                                                                        $ncnv_s1++;                  
                                                                    } else {
                                                                        $ncv_s1++;
                                                                    }
                                                                }else {
                                                                    $manques_s1++;
                                                                }
                                                            }
                                                            
                                                        }else{
                                                            $manques_s1++;
                                                        }
    
                                                    }

                                                } else {
                                                    $legers_s1 = 0;
                                                    $graves_s1 = 0;
                                                }
                                                 
                                                ?>
                                                    <tr>
                                                        <th>MAXIMUM</th>
                                                        <td><?= $max_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>TOTAL OBTENU</th>
                                                        <td><?= $obt_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>POURCENTAGE</th>
                                                        <td><?= 100*($obt_s1/$max_s1) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MANQUE DES COTES</th>
                                                        <td><?= $manques_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NCV</th>
                                                        <td><?= $ncv_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NCNV</th>
                                                        <td><?= $ncnv_s1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>DECISION DU JURY</th>
                                                        <td>A</td>
                                                    </tr>
                                                </table>
                                                <div class="product-status-wrap">
                                                    <div class="asset-inner">
                                                        <table>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>MATIERE</th>
                                                                <th>TP</th>
                                                                <th>TD</th>
                                                                <th>TOTAL AN.</th>
                                                                <th>EXAMEN</th>
                                                                <th>RATTRAPAGE</th>
                                                                <th>TOTAL</th>
                                                                <th>CREDIT</th>
                                                                <th>TOT. POND</th>
                                                            </tr>
                                                    <?php
                                                    foreach ($matieres_s2 as $key => $value) {
                                                    ?>
                                                            <tr>
                                                                <td><?= $key+1 ?></td>
                                                                <td><?= $value['ec'] ?></td>
                                                                <td><?= $value['tp'] ?></td>
                                                                <td><?= $value['td'] ?></td>
                                                                <td><?= (is_numeric($value['tp']) AND is_numeric($value['tp'])) ? $value['tp'] + $value['td'] : '' ?></td>
                                                                <td><?= $value['examen'] ?></td>
                                                                <td><?= $value['rattrapage'] ?></td>
                                                                <td><?= (is_numeric($value['tp']) AND is_numeric($value['tp']) AND is_numeric($value['examen'])) ? $value['examen'] + $value['tp'] + $value['td'] : '' ?></td>
                                                                <td><?= $value['credit'] ?></td>
                                                                <td><?= (is_numeric($value['tp']) AND is_numeric($value['tp']) AND is_numeric($value['examen'])) ? (is_numeric($value['rattrapage'])) ? $value['rattrapage']*$value['credit'] : ($value['examen'] + $value['tp'] + $value['td'])*$value['credit'] : '' ?></td>
                                                            </tr>

                                                    <?php
                                                    }
                                                    ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-info widget-btn-2 btn-sm">IMPRIMER</button>
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

    <?php
    } elseif ($_SESSION['module'] == 'Coges') {
    ?>
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Computer Technologies</h5>
                            <h2>$<span class="counter">5000</span> <span class="tuition-fees">Tuition Fees</span></h2>
                            <span class="text-success">20%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Accounting Technologies</h5>
                            <h2>$<span class="counter">3000</span> <span class="tuition-fees">Tuition Fees</span></h2>
                            <span class="text-danger">30%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">230% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                        <div class="analytics-content">
                            <h5>Electrical Engineering</h5>
                            <h2>$<span class="counter">2000</span> <span class="tuition-fees">Tuition Fees</span></h2>
                            <span class="text-info">60%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:60%;"> <span class="sr-only">20% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                        <div class="analytics-content">
                            <h5>Chemical Engineering</h5>
                            <h2>$<span class="counter">3500</span> <span class="tuition-fees">Tuition Fees</span></h2>
                            <span class="text-inverse">80%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">230% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-sales-area mg-tb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                        <div class="portlet-title">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="caption pro-sl-hd">
                                        <span class="caption-subject"><b>University Earnings</b></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="actions graph-rp graph-rp-dl">
                                        <p>All Earnings are in million $</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-inline cus-product-sl-rp">
                            <li>
                                <h5><i class="fa fa-circle" style="color: #006DF0;"></i>CSE</h5>
                            </li>
                            <li>
                                <h5><i class="fa fa-circle" style="color: #933EC5;"></i>Accounting</h5>
                            </li>
                            <li>
                                <h5><i class="fa fa-circle" style="color: #65b12d;"></i>Electrical</h5>
                            </li>
                        </ul>
                        <div id="extra-area-chart" style="height: 356px;"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="analysis-progrebar res-mg-t-30 mg-ub-10 res-mg-b-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                        <div class="analysis-progrebar-content">
                            <h5>Usage</h5>
                            <h2 class="storage-right"><span class="counter">90</span>%</h2>
                            <div class="progress progress-mini ug-1">
                                <div style="width: 68%;" class="progress-bar"></div>
                            </div>
                            <div class="m-t-sm small">
                                <p>Server down since 1:32 pm.</p>
                            </div>
                        </div>
                    </div>
                    <div class="analysis-progrebar reso-mg-b-30 res-mg-b-30 mg-ub-10 tb-sm-res-d-n dk-res-t-d-n">
                        <div class="analysis-progrebar-content">
                            <h5>Memory</h5>
                            <h2 class="storage-right"><span class="counter">70</span>%</h2>
                            <div class="progress progress-mini ug-2">
                                <div style="width: 78%;" class="progress-bar"></div>
                            </div>
                            <div class="m-t-sm small">
                                <p>Server down since 12:32 pm.</p>
                            </div>
                        </div>
                    </div>
                    <div class="analysis-progrebar reso-mg-b-30 res-mg-b-30 res-mg-t-30 mg-ub-10 tb-sm-res-d-n dk-res-t-d-n">
                        <div class="analysis-progrebar-content">
                            <h5>Data</h5>
                            <h2 class="storage-right"><span class="counter">50</span>%</h2>
                            <div class="progress progress-mini ug-3">
                                <div style="width: 38%;" class="progress-bar progress-bar-danger"></div>
                            </div>
                            <div class="m-t-sm small">
                                <p>Server down since 8:32 pm.</p>
                            </div>
                        </div>
                    </div>
                    <div class="analysis-progrebar res-mg-t-30 table-dis-n-pro tb-sm-res-d-n dk-res-t-d-n">
                        <div class="analysis-progrebar-content">
                            <h5>Space</h5>
                            <h2 class="storage-right"><span class="counter">40</span>%</h2>
                            <div class="progress progress-mini ug-4">
                                <div style="width: 28%;" class="progress-bar progress-bar-danger"></div>
                            </div>
                            <div class="m-t-sm small">
                                <p>Server down since 5:32 pm.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="traffic-analysis-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="social-media-edu">
                        <i class="fa fa-facebook"></i>
                        <div class="social-edu-ctn">
                            <h3>50k Likes</h3>
                            <p>You main list growing</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="social-media-edu twitter-cl res-mg-t-30 table-mg-t-pro-n">
                        <i class="fa fa-twitter"></i>
                        <div class="social-edu-ctn">
                            <h3>30k followers</h3>
                            <p>You main list growing</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="social-media-edu linkedin-cl res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                        <i class="fa fa-linkedin"></i>
                        <div class="social-edu-ctn">
                            <h3>7k Connections</h3>
                            <p>You main list growing</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="social-media-edu youtube-cl res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                        <i class="fa fa-youtube"></i>
                        <div class="social-edu-ctn">
                            <h3>50k Subscribers</h3>
                            <p>You main list growing</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="library-book-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-cards-item">
                        <div class="single-product-image">
                            <a href="#"><img src="vue/gabarit/img/product/dettes-banner.jpg" alt=""></a>
                        </div>
                        <div class="single-product-text">
                            <img src="vue/gabarit/img/product/dette-content.jpg" alt="">
                            <h4><a class="cards-hd-dn" href="#">TOTAL DETTES</a></h4>
                            <h5>3500 USD & 4 253 254 CDF</h5>
                            <button class="btn btn-info widget-btn-2 btn-sm"  data-toggle="modal" data-target=".dettes">VOIR LE RAPPORT</button>
                            <div class="modal fade dettes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">BULLETIN SECOND SEMESTRE</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table>
                                                <tr>
                                                    <th>RUBRIQUE</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>CLASSE</th>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            <div class="product-status-wrap">
                                                <div class="asset-inner">
                                                    <table>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NOM</th>
                                                            <th>POST - NOM</th>
                                                            <th>PRENOM</th>
                                                            <th>SEXE</th>
                                                            <th>MONTANT</th>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-info widget-btn-2 btn-sm">IMPRIMER</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">199</span></h3>
                                        <p>F.ETUDE</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">599</span></h3>
                                        <p>D.DIPLOME</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">399</span></h3>
                                        <p>F.S.ACAD</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">399</span></h3>
                                        <p>F.SECTION</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-cards-item">
                        <div class="single-product-image">
                            <a href="#"><img src="vue/gabarit/img/product/recettes-banner.jpeg" alt=""></a>
                        </div>
                        <div class="single-product-text">
                            <img src="vue/gabarit/img/product/recettes-content.png" alt="">
                            <h4><a class="cards-hd-dn" href="#">TOTAL RECETTES</a></h4>
                            <h5>3500 USD & 4 253 254 CDF</h5>
                            <button class="btn btn-info widget-btn-2 btn-sm"  data-toggle="modal" data-target=".recettes">VOIR LE RAPPORT</button>
                            <div class="modal fade recettes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">BULLETIN SECOND SEMESTRE</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h3>PERIODE</h3>
                                                    <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                                        <div class="input-daterange input-group" id="datepicker">
                                                            <input type="text" class="form-control" id='date-debut-recettes' name="start" value="07/01/2023" />
                                                            <span class="input-group-addon">à</span>
                                                            <input type="text" class="form-control" id='date-fin-recettes'  name="end" value="07/02/2023" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h3>RUBRIQUES</h3>
                                                    <div class="chosen-select-single mg-b-20">
                                                        <select data-placeholder="LISTE DES RUBRIQUES" class="chosen-select currentRubrique" tabindex="-1">
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
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">FERMER</button>
                                            <button type="button" class="btn btn-info widget-btn-2 btn-sm print-recettes">IMPRIMER</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">199</span></h3>
                                        <p>F.ETUDE</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">599</span></h3>
                                        <p>D.DIPLOME</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">399</span></h3>
                                        <p>F.S.ACAD</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">399</span></h3>
                                        <p>F.SECTION</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-cards-item">
                        <div class="single-product-image">
                            <a href="#"><img src="vue/gabarit/img/product/depenses-banner.jpg" alt=""></a>
                        </div>
                        <div class="single-product-text">
                            <img src="vue/gabarit/img/product/depenses-content.png" alt="">
                            <h4><a class="cards-hd-dn" href="#">TOTAL DEPENSES</a></h4>
                            <h5>3500 USD & 4 253 254 CDF</h5>
                            <button class="btn btn-info widget-btn-2 btn-sm"  data-toggle="modal" data-target=".bulletin-s2">VOIR LE RAPPORT</button>
                            <div class="modal fade bulletin-s2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">BULLETIN SECOND SEMESTRE</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <h4>PERIODE</h4>
                                                    <div class="chosen-select-single mg-b-20 form-group">
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

                                                </div>
                                                <div class="form-group"> 
                                                    <h4>RUBRIQUE</h4>                                                       
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="form-control" id='date-debut-recettes' name="start" value="07/01/2023" />
                                                        <span class="input-group-addon">à</span>
                                                        <input type="text" class="form-control" id='date-fin-recettes'  name="end" value="07/02/2023" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-info widget-btn-2 btn-sm">IMPRIMER</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">199</span></h3>
                                        <p>F.ETUDE</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">599</span></h3>
                                        <p>D.DIPLOME</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">399</span></h3>
                                        <p>F.S.ACAD</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="cards-dtn">
                                        <h3><span class="counter">399</span></h3>
                                        <p>F.SECTION</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    } elseif ($_SESSION['module'] == 'Operateur') {
    ?>
    <div class="product-status mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="sparkline10-list mt-b-30">
                        <div class="sparkline10-hd">
                            <div class="main-sparkline10-hd">
                                <h1>MONTANT <span class="basic-ds-n">TRANSACTIONS</span></h1>
                            </div>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="basic-login-form-ad">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="basic-login-inner inline-basic-form">
                                            <h5>2500 USD</h5>
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
                                <h1>MONTANT <span class="basic-ds-n">DEPENSES</span></h1>
                            </div>
                        </div>
                        <div class="sparkline11-graph">
                            <div class="basic-login-form-ad">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="modal-bootstrap modal-login-form">
                                            <a class="zoomInDown mg-t" href="#" data-toggle="modal" data-target="#zoomInDown1">NOUVELLE DEPENSE</a>
                                        </div>
                                        <div id="zoomInDown1" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-close-area modal-close-df">
                                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-login-form-inner">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="login-social-inner">
                                                                        <a href="#" class="button btn-social facebook span-left"> N° Reçu </a>
                                                                        <a href="#" class="button btn-social twitter span-left"> Date </a>
                                                                        <a href="#" class="button btn-social googleplus span-left"> <?= $_SESSION['grade'] ?> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="basic-login-inner modal-basic-inner">
                                                                        <form action="#">
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                        <label class="login2">MOTIF</label>
                                                                                    </div>
                                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <input type="texte" class="form-control" placeholder="Motif decaissement" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                        <label class="login2">BENEFICIAIRE</label>
                                                                                    </div>
                                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <input type="texte" class="form-control" placeholder="Nom du service/personne" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                        <label class="login2">MONTANT</label>
                                                                                    </div>
                                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <input type="texte" class="form-control" placeholder="Montant decaissement" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                        <label class="login2">IMPUTATION</label>
                                                                                    </div>
                                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <input type="texte" class="form-control" placeholder="Compte" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                        <label class="login2">MOT DE PASSE</label>
                                                                                    </div>
                                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <input type="password" class="form-control" placeholder="Autentification" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="login-btn-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <label>
                                                                                                <input type="checkbox" class="i-checks"> USD </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                        <div class="login-horizental">
                                                                                            <button class="btn btn-sm btn-primary login-submit-cs">VALIDER LA DEPENSE</button>
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
    <div class="widget-program-box mg-tb-30">
        <div class="container-fluid">
            <div class="row">
            <?php
            foreach ($liste_finances as $key => $value) {
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="hpanel widget-int-shape responsive-mg-b-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                    <div class="panel-body">
                        <div class="text-center content-box">
                            <h2 class="m-b-xs"><?= $value['designation'] ?></h2>
                            <p class="font-bold text-warning"><?= $value['montant'] ?> <?= $value['monnaie'] ?></p>
                            <div class="m icon-box"><i class="fa fa-money"></i>
                            </div>
                            <p class="small mg-t-box">
                                SEMESTRE <?= $value['semestre'] ?>
                            </p>
                            <button class="btn btn-warning widget-btn-3 btn-sm perception-rubrique" data-id='<?= $value['perception'] ?>'>Perception <?= $value['intitule'] ?></button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            }
            ?>
            </div>
        </div>
    </div>
    <?php
    } else{
    ?>
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Participants S1</h5>
                            <h2>Etudiants<span class="counter"></span> <span class="tuition-fees">Autorisé(s)</span></h2>
                            <span class="text-success">20%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Participants S2</h5>
                            <h2>Etudiants <span class="counter"></span> <span class="tuition-fees">Autorisé(s)</span></h2>
                            <span class="text-danger">30%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">230% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                        <div class="analytics-content">
                            <h5>Enseignants</h5>
                            <h2>Titulaire<span class="nbreTitulaires"></span> <span class="tuition-fees">Section</span></h2>
                            <span class="text-info">60%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:60%;"> <span class="sr-only">20% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                        <div class="analytics-content">
                            <h5>Enseignement</h5>
                            <h2>Matières<span class="cours-s"></span> <span class="tuition-fees">Matières vues</span></h2>
                            <span class="text-inverse">80%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">230% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Effectifs par Promotion</h3>
                    <ul class="basic-list">
                        <li>L1/LMD <span class="pull-right label-danger label-1 label">95.8%</span></li>
                        <li>L2/LMD <span class="pull-right label-purple label-2 label">85.8%</span></li>
                        <li>L3/LMD <span class="pull-right label-success label-3 label">23.8%</span></li>
                        <li>G3/AS <span class="pull-right label-info label-4 label">55.8%</span></li>
                        <li>E1/AS <span class="pull-right label-warning label-5 label">28.8%</span></li>
                        <li>E2/AS <span class="pull-right label-purple label-6 label">26.8%</span></li>
                        <li>TOTAL <span class="pull-right label-purple label-7 label">31.8%</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box res-mg-t-30 table-mg-t-pro-n">
                    <h3 class="box-title">Enseignants par grade</h3>
                    <ul class="country-state">
                        <li>
                            <h2><span class="counter">1250</span></h2> <small>CPP</small>
                            <div class="pull-right">75% <i class="fa fa-level-up text-danger ctn-ic-1"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger ctn-vs-1" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:75%;"> <span class="sr-only">75% Complete</span></div>
                            </div>
                        </li>
                        <li>
                            <h2><span class="counter">1050</span></h2> <small>ASS</small>
                            <div class="pull-right">48% <i class="fa fa-level-up text-success ctn-ic-2"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info ctn-vs-2" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:48%;"> <span class="sr-only">48% Complete</span></div>
                            </div>
                        </li>
                        <li>
                            <h2><span class="counter">6350</span></h2> <small>CT</small>
                            <div class="pull-right">55% <i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success ctn-vs-3" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:55%;"> <span class="sr-only">55% Complete</span></div>
                            </div>
                        </li>
                        <li>
                            <h2><span class="counter">950</span></h2> <small>PROF</small>
                            <div class="pull-right">33% <i class="fa fa-level-down text-success ctn-ic-4"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success ctn-vs-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:33%;"> <span class="sr-only">33% Complete</span></div>
                            </div>
                        </li>
                        <li>
                            <h2><span class="counter">3250</span></h2> <small>EXPERTS</small>
                            <div class="pull-right">60% <i class="fa fa-level-up text-success ctn-ic-5"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-inverse ctn-vs-5" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:60%;"> <span class="sr-only">60% Complete</span></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="courses-inner res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                    <div class="courses-title">
                        <?php
                        if ($_SESSION['designation'] == "ARCHITECTURE") {
                        ?>
                        <a href="#"><img src="vue/gabarit/img/sections/7.png" alt="" /></a>

                        <?php
                        } else {
                        ?>
                        <a href="#"><img src="vue/gabarit/img/courses/1.jpg" alt="" /></a>

                        <?php
                        }
                        
                        ?>
                        <h2><?= $_SESSION['designation'] ?></h2>
                    </div>
                    <div class="courses-alaltic nbrePromo"></div>
                    <div class="course-des">
                        <p><span><i class="fa fa-clock"></i></span> <b>Permanant(s):</b> 16</p>
                        <p><span><i class="fa fa-clock"></i></span> <b>Visiteur(s):</b> 10</p>
                        <p><span><i class="fa fa-clock"></i></span> <b>Expert(s):</b> 100</p>
                    </div>
                    <div class="progress">
                        <div class="progress-bar wow fadeInLeft" data-progress="95%" style="width: 95%;" data-wow-duration="1.5s" data-wow-delay="1.2s"> <span>95% Moy. Annuelle</span>
                        </div>
                    </div>
                    <div class="product-buttons">
                        <button type="button" class="button-default cart-btn">Inscrire</button>
                        <button type="button" class="button-default cart-btn">Inscrire</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php
    }
    ?>
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/main.php"; ?>