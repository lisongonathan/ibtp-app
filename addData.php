<?PHP
require "modele/modele.php";

function read($csv){
    $file = fopen($csv, 'r');
    while (!feof($file) ) {
        $line[] = fgetcsv($file, 1024);
    }
    fclose($file);
    return $line;
}

// Définir le chemin d'accès au fichier CSV
// $csv = 'modele/PREPO.csv';

// $csv = read($csv);
$countItems = 0;

// foreach ($csv as $key => $value) {
//     echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Sexe : " . $value[3] . " Date : ".$value[6]." Nationalité : " . $value[4] . " Origine : " . $value[5] . " Matricule : " . $value[7] . " Promotion : " . $value[8] . "<br/>";
//     $date = explode("/",$value['6']);

//     $data = array(
//         'nom' => $value[0], 
//         'post_nom' => $value[1],
//         'prenom' => $value[2],
//         'code_access' => $value[7], 
//         'sexe' => $value[3], 
//         'promotion' => $value[8],
//         'nationalite' => $value[4],
//         'lieu_naiss' => $value[5],
//         'date_naiss' => $date[2].'-'.$date[1].'-'.$date[0]
//     );
//     $countItems++;

//     addStud($data);
//     echo 'LIGNE N° : '. $countItems .'<br/>';
// }
// $csv = 'modele/ARCHI.csv';

// $csv = read($csv);

// foreach ($csv as $key => $value) {
//     echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Sexe : " . $value[3] . " Date : ".$value[6]." Nationalité : " . $value[4] . " Origine : " . $value[5] . " Matricule : " . $value[7] . " Promotion : " . $value[8] . "<br/>";
//     $date = explode("/",$value['6']);

//     $data = array(
//         'nom' => $value[0], 
//         'post_nom' => $value[1],
//         'prenom' => $value[2],
//         'code_access' => $value[7], 
//         'sexe' => $value[3], 
//         'promotion' => $value[8],
//         'nationalite' => $value[4],
//         'lieu_naiss' => $value[5],
//         'date_naiss' => $date[2].'-'.$date[1].'-'.$date[0]
//     );
//     $countItems++;

//     addStud($data);
//     echo 'LIGNE N° : '. $countItems .'<br/>';
// }
// $csv = 'modele/BTP.csv';

// $csv = read($csv);

// foreach ($csv as $key => $value) {
//     echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Sexe : " . $value[3] . " Date : ".$value[6]." Nationalité : " . $value[4] . " Origine : " . $value[5] . " Matricule : " . $value[7] . " Promotion : " . $value[8] . "<br/>";
//     $date = explode("/",$value['6']);

//     $data = array(
//         'nom' => $value[0], 
//         'post_nom' => $value[1],
//         'prenom' => $value[2],
//         'code_access' => $value[7], 
//         'sexe' => $value[3], 
//         'promotion' => $value[8],
//         'nationalite' => $value[4],
//         'lieu_naiss' => $value[5],
//         'date_naiss' => $date[2].'-'.$date[1].'-'.$date[0]
//     );
//     $countItems++;

//     addStud($data);
//     echo 'LIGNE N° : '. $countItems .'<br/>';
// }
// $csv = 'modele/GT.csv';

// $csv = read($csv);

// foreach ($csv as $key => $value) {
//     echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Sexe : " . $value[3] . " Date : ".$value[6]." Nationalité : " . $value[4] . " Origine : " . $value[5] . " Matricule : " . $value[7] . " Promotion : " . $value[8] . "<br/>";
//     $date = explode("/",$value['6']);

//     $data = array(
//         'nom' => $value[0], 
//         'post_nom' => $value[1],
//         'prenom' => $value[2],
//         'code_access' => $value[7], 
//         'sexe' => $value[3], 
//         'promotion' => $value[8],
//         'nationalite' => $value[4],
//         'lieu_naiss' => $value[5],
//         'date_naiss' => $date[2].'-'.$date[1].'-'.$date[0]
//     );
//     $countItems++;

//     addStud($data);
//     echo 'LIGNE N° : '. $countItems .'<br/>';
// }


// $csv = 'modele/ENSEIGNANTS.csv';

// $csv = read($csv);

// foreach ($csv as $key => $value) {
//     //echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Grade : ".$value[6]." Statut : " . $value[4] . "<br/>";
//     $maxVal = $countItems + 5;
//     $temp = (float) (rand($countItems, $maxVal) * rand(89, 99))/100;

//     $data = array(
//         'nom' => $value[1], 
//         'post_nom' => $value[2],
//         'prenom' => $value[3],
//         'code_access' => '2023-' . $temp, 
//         'sexe' => 'M', 
//         'statut' => $value[4],
//         'grade' => $value[0]
//     );
//     $countItems++;

//     addEnseignant($data);
//     echo '<pre>';
//     print_r($data);
//     echo '</pre>';
// }

// $csv = 'modele/ue_ibtp - PREPO.csv';

// $csv = read($csv);

// foreach ($csv as $key => $value) {
//     //echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Grade : ".$value[6]." Statut : " . $value[4] . "<br/>";
//     //$maxVal = $countItems + 5;
//     //$temp = (float) (rand($countItems, $maxVal) * rand(89, 99))/100;

//     $data = array(
//         'PROMOTION' => $value[0], 
//         'UE' => $value[1],
//         'CODE' => $value[2],
//         'ID_PROMO' => $value[3]
//     );
//     $countItems++;

//     $statut = addUE($data['ID_PROMO'], $data['UE'], $data['CODE']);
//     echo '<pre>';
//     print_r($data);
//     echo '</pre>';
//     echo $statut;
//     echo $countItems;
// }

// $csv = 'modele/ue_ibtp - G3.csv';

// $csv = read($csv);

// foreach ($csv as $key => $value) {
//     //echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Grade : ".$value[6]." Statut : " . $value[4] . "<br/>";
//     //$maxVal = $countItems + 5;
//     //$temp = (float) (rand($countItems, $maxVal) * rand(89, 99))/100;

//     $data = array(
//         'PROMOTION' => $value[0], 
//         'UE' => $value[1],
//         'CODE' => $value[2],
//         'ID_PROMO' => $value[3]
//     );
//     $countItems++;

//     $statut = addUE($data['ID_PROMO'], $data['UE'], $data['CODE']);
//     echo '<pre>';
//     print_r($data);
//     echo '</pre>';
//     echo $statut;
//     echo $countItems;
// }

// $csv = 'modele/ue_ibtp - E1.csv';

// $csv = read($csv);

// foreach ($csv as $key => $value) {
//     //echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Grade : ".$value[6]." Statut : " . $value[4] . "<br/>";
//     //$maxVal = $countItems + 5;
//     //$temp = (float) (rand($countItems, $maxVal) * rand(89, 99))/100;

//     $data = array(
//         'PROMOTION' => $value[0], 
//         'UE' => $value[1],
//         'CODE' => $value[2],
//         'ID_PROMO' => $value[3]
//     );
//     $countItems++;

//     $statut = addUE($data['ID_PROMO'], $data['UE'], $data['CODE']);
//     echo '<pre>';
//     print_r($data);
//     echo '</pre>';
//     echo $statut;
//     echo $countItems;
// }

// $csv = 'modele/ue_ibtp - E2.csv';

// $csv = read($csv);

// foreach ($csv as $key => $value) {
//     //echo "Nom : " . $value[0] . " Post Nom : " . $value[1] . " Grade : ".$value[6]." Statut : " . $value[4] . "<br/>";
//     //$maxVal = $countItems + 5;
//     //$temp = (float) (rand($countItems, $maxVal) * rand(89, 99))/100;

//     $data = array(
//         'PROMOTION' => $value[0], 
//         'UE' => $value[1],
//         'CODE' => $value[2],
//         'ID_PROMO' => $value[3]
//     );
//     $countItems++;

//     $statut = addUE($data['ID_PROMO'], $data['UE'], $data['CODE']);
//     echo '<pre>';
//     print_r($data);
//     echo '</pre>';
//     echo $statut;
//     echo $countItems;
// }
// ?>