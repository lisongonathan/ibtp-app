<?php

/* -- LIEN MODELE - CONTRÔLEUR -- */
require "modele/modele.php";
//Connexion au compte					
require_once 'controleur/php/dompdf/autoload.inc.php';
require_once 'controleur/php/vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

/* CONTROLEURS BACKEND */
//Page login
function login(){
	//GRADE ADMINISTRATIF
    $listeGrades = gradeAdministratif();

    if (isset($_POST['submit'])) {

        if(isset($_POST['matricule']) AND !empty($_POST['matricule']) AND isset($_POST['mdp']) AND !empty($_POST['mdp']) AND isset($_POST['module']) AND !empty($_POST['module'])){
        
            $matricule = htmlspecialchars($_POST['matricule']);
            $module_user = (int) htmlspecialchars($_POST['module']);
            $mdp = htmlspecialchars($_POST['mdp']);
            
            switch ($module_user) {
                case 1:
                    # SECTION
                    if($dataUser = authSection($matricule, crypt($mdp, $matricule))){
                        $_SESSION['module'] = 'Section';

                        $_SESSION['id'] = $dataUser['id'];
                        $_SESSION['designation'] = $dataUser['designation'];
                        $_SESSION['description'] = $dataUser['description'];
                        $_SESSION['logo'] = $dataUser['logo'];
                        $_SESSION['id_president'] = $dataUser['id_president'];
                        $_SESSION['nom'] = $dataUser['nom'];
                        $_SESSION['post_nom'] = $dataUser['post_nom'];
                        $_SESSION['prenom'] = $dataUser['prenom'];
                        $_SESSION['sexe'] = $dataUser['sexe'];
                        $_SESSION['grade'] = $dataUser['grade'];

                        header('Location:index.php');
                    } else {
                        $msg = "Vous n'êtes pas enregistré dans le système, veuillez vous rapprocher du service académique...";
                    }
                    break;

                case 2:
                    # COMGER
                    if ($dataUser = authComger($matricule, crypt($mdp, $matricule))) {
                        $_SESSION['module'] = 'Comger';
                        $_SESSION['id'] = $dataUser['id'];
                        $_SESSION['nom'] = $dataUser['nom'];
                        $_SESSION['post_nom'] = $dataUser['post_nom'];
                        $_SESSION['prenom'] = $dataUser['prenom'];
                        $_SESSION['matricule'] = $dataUser['matricule'];
                        $_SESSION['grade'] = $dataUser['grade'];
                        $_SESSION['frais_academique'] = $dataUser['frais_academique'];
                        $_SESSION['enrol_1'] = $dataUser['enrol_1'];
                        $_SESSION['enrol_2'] = $dataUser['enrol_2'];

                        if ($_SESSION['grade'] == "SGAC") {
                            header('Location:index.php?sgac');
                        } else {
                            header('Location:index.php');
                        }
                    } else {
                        $msg = "Vous n'êtes pas enregistré dans le système, veuillez vous rapprocher du service académique...";
                    }
                    break;
                
                    
                case 3:
                    # TITULAIRE
                    if($dataUser = authEnseignant($matricule, crypt($mdp, $matricule))){
                        $_SESSION['module'] = 'Titulaire';
    
                        $_SESSION['id'] = $dataUser['id'];
                        $_SESSION['nom'] = $dataUser['nom'];
                        $_SESSION['post_nom'] = $dataUser['post_nom'];
                        $_SESSION['prenom'] = $dataUser['prenom'];
                        $_SESSION['sexe'] = $dataUser['sexe']; 
                        $_SESSION['grade'] = $dataUser['grade'];
                        $_SESSION['matricule'] = $dataUser['matricule'];
                        $_SESSION['statut'] = $dataUser['statut'];
                        $_SESSION['id_section'] = $dataUser['id_section'];
                        header('Location:index.php');

                    }else {
                        $msg = "Vous n'êtes pas enregistré dans le système, veuillez vous rapprocher du service académique...";
                    } 
                    break;
                    
                case 5:
                    #JURY
                    if($dataUser = authJury($matricule, $mdp)){
                        $_SESSION['module'] = 'Jury';
    
                        $_SESSION['id'] = $dataUser['id'];
                        $_SESSION['designation'] = $dataUser['designation'];
                        $_SESSION['mdp'] = $dataUser['mdp'];
                        $_SESSION['id_secretaire'] = $dataUser['id_sec'];
                        $_SESSION['statut'] = $dataUser['statut'];
                        header('Location:index.php');

                    }else {
                        $msg = "Vous n'êtes pas enregistré dans le système, veuillez vous rapprocher du service académique...";
                    }
                    break;

                default:
                    # ETUDIANT
                    if ($dataUser = authEtudiant($matricule, crypt($mdp, $matricule))) {
                        $_SESSION['module'] = 'Etudiant';
    
                        $_SESSION['id'] = $dataUser['id'];
                        $_SESSION['nom'] = $dataUser['nom'];
                        $_SESSION['post_nom'] = $dataUser['post_nom'];
                        $_SESSION['prenom'] = $dataUser['prenom'];
                        $_SESSION['sexe'] = $dataUser['sexe'];
                        $_SESSION['statut'] = $dataUser['statut'];
                        $_SESSION['matricule'] = $dataUser['matricule'];
                        $_SESSION['grade'] = $dataUser['grade'];
                        $_SESSION['id_promotion'] = $dataUser['id_promotion'];
                        $_SESSION['frais_academique'] = $dataUser['frais_academique'];
                        $_SESSION['enrol_1'] = $dataUser['enrol_1'];
                        $_SESSION['enrol_2'] = $dataUser['enrol_2'];
                        
                        header('Location:index.php');
                    } else {
                        $msg = "Vous n'êtes pas enregistré dans le système, veuillez vous rapprocher du service académique...";
                    }
                    break;
            }
    
        }else{
            $msg = "Veuillez remplir tous les champs svp...";
        }
    }else{

        $msg = "Veuillez entrer vos identifiants de connexion (code d'access, mot de passe et module)...";
    }

	//Lien vue - controleur
	require "vue/pages/login.php";
}

function accessEtudiant(){
    $data = getAllStudents();
	//Lien vue - controleur
	require "vue/pages/items_print.php";
}

function accessEnseignant(){  
    $data = getAllEnseignant();
    

    if (isset($_POST['submit'])) {

        if(isset($_POST['matricule']) AND !empty($_POST['matricule']) AND isset($_POST['mdp']) AND !empty($_POST['mdp']) AND isset($_POST['c_mdp']) AND !empty($_POST['c_mdp']) AND isset($_POST['module']) AND !empty($_POST['module'])){
        
            $matricule = htmlspecialchars($_POST['matricule']);
            $module_user = (int) htmlspecialchars($_POST['module']);
            $mdp = htmlspecialchars($_POST['mdp']);
            $c_mdp = htmlspecialchars($_POST['c_mdp']);

            if ($mdp == $c_mdp) {            
            
                switch ($module_user) {
                    case 1:
                        # ENSEIGNANT
                        $isExist = getEnseignantSignin($matricule);
                        if ($isExist) {
                            $msg = "Cette utilisateur possède déjà un compte";
                        } else {
                        
                            if($dataUser = signinEnseignant($matricule, crypt($mdp, $matricule))){    
                                header('Location:index.php');
                            } else {
                                $msg = "Un prombème est survenu lors de l'inscription, veuillez verifier votre code d'accès...";
                            }
                        }
                        break;
    
                    case 2:
                        # ETUDIANT
                        $isExist = getEtudiantSignin($matricule);
                        if ($isExist) {
                            # code...
                            $msg = "Cette utilisateur existe déjà dans la base de donnée";
                        } else {
                            # code...
                            if ($dataUser = signinEtudiant($matricule, crypt($mdp, $matricule))) {
                                header('Location:index.php');
                            } else {
                                $msg = "Un prombème est survenu lors de l'inscription, veuillez verifier votre code d'accès...";
                            }
                        }
                        
                        break;
                    
                        
                    case 3:
                        # ADMINISTRATIF
                        $isExist = getAdminSignin($matricule);
                        if ($isExist) {# code...
                            $msg = "Cette utilisateur existe déjà dans la base de donnée";
                        } else {
                                # code...
                            if($dataUser = signinAdmin($matricule, crypt($mdp, $matricule))){
                                header('Location:index.php');    
                            }else {
                          
                        }
                          $msg = "Un prombème est survenu lors de l'inscription, veuillez verifier votre code d'accès...";
                        } 
                        break;
                    default:
                        # N'IMPORTE QUOI
                        $msg = "Veuillez choisir un type d'utilisateur correct svp...";
                        break;
                }
            } else {
                $msg = "Le mot de passe doit être confirmer";
            }
    
        }else{
            $msg = "Veuillez remplir tous les champs svp...";
        }
    }else{

        $msg = "Veuillez entrer votre code d'access, choissiez votre mot de passe et et le type d'utilisateur";
    }
	//Lien vue - controleur
	require "vue/pages/items_print.php";
}

function signin(){
	//Message de bienvenu
    //$itemsPromotions = getAllPromotions();
    //echo "ok";
	//Lien vue - controleur
	require "vue/pages/signin.php";
}

//Page d'autorisation
function sgacd(){
    require "vue/pages/academique.php";
}

//Page Tableau de bord
function dashboard(){

    if ($_SESSION['module'] == 'Comger') {
        $dataStat = getStatComger();
    }

    if ($_SESSION['module'] == 'Etudiant') {
        $infosPromotion = getDetailsPromotion($_SESSION['id_promotion']);
        $infosMatieres = getMatieresByPromo($_SESSION['id_promotion']);

        $maximum = 0;
        $total = 0;
        $reussites = 0;
        $echecs = 0;

        $mat_s1 = 0;
        $mat_s2 = 0;

        $matieres_s1 = [];
        $matieres_s2 = [];

        foreach ($infosMatieres as $key => $value) {
            $maximum = $maximum + 10;
            $cotes = getCoteEtudiant($_SESSION['id'], $value['id']);

            if (isset($cotes['tp']) AND !empty($cotes['tp']) AND isset($cotes['td']) AND !empty($cotes['td'])) {
                $total += $cotes['tp'] + $cotes['td'];

                if ($cotes['tp'] + $cotes['td'] < 5) {
                    $echecs++;                  
                } else {
                    $reussites++;
                }
            }

            if ($value['statut'] == 'VU' AND $value['semestre'] == 'Premier') {
                # code...
                $mat_s1++;
                # code...
                $matieres_s1[]= array(
                    'ec' => $value['intitule'],
                    'credit' => $value['credit'],
                    'tp' => (isset($cotes['tp'])) ? $cotes['tp'] : '-',
                    'td' => (isset($cotes['td'])) ? $cotes['td'] : '-',
                    'examen' => (isset($cotes['examen'])) ? $cotes['examen'] : '-',
                    'rattrapage' => (isset($cotes['rattrapage'])) ? $cotes['rattrapage'] : '-'
                );
                
            } else {
                # code...
                $mat_s2++;
                # code...
                $matieres_s2[]= array(
                    'ec' => $value['intitule'],
                    'credit' => $value['credit'],
                    'tp' => (isset($cotes['tp'])) ? $cotes['tp'] : '-',
                    'td' => (isset($cotes['td'])) ? $cotes['td'] : '-',
                    'examen' => (isset($cotes['examen'])) ? $cotes['examen'] : '-',
                    'rattrapage' => (isset($cotes['rattrapage'])) ? $cotes['rattrapage'] : '-'
                );
            }
            
        }
    }

    if ($_SESSION['module'] == 'Titulaire') {
        $effecOfIbtp = getAllStudents();
        $countStudents = 0;
        
        foreach ($effecOfIbtp as $key => $value) {
            $countStudents++;
        }

        $effecOfTitulaire = getStudentsTitulaire($_SESSION['id']);
        $countStudentsOfTitulaire = 0;

        foreach ($effecOfTitulaire as $key => $value) {
            # code...
            $countStudentsOfTitulaire++;
        }

        $promoOfTitulaire = getPromosListTitulaire($_SESSION['id']);
        $totalPromoOfTitulaire = 0;

        foreach ($promoOfTitulaire as $key => $value) {
            # code...
            $totalPromoOfTitulaire++;
        }

        $promoOfibtp = getAllPromotions();
        $countAllPromotions = 0;

        foreach($promoOfibtp as $key => $value){
            $countAllPromotions++;
        }

        $matieresOfIbtp = getECS();
        $countAllMatieres = 0;
        $sumOfCredisIbtp = 0;

        foreach ($matieresOfIbtp as $key => $value) {
            # code...
            $countAllMatieres++;
            $sumOfCredisIbtp += $value['credit'];
        }

        $matieresOfTitulaires=getEnseignant($_SESSION['id']);
        $countMatieres = 0;
        $sumOfCreditsTit = 0;

        foreach ($matieresOfTitulaires as $key => $value) {
            # code...
            $countMatieres++;
            $sumOfCreditsTit += $value['credit'];
        }

    }

    

    if ($_SESSION['module'] == 'Operateur') {

        //Liste des finances
        $liste_finances = getAllFinances();
    }


	//Lien vue - controleur
	require "vue/pages/dashboard.php";
}

function bulletin($semestre){
    $infosBulletin = getDetailsPromotion($_SESSION['id_promotion']);
    $infoReleve = getDetailsReleve($_SESSION['id']);
    $dataCotes = getAllCotes($_SESSION['id_promotion'],  $_SESSION['id'], $semestre);
    $maxOfPromotion = getMaxByPromo($_SESSION['id_promotion']);
    $totObtByStudent = getByObtEtudiant($_SESSION['id']);
    $dataCours = getMatieresByPromo($_SESSION['id_promotion']);
    //print_r($dataCotes);
    if($infosBulletin['lblSysteme'] == "LMD"){
        $dataCredits = array(
            'ncv' => 0,
            'ncnv' => 0
        );

        foreach ($dataCours as $key => $value) {
            $data = getCoteEtudiant($_SESSION['id'], $value['id']);
            //print_r($data);
            if (isset($data['tp']) AND isset($data['td']) AND isset($data['examen'])) {
                if($data['tp'] + $data['td'] + $data['examen'] >= 10.0){
                    $dataCredits['ncv'] = $dataCredits['ncv'] + $value['credit'];
                }else {
                    $dataCredits['ncnv'] = $dataCredits['ncnv'] + $value['credit'];
                }
            } else {
                $dataCredits['ncnv'] = $dataCredits['ncnv'] + $value['credit'];
            }
            
        }
        $pourcentage = round(($totObtByStudent['OBT']/$maxOfPromotion['Maximum'])*100,2);
        if ($pourcentage >=50.0) {
            if ($pourcentage >= 60.0) {
                if ($pourcentage >= 70.0) {
                    if ($pourcentage >= 80.0) {
                        if ($pourcentage >= 90.0) {
                            $jury = "A";
                        } else {
                            $jury = "B";
                        }
                        
                    } else {
                        $jury = "C";
                    }
                    
                } else {
                    $jury = "D";
                }
                
            } else {
                $jury = "E";
            }
            
        } else {
            $jury = "X";
        }
        //print_r($dataCours);
    }else{

        $dataCredits = array(
            'ncv' => 0,
            'ncnv' => 0
        );

        foreach ($dataCours as $key => $value) {
            $data = getCoteEtudiant($_SESSION['id'], $value['id']);
            if (isset($data['tp']) AND isset($data['td']) AND isset($data['examen'])) {
                if($data['tp'] + $data['td'] + $data['examen'] >= 10.0){
                    $dataCredits['ncv'] = $dataCredits['ncv'] + $value['credit'];
                }else {
                    $dataCredits['ncnv'] = $dataCredits['ncnv'] + $value['credit'];
                }
            } else {
                $dataCredits['ncnv'] = $dataCredits['ncnv'] + $value['credit'];
            }
            
        }

        $counterLegers = 0;
        $counterGraves = 0;
        $counterManque = 0;
        $resultat = 0;
        $tot = 0;

        foreach ($data as $key => $value) {
          $tot = $tot + 20*$value['credit'];
          if (!isset($value['tp']) OR !isset($value['td']) OR !isset($value['examen'])) {                
            $counterManque = $counterManque + 1;
          }
          
          if (!empty($value['tp']) AND !empty($value['td']) AND !empty($value['examen'])) {                      
            $resultat = $resultat + ($value['tp'] + $value['td'] + $value['examen'])*$value['credit'];
            $cote = $value['tp'] + $value['td'] + $value['examen'];
            if ($cote < 9) {
              if ($cote < 8) {
                $counterGraves = $counterGraves + 1;
              }else{
                $counterLegers = $counterLegers + 1;
              }
            }        
          }
        }
        if (!$counterManque) {
            $pourcentage = ((float) $resultat/(float) $tot)*100;
            if (empty($pourcentage)) {
                $jury = "Pas d'info.";
            }else {
                if ($pourcentage < 40.0) {
                    if ($counterManque >0) {
                        $jury = "ANAF";
                    } else {
                        $jury = "NAF";
                    }
                    
                } else {
                    if ($pourcentage < 50.0) {
                        $jury = "A";
                    } else {
                        if ($counterGraves > 0) {
                            $jury = "A";
                        }else{
                            if ($pourcentage <= 100.0 AND $counterManque > 0) {
                                $jury = "AA";
                            }
                            if ($pourcentage >= 50.0 AND $pourcentage <= 69.99) {
                                if ($counterLegers < 1) {
                                    $jury = "S";
                                } else {
                                    if ($counterLegers == 1 AND $pourcentage <= 54.99) {
                                        $jury = "S";
                                    }
                                    if ($counterLegers <= 2 AND $pourcentage >= 55.0 AND $pourcentage <=59.99) {
                                        $jury = "S";
                                    }
                                    if ($counterLegers <= 3 AND $pourcentage >= 60.0 AND $pourcentage <=69.99) {
                                        $jury = "S";
                                    }                     
                                }                    
                            } else {
                                if ($pourcentage <= 100.0) {
                                    if ($pourcentage <= 89.99) {
                                        if ($pourcentage <= 79.99) {
                                            $jury = "D";
                                        }else{
                                            $jury = "GD";
                                        }                        
                                    } else {
                                        $jury = "PGD";
                                    }                        
                                } 
            
                            } 
                        }
                        
                    }            
                }
            }
        } else {
            $pourcentage = "";
            $jury = "AA";
        }

    }
    
    //print_r($data);
	//Lien vue - controleur
	require "vue/pages/bulletin.php";
}

//Page Tableau de bord
function fichesCotation($matiere, $class){
    // $promotion = (int) $_GET['fiche'];
    // $matiere = getTitEcs($_SESSION['id'], $promotion, (int) $_GET['matiere']);
    // $infoPromotion = infoPromotion($promotion);
    // $dataStudents = getStudentsByPromo((int) $_GET['fiche']);
    
    $_SESSION['promotion'] = $class;

    $dataCours = getMatieresByMatiere($matiere);
    $niveauOfPromotion = infoPromotion($_SESSION['promotion']);
    $dataStudents = getStudentsByPromo($_SESSION['promotion']);
    
    if($niveauOfPromotion['systeme'] == 'LMD'){
        $infoGrille = array(
            'promotion' => 'PROMOTION : ' . $niveauOfPromotion['niveau'] . ' ' . $niveauOfPromotion['section'],
            'matiere' => 'EC : ' . $dataCours['intitule'] . ' (Credit : '. $dataCours['credit'] .')',
            'ue' => 'UE : ' . $dataCours['designation'],
            'semestre' => 'SEMESTRE : ' . $dataCours['semestre'],
            'titulaire' => 'TITULAIRE : ' . $dataCours['grade'] . ' ' . $dataCours['nom'] . ' ' . $dataCours['post_nom'],
            'date' => date("d/m/Y")
        );

    }else{

        $infoGrille = array(
            'promotion' => 'PROMOTION : ' . $niveauOfPromotion['niveau'] . ' ' . $niveauOfPromotion['section'],
            'matiere' => 'MATIERE : ' . $dataCours['intitule'] . ' (PONDERATION : '. $dataCours['credit'] .')',
            'ue' => 'GROUPE : ' . $dataCours['designation'],
            'semestre' => 'SEMESTRE : ' . $dataCours['semestre'],
            'titulaire' => 'TITULAIRE : ' . $dataCours['grade'] . ' ' . $dataCours['nom'] . ' ' . $dataCours['post_nom'],
            'date' => date("d/m/Y")
        );

    }  
        
	//Lien vue - controleur
	require "vue/pages/fiche.php";
}

//Page Tableau de bord
function fiches($class){
    // $promotion = (int) $_GET['fiche'];
    // $matiere = getTitEcs($_SESSION['id'], $promotion, (int) $_GET['matiere']);
    // $infoPromotion = 
    // $dataStudents = getStudentsByPromo((int) $_GET['fiche']);
    
    $_SESSION['promotion'] = $class;
    
    # IDCOURS TITULAIRE
    $listeCours = getMatieresOfTitulaireByPromo($_SESSION['promotion'], $_SESSION['id']);
    $infosPromotion = infoPromotion($class);
        
	//Lien vue - controleur
	require "vue/pages/class.php";
}

function grilleDeliberation(){
    $_SESSION['grille'] = (int) $_GET['grille'];
    $dataStudents = getStudentsByPromo((int) $_GET['grille']);
    $dataCours = getMatieresByPromo((int) $_GET['grille']);
    $niveauOfPromotion = infoPromotion((int) $_GET['grille']);
    $maxOfPromotion = getMaxByPromo((int) $_GET['grille']);
    $palmaress = getByObtPromo((int) $_GET['grille']);
    $effectifOfPromo = getEffByPromo((int) $_GET['grille']);
    if (!$maxOfPromotion['Maximum']) {
        $maxOfPromotion['Maximum'] = 1;
    }
    for ($i=5; $i >= 0; $i--) { 
        $participants[] = round(($i * $effectifOfPromo['participant']/5)*100/$effectifOfPromo['participant']);
    }

    foreach ($palmaress as $key => $value) {
        $dataPalmaress[] = array(
            "id" => $value['id'],
            "nom" => $value['nom'],
            "post_nom" => $value['post_nom'],
            "pourcentage" => round(($value['OBT']/$maxOfPromotion['Maximum'])*100, 2)
        );
    }
    $apA = 0;
    $apB = 0;
    $apC = 0;
    $apD = 0;
    $apE = 0;
    $apX = 0;
    foreach ($dataPalmaress as $value) {        
        if ($value['pourcentage'] >=50.0) {
            if ($value['pourcentage'] >= 60.0) {
                if ($value['pourcentage'] >= 70.0) {
                    if ($value['pourcentage'] >= 80.0) {
                        if ($value['pourcentage'] >= 90.0) {
                            $apA = $apA + 1;
                        } else {
                            $apB = $apB + 1;
                        }
                        
                    } else {
                        $apC = $apC + 1;
                    }
                    
                } else {
                    $apD = $apD + 1;
                }
                
            } else {
                $apE = $apE + 1;
            }
            
        } else {
            $apX = $apX + 1;
        }
    }

	//Lien vue - controleur
	require "vue/pages/grille.php";
}

function detailleGrille($promotion){
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    
    $dataStudents = getStudentsByPromo($promotion);
    $dataCours = getMatieresByPromo($promotion);
    $niveauOfPromotion = infoPromotion($promotion);

    $total_credit = 0;
    $total_promos = 0;
    $max_promotion = 0;

    $infoGrille = array(
        'promotion' =>  $niveauOfPromotion['niveau'] . ' - '. $niveauOfPromotion['section'] . ' ' . $niveauOfPromotion['orientation'],
        'systeme' => $niveauOfPromotion['systeme']
    );

    //require "vue/pages/detailGrille.php";
    try {
        //code...
        if ($niveauOfPromotion['orientation']) {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('vue/gabarit/assets/'. $niveauOfPromotion['niveau'] .'_'. $niveauOfPromotion['section'] .'_'. $niveauOfPromotion['orientation'].'.xlsx');
        } else {            
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('vue/gabarit/assets/'. $niveauOfPromotion['niveau'] .'_'. $niveauOfPromotion['section'].'.xlsx');
        }
        
        $worksheet = $spreadsheet->getActiveSheet();
        
        $worksheet->getCell('C7')->setValue($infoGrille['promotion']);
        
        $worksheet->getCell('C8')->setValue($infoGrille['systeme']);
    
        foreach ($dataCours as $key => $value) { 
            $j = $key +4;
            $UE = $value['ucode'];
            $EC = $value['intitule'];
            $CREDIT = $value['credit'];

            $total_credit = $total_credit + $CREDIT;
            $total_promos++;

            $max_promotion += 20*$CREDIT;
    
            //$worksheet->setCellValueByColumnAndRow($j, 9, $UE);
            $worksheet->setCellValueByColumnAndRow($j, 10, $EC);
            $worksheet->setCellValueByColumnAndRow($j, 14, $CREDIT);
    
            $j++;
        }
        
        $worksheet->setCellValueByColumnAndRow($j, 15, $max_promotion);
    } catch (Exception $th) {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('vue/gabarit/assets/en_tete_grille.xlsx');
        
        $worksheet = $spreadsheet->getActiveSheet();
        
        $worksheet->getCell('C7')->setValue($infoGrille['promotion']);
        
        $worksheet->getCell('C8')->setValue($infoGrille['systeme']);

        foreach ($dataCours as $key => $value) { 
            $j = $key +4;
            $UE = $value['ucode'];
            $EC = $value['intitule'];
            $CREDIT = $value['credit'];

            $total_credit = $total_credit + $CREDIT;
            $total_promos++;
            $max_promotion += 20*$CREDIT;

            $worksheet->setCellValueByColumnAndRow($j, 9, $UE);
            $worksheet->setCellValueByColumnAndRow($j, 10, $EC);
            $worksheet->setCellValueByColumnAndRow($j, 14, $CREDIT);

            $j++;
        }
        
        $worksheet->setCellValueByColumnAndRow($j, 15, $max_promotion);
    }
    
    $worksheet->getCell('L7')->setValue($total_credit);
    $worksheet->getCell('L8')->setValue($total_promos);  
    // $worksheet->getCell('Z3')->setValue('Pourcentage');
    // $worksheet->getCell('AA3')->setValue('NCV');
    // $worksheet->getCell('AB3')->setValue('NCNV');
    // $worksheet->getCell('AC3')->setValue('Appréciation');
    // $worksheet->getCell('AD3')->setValue('Capitalisation');
    
    $L = 17;
    foreach ($dataStudents as $key => $value) {
        // $ncv = 0;
        // $ncnv = 0;
        // $tp = 0;
        // $td = 0;
        // $examen = 0;
    
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];

        $worksheet->getStyle('A' . $L)->applyFromArray($styleArray);    
        $worksheet->getCell('A' . $L)->setValue($key + 1);

        $worksheet->getStyle('B' . $L)->applyFromArray($styleArray);    
        $worksheet->getCell('B' . $L)->setValue($value['nom']);

        $worksheet->getStyle('C' . $L)->applyFromArray($styleArray);    
        $worksheet->getCell('C' . $L)->setValue($value['post_nom']);
        
        // $M = 2;
        // foreach ($dataCours as $k => $v) {
        //     $data = getCoteEtudiant($value['id'], $v['id']);
        //     $colName = array('B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC');
            
        //     if(isset($data['tp'])){
        //         $tp = (int) $data['tp']*$v['credit'];
        //     }else{
        //         $tp = $tp + 0;
        //     }

        //     if(isset($data['td'])){
        //         $td = (int) $data['td']*$v['credit'];
        //     }else{
        //         $td = $td + 0;
        //     }

        //     if(isset($data['examen'])){
        //         $examen =(int) $data['examen']*$v['credit'];
        //     }else{
        //         $examen = $examen + 0;
        //     }

        //     if(isset($data['tp']) AND isset($data['td']) AND isset($data['examen'])){
        //         if($data['tp'] + $data['td'] + $data['examen'] >= 10.0){                    
        //             $ncv = $ncv + $v['credit'];
        //         }else {
        //             $ncnv = $ncnv + $v['credit'];
        //         }                 
                
        //         $styleArray = [
        //             'borders' => [
        //                 'outline' => [
        //                     'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        //                     'color' => ['argb' => '00000000'],
        //                 ],
        //             ],
        //         ];
        //         $worksheet->getStyle($colName[$k] . $L)->applyFromArray($styleArray);  
        //         $totalEtudiant = $data['tp'] + $data['td'] + $data['examen'];
        //         $worksheet->setCellValueByColumnAndRow($M, $L, $totalEtudiant); 
        //     }else{
        //         $ncnv = $ncnv + $v['credit'];
        //         $styleArray = [
        //                 'borders' => [
        //                     'outline' => [
        //                         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        //                 ],
        //             ],
        //         ];
        //         $worksheet->getStyle($colName[$k] . $L)->applyFromArray($styleArray);  
        //         $totalEtudiant = " - ";
        //         $worksheet->setCellValueByColumnAndRow($M, $L, $totalEtudiant); 
        //     }

        //     $max[] = 20*$v['credit'];
        //     $moyTot[] = ($tp+$td+$examen);
        //     $M++;
        // }
        // $den = array_sum($max);
        // $num = getByObtEtudiant($value['id']);
        // $pourcentage = ($num['OBT']/$den);

        // $coeff = (float) $ncv/(float) ($ncv+$ncnv);
        // $coeff = $coeff*100;

        // if ($coeff  >= 70.0) { 
        //     if ($pourcentage >=50.0) {
        //         if ($pourcentage >= 60.0) {
        //             if ($pourcentage >= 70.0) {
        //                 if ($pourcentage >= 80.0) {
        //                     if ($pourcentage >= 90.0) {
        //                         $ap = "A";
        //                     } else {
        //                         $ap = "B";
        //                     }
                            
        //                 } else {
        //                     $ap = "C";
        //                 }
                        
        //             } else {
        //                 $ap = "D";
        //             }                
        //         } else {
        //             $ap = "E";
        //         }
        //     } else {
        //         $ap = "X";
        //     }

        // } else {
        //     $ap = "NON";
        // }

        // if ($ncnv) {
        //     $cap = "DETTES";
        // } else {
        //     $cap = "CAP";
        // }
        // $styleArray = [
        //         'borders' => [
        //             'outline' => [
        //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        //         ],
        //     ],
        // ];
        // $worksheet->getStyle('W' . $L)->applyFromArray($styleArray);
        // $worksheet->getStyle('X' . $L)->applyFromArray($styleArray);   
        // $worksheet->getCell('X' . $L)->setValue($den); 
        // $worksheet->getStyle('Y' . $L)->applyFromArray($styleArray);  
        // $worksheet->getCell('Y' . $L)->setValue($num['OBT']);
        // $worksheet->getStyle('Z' . $L)->applyFromArray($styleArray);  
        // $worksheet->getCell('Z' . $L)->setValue($pourcentage);
        // $worksheet->getStyle('AA' . $L)->applyFromArray($styleArray);  
        // $worksheet->getCell('AA' . $L)->setValue($ncv);
        // $worksheet->getStyle('AB' . $L)->applyFromArray($styleArray);  
        // $worksheet->getCell('AB' . $L)->setValue($ncnv);
        // $worksheet->getStyle('AC' . $L)->applyFromArray($styleArray);  
        // $worksheet->getCell('AC' . $L)->setValue($ap);
        // $worksheet->getStyle('AD' . $L)->applyFromArray($styleArray);  
        // $worksheet->getCell('AD' . $L)->setValue($cap);
         
        // $max = array();
        // $moyTot = array();
        $L++;
    }
    
    if ($niveauOfPromotion['orientation']) {
        header('Content-Disposition: attachment;filename="'.$niveauOfPromotion['niveau'] .'_'. $niveauOfPromotion['section'] .'_'. $niveauOfPromotion['orientation'] . '_' . time() . '.xlsx"');
    } else {
        header('Content-Disposition: attachment;filename="'.$niveauOfPromotion['niveau'] .'_'. $niveauOfPromotion['section'] . '_' . time() . '.xlsx"');
    }
    

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');

    exit;
}

function deliberation($student, $promotion){
    //Pourcentage  
    $infosBulletin = getDetailsPromotion($promotion);  
    $maxOfPromotion = getMaxByPromo($promotion);
    $totObtByStudent = getByObtEtudiant($student);
    $dataCours = getMatieresByPromo((int) $_GET['grille']);
    $dataAncienSys = getAllCotesJury($promotion,  $student, $semestre);
    $counterLegers = 0;
    $counterGraves = 0;
    $counterManque = 0;    
    $resultat = 0;
    
    foreach ($dataAncienSys as $key => $value) {
      $tot = $tot + 20*$value['credit'];
      if (!isset($value['tp']) OR !isset($value['td']) OR !isset($value['examen'])) {                
        $counterManque = $counterManque + 1;
      }
      
      if (!empty($value['tp']) AND !empty($value['td']) AND !empty($value['examen'])) {                      
        $resultat = $resultat + ($value['tp'] + $value['td'] + $value['examen'])*$value['credit'];
        $cote = $value['tp'] + $value['td'] + $value['examen'];
        if ($cote < 9) {
          if ($cote < 8) {
            $counterGraves = $counterGraves + 1;
          }else{
            $counterLegers = $counterLegers + 1;
          }
        }        
      }
    }

    $dataCredits = array(
        'ncv' => 0,
        'ncnv' => 0
    );

    foreach ($dataCours as $key => $value) {
        $data = getCoteEtudiant($student, $value['id']);
        if (isset($data['tp']) AND isset($data['td']) AND isset($data['examen'])) {
            if($data['tp'] + $data['td'] + $data['examen'] >= 10.0){
                $dataCredits['ncv'] = $dataCredits['ncv'] + $value['credit'];
            }else {
                $dataCredits['ncnv'] = $dataCredits['ncnv'] + $value['credit'];
            }
        } else {
            $dataCredits['ncnv'] = $dataCredits['ncnv'] + $value['credit'];
        }
        
    }

    if (!$maxOfPromotion['Maximum']) {
        $maxOfPromotion['Maximum'] = 1;
    }

    if ($infosBulletin['lblSysteme'] == "LMD") {

        $pourcentage = round(($totObtByStudent['OBT']/$maxOfPromotion['Maximum'])*100,2);
        if ($pourcentage >=50.0) {
            if ($pourcentage >= 60.0) {
                if ($pourcentage >= 70.0) {
                    if ($pourcentage >= 80.0) {
                        if ($pourcentage >= 90.0) {
                            $ap = "A";
                        } else {
                            $ap = "B";
                        }
                        
                    } else {
                        $ap = "C";
                    }
                    
                } else {
                    $ap = "D";
                }
                
            } else {
                $ap = "E";
            }
            
        } else {
            $ap = "X";
        }

    }else{
        if (!$counterManque) {
            if(!$tot){
                $pourcentageA = "";
            }else{
                $pourcentageA = ((float) $resultat/(float) $tot)*100;
            }
            if (empty($pourcentage)) {
                $ap = "Pas d'info.";
            }else {
                if ($pourcentage < 40.0) {
                    if ($counterManque >0) {
                        $ap = "ANAF";
                    } else {
                        $ap = "NAF";
                    }
                    
                } else {
                    if ($pourcentage < 50.0) {
                        $ap = "A";
                    } else {
                        if ($counterGraves > 0) {
                            $ap = "A";
                        }else{
                            if ($pourcentage <= 100.0 AND $counterManque > 0) {
                                $ap = "AA";
                            }
                            if ($pourcentage >= 50.0 AND $pourcentage <= 69.99) {
                                if ($counterLegers < 1) {
                                    $ap = "S";
                                } else {
                                    if ($counterLegers == 1 AND $pourcentage <= 54.99) {
                                        $ap = "S";
                                    }
                                    if ($counterLegers <= 2 AND $pourcentage >= 55.0 AND $pourcentage <=59.99) {
                                        $ap = "S";
                                    }
                                    if ($counterLegers <= 3 AND $pourcentage >= 60.0 AND $pourcentage <=69.99) {
                                        $ap = "S";
                                    }                     
                                }                    
                            } else {
                                if ($pourcentage <= 100.0) {
                                    if ($pourcentage <= 89.99) {
                                        if ($pourcentage <= 79.99) {
                                            $ap = "D";
                                        }else{
                                            $ap = "GD";
                                        }                        
                                    } else {
                                        $ap = "PGD";
                                    }                        
                                } 
            
                            } 
                        }
                        
                    }            
                }
            }
        } else {
            $pourcentage = "";
            $ap = "AA";
        }

    }
    

    //Lien vue - controleur
    require "vue/pages/deliberation.php";
}

function promotion(){

    $_SESSION['promotion'] = (int) $_GET['promotion'];

    //Données ECS
    $dataEC = getMatieresByPromo((int) $_GET['promotion']);  

    //Données UE
    $dataUE = getUEsByPromo((int) $_GET['promotion']);

    //Lien vue - controleur
    require "vue/pages/promotion.php";
}

function finance(){
    $dataSection = getPromotionsList($_SESSION['infoSection']);
    $currentSection = getCurrentSection($_SESSION['infoSection']);
    $listStudentRCurrentSection = getAllStudenRtCurrentSection($_SESSION['infoSection'], (int) $_GET['col']);
    $listStudentICurrentSection = getAllStudenItCurrentSection($_SESSION['infoSection'], (int) $_GET['col']);
    //Lien vue - controleur
    require "vue/pages/comger.php";
}
//Page d'erreur
function erreur($msgErreur){
	//Lien vue - controleur
	require "vue/pages/erreur.php";
}

function newUE(){
    $msg = 'Veuillez completer tous les champs...'; 
    $data = getPromotionsList($_SESSION['id']);

	//Lien vue - controleur
	require "vue/pages/add_unite.php";
}

function addCours(){
    
    $msg = "";

    $_SESSION['promotion'] = (int) $_GET['class'];
    //Données enseignants
    $dataEnseignant = getEnseignantSectionList();

    //Données UE
    $dataUE = getUEs($_SESSION['id'], (int) $_GET['class']);
    
    if(isset($_POST['addCours'])){
        if (isset($_POST['cours-titulaire']) AND !empty($_POST['cours-titulaire']) AND isset($_POST['cours-intitule']) AND !empty($_POST['cours-intitule']) AND isset($_POST['cours-code']) AND !empty($_POST['cours-code']) AND isset($_POST['cours-credit']) AND !empty($_POST['cours-credit']) AND isset($_POST['cours-semestre']) AND !empty($_POST['cours-semestre']) AND isset($_POST['cours-unite']) AND !empty($_POST['cours-unite'])) {
            $data = array(
                "intitule" => $_POST['cours-intitule'],
                "code" => $_POST['cours-code'],
                "credit" => $_POST['cours-credit'],
                "semestre" => $_POST['cours-semestre'],
                "unite" => $_POST['cours-unite'],
                "titulaire" => $_POST['cours-titulaire']
            );
            if(addECS($data)){
                $msg = "Le cours a bien été ajouté...";
                header("location:index.php?promotion=" . $_GET['class']);
            } else {
                $msg = "Un problème est survu lors de l'ajout du cours...";
            }
        } else {
            $msg = "Veuillez remplir tous les champs svp...";
        }        
    }

    //Lien vue - conroleur
    require "vue/pages/add_cours.php";
}

function updateEC($id){
    
    $msg = "Changer les information du formulaire pour faire la mise à jour";
    //Données enseignants
    $dataEnseignant = getEnseignantSectionList();

    //Données UE
    $dataUE = getUEs($_SESSION['id'], $_SESSION['promotion']);

    //Données EC
    $dataEC = getMatieresByMatiere((int) $_GET['editCours']);
    
    $dataDescription = array(
        'promotion' => getPromotionByMatiere((int) $_GET['editCours']),
        'effectif' => getEffByPromo(getPromotionByMatiere((int) $_GET['editCours'])['promo'])['participant'],
        'echecs' => getEchecsByMatiere((int) $_GET['editCours'], 5.0),
        'reussites' => getReussitesByMatiere((int) $_GET['editCours']),
        'stat_1' => getEchecsByMatiere((int) $_GET['editCours'], 2.5),
        'stat_2' => getEchecsByMatiere((int) $_GET['editCours'], 7.5)
    );

    if(isset($_POST['updateCours'])){
        $data = array();

        $data = array(
            "intitule" => $_POST['cours-intitule'],
            "code" => $_POST['cours-code'],
            "credit" => $_POST['cours-credit'],
            "semestre" => $_POST['cours-semestre'],
            "id_unite" => $_POST['cours-unite'],
            "id_titulaire" => $_POST['cours-titulaire'],
            "statut" => $_POST['cours-statut'],
            "id" => $_POST['id']
        );
        
        if(updateECS($data)){
             header("location:index.php?promotion=" . $_SESSION['promotion']);
        } else {
             $msg = "Un problème est survu lors de l'ajout du cours...";
        }       
    }

    //Lien vue - controleur
    require "vue/pages/edit_cours.php";
}

function updateEtudiant($id){
    $infoStudent = getAllInfosOfStudent($id);
    $infoAnee = getAnneAcadByStudent($infoStudent['id_promotion']);
    $infoPromotion = getDetailsPromotion($infoStudent['id_promotion']);
    $infoAJAC = getListAjacOfStudent($infoStudent['num_releve']);

    if ($infoPromotion['intitule'] == 'PREPO-A' OR $infoPromotion['intitule'] == 'PREPO-B' OR $infoPromotion['intitule'] == 'PREPO-C' OR $infoPromotion['intitule'] == 'L1') {
        $frais_acad = (float) 318*2300.0;
    } elseif ($infoPromotion['intitule'] == 'L2' OR $infoPromotion['intitule'] == 'G3') {
        $frais_acad = (float) 317*2300.0;
    } else {
        $frais_acad = (float) 340*2300.0;
    }

    $listPromotion =  getPromotionsList($_SESSION['id']);
    $listECsAJAC = getECsBySection($_SESSION['id']);

    $countAjac = 0;

    foreach ($infoAJAC as $key => $value) {
        $countAjac++;
    }
    
    $dataCotesOfStudent = getAllCotesJury($infoStudent['id_promotion'],  $infoStudent['num_releve']);
    
    $metriqueCurrentPromo = array(
        'ncv' => 0,
        'ncnv' => 0,
        'legers' => 0,
        'graves' => 0
    );

    foreach ($dataCotesOfStudent as $key => $value) {
       
        if (isset($dataCotesOfStudent['tp'])) {
            $moyTP = $dataCotesOfStudent['tp'];
        } else {
            $moyTP = 0;
        }
       
        if (isset($dataCotesOfStudent['td'])) {
            $moyTD = $dataCotesOfStudent['td'];
        } else {
            $moyTD = 0;
        }
       
        if (isset($dataCotesOfStudent['examen'])) {
            $examen = $dataCotesOfStudent['examen'];
        } else {
            $examen = 0;
        }
        
        if ($infoPromotion['systeme'] == 'LMD') {
            if ($moyTD + $moyTP + $examen < 10.00) {
                $metriqueCurrentPromo['ncnv'] += $dataCotesOfStudent['credit'];

            } else {
                $metriqueCurrentPromo['ncv'] += $dataCotesOfStudent['credit'];
            }
            
        } else {
            if ($moyTD + $moyTP + $examen < 8.00) {
                $metriqueCurrentPromo['graves'] += 1;

            } else {
                if ($moyTD + $moyTP + $examen < 10.00) {
                    $metriqueCurrentPromo['legers'] += 1;
                }
            }
        }
    }

    $dataAjacsOfStudent = getAllCotesAjac($infoStudent['num_releve']);

    //Lien vue - conroleur
    require "vue/pages/edit_etudiant.php";
}

function etatFiche($matiere){
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    
    $dataCours = getMatieresByMatiere($matiere);
    $niveauOfPromotion = infoPromotion($_SESSION['promotion']);
    $dataStudents = getStudentsByPromo($_SESSION['promotion']);
    
    if($niveauOfPromotion['systeme'] = 'LMD'){
        $infoGrille = array(
            'promotion' => 'PROMOTION : ' . $niveauOfPromotion['niveau'] . ' ' . $niveauOfPromotion['section'],
            'matiere' => 'EC : ' . $dataCours['intitule'] . ' (Credit : '. $dataCours['credit'] .')',
            'ue' => 'UE : ' . $dataCours['designation'],
            'semestre' => 'SEMESTRE : ' . $dataCours['semestre'],
            'titulaire' => 'TITULAIRE : ' . $dataCours['grade'] . ' ' . $dataCours['nom'] . ' ' . $dataCours['post_nom'],
            'date' => 'IMPRIME LE : ' . date("d/m/Y à H:i:s")
        );

    }else{

        $infoGrille = array(
            'promotion' => 'PROMOTION : ' . $niveauOfPromotion['niveau'] . ' ' . $niveauOfPromotion['section'],
            'matiere' => 'MATIERE : ' . $dataCours['intitule'] . ' (PONDERATION : '. $dataCours['credit'] .')',
            'ue' => 'GROUPE : ' . $dataCours['designation'],
            'semestre' => 'SEMESTRE : ' . $dataCours['semestre'],
            'titulaire' => 'TITULAIRE : ' . $dataCours['grade'] . ' ' . $dataCours['nom'] . ' ' . $dataCours['post_nom'],
            'date' => 'IMPRIME LE : ' . date("d/m/Y à H:i:s")
        );

    }  
        
    // //OUVERTURE TEMPLATE
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('vue/gabarit/assets/templateFiche.xlsx');
    $worksheet = $spreadsheet->getActiveSheet(); 
                   
    //DESCRIPTION FICHE
    $worksheet->getCell('A7')->setValue($infoGrille['promotion']);
    $worksheet->getCell('A8')->setValue($infoGrille['matiere']);
    $worksheet->getCell('A9')->setValue($infoGrille['ue']);
    $worksheet->getCell('A10')->setValue($infoGrille['semestre']);
    $worksheet->getCell('A11')->setValue($infoGrille['titulaire']);
    $worksheet->getCell('A12')->setValue($infoGrille['date']);    
    $worksheet->getCell('J14')->setValue($dataCours['credit']*20);

    //LISTE DES COTES         
    $L = 15;
    
    foreach ($dataStudents as $key => $value) {   
        $tot = null;
        $totA = null;
        $totP = null;
        $totS1 =null;   
        //IDENTITES ETUDIANT
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        $worksheet->getStyle('A' . $L)->applyFromArray($styleArray);    
        $worksheet->getCell('A' . $L)->setValue($key+1);
        $worksheet->getStyle('B' . $L)->applyFromArray($styleArray); 
        $worksheet->getCell('B' . $L)->setValue($value['nom']);
        $worksheet->getStyle('C' . $L)->applyFromArray($styleArray); 
        $worksheet->getCell('C' . $L)->setValue($value['post_nom']);
    
        //LIGNE ETUDIANT
        $data = getCoteEtudiant($value['id'], $matiere);

        if(isset($data['tp'])){
            $tp = (float) $data['tp'];
            
            //CELLLE TP
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('D' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('D' . $L)->setValue($tp); 
        }else{
            $tp = 0;
            
            //CELLLE TP
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('D' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('D' . $L)->setValue(''); 
        }

        if(isset($data['td'])){
            $td = (float) $data['td'];
            
            //CELLLE TD
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('E' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('E' . $L)->setValue($td); 
            
            //CELLLE TOTAL ANNUEL
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('F' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('F' . $L)->setValue($totA = ($tp) ? $tp+$td : ''); 
        }else{
            $td = 0;
            
            //CELLLE TD
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('E' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('E' . $L)->setValue(''); 
            
            //CELLLE TOTAL ANNUEL
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('F' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('F' . $L)->setValue(''); 
        }

        if(isset($data['examen'])){
            $examen =(float) $data['examen'];
            
            //CELLLE EXAMEN
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('G' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('G' . $L)->setValue($examen);             
            
            //CELLLE TOTAL S1
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('H' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('H' . $L)->setValue($totS1 = (isset($totA)) ? $totA+$examen : ''); 
        }else{
            $examen = 0;
            
            //CELLLE EXAMEN
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('G' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('G' . $L)->setValue('');        
            
            //CELLLE TOTAL S1
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('H' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('H' . $L)->setValue('');  
        }

        if(isset($data['ratrapage'])){
            $ratrapage =(float) $data['ratrapage'];
            
            //CELLLE RATTRAPAGE
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('I' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('I' . $L)->setValue($ratrapage);   
            
            //CELLLE TOTAL S1
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('J' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('J' . $L)->setValue($totP = (isset($ratrapage)) ? $dataCours['credit']*$ratrapage : '');  
        }else{
            $ratrapage = 0;
            
            //CELLLE RATTRAPAGE
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('I' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('I' . $L)->setValue('');   
            
            //CELLLE TOTAL S1
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
            $worksheet->getStyle('J' . $L)->applyFromArray($styleArray);  
            
            $worksheet->getCell('J' . $L)->setValue($totP = (isset($totS1)) ? $dataCours['credit']*$totS1 : '');  
        }

        //PROCHAIN ETUDIAN
        $L++;


    } 
    
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('fiche.xlsx');
    
    //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="FICHE_'.$niveauOfPromotion['niveau'].'_'.$niveauOfPromotion['section'].'.xlsx"');  

    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
    
}

function etudiants($promotion){
    $listPromotion =  getPromotionsList($_SESSION['id']);
    
    $listEtudiant = getStudentsByPromo($promotion);
    
	//Lien vue - controleur
	require "vue/pages/etudiants.php";
}

function suppUe($id){
    if($data = deleteUE($id)){
        header("Location:".$_SERVER['HTTP_REFERER']);
    }else {
        erreur("Un problème est survenu lors de la suppresion de l'Unité d'enseignement");
    }

}

function gestionJury(){

    $listJury = getListJury();
    $data = getAllEnseignant();    
    $listePromotions = getAllPromotions();
    
	//Lien vue - controleur
	require "vue/pages/gestion_jury.php";

}

function gestionTitulaire($promotion){

    $listTitulaire = getEnseignantSection($promotion);
    
	//Lien vue - controleur
	require "vue/pages/gestion_titulaires.php";

}

function financeEtudiant(){
    
	//Lien vue - controleur
	require "vue/pages/finance-etudiant.php";

}

function setProfileAdmin($id){
    //Liste des operateurs
    $liste_operateurs = getAllOperateurs();
    
    //Liste des agents
    $list_agents = getAllEnseignant();

    //Liste des promotions
    $list_classes = getAllClasse();

    //Liste des rubriques
    $liste_rubriques = getAllRubriques();
    
	//Lien vue - controleur
	require "vue/pages/profile-admin.php";

}