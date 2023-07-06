<?php 
    $page = "Profile";
?>

<?php ob_start(); ?> 
        <div class="product-status mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>No</th>
                                        <th>ETUDIANT</th>
                                        <th>NIVEAU</th>
                                        <th>TOTAL</th>
                                        <th>RESTE</th>
                                        <th>PERCEVOIR</th>
                                    </tr>
                                <?php
                                foreach ($detail_rubrique as $key => $value) {
                                    $soldeEtudiant = getSoldeOfEtudiant($value['id'], $id);
                                ?>
                                <tr>
                                    <td><?= $key+1 ?></td>
                                    <td><?= strtoupper($value['nom']) ?> <?= strtoupper($value['post_nom']) ?> <?= strtoupper($value['prenom']) ?></td>
                                    <td>
                                        <button class="pd-setting"><?= $value['intitule'] ?> <?= $value['designation'] ?></button>
                                    </td>
                                    <td><?= (isset($soldeEtudiant['TOTAL'])) ? $soldeEtudiant['TOTAL'] : '0' ?> <?= $infos_rubrique['monnaie'] ?></td>
                                    <td><?= (isset($soldeEtudiant['RESTE'])) ? $soldeEtudiant['RESTE'] : '0' ?> <?= $infos_rubrique['monnaie'] ?></td>
                                    <td>
                                        <button data-toggle="tooltip" title="Ajouter un nouveau païement" class="pd-setting-ed add-paiement" data-id='<?= $value['id'] ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    </td>
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
        </div>
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/main.php"; ?>