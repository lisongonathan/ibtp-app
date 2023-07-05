<?PHP
// require "modele/modele.php";

// /* RECUERATION DE TOUS LES ETUDIANT */
// $listEtudiant = getAllStudents();

// /* FIN RECUPERATION ETUDIANTS */

// foreach ($listEtudiant as $key => $value) {
//     $annee = getCurrentAnneeByStudent($value['id'])['id_annee'];

//     $data = array(
//         'numero' => $value['id'] .'/'. $value['id_promotion'] .'/'. $value['code_access'] .'/'. $key + 1,
//         'annee' => $annee,
//         'etudiant' => $value['id']
//     );

//     print_r($data);

//     echo setReleve($data);
// }

