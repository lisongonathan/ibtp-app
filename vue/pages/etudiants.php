<?php 
    $page = "Etudiants";
?>

<?php ob_start(); ?> 
    <div class="admintab-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">                  
                    <div class="admintab-wrap edu-tab1 mg-t-30 ">
                        <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1 tab-menu-right">
                            <li class="active"><a data-toggle="tab" href="#TabDetails2"><span class="edu-icon edu-analytics tab-custon-ic"></span>TOUS LES ETUDIANTS</a>
                            </li>
                            <li><a data-toggle="tab" href="#TabProject2"><span class="edu-icon edu-analytics-arrow tab-custon-ic"></span>INSCRIRE UN ETUDIANT</a>
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
                                                            <th data-field="id">MATRICULE</th>
                                                            <th>NOM</th>
                                                            <th>POST - NOM</th>
                                                            <th>PRE NOM</th>
                                                            <th>SEXE</th>
                                                            <th>LIEU DE NAISSANCE</th>
                                                            <th>FRAIS ACADEMIQUE</th>
                                                            <th>FRAIS CONNEXES S1</th>
                                                            <th>FRAIS CONNEXES S2</th>
                                                            <th>AJAC</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach ($listEtudiant as $key => $value) {
                                                    ?>
                                                    <tr>
                                                       <td><?= $value['code_access'] ?></td>
                                                       <td><?= $value['nom'] ?></td>
                                                       <td><?= $value['post_nom'] ?></td>
                                                       <td><?= $value['prenom'] ?></td>
                                                       <td><?= $value['sexe'] ?></td>
                                                       <td><?= $value['lieu_naiss'] ?></td>
                                                       <td><?= $value['acad_frais'] ?></td>
                                                       <td><?= $value['connexe_frais'] ?></td>
                                                       <td><?= $value['connexe_frais_s2'] ?></td>
                                                       <td><?= $value['dettes'] ?></td>
                                                       <td class="datatable-ct">    
                                                           <div class="button-ap-list responsive-btn">
                                                               <div class="btn-group btn-custom-groups btn-custom-groups-one">
                                                                   <a type="button" class="btn btn-primary" href="index.php?editEtudiant=<?= $value['id'] ?>"><i class="fa fa-info-circle edu-informatio" aria-hidden="true"></i></a>
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
                            <div id="TabProject2" class="tab-pane animated flipInY custon-tab-style1">
                                <div class="row">
                                    <div class="col-lg-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">IDENTITES</a></li>
                                <li><a href="#reviews"> INFOS. ACADEMIQUE</a></li>
                                <li><a href="#INFORMATION">INFOS. FINANCE</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action="/upload" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control nom_etudiant" placeholder="Nom de l'étudiant">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control post_nom_etudiant" placeholder="Post - nom de l'étudiant">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control prenom_etudiant" placeholder="Prenom de l'étudiant">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control nationalite_etudiant" placeholder="Nationalite de l'étudiant">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group data-custon-pick" id="data_1">
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input type="text" class="form-control date_etudiant">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="lieu_naiss" type="text" class="form-control lieu_naiss_etudiant" placeholder="Lieu de naissance de l'étudiant">
                                                                </div>
                                                                <div class="form-group">
                                                                    <select name="gender" class="form-control sexe_etudiant">
																		<option value="" selected disabled>Sexe</option>
																		<option value="M">MASCULIN</option>
																		<option value="F">FEMININ</option>
																	</select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control diplome_etudiant" placeholder="Diplome de l'étudiant">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-default annulerBtn">ANNULER</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="reviews">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="devit-card-custom">
                                                            <div class="form-group">
                                                                <select class="form-control promotion_etudiant" value="<?= $_GET['etudiants'] ?>">
                                                                    <option value="">NIVEAU DE L'ETUDIANT</option>
                                                                <?php 
                                                                foreach ($listPromotion as $key => $value) {
                                                                ?>
                                                                <option value="<?= $value['promo'] ?>" <?= ($value['promo'] == $_GET['etudiants']) ? 'default selected' : '' ?>><?= $value['class'] ?> <?= $value['designation'] ?> <?= $retVal = ($value['orientation']) ? $value['orientation'] : '' ; ?></option>

                                                                <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control ajac_etudiant" placeholder="AJAC">
                                                            </div>
                                                            <button class="btn btn-default annulerBtn">ANNULER</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
												<div class="row">
													<div class="col-lg-12">
														<div class="devit-card-custom">
															<div class="form-group">
																<input type="text" class="form-control frais_acad_etudiant" placeholder="FRAIS ACADEMIQUE (CDF)">
															</div>
															<div class="form-group">
																<input type="text" class="form-control frais_connexe_s1" placeholder="FRAIS CONNEXE S1 (CDF)">
															</div>
															<div class="form-group">
																<input type="text" class="form-control frais_connexe_s2" placeholder="FRAIS CONNEXE S2 (CDF)">
															</div>
															<button class="btn btn-primary waves-effect waves-light add_etudiant">ENREGISTRER</button>
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
    
<?php $contenu = ob_get_clean(); ?>
<?php require "vue/gabarit/main.php"; ?>