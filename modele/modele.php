<?php

/* -- API-BASE DE DONNEES -- */
function getBdd(){
	//Instancie l'objet PDO associé
	$bdd = new PDO(
			'mysql:host=mysql-ibtp-matadi.alwaysdata.net;dbname=ibtp-matadi_data',
			'315933',
			'mot2p@sse'
		);

	//renvoie de l'objet PDO associé
	return $bdd;
}

/* 
	-- SQL-CONNEXION -- 
*/

//ID ETUDIANTS
function getAllPromotions(){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT promotion.id, niveau.intitule, section.designation, promotion.orientation FROM promotion
	INNER JOIN niveau ON promotion.id_niveau = niveau.id
	INNER JOIN section ON promotion.id_section = section.id
	");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getAllEnseignant(){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT enseignant.id, enseignant.nom, enseignant.post_nom, enseignant.code_access
	FROM enseignant");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

//AFFECTATION CODE D'ACCEES
function getAllStudents(){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT etudiant.nom, etudiant.post_nom, etudiant.code_access, etudiant.id, etudiant.id_promotion
						FROM etudiant
	");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getStudentsByPromo($id){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT etudiant.*, releve.id AS num_releve
						FROM etudiant
						INNER JOIN releve
						ON etudiant.id = releve.id_etudiant
						WHERE etudiant.id_promotion = ?
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getStudentsBySection($id){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT etudiant.* 
	FROM etudiant
	INNER JOIN promotion ON promotion.id = etudiant.id_promotion
	WHERE promotion.id_section= ?
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getStudentByRubrique($id){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT etudiant.*, niveau.intitule, section.designation 
							FROM rubrique 
							INNER JOIN niveau ON niveau.id = rubrique.id_niveau 
							INNER JOIN promotion ON promotion.id_niveau = niveau.id 
							INNER JOIN etudiant ON etudiant.id_promotion = promotion.id 
							INNER JOIN section ON section.id = promotion.id_section 
							WHERE rubrique.id = ?
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getSoldeOfEtudiant($id, $rubrique){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT paiement.id AS 'ID', paiement.id_etudiant AS 'ETUDIANT', SUM(paiement.montant) AS TOTAL, finance.montant - SUM(paiement.montant) AS RESTE
							FROM paiement
							INNER JOIN rubrique ON rubrique.id = paiement.id_rubrique
							INNER JOIN finance ON finance.id = rubrique.id_finance
							WHERE paiement.id_etudiant = ? AND paiement.id_rubrique = ?
							GROUP BY paiement.id_etudiant");

	//Data utilisateur
	$req -> execute(array($id, $rubrique));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}


//0.Inscription
function getEnseignantSignin($tel){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT id
		FROM enseignant
		WHERE telephone = ?
	");

	//Data utilisateur
	$req -> execute(array($tel));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);
	$retVal = (isset($data['id'])) ? TRUE : FALSE ;

	return $retVal;

}

//0.Inscription
function getEnseignantInfos($id){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT *
		FROM enseignant
		WHERE id = ?
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	return $data;

}


function getEtudiantSignin($tel){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT id
		FROM etudiant
		WHERE telephone = ?
	");

	//Data utilisateur
	$req -> execute(array($tel));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);
	$retVal = (isset($data['id'])) ? TRUE : FALSE ;

	return 	$retVal;

}
function getStatutEtudiant($id){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT statut, frais_academique, enrol_1, enrol_2
		FROM etudiant
		WHERE id = ?
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	return 	$data;

}

function addUserAdministratif($infos){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT administratif.mdp AS existance, administratif.id AS userAdmin
		FROM administratif
		INNER JOIN enseignant ON enseignant.id = administratif.id_agent
		WHERE code_access = ?
	");

	//Data utilisateur
	$req -> execute(array($infos['code_access']));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	if (isset($data['existance'])) {
		return false;
	} else {

		//Enregistrement mot de passe utilisateur
		$req = $bdd -> prepare("UPDATE administratif SET mdp = ? WHERE id = ?");

		//Data utilisateur
		$req -> execute(array(sha1($infos['mdp']), $data['userAdmin']));
		
		$req = $bdd -> prepare("SELECT administratif.mdp AS existance
								FROM administratif
								INNER JOIN enseignant ON enseignant.id = administratif.id_agent
								WHERE code_access = ?
								");

		//Data utilisateur
		$req -> execute(array($infos['code_access']));
   
		$data = $req -> fetch(PDO::FETCH_ASSOC);

		return ($req -> rowCount() > 0) ? "Votre compte a bien été créer..." :  "Un problème est survenu lors de la création du compte...";
	}

}

function signinEnseignant($id, $mdp, $addr, $tel){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT mdp
		FROM enseignant
		WHERE id = ?
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	if (isset($data['mdp'])) {
		return false;
	} else {

		//Enregistrement mot de passe utilisateur
		$req = $bdd -> prepare("UPDATE enseignant SET enseignant.mdp = ?, enseignant.telephone = ?, enseignant.adresse = ? WHERE id = ?");

		//Data utilisateur
		$req -> execute(array($mdp, $tel, $addr, $id));

		return true;
	}
}

function addJury($resp){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés dans la table JURY
	$req = $bdd -> prepare("SELECT id
		FROM jury
		WHERE id_president = ? OR id_secretaire = ?
	");

	//Data utilisateur
	$req -> execute(array($resp['id_president'], $resp['id_secretaire']));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	if (isset($data['id'])) {
		return false;
	} else {

		//Enregistrement mot de passe utilisateur
		$req = $bdd -> prepare("INSERT INTO jury(designation, id_president, mdp, statut, id_secretaire)
								VALUES (?,?,?,?,?)");

		//Data utilisateur
		$req -> execute(array($resp['designation'], $resp['id_president'], $resp['mdp'], $resp['statut'], $resp['id_secretaire']));

		if ($req) {
			$req = $bdd -> prepare("SELECT id
				FROM jury
				WHERE id_president = ? OR id_secretaire = ?
			");
		
			//Data utilisateur
			$req -> execute(array($resp['id_president'], $resp['id_secretaire']));
		
			//Data BD
			$data = $req -> fetch(PDO::FETCH_ASSOC);

			foreach ($resp['promotion'] as $key => $value) {

				//Enregistrement mot de passe utilisateur
				$req = $bdd -> prepare("UPDATE promotion SET promotion.id_jury = ? WHERE id = ?");
		
				//Data utilisateur
				$req -> execute(array($data['id'], $value));
			}
		
			return "Le bureau du JURY " . $resp['designation'] . " a bien été ajouter...";
		} else {
			return "Un problème est survenue pendant la soummision du formulaire";
		}
		
	}
}

function checkJury($id){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT statut
	FROM jury
	WHERE id=?
	");

	//Data utilisateur
	$req -> execute(array($id));
	
	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	return 	$data['statut'];

}

function checkTitulaire($id){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT statut
	FROM enseignant
	WHERE id=?
	");

	//Data utilisateur
	$req -> execute(array($id));
	
	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	return 	$data['statut'];

}

function updateStatutJury($id, $statut){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("UPDATE jury SET jury.statut = ? WHERE id = ?
	");

	//Data utilisateur
	$req -> execute(array($statut, $id));
	
	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	return 	true;

}

function signinEtudiant($id, $mdp, $addr, $tel){
	//Connexion BD
	$bdd = getBdd();	
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT mdp
		FROM etudiant
		WHERE id = ?
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	

	if (isset($data['mdp'])) {
		return false;
	} else {
		//Enregistrement mot de passe utilisateur
		$req = $bdd -> prepare("UPDATE etudiant SET etudiant.mdp = ?, etudiant.telephone=?, etudiant.adresse=? WHERE id = ?");
	
		//Data utilisateur
		$req -> execute(array($mdp, $tel, $addr, $id));		
	
		return true;
	}
}

function signinAdmin($matricule, $mdp){
	//Connexion BD
	$bdd = getBdd();
	
	//Verification code d'accés
	$req = $bdd -> prepare("SELECT id
		FROM administration
		WHERE matricule = ?
	");

	//Data utilisateur
	$req -> execute(array($matricule));

	//Data BD
	$data = $req -> fetch(PDO::FETCH_ASSOC);

	if ($data['id']) {

		//Enregistrement mot de passe utilisateur
		$req = $bdd -> prepare("UPDATE administration SET administration.mdp = ? WHERE id = ?");

		//Data utilisateur
		$req -> execute(array($mdp, $data['id']));

		return true;

	} else {
		return false;
	}
}

//1. Authentification
function authEnseignant($data, $mdp){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT *
		FROM enseignant
		WHERE code_access = ? AND mdp=?
	");

	//Data utilisateur
	$req -> execute(array($data, $mdp));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function authJury($data, $mdp){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT jury.id, jury.designation, jury.mdp, jury.id_sec, jury.statut
		FROM enseignant
        INNER JOIN jury
        ON enseignant.id = jury.id_sec
		WHERE jury.mdp = ? AND matricule=?
	");

	//Data utilisateur
	$req -> execute(array($mdp, $data));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}


function authSection($data, $mdp){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT section.id, section.designation, section.logo, section.description, section.id_chef, enseignant.nom, enseignant.post_nom, enseignant.prenom, enseignant.sexe, enseignant.grade
		FROM enseignant
        INNER JOIN section
        ON enseignant.id = section.id_sec
		WHERE code_access = ? AND pass=?
	");

	//Data utilisateur
	$req -> execute(array($data, $mdp));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function authComger($code_access, $mdp, $grade){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT enseignant.*, administratif.id AS coges, administratif.grade AS preseance, administratif.login
							FROM administratif
							INNER JOIN enseignant ON enseignant.id = administratif.id_agent
							WHERE login = ? AND administratif.mdp = ? AND administratif.grade = ?
	");

	//Data utilisateur
	$req -> execute(array($code_access, $mdp, $grade));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function authOperateur($code_access, $mdp){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT enseignant.telephone, enseignant.adresse, enseignant.nom, enseignant.post_nom, enseignant.prenom, enseignant.sexe, enseignant.code_access, operateur.id, operateur.grade AS 'operateur', operateur.id_agent AS login
							FROM operateur
							INNER JOIN enseignant ON enseignant.id = operateur.id_agent
							WHERE enseignant.code_access = ? AND operateur.mdp = ?
	");

	//Data utilisateur
	$req -> execute(array($code_access, $mdp));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function authEtudiant($data, $mdp){
	//Connexion BD
	$bdd = getBdd();

	//Authentification
	$req = $bdd -> prepare("SELECT *
		FROM etudiant
		WHERE code_access = ? AND mdp=?
	");

	//Data utilisateur
	$req -> execute(array($data, $mdp));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

//2. Dashboard Section
function getEffectifSection($section){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(*) AS effectif
                    FROM (SELECT promotion.id_section
                        FROM etudiant
                        INNER JOIN promotion
                        ON etudiant.id_promotion = promotion.id ) AS listEtudiant
                    INNER JOIN section
                    ON section.id = listEtudiant.id_section
                    WHERE listEtudiant.id_section = ?
    ");
    
	//Data utilisateur
	$req -> execute(array($section));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getEnseignantSection($promotion){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT enseignant.*
							FROM enseignant
							iNNER JOIN matiere ON matiere.id_titulaire = enseignant.id
							INNER JOIN unite ON unite.id = matiere.id_unite
							WHERE unite.id_promotion = ?
							GROUP BY enseignant.id
	");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getECS(){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT *
	FROM matiere");
    
	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getECsBySection($section){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT dMatieres.cours, dMatieres.code, dMatieres.designation, dMatieres.credit
							FROM (SELECT matiere.id AS cours, matiere.designation, matiere.credit, unite.code, unite.id_promotion
								FROM unite
								INNER JOIN matiere ON matiere.id_unite = unite.id) AS dMatieres
							INNER JOIN promotion ON dMatieres.id_promotion = promotion.id
							WHERE promotion.id_section=?
    ");
    
	//Data utilisateur
	$req -> execute(array($section));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getChefSection($section){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT nom, post_nom, prenom, grade
                            FROM enseignant
                            INNER JOIN section
                            ON enseignant.id = section.id_chef
                            WHERE section.id = ?
    ");
    
	//Data utilisateur
	$req -> execute(array($section));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getPromoSection($section){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(*) AS total
                            FROM promotion
                            INNER JOIN section
                            ON promotion.id_section = section.id
                            WHERE section.id = ?
    ");
    
	//Data utilisateur
	$req -> execute(array($section));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getEffectifM($section){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(*) AS total
	FROM (SELECT etudiant.id
		  FROM etudiant
		  INNER JOIN promotion ON etudiant.id_promotion = promotion.id
		  WHERE promotion.id_section = ? AND sexe='M') AS list
    ");
    
	//Data utilisateur
	$req -> execute(array($section));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getEffectifF($section){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(*) AS total
	FROM (SELECT etudiant.id
		  FROM etudiant
		  INNER JOIN promotion ON etudiant.id_promotion = promotion.id
		  WHERE promotion.id_section = ? AND sexe='F') AS list
    ");
    
	//Data utilisateur
	$req -> execute(array($section));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getEnseignantsByJury($jury){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT enseignant.id AS titulaire, enseignant.grade, enseignant.statut, enseignant.nom, enseignant.post_nom, enseignant.telephone
	FROM enseignant
	INNER JOIN matiere ON matiere.id_titulaire = enseignant.id
	INNER JOIN unite ON unite.id = matiere.id_unite
	INNER JOIN promotion ON promotion.id = unite.id_promotion
	WHERE promotion.id_jury = ?");
    
	//Data utilisateur
	$req -> execute(array($jury));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getPromotionsList($section){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT niveau.intitule AS class, promo, orientation, designation
					FROM (
					    SELECT promotion.id AS promo, promotion.id_niveau, promotion.orientation, section.designation
					    FROM promotion
					    INNER JOIN section
					    ON promotion.id_section = section.id
					    WHERE section.id = ?) AS detailClass
					INNER JOIN niveau
					ON detailClass.id_niveau = niveau.id
    ");
    
	//Data utilisateur
	$req -> execute(array($section));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getUEs($session, $promotion){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT unite.id, unite.designation, unite.code
						FROM unite
						INNER JOIN promotion
						ON unite.id_promotion = promotion.id
						WHERE promotion.id_section = ? AND promotion.id = ?
					");

	//Data utilisateur
	$req -> execute(array($session, $promotion));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getUEsByPromo($promotion){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT unite.id, unite.designation, unite.code
						FROM unite
						WHERE unite.id_promotion = ?
					");

	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function addUE($promotion, $designation, $code){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO unite(designation, id_promotion, code) VALUES (?, ?, ?)
					");

	//Data utilisateur
	$req -> execute(array($designation, $promotion, $code));

	//Data BD
	return "Unité d'enseignement ajouté";
}

function addPaiement($data){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Verification paiement
	$req = $bdd -> prepare("SELECT id
							FROM paiement
							WHERE paiement.preuve=?");

	//Data utilisateur
	$req -> execute(array($data['preuve']));

	
	//Data BD
	$resp = $req -> fetch(PDO::FETCH_ASSOC);

	if (isset($resp['id'])) {
		//Data BD
		return "Cette preuve existe déjà";
		
	} else {
		//Effectif Section
		$req = $bdd -> prepare("INSERT INTO paiement(id_etudiant,id_rubrique,montant,preuve) VALUES (?,?,?,?)");
	
		//Data utilisateur
		$req -> execute(array($data['etudiant'], $data['rubrique'], $data['montant'], $data['preuve']));
	
		//Data BD
		return "Paîement ajouté";
	}
	
    
}


function getDetailUES($ue){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT SUM(matiere.credit) AS credits, COUNT(matiere.id) AS ecs
							FROM unite
							INNER JOIN matiere ON unite.id = matiere.id_unite
							WHERE unite.id=?");

	//Data utilisateur
	$req -> execute(array($ue));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}


function geUEbyECsVue($ue){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(matiere.id) AS total
							FROM unite
							INNER JOIN matiere ON unite.id = matiere.id_unite
							WHERE unite.id=? AND matiere.statut='VU'");

	//Data utilisateur
	$req -> execute(array($ue));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function deleteUE($unite){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("DELETE FROM unite WHERE id=?");

	//Data utilisateur
	$req -> execute(array($unite));

	//Data BD
	return "Unité d'enseignement supprimée";
}

function deleteJury($id){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("DELETE FROM jury WHERE id=?");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return true;
}

function deleteStudent($unite){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("DELETE FROM etudiant WHERE id=?");

	//Data utilisateur
	$req -> execute(array($unite));

	//Data BD
	return "L'étudiant a bien été supprimée";
}

function updateUEbyDesignation($unite, $designation){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("UPDATE unite SET designation=? WHERE id=?");

	//Data utilisateur
	$req -> execute(array($designation, $unite));

	//Data BD
	return "Unité d'enseignement modifiée";
}

function updateUEbyCode($unite, $code){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("UPDATE unite SET code=? WHERE id=?");

	//Data utilisateur
	$req -> execute(array($code, $unite));

	//Data BD
	return "Unité d'enseignement modifiée";
}


function getEnseignant($enseignant){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT matiere.id AS cours, matiere.designation, matiere.credit, matiere.semestre, matiere.statut, matiere.code, niveau.intitule AS 'class', section.designation AS 'section', promotion.orientation, promotion.id AS 'promo'
	FROM matiere
	INNER JOIN unite ON unite.id = matiere.id_unite
	INNER JOIN promotion ON promotion.id = unite.id_promotion
	INNER JOIN niveau ON niveau.id = promotion.id_niveau
	INNER JOIN section ON section.id = promotion.id_section
	WHERE matiere.id_titulaire=?");

	//Data utilisateur
	$req -> execute(array($enseignant));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}


function deleteEnseignant($enseignant){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("DELETE FROM enseignant WHERE id=?");

	//Data utilisateur
	$req -> execute(array($enseignant));

	//Data BD
	return "Enseignant supprimé";
}

function addEnseignant($data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO enseignant(nom, post_nom, prenom, sexe, code_access, grade, statut) VALUES (?, ?, ?, ?, ?, ?, ?)");

	//Data utilisateur
	$req -> execute(array($data['nom'], $data['post_nom'], $data['prenom'], $data['sexe'], $data['code_access'], $data['grade'], $data['statut']));

	//Data BD
	return TRUE;
}


function addStud($data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO etudiant(nom, post_nom, prenom, code_access, sexe, id_promotion, nationalite, lieu_naiss, date_naiss, acad_frais, connexe_frais, connexe_frais_s2, dettes, diplome) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	//Data utilisateur
	$req -> execute(array($data['nom'], $data['post_nom'], $data['prenom'], $data['code_access'], $data['sexe'], $data['id_promotion'], $data['nationalite'], $data['lieu_naiss'], $data['date_naiss'], $data['acad_frais'], $data['connexe_frais'], $data['connexe_frais_s2'], $data['dettes'], $data['diplome']));

	//Data BD
	return TRUE;
}

function addECS($data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO matiere(designation, credit, id_unite, code, semestre, id_titulaire) VALUES (?,?,?,?,?,?)");

	//Data utilisateur
	$req -> execute(array($data['intitule'], $data['credit'], $data['unite'], $data['code'], $data['semestre'], $data['titulaire']));

	//Data BD
	return TRUE;
}

function updateECS($data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("UPDATE matiere SET id_titulaire=?, id_unite=?, statut=?, semestre=?, credit=?, code=?, designation=? WHERE id=?");

	//Data utilisateur
	$req -> execute(array($data['id_titulaire'], $data['id_unite'], $data['statut'], $data['semestre'], $data['credit'], $data['code'], $data['intitule'], $data['id']));

	//Data BD
	return TRUE;
}

function getEnseignantSectionList(){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT id, grade, nom, post_nom, code_access
							FROM enseignant
					");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getStudentsTitulaire($titulaire){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT  etudiant.nom, etudiant.post_nom, etudiant.code_access, etudiant.id, etudiant.id_promotion
	FROM matiere
	INNER JOIN enseignant ON enseignant.id = matiere.id_titulaire
	INNER JOIN unite ON unite.id = matiere.id_unite
	INNER JOIN promotion ON promotion.id = unite.id_promotion
	INNER JOIN etudiant ON etudiant.id_promotion = promotion.id
	WHERE enseignant.id=?");

	//Data utilisateur
	$req -> execute(array($titulaire));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getStudentsOfTitulaire($titulaire){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif PROMOTIONS
	$req = $bdd -> prepare("SELECT COUNT(etudiant.id) AS Effectif, dPromo.intitule, dPromo.designation
	FROM (SELECT promotion.id, niveau.intitule, section.designation
		 FROM unite
		 INNER JOIN promotion ON unite.id_promotion = promotion.id
		 INNER JOIN matiere ON matiere.id_unite = unite.id
		 INNER JOIN niveau ON promotion.id_niveau = niveau.id
		 INNER JOIN section ON promotion.id_section = section.id 
		 WHERE matiere.id_titulaire = ?) AS dPromo
	INNER JOIN etudiant ON dPromo.id = etudiant.id_promotion");

	//Data utilisateur
	$req -> execute(array($titulaire));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getCreditsTitulaire($titulaire){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT SUM(matiere.credit) AS total
						FROM matiere
						INNER JOIN enseignant
						ON matiere.id_titulaire = enseignant.id
						WHERE enseignant.id = ?
					");

	//Data utilisateur
	$req -> execute(array($titulaire));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getPromosTitulaire($titulaire){    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT promotion.id, niveau.intitule, section.designation, matiere.designation, enseignant.nom, enseignant.code_access
	FROM matiere
	RIGHT JOIN enseignant ON enseignant.id = matiere.id_titulaire
	LEFT JOIN unite ON unite.id = matiere.id_unite
	LEFT JOIN promotion ON promotion.id = unite.id_promotion
	RIGHT JOIN niveau ON promotion.id_niveau = niveau.id
	RIGHT JOIN section ON promotion.id_section = section.id
	WHERE enseignant.id = ?
	GROUP BY section.designation");

	//Data utilisateur
	$req -> execute(array($titulaire));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getPromosListTitulaire($titulaire){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT dListPromo.id, dListPromo.intitule, section.designation, dListPromo.orientation, dListPromo.systeme
	FROM (SELECT dPromo.*, niveau.intitule
		FROM (SELECT promotion.id, promotion.id_section, promotion.id_niveau, promotion.orientation, promotion.systeme
			FROM (SELECT unite.id_promotion
				FROM matiere
				INNER JOIN unite ON matiere.id_unite = unite.id
				WHERE matiere.id_titulaire = ?) AS dTit
			INNER JOIN promotion ON promotion.id = dTit.id_promotion) AS dPromo
		INNER JOIN niveau ON dPromo.id_niveau = niveau.id) AS dListPromo
	INNER JOIN section ON section.id = dListPromo.id_section");

	//Data utilisateur
	$req -> execute(array($titulaire));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getStatTitulaire($matiere, $total){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT matiere.id, matiere.designation, COUNT(*) AS effEtudiants
	FROM matiere
	INNER JOIN fiche_cotation ON fiche_cotation.id_matiere = matiere.id
	WHERE matiere.id=? AND fiche_cotation.tp + fiche_cotation.td >= ?");
    
	//Data utilisateur
	$req -> execute(array($matiere, $total));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getEffectifJury($jury){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(etudiant.id) AS total
    FROM(SELECT promotion.id
        FROM (SELECT section.id
            FROM section
            INNER JOIN jury
            ON jury.id = section.id_jury
             WHERE jury.id = ?) AS detailSection
        INNER JOIN promotion
        ON detailSection.id = promotion.id_section) AS detailPromo
    INNER JOIN etudiant
    ON etudiant.id_promotion = detailPromo.id
    ");
    
	//Data utilisateur
	$req -> execute(array($jury));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getECsJury($jury){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(matiere.id) AS total
	FROM (SELECT unite.id
		FROM (
			SELECT promotion.id
			FROM promotion
			INNER JOIN section
			ON promotion.id_section = section.id
			WHERE section.id_jury = ?) AS detailPromo
		INNER JOIN unite
		ON detailPromo.id = unite.id_promotion) AS detailUnite
	INNER JOIN matiere
	ON matiere.id_unite = detailUnite.id
    ");
    
	//Data utilisateur
	$req -> execute(array($jury));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getPromosJury($jury){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT promotion.id, niveau.intitule, section.designation, promotion.orientation
							FROM promotion
							INNER JOIN niveau ON niveau.id = promotion.id_niveau
							INNER JOIN section ON section.id = promotion.id_section
							WHERE promotion.id_jury = ?
    ");
    
	//Data utilisateur
	$req -> execute(array($jury));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}


function getPresJury($jury){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT enseignant.nom, enseignant.post_nom, enseignant.prenom, enseignant.matricule, enseignant.grade
	FROM enseignant
	INNER JOIN section
	ON enseignant.id_section = section.id
	WHERE enseignant.id = section.id_president AND section.id_jury=?
    ");
    
	//Data utilisateur
	$req -> execute(array($jury));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getStatJury($section){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT promo, effectif, credits, niveau.intitule AS nom_promo
					FROM (SELECT effectif, SUM(credit) AS credits, promo, niv
					    FROM (SELECT effectif, unite.designation, unite.id, promo, niv
					        FROM (SELECT COUNT(*) AS effectif, promo, niv
					            FROM (
					                SELECT promotion.id AS promo, promotion.id_niveau AS niv
					                FROM section
					                INNER JOIN promotion
					                ON section.id = promotion.id_section
					                WHERE section.id_jury = ?) AS class
					            INNER JOIN etudiant
					            ON class.promo = etudiant.id_promotion
					            GROUP BY niv) AS detailPromo
					        LEFT JOIN unite
					        ON unite.id_promotion = detailPromo.promo) AS uniteDetail
					    INNER JOIN matiere
					    ON uniteDetail.id = matiere.id_unite
					    GROUP BY niv) AS resultatDetail
					INNER JOIN niveau
					ON niveau.id = resultatDetail.niv
    ");
    
	//Data utilisateur
	$req -> execute(array($section));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getGrilleList($jury){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT niveau.intitule AS class, promo
					FROM (
					    SELECT promotion.id AS promo, promotion.id_niveau
					    FROM promotion
					    INNER JOIN section
					    ON promotion.id_section = section.id
					    WHERE section.id_jury = ?) AS detailClass
					INNER JOIN niveau
					ON detailClass.id_niveau = niveau.id
    ");
    
	//Data utilisateur
	$req -> execute(array($jury));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getEnrol1(){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT SUM(Solde) AS total
	FROM (SELECT section.designation AS lblSection, SUM(dPromotion.montant) AS Solde
		FROM(
			SELECT etudiant.enrol_1 AS montant, promotion.id_section
			FROM etudiant
			INNER JOIN promotion
			ON etudiant.id_promotion = promotion.id) AS dPromotion
		INNER JOIN section
		ON section.id = dPromotion.id_section
		GROUP BY section.designation) AS finance
    ");
    
	//Data utilisateur
	$req -> execute();

	$data = $req -> fetch(PDO::FETCH_ASSOC);

	//Data BD
	return $data['total'];
}

function getEnrol2(){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT SUM(Solde) AS total
	FROM (SELECT section.designation AS lblSection, SUM(dPromotion.montant) AS Solde
		FROM(
			SELECT etudiant.enrol_2 AS montant, promotion.id_section
			FROM etudiant
			INNER JOIN promotion
			ON etudiant.id_promotion = promotion.id) AS dPromotion
		INNER JOIN section
		ON section.id = dPromotion.id_section
		GROUP BY section.designation) AS finance
    ");
    
	//Data utilisateur
	$req -> execute();

	$data = $req -> fetch(PDO::FETCH_ASSOC);

	//Data BD
	return $data['total'];
}

function getFraisAcad(){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT SUM(Solde) AS total
	FROM (SELECT section.designation AS lblSection, SUM(dPromotion.montant) AS Solde
		FROM(
			SELECT etudiant.frais_academique AS montant, promotion.id_section
			FROM etudiant
			INNER JOIN promotion
			ON etudiant.id_promotion = promotion.id) AS dPromotion
		INNER JOIN section
		ON section.id = dPromotion.id_section
		GROUP BY section.designation) AS finance
    ");
    
	//Data utilisateur
	$req -> execute();

	$data = $req -> fetch(PDO::FETCH_ASSOC);

	//Data BD
	return $data['total'];
}

function getStatComger(){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT section.designation AS lblSection, SUM(dPromotion.montant) AS Solde
	FROM(
		SELECT etudiant.enrol AS montant, promotion.id_section
		FROM etudiant
		INNER JOIN promotion
		ON etudiant.id_promotion = promotion.id) AS dPromotion
	INNER JOIN section
	ON section.id = dPromotion.id_section
	GROUP BY section.designation");
    
	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}


function getSectionList(){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT section.id, section.designation
							FROM section
	");
    
	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getTotAnuel($promotion){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT dPromo.totAnnuel AS total
	FROM (SELECT promotion.id_niveau, SUM(moyAn) AS totAnnuel
		FROM (SELECT matiere.intitue, matiere.credit, matiere.credit*10 AS moyAn, unite.id_promotion
			FROM matiere
			INNER JOIN unite
			ON matiere.id_unite = unite.id
			WHERE unite.id_promotion = ?) AS coursPromo
		INNER JOIN promotion
		ON coursPromo.id_promotion = promotion.id) AS dPromo
	INNER JOIN niveau
	ON niveau.id = dPromo.id_niveau
    ");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	$data = $req -> fetch(PDO::FETCH_ASSOC);

	//Data BD
	return $data['total'];
}

function getMoyAnuel($etudiant){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT fiche_cotation.id_etudiant, SUM((fiche_cotation.tp+fiche_cotation.td)*matiere.credit) AS moyAnnuel
	FROM fiche_cotation
	INNER JOIN matiere
	ON fiche_cotation.id_matiere = matiere.id
	WHERE fiche_cotation.id_etudiant = ?
	GROUP BY fiche_cotation.id_etudiant
    ");
    
	//Data utilisateur
	$req -> execute(array($etudiant));

	$data = $req -> fetch(PDO::FETCH_ASSOC);

	//Data BD
	return $data;
}

function getTotCredits($promotion){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT SUM(matiere.credit) AS totCredit
							FROM matiere
							INNER JOIN unite
							ON matiere.id_unite = unite.id
							WHERE unite.id_promotion = ?
    ");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	$data = $req -> fetch(PDO::FETCH_ASSOC);

	//Data BD
	return $data['totCredit'];
}

function getCreditsValide($promotion){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(*) AS creditValide
						FROM etudiant
						INNER JOIN fiche_cotation
						ON etudiant.id = fiche_cotation.id_etudiant
						WHERE etudiant.id = ?
    ");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	$data = $req -> fetch(PDO::FETCH_ASSOC);

	//Data BD
	return $data['creditValide'];
}

function getRecettes($data){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT DATE(paiement.date) AS 'DATE', paiement.preuve AS 'PREUVE', etudiant.nom, etudiant.post_nom, etudiant.prenom, niveau.intitule AS 'CLASSE', section.designation AS 'SECTION', promotion.orientation AS 'ORIENTATION', paiement.montant AS 'MONTANT'
	FROM paiement
	INNER JOIN etudiant ON etudiant.id = paiement.id_etudiant
	INNER JOIN promotion ON promotion.id = etudiant.id_promotion
	INNER JOIN niveau ON niveau.id = promotion.id_niveau
	INNER JOIN section ON section.id = promotion.id_section
	WHERE DATE(paiement.date) BETWEEN DATE(?) AND DATE(?) AND paiement.id_rubrique = ?");
    
	//Data utilisateur
	$req -> execute(array($data['debut'], $data['fin'], $data['rubrique']));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getStudentsByLevel($data){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT etudiant.*, section.designation, promotion.orientation
	FROM etudiant
	INNER JOIN promotion ON promotion.id = etudiant.id_promotion
	INNER JOIN section ON section.id = promotion.id_section
	INNER JOIN niveau ON niveau.id = promotion.id_niveau
	WHERE niveau.intitule = ?");
    
	//Data utilisateur
	$req -> execute(array($data));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getDetailsRecettes($data){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT rubrique.id, frais_academique.designation, finance.semestre, finance.montant, finance.monnaie, niveau.intitule, niveau.id
	FROM rubrique
	INNER JOIN finance ON finance.id = rubrique.id_finance
	INNER JOIN niveau ON niveau.id = rubrique.id_niveau
	INNER JOIN frais_academique ON frais_academique.id = finance.designation
	WHERE rubrique.id = ?");
    
	//Data utilisateur
	$req -> execute(array($data));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getUnitesStudent($promotion){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT unite.id, unite.code, unite.designation
							FROM unite
							WHERE unite.id_promotion = ?
	");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getECsStudent($etudiant){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT fiche_cotation.tp, fiche_cotation.td, dCotes.intitule, dCotes.credit, dCotes.nom, dCotes.post_nom, dCotes.grade
						FROM (SELECT dCours.intitule, dCours.credit, dCours.nom, dCours.post_nom, dCours.grade, dCours.cours
							FROM (SELECT matiere.intitue AS intitule, enseignant.nom, enseignant.post_nom, enseignant.grade, matiere.credit, matiere.id_unite, matiere.id AS cours
								FROM matiere
								INNER JOIN enseignant
								ON matiere.id_titulaire = enseignant.id) AS dCours
							INNER JOIN unite
							ON dCours.id_unite = unite.id) AS dCotes
						INNER JOIN fiche_cotation
						ON fiche_cotation.id_matiere = dCotes.cours
						WHERE fiche_cotation.id_etudiant = ?
	");
    
	//Data utilisateur
	$req -> execute(array($etudiant));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getECsStudentById($unite, $etudiant){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT fiche_cotation.tp, fiche_cotation.td, dCotes.intitule, dCotes.credit, dCotes.nom, dCotes.post_nom, dCotes.grade
						FROM (SELECT dCours.intitule, dCours.credit, dCours.nom, dCours.post_nom, dCours.grade, dCours.cours
							FROM (SELECT matiere.intitue AS intitule, enseignant.nom, enseignant.post_nom, enseignant.grade, matiere.credit, matiere.id_unite, matiere.id AS cours
								FROM matiere
								INNER JOIN enseignant
								ON matiere.id_titulaire = enseignant.id) AS dCours
							INNER JOIN unite
							ON dCours.id_unite = unite.id
							WHERE unite.id = ?) AS dCotes
						INNER JOIN fiche_cotation
						ON fiche_cotation.id_matiere = dCotes.cours
						WHERE fiche_cotation.id_etudiant = ?
	");
    
	//Data utilisateur
	$req -> execute(array($unite, $etudiant));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function updateStudent($data, $student){	
    
	//Connexion BD
	$bdd = getBdd();

    //Données à mettre à jour
	foreach ($data as $key => $value) {
		# code...
		switch ($key) {
			case 'nom':
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE etudiant SET etudiant.nom=? WHERE etudiant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['nom'], $student));
				}
				break;
				
			case 'post_nom':
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE etudiant SET etudiant.post_nom=? WHERE etudiant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['post_nom'], $student));
				}
				break;
				
			case 'prenom':
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE etudiant SET etudiant.prenom=? WHERE etudiant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['prenom'], $student));
				}
				break;
			
			default:
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE etudiant SET etudiant.sexe=? WHERE etudiant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['sexe'], $student));
				}
				break;
		}
	}

	//Data BD
	return true;
}

function updateStudentByAdmin($data){	
    
	//Connexion BD
	$bdd = getBdd();

    //Données à mettre à jour
	foreach ($data as $key => $value) {
		# code...
		switch ($key) {
			case 'diplome':
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE etudiant SET etudiant.diplome=? WHERE etudiant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['diplome'], $data['id']));
				}
				break;
				
			case 'mdp':
				if (!empty($value)) {
					$req = $bdd -> prepare("SELECT * FROM etudiant WHERE etudiant.id=?");
					
					$req -> execute(array($data['id']));

					$matricule = $req -> fetch(PDO::FETCH_ASSOC);

					$req = $bdd -> prepare("UPDATE etudiant SET etudiant.mdp=? WHERE etudiant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array(crypt($data['mdp'], $matricule['code_access']) , $data['id']));
				}
				break;
				
			case 'promotion':
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE etudiant SET etudiant.id_promotion=? WHERE etudiant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['promotion'], $data['id']));
				}
				break;
			
			default:
				echo "";
				break;
		}
	}

	//Data BD
	return true;
}


function updateTeacher($data, $student){	
    
	//Connexion BD
	$bdd = getBdd();

    //Données à mettre à jour
	foreach ($data as $key => $value) {
		# code...
		switch ($key) {
			case 'nom':
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE enseignant SET enseignant.nom=? WHERE enseignant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['nom'], $student));
				}
				break;
				
			case 'post_nom':
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE enseignant SET enseignant.post_nom=? WHERE enseignant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['post_nom'], $student));
				}
				break;
				
			case 'prenom':
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE enseignant SET enseignant.prenom=? WHERE enseignant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['prenom'], $student));
				}
				break;
			
			default:
				if (!empty($value)) {
					$req = $bdd -> prepare("UPDATE enseignant SET enseignant.sexe=? WHERE enseignant.id=?
					");
					
					//Data utilisateur
					$req -> execute(array($data['sexe'], $student));
				}
				break;
		}
	}

	//Data BD
	return true;
}

function getPromotionEcs($grille){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT matiere.id, matiere.intitue AS intitule
							FROM matiere
							INNER JOIN unite
							ON unite.id = matiere.id_unite
							WHERE unite.id_promotion=?
						
	");
    
	//Data utilisateur
	$req -> execute(array($grille));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getTitEcs($titulaire, $promotion, $matiere){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT detEC.id, detEC.intitule, detEC.credit, unite.designation, (20*detEC.credit) AS maximum, detEC.semestre
						FROM (SELECT matiere.id, matiere.intitue AS intitule, matiere.id_unite, matiere.credit, matiere.semestre
							FROM matiere
							INNER JOIN enseignant
							ON matiere.id_titulaire = enseignant.id
							WHERE enseignant.id = ?) AS detEC
						INNER JOIN unite
						ON unite.id = detEC.id_unite
						WHERE unite.id_promotion=? AND detEC.id = ?
	");
    
	//Data utilisateur
	$req -> execute(array($titulaire, $promotion, $matiere));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getFicheCotationListJury($promotion){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT * FROM etudiant WHERE id_promotion=? WHERE frais_a
	");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function infoPromotion($promotion){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT dPromo.intitule AS 'niveau', section.designation AS 'section', systeme, orientation
	FROM (
		SELECT niveau.intitule, promotion.id_section, promotion.systeme, promotion.orientation
		FROM niveau
		INNER JOIN promotion
		ON niveau.id = promotion.id_niveau
		WHERE promotion.id = ?) AS dPromo
	INNER JOIN section
	ON section.id = dPromo.id_section
	");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getFicheCotationList($promotion){	
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT * FROM etudiant WHERE id_promotion=?
	");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getFicheCotationListKeyword($promotion, $keyword){	
    
	//Connexion BD
	$bdd = getBdd();

	$pattern = "%". $keyword . "%";

	$sql = "SELECT * FROM etudiant WHERE id_promotion= :promotion AND etudiant.nom LIKE :pattern OR etudiant.post_nom LIKE :pattern OR etudiant.prenom LIKE :pattern OR etudiant.matricule LIKE :pattern";

    //Effectif Section
	$req = $bdd -> prepare($sql);

	$req -> execute([':promotion' => $promotion, ':pattern'=>$pattern]);

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getCoteEtudiant($etudiant, $matiere){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT * 
						FROM fiche_cotation
						INNER JOIN releve ON releve.id = fiche_cotation.id_releve
						WHERE releve.id_etudiant = ? AND id_matiere=?
	");
    
	//Data utilisateur
	$req -> execute(array($etudiant,$matiere));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}



function getCoteEtudiantAJAC($etudiant, $matiere){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT * 
						FROM fiche_ajac
						INNER JOIN releve
						WHERE releve.id_etudiant = ? AND id_matiere=?
	");
    
	//Data utilisateur
	$req -> execute(array($etudiant,$matiere));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getCoteEtudiantTD($etudiant, $matiere){
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT * 
						FROM fiche_cotation
						INNER JOIN etudiant
						ON fiche_cotation.id_etudiant= etudiant.id
						WHERE fiche_cotation.id_etudiant = ? AND id_matiere=?
	");
    
	//Data utilisateur
	$req -> execute(array($etudiant,$matiere));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function updateCoteEtudiantExamen($etudiant, $matiere, $cote){

	$num_releve = getAllInfosOfStudent($etudiant)['num_releve'];
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("UPDATE fiche_cotation SET examen=? WHERE fiche_cotation.id_releve = ? AND id_matiere=?
	");
    
	//Data utilisateur
	$req -> execute(array($cote, $num_releve , $matiere));

	//Data BD
	return TRUE;

}

function updateCoteEtudiantTD($etudiant, $matiere, $cote){	

	$num_releve = getAllInfosOfStudent($etudiant)['num_releve'];
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("UPDATE fiche_cotation SET td=? WHERE fiche_cotation.id_releve = ? AND id_matiere=?
	");
    
	//Data utilisateur
	$req -> execute(array($cote, $num_releve, $matiere));

	//Data BD
	return TRUE;

}

function updateCoteEtudiantTP($etudiant, $matiere, $cote){

	$num_releve = getAllInfosOfStudent($etudiant)['num_releve'];
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("UPDATE fiche_cotation SET tp=? WHERE fiche_cotation.id_releve = ? AND id_matiere=?
	");
    
	//Data utilisateur
	$req -> execute(array($cote, $num_releve, $matiere));

	//Data BD
	return TRUE;

}

function setCoteEtudiant($etudiant, $matiere, $coteTD, $coteTP){
	$num_releve = getAllInfosOfStudent($etudiant)['num_releve'];
    
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO fiche_cotation(id_releve, id_matiere, tp, td) VALUES (?, ?, ?, ?)");
    
	//Data utilisateur
	$req -> execute(array($num_releve, $matiere, $coteTP, $coteTD));

	//Data BD
	return TRUE;

}

function getCurrentSection($id){	
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT section.designation
							FROM section
							WHERE section.id = ?
	");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getAllInfosOfStudent($id){	
	//Connexion BD
	$bdd = getBdd();

    //Liste Etudiant Section
	$req = $bdd -> prepare("SELECT etudiant.*, releve.id AS num_releve
							FROM etudiant
							INNER JOIN releve ON releve.id_etudiant = etudiant.id
							WHERE etudiant.id = ?
							");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getAllStudenRtCurrentSection($id, $rubrique){	//Connexion BD
	$bdd = getBdd();

    //Liste Etudiant Section
	switch ($rubrique) {
		case 1:
			$req = $bdd -> prepare("SELECT DEtudiant.nom, DEtudiant.post_nom, DEtudiant.prenom, DEtudiant.matricule, DEtudiant.frais_academique AS solde
									FROM (
										SELECT etudiant.id, etudiant.nom, etudiant.post_nom, etudiant.prenom, etudiant.matricule, etudiant.frais_academique
										FROM etudiant
										INNER JOIN promotion
										ON etudiant.id_promotion = promotion.id
										WHERE promotion.id_section=?) AS DEtudiant
									WHERE DEtudiant.frais_academique = 500000
			");
			break;
		
		case 2:
			$req = $bdd -> prepare("SELECT DEtudiant.nom, DEtudiant.post_nom, DEtudiant.prenom, DEtudiant.matricule, DEtudiant.enrol_1 AS solde
									FROM (
										SELECT etudiant.id, etudiant.nom, etudiant.post_nom, etudiant.prenom, etudiant.matricule, etudiant.enrol_1
										FROM etudiant
										INNER JOIN promotion
										ON etudiant.id_promotion = promotion.id
										WHERE promotion.id_section=?) AS DEtudiant
									WHERE DEtudiant.enrol_1 = 25000
			");
			break;
		default:
			$req = $bdd -> prepare("SELECT DEtudiant.nom, DEtudiant.post_nom, DEtudiant.prenom, DEtudiant.matricule, DEtudiant.enrol_2 AS solde
									FROM (
										SELECT etudiant.id, etudiant.nom, etudiant.post_nom, etudiant.prenom, etudiant.matricule, etudiant.enrol_2
										FROM etudiant
										INNER JOIN promotion
										ON etudiant.id_promotion = promotion.id
										WHERE promotion.id_section=?) AS DEtudiant
									WHERE DEtudiant.enrol_2 = 25000
			");
			break;
	}
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}


function getAllStudenRtCurrentSectionByWord($id, $rubrique, $keyword){	
	

	$pattern = "%". $keyword . "%";

	//Connexion BD
	$bdd = getBdd();

    //Liste Etudiant Section
	switch ($rubrique) {
		case 1:

			$sql = "SELECT DEtudiant.nom, DEtudiant.post_nom, DEtudiant.prenom, DEtudiant.matricule, DEtudiant.frais_academique AS solde
			FROM (
				SELECT etudiant.id, etudiant.nom, etudiant.post_nom, etudiant.prenom, etudiant.matricule, etudiant.frais_academique
				FROM etudiant
				INNER JOIN promotion
				ON etudiant.id_promotion = promotion.id
				WHERE promotion.id_section=:section) AS DEtudiant
			WHERE DEtudiant.frais_academique = 500000 AND DEtudiant.nom LIKE :pattern OR DEtudiant.post_nom LIKE :pattern OR DEtudiant.prenom LIKE :pattern OR DEtudiant.matricule LIKE :pattern";
			$req = $bdd -> prepare($sql);
			break;
		
		case 2:
			$req = $bdd -> prepare("SELECT DEtudiant.nom, DEtudiant.post_nom, DEtudiant.prenom, DEtudiant.matricule, DEtudiant.enrol_1 AS solde
									FROM (
										SELECT etudiant.id, etudiant.nom, etudiant.post_nom, etudiant.prenom, etudiant.matricule, etudiant.enrol_1
										FROM etudiant
										INNER JOIN promotion
										ON etudiant.id_promotion = promotion.id
										WHERE promotion.id_section=?) AS DEtudiant
									WHERE DEtudiant.enrol_1 = 25000
			");
			break;
		default:
			$req = $bdd -> prepare("SELECT DEtudiant.nom, DEtudiant.post_nom, DEtudiant.prenom, DEtudiant.matricule, DEtudiant.enrol_2 AS solde
									FROM (
										SELECT etudiant.id, etudiant.nom, etudiant.post_nom, etudiant.prenom, etudiant.matricule, etudiant.enrol_2
										FROM etudiant
										INNER JOIN promotion
										ON etudiant.id_promotion = promotion.id
										WHERE promotion.id_section=?) AS DEtudiant
									WHERE DEtudiant.enrol_2 = 25000
			");
			break;
	}
    
	//Data utilisateur
	$req -> execute([':section' => $id, ':pattern'=>$pattern]);

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}
function updateFinEtudiant($id, $rubrique){	//Connexion BD
	$bdd = getBdd();

    //Liste Etudiant Section
	switch ($rubrique) {
		case 1:
			$req = $bdd -> prepare("UPDATE etudiant SET etudiant.frais_academique = 500000 WHERE etudiant.matricule = ?");
			break;
		
		case 2:
			$req = $bdd -> prepare("UPDATE etudiant SET etudiant.enrol_1 = 25000 WHERE etudiant.matricule = ?");
			break;
		default:			
			$req = $bdd -> prepare("UPDATE etudiant SET etudiant.enrol_2 = 25000 WHERE etudiant.matricule = ?");
			break;
	}
    
	//Data utilisateur
	$req -> execute(array($id));

	
	$req = $bdd -> prepare("UPDATE etudiant SET etudiant.statut = 1 WHERE etudiant.matricule = ? AND etudiant.frais_academique=500000 AND etudiant.enrol_1 = 25000 AND etudiant.enrol_2 = 25000");	
	
	$req -> execute(array($id));
	//Data BD
	return TRUE;

}

function getAuthorisation(){	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT authentification.statut, authentification.access 
							FROM authentification
							WHERE authentification.departement = 'jury'");
    
	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getAuthorisationTit(){	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT authentification.statut
							FROM authentification
							WHERE authentification.departement = 'titulaire'");
    
	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getAuthorisationForTit(){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT authentification.statut, authentification.access
							FROM authentification
							WHERE authentification.departement = 'titulaire'");
    
	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getAuthorisationForJury(){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT authentification.statut, authentification.access
							FROM authentification
							WHERE authentification.departement = 'jury'");
    
	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}


function getDetailsPromotion($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT infoSection.id, infoSection.systeme, infoSection.lblSection, niveau.intitule
	FROM (
		SELECT promotion.id, promotion.id_niveau, promotion.systeme, section.designation AS lblSection
		FROM promotion
		INNER JOIN section ON promotion.id_section = section.id
		WHERE promotion.id=?) AS infoSection
	INNER JOIN niveau ON niveau.id = infoSection.id_niveau");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getCurrentAnneeByStudent($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT promotion.id_annee
							FROM etudiant
							INNER JOIN promotion ON promotion.id = etudiant.id_promotion
							WHERE etudiant.id=?
	");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getAnneAcadByStudent($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT annee.debut, annee.fin
							FROM annee
							INNER JOIN promotion ON promotion.id_annee = annee.id
							WHERE promotion.id =?
	");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getAllCotesAjac($etudiant){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT dCours.cours, fiche_ajac.tp, fiche_ajac.td, fiche_ajac.examen, fiche_ajac.echec, dCours.credit, dCours.ue_code, fiche_ajac.id_releve, fiche_ajac.id AS ajac
							FROM (SELECT matiere.designation AS cours, matiere.credit, matiere.id, unite.code AS ue_code
								FROM matiere
								INNER JOIN unite ON unite.id = matiere.id_unite) AS dCours
							LEFT JOIN fiche_ajac
							ON dCours.id = fiche_ajac.id_matiere
							WHERE fiche_ajac.id_releve=?
	");
    
	//Data utilisateur
	$req -> execute(array($etudiant));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getAllCotesJury($promotion, $etudiant){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT dCours.cours, fiche_cotation.tp, fiche_cotation.td, fiche_cotation.examen, dCours.credit, fiche_cotation.id_releve
							FROM (SELECT matiere.designation AS cours, matiere.credit, matiere.id
								FROM matiere
								INNER JOIN unite ON unite.id = matiere.id_unite
								WHERE unite.id_promotion = ?) AS dCours
							LEFT JOIN fiche_cotation
							ON dCours.id = fiche_cotation.id_matiere
							WHERE fiche_cotation.id_releve=?");
    
	//Data utilisateur
	$req -> execute(array($promotion, $etudiant));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getMatieresGrilleByPromo($promotion){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT matiere.intitue AS cours, matiere.credit, unite.id_promotion, matiere.id
							FROM matiere
							INNER JOIN unite ON unite.id = matiere.id_unite
							WHERE unite.id_promotion = ?
	");
    
	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function getCotesAllPromotionByMatiere($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT etudiant.nom, etudiant.post_nom, etudiant.prenom, etudiant.id, fiche_cotation.tp, fiche_cotation.td, fiche_cotation.examen
							FROM fiche_cotation
							LEFT JOIN etudiant ON fiche_cotation.id_etudiant = etudiant.id
							WHERE etudiant.id_promotion = ?
	");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function updateStatutTitulaire($id, $statut){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("UPDATE enseignant SET statut=? WHERE enseignant.id=?");
    $req -> execute(array($statut, $id));
	//Data BD
	return true;
}

function updateMdpJury($id, $mdp){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("UPDATE jury SET code_auth = ? WHERE id = ?");
    $req -> execute(array($mdp, $id));
	//Data BD
	return true;
}

function updateMdpTitulaire($id, $mdp){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT enseignant.mdp
							FROM enseignant
							WHERE enseignant.id = ?
	");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	$isOk = $req -> fetch(PDO::FETCH_ASSOC);

	if ($isOk['mdp']) {
		$req = $bdd -> prepare("UPDATE enseignant SET mdp=? WHERE enseignant.id=?");
		$req -> execute(array($mdp, $id));
		//Data BD
		return true;

	} else {
		return false;
	}
}

function getMatieresByPromo($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT enseignant.grade, enseignant.nom, enseignant.post_nom, dMatiere.id, dMatiere.intitule, dMatiere.credit, dMatiere.code, dMatiere.ucode, dMatiere.semestre, dMatiere.statut, dMatiere.id_titulaire, dMatiere.unite
	FROM (SELECT matiere.id, matiere.designation AS intitule, matiere.credit, matiere.code, unite.code AS ucode, unite.designation AS 'unite', matiere.semestre, matiere.statut, matiere.id_titulaire
								FROM matiere
								INNER JOIN unite ON unite.id = matiere.id_unite
								WHERE unite.id_promotion=?) AS dMatiere
	INNER JOIN enseignant on dMatiere.id_titulaire = enseignant.id
		 ");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function getMatieresOfTitulaireByPromo($id, $titulaire){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT enseignant.grade, enseignant.nom, enseignant.post_nom, dMatiere.id, dMatiere.intitule, dMatiere.credit, dMatiere.code, dMatiere.ucode, dMatiere.semestre, dMatiere.statut, dMatiere.id_titulaire, dMatiere.class, dMatiere.section, dMatiere.orientation, promo
	FROM (SELECT matiere.id, matiere.designation AS intitule, matiere.credit, matiere.code, unite.code AS ucode, matiere.semestre, matiere.statut, matiere.id_titulaire, niveau.intitule AS class, section.designation AS 'section', promotion.orientation, promotion.id AS promo
								FROM matiere
								INNER JOIN unite ON unite.id = matiere.id_unite
								INNER JOIN promotion ON unite.id_promotion = promotion.id
								INNER JOIN niveau ON promotion.id_niveau = niveau.id
								INNER JOIN section ON promotion.id_section = section.id
								WHERE unite.id_promotion=?) AS dMatiere
	INNER JOIN enseignant on dMatiere.id_titulaire = enseignant.id
	WHERE enseignant.id = ?
		 ");
    
	//Data utilisateur
	$req -> execute(array($id, $titulaire));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function getMatieresByMatiere($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT enseignant.grade, enseignant.nom, enseignant.post_nom, dMatiere.id, dMatiere.intitule, dMatiere.credit, dMatiere.code, dMatiere.designation, dMatiere.semestre, dMatiere.statut, dMatiere.id_titulaire, dMatiere.id_promotion, dMatiere.modif
							FROM (SELECT matiere.id, matiere.designation AS intitule, matiere.credit, matiere.code, unite.designation, unite.id_promotion, matiere.semestre, matiere.statut, matiere.id_titulaire, unite.id AS 'modif'
								FROM matiere
								INNER JOIN unite ON unite.id = matiere.id_unite
								WHERE matiere.id=?) AS dMatiere
							INNER JOIN enseignant on dMatiere.id_titulaire = enseignant.id
	");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getPromotionByMatiere($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT intitule AS classe, section.designation, dNiveau.id_promotion AS promo
	FROM (SELECT niveau.intitule, dPromotion.id_section, dPromotion.id_Promotion
		FROM (SELECT promotion.id_niveau, promotion.id_section, dMatiere.id_promotion
			FROM (SELECT unite.id_promotion
					FROM unite
					INNER JOIN matiere ON matiere.id_unite = unite.id
					WHERE matiere.id = ?) AS dMatiere
			INNER JOIN promotion ON dMatiere.id_promotion = promotion.id) AS dPromotion
		INNER JOIN niveau ON niveau.id = dPromotion.id_niveau) AS dNiveau
	INNER JOIN section ON dNiveau.id_section = section.id
	");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getEchecsByMatiere($id, $seuil){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(*) AS echecs
	FROM (SELECT fiche_cotation.tp+fiche_cotation.td AS moyAnnuel
		 FROM fiche_cotation 
		 INNER JOIN matiere ON fiche_cotation.id_matiere = matiere.id
		 WHERE matiere.id=?) AS dFiches
	WHERE moyAnnuel < ?
	");
    
	//Data utilisateur
	$req -> execute(array($id, $seuil));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getReussitesByMatiere($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(*) AS reussites
	FROM (SELECT fiche_cotation.tp+fiche_cotation.td AS moyAnnuel
		 FROM fiche_cotation 
		 INNER JOIN matiere ON fiche_cotation.id_matiere = matiere.id
		 WHERE matiere.id=?) AS dFiches
	WHERE moyAnnuel < 5.0
	");
    
	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function deleteMatiere($id){
	//Connexion BD
	$bdd = getBdd();

    //Effectif Section
	$req = $bdd -> prepare("DELETE FROM matiere WHERE id=?");
    
	$req -> execute(array($id));

	//Data BD
	return true;

}

function updateIntituleByMatiere($id, $data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("UPDATE matiere SET intitue=? WHERE id=?");

	//Data utilisateur
	$req -> execute(array($id, $data));

	//Data BD
	return TRUE;
}

function updateCreditByMatiere($id, $data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("UPDATE matiere SET credit=? WHERE id=?");

	//Data utilisateur
	$req -> execute(array($id, $data));

	//Data BD
	return TRUE;
}

function updateCodeByMatiere($id, $data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("UPDATE matiere SET code=? WHERE id=?");

	//Data utilisateur
	$req -> execute(array($id, $data));

	//Data BD
	return TRUE;
}

function updateSemestreByMatiere($id, $data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("UPDATE matiere SET semestre=? WHERE id=?");

	//Data utilisateur
	$req -> execute(array($id, $data));

	//Data BD
	return TRUE;
}

function updateUniteByMatiere($id, $data){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("UPDATE matiere SET id_unite=? WHERE id=?");

	//Data utilisateur
	$req -> execute(array($id, (int) $data));

	//Data BD
	return TRUE;
}

function getMaxByPromo($promotion){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT SUM(matiere.credit*20) AS Maximum
							FROM matiere
							INNER JOIN unite
							ON matiere.id_unite = unite.id
							WHERE unite.id_promotion=?
	");

	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getByObtPromo($promotion){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT dCote.id, dCote.nom, dCote.post_nom, SUM((dCote.tp+dCote.td+ dCote.examen)*matiere.credit) AS OBT
							FROM (SELECT etudiant.id, etudiant.nom, etudiant.post_nom, fiche_cotation.id_matiere, fiche_cotation.tp, fiche_cotation.td, fiche_cotation.examen 
								FROM etudiant 
								LEFT JOIN fiche_cotation 
								ON etudiant.id = fiche_cotation.id_etudiant 
								WHERE etudiant.id_promotion=?) AS dCote
							LEFT JOIN matiere
							ON dCote.id_matiere = matiere.id
							GROUP BY id
							ORDER BY OBT DESC
	");

	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getByObtEtudiant($id){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT dCote.id, dCote.nom, dCote.post_nom, SUM((dCote.tp+dCote.td+ dCote.examen)*matiere.credit) AS OBT
							FROM (SELECT etudiant.id, etudiant.nom, etudiant.post_nom, fiche_cotation.id_matiere, fiche_cotation.tp, fiche_cotation.td, fiche_cotation.examen 
								FROM etudiant 
								LEFT JOIN fiche_cotation 
								ON etudiant.id = fiche_cotation.id_etudiant 
								WHERE etudiant.id=?) AS dCote
							LEFT JOIN matiere
							ON dCote.id_matiere = matiere.id
							GROUP BY id
							ORDER BY OBT DESC
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function getEffByPromo($promotion){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT COUNT(*) AS participant 
							FROM etudiant 
							WHERE id_promotion = ?
	");

	//Data utilisateur
	$req -> execute(array($promotion));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);
}

function setReleve($data){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO releve(numero, id_annee, id_etudiant) VALUES (?, ?, ?)
					");

	//Data utilisateur
	$req -> execute(array($data['numero'], $data['annee'], $data['etudiant']));

	//Data BD
	$resultat = ($req) ? "Relevé ajoutée" : "Relevé non ajoutée" ;
	return $resultat;	
}

function setAjacOfStudent($data){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO fiche_ajac(id_releve, id_matiere, echec) VALUES (?, ?, ?)");

	//Data utilisateur
	$req -> execute(array($data['id'], $data['matiere'], $data['echec']));

	//Data BD
	$resultat = ($req) ? "L'AJAC a bien été ajouté" : "Un problème est survenu" ;
	return $resultat;	
}

function setFinance($data){
	$ref = time();
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO frais_academique(designation, ref_frais_academique) VALUES (?, ?)");

	//Data utilisateur
	$req -> execute(array($data, $ref));

	return "La rubrique a bien été ajouter";
}

function setFixation($data, $promotions){
	$ref = time();
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO finance(designation, semestre, montant, monnaie, id_operateur, ref_rubrique, id_coges) VALUES (?, ?, ?, ?, ?, ?, ?)");

	//Data utilisateur
	$req -> execute(array($data['rubrique'], $data['semestre'], $data['montant'], $data['monnaie'], $data['id_operateur'], $ref, $data['id_coges']));
    
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT id
							FROM finance
							WHERE ref_rubrique = ?
	");

	//Data utilisateur
	$req -> execute(array($ref));

	//REFERENCE FINANCE
	$id_finance = $req -> fetch(PDO::FETCH_ASSOC);

	foreach ($promotions as $value) {
		//Effectif Section
		$req = $bdd -> prepare("INSERT INTO rubrique(id_finance, id_niveau) VALUES (?, ?)");
	
		//Data utilisateur
		$req -> execute(array($id_finance['id'], $value));
	}
	
	return "Le montant a bien été fixer";
}

function setOperateur($data){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("INSERT INTO operateur(mdp, grade, id_agent) VALUES (?, ?, ?)");

	//Data utilisateur
	$req -> execute(array(sha1($data['mdp']), $data['grade'], $data['id_agent']));

	//Data BD
	$resultat = ($req) ? "L'opérateur a bien été ajouter" : "Un problème est survenu" ;
	return $resultat;	
}

function delAjacOfStudent($data){
    
	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("DELETE FROM fiche_ajac WHERE id=?");

	//Data utilisateur
	$req -> execute(array($data));

	//Data BD
	$resultat = ($req) ? "L'AJAC a bien été supprimé" : "Un problème est survenu lors de la suppression" ;
	return $resultat;	
}

function getListAjacOfStudent($releve){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT matiere.designation, matiere.credit, fiche_ajac.echec
							FROM matiere
							INNER JOIN fiche_ajac ON fiche_ajac.id_matiere = matiere.id
							WHERE fiche_ajac.id_releve = ?
	");

	//Data utilisateur
	$req -> execute(array($releve));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getListJury(){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT *
							FROM jury
	");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function gradeAdministratif(){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT id, grade
							FROM administratif
	");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);
}

function getAllClasse(){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT *
							FROM niveau
	");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function getAllOperateurs(){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT operateur.grade AS 'operateur', enseignant.nom, enseignant.post_nom, operateur.id
							FROM operateur
							INNER JOIN enseignant ON enseignant.id = operateur.id_agent
	");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function getFrais($id){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT id, designation
							FROM frais_academique
							WHERE id = ?
	");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getAllFrais(){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT id, designation
							FROM frais_academique
	");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function getAllRubriques(){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT rubrique.id AS 'rubrique', finance.id, frais_academique.designation AS 'designation', finance.semestre, finance.montant, finance.monnaie, finance.id_operateur, finance.ref_rubrique, niveau.intitule, enseignant.grade, enseignant.nom, enseignant.post_nom, enseignant.statut
							FROM finance
							INNER JOIN frais_academique ON frais_academique.id = finance.designation
							INNER JOIN rubrique ON rubrique.id_finance = finance.id
							INNER JOIN niveau ON niveau.id = rubrique.id_niveau
							INNER JOIN operateur ON operateur.id = finance.id_operateur
							INNER JOIN enseignant ON enseignant.id = operateur.id_agent
	");

	//Data utilisateur
	$req -> execute();

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function getRubrique($id){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT finance.id, finance.designation, finance.semestre, finance.montant, finance.monnaie, finance.id_operateur, finance.ref_rubrique, niveau.intitule, enseignant.grade, enseignant.nom, enseignant.post_nom, enseignant.statut
							FROM finance
							INNER JOIN rubrique ON rubrique.id_finance = finance.id
							INNER JOIN niveau ON niveau.id = rubrique.id_niveau
							INNER JOIN operateur ON operateur.id = finance.id_operateur
							INNER JOIN enseignant ON enseignant.id = operateur.id_agent
                            WHERE rubrique.id=?
							");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetch(PDO::FETCH_ASSOC);

}

function getAllFinances(){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT finance.id, rubrique.id AS perception, frais_academique.designation AS 'designation', finance.semestre, finance.montant, finance.monnaie, finance.id_operateur, finance.ref_rubrique, niveau.intitule, enseignant.grade, enseignant.nom, enseignant.post_nom, enseignant.statut
							FROM finance
							INNER JOIN rubrique ON rubrique.id_finance = finance.id
							INNER JOIN niveau ON niveau.id = rubrique.id_niveau
							INNER JOIN operateur ON operateur.id = finance.id_operateur
							INNER JOIN enseignant ON enseignant.id = operateur.id_agent
							INNER JOIN frais_academique ON frais_academique.id = finance.designation
							WHERE id_operateur = ?");

	//Data utilisateur
	$req -> execute(array($_SESSION['id']));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function getListePaiementsByRubrique($id){

	//Connexion BD
	$bdd = getBdd();
    
    //Effectif Section
	$req = $bdd -> prepare("SELECT etudiant.nom, etudiant.post_nom, etudiant.prenom, SUM(paiement.montant) AS TOTAL, finance.monnaie,  (finance.montant - SUM(paiement.montant)) AS DETTES, finance.semestre, etudiant.id
							FROM paiement
							INNER JOIN etudiant ON etudiant.id = paiement.id_etudiant
							INNER JOIN rubrique ON rubrique.id = paiement.id_rubrique
							INNER JOIN finance ON finance.id = rubrique.id_finance
							WHERE rubrique.id = ?
                            GROUP BY etudiant.id");

	//Data utilisateur
	$req -> execute(array($id));

	//Data BD
	return $req -> fetchAll(PDO::FETCH_ASSOC);

}

function setChangeMdpAdmin($data){

	//Connexion BD
	$bdd = getBdd();
    
    //Existance mot de passe 
	$req = $bdd -> prepare("SELECT id FROM administratif WHERE mdp=? AND id = ?");

	//Data utilisateur
	$req -> execute(array(sha1($data['currMdp']), $data['coges']));

	$resp = $req -> fetch(PDO::FETCH_ASSOC);

	if (isset($resp['id'])) {
		//Effectif Section
		$req = $bdd -> prepare("UPDATE administratif SET mdp=? WHERE id=?");
	
		//Data utilisateur
		$req -> execute(array(sha1($data['newMdp']), $data['coges']));

		//Existance mot de passe 
		$req = $bdd -> prepare("SELECT id FROM administratif WHERE mdp=? AND id = ?");
	
		//Data utilisateur
		$req -> execute(array(sha1($data['newMdp']), $data['coges']));

		$resp = $req -> fetch(PDO::FETCH_ASSOC);

		if (isset($resp['id'])) {
			//Data BD
			return 'Le mot de passe a été modifier...';

		} else {
			//Data BD
			return 'Le mot de passe n\'a pas été modifier...';
		}
		
	
		
	} else {
		//Data BD
		return 'L\'ancien mot de passe n\'est pas exact...';
	}
	
    

}
