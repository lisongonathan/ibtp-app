<?php 
    $page = "Class";
?>

<?php ob_start(); ?> 
    <div class="admintab-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content-details shadow-reset">
                        <h2><?= $infosPromotion['niveau'] ?> - <?= $infosPromotion['section'] ?> <?= (isset($infosPromotion['orientation'])) ? '(' . $infosPromotion['orientation'] . ')' : '' ?></h2>
                    </div>
                </div>
            </div>
            <br />
        </div>
    </div>

<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">    
        <?php
        foreach ($listeCours as $key => $value) {
        ?> 
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="courses-inner res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                <div class="courses-title">
                    <a href="#"><img src="vue/gabarit/img/courses/1.jpg" alt="" /></a>
                    <h2><?= $value['intitule'] ?></h2>
                </div>
                <div class="courses-alaltic">
                    <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-star"></i></span> <?= $value['class'] ?></span>
                    <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-solid fa-trophy"></i></span> <?= $value['section'] ?></span>
                    <?= ($value['orientation']) ? '<span class="cr-ic-r"><span class="course-icon"><i class="fa fa-heart"></i></span> ' . $value["orientation"] . ' </span>' : '' ; ?> 
                </div>
                <div class="course-des">
                    <p><span><i class="fa fa-clock"></i></span> <b>Credit :</b> <?= $value['credit'] ?></p>
                    <p><span><i class="fa fa-clock"></i></span> <b>Semestre :</b> <?= $value['semestre'] ?></p>
                    <p><span><i class="fa fa-clock"></i></span> <b>Statut :</b> <?= $value['statut'] ?></p>
                    <p><span><i class="fa fa-clock"></i></span> <b>Code UE :</b> <?= $value['ucode'] ?></p>
                </div>
                <div>
                    <a type="button" class="btn btn-success" href="index.php?myclass=<?= $value['promo'] ?>&fiche=<?= $value['id'] ?>">FICHE DE COTATION</a>
                    <a type="button" class="btn btn-warning" href="index.php?printFiche=<?= $value['id'] ?>">IMPRIMER</a>
                </div>
            </div>
        </div>
        <br />
        <?php
        }
        ?>       
        </div>
    </div>
</div>
    
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/main.php"; ?>