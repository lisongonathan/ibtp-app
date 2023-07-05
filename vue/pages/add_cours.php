<?php 
    $page = "Cours";
?>

<?php ob_start(); ?> 
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">                               
                                <li class="active"><a href="#description">Ajouter Cours</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad addcoursepro">
                                                    <form class="dropzone dropzone-custom needsclick" method="POST" id="demo1-upload">
                                                        <?= $msg ?>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input name="cours-intitule" type="text" class="form-control" placeholder="Intitulé">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="cours-code" id="finish" type="text" class="form-control" placeholder="Code">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="cours-credit" type="number" class="form-control" placeholder="Credit">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="chosen-select-single mg-b-20">
                                                                    <select data-placeholder="Choisissez le titulaire..." name="cours-titulaire" class="chosen-select" tabindex="-1">
                                                                        <option value=""></option>
                                                                    <?php
                                                                    foreach ($dataEnseignant as $key => $value) {
                                                                        # code...
                                                                    ?>
                                                                        <option value="<?= $value['id'] ?>"><?= $value['grade'] ?> <?= $value['nom'] ?> <?= $value['post_nom'] ?> (<?= $value['code_access'] ?>)</option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                                <div class="chosen-select-single mg-b-20">
                                                                    <select data-placeholder="Choisissez le semestre..." name="cours-semestre" class="chosen-select" tabindex="-1">
                                                                        <option value=""></option>
                                                                        <option value="1">Premier</option>
                                                                        <option value="2">Second</option>
                                                                    </select>
                                                                </div>
                                                                <div class="chosen-select-single mg-b-20">
                                                                    <select data-placeholder="Choisissez l'unité d'enseignement..." name="cours-unite" class="chosen-select" tabindex="-1">
                                                                        <option value=""></option>
                                                                    <?php
                                                                    foreach ($dataUE as $key => $value) {
                                                                        # code...
                                                                    ?>
                                                                        <option value="<?= $value['id'] ?>"><?= $value['designation'] ?> (<?= $value['code'] ?>)</option>
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
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-light" value="Enregistrer" name="addCours">
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