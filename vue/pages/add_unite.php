<?php 
    $page = "Unite";
?>

<?php ob_start(); ?> 
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#reviews"> Ajouter Unité</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="reviews">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="alert alert-success alert-success-style1 alert-success-stylenone ue-ok">
                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                    </button>
                                                <i class="fa fa-check edu-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                                <p class="message-alert-none"><strong>Success!</strong> L'unité d'enseignement a bien été ajouter dans le système.</p>
                                            </div>
                                            <div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3 alert-st-bg14 ue-no">
                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                    </button>
                                                <i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3 admin-check-pro-clr14" aria-hidden="true"></i>
                                                <p><strong>Erreur!</strong> Un problème est survenu lors de l'enregistrement</p>
                                            </div>
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="devit-card-custom">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="ue-designation" placeholder="Intitule">
                                                            </div>
                                                            <div class="form-group">
                                                                <input  type="text" class="form-control" id="ue-code" placeholder="Code">
                                                            </div>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select id="promotion" data-placeholder="Choisissez la promotion..." class="chosen-select" tabindex="-1">
                                                                    <option value=""></option>
                                                                <?php
                                                                foreach ($data as $key => $value) {
                                                                ?>
                                                                    <option value="<?= $value['promo'] ?>"><?= $value['class'] ?>-<?= $value['designation'] ?> <?= ($value['orientation']) ? '('.$value['orientation'].')' : '' ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <a href="#" class="btn btn-primary waves-effect waves-light" id="addUE-form">Enregistrer</a>
                                                            <a href="#" class="btn btn-default annulerBtn">Annuler</a>
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