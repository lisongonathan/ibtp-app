<?php
//Déclaration session 
session_start();

//Inmport back - controleur
require "controleur/php/controleur.php";

//Prépare erreur
try{
	if (isset($_GET['deconnexion'])) {
				
		//Déconnexion 
		$_SESSION = array();
		session_destroy();

		//Formulaire de connexion
		header("Location:index.php");

	}elseif(isset($_SESSION['id'])){
		
		if (isset($_GET['erreur'])) {
			//Profile utilisateur
			erreur($_GET['erreur']);

		} elseif (isset($_GET['promotion'])) {
			//Gestion promotion
			$_SESSION['promotion'] = (int) $_GET['promotion'];
			promotion();
		} elseif (isset($_GET['fiche'])) {
			//Gestion cotes
			
			fichesCotation((int) $_GET['fiche'], (int) $_GET['myclass']);
		} elseif (isset($_GET['grille'])) {
			detailleGrille((int) $_GET['grille']);
			
		} elseif (isset($_GET['section'])) {
			$_SESSION['infoSection'] = (int) $_GET['section'];
			$_SESSION['nom_section'] = (int) $_GET['section'];
			//Gestion cotes
			finance();

		} elseif (isset($_GET['releve'])) {
			//Gestion cotes
			if ($_GET['releve'] == 1) {
				bulletin(1);

			} elseif ($_GET['releve'] == 2) {
				bulletin(2);

			} else {
				erreur("Page Inexistant");

			}
		} elseif (isset($_GET['sgac'])) {
			//Gestion authorisation
			sgacd();

		} elseif (isset($_GET['printFiche'])) {
			etatFiche((int) $_GET['printFiche']);

		} elseif (isset($_GET['add_cours']) AND $_GET['add_cours'] == 2) {
			newUE();

		} elseif (isset($_GET['add_cours']) AND $_GET['add_cours'] == 1) {
			addCours();

		} elseif (isset($_GET['editCours'])) {
			updateEC((int) $_GET['editCours']);

		} elseif (isset($_GET['editEtudiant'])) {
			updateEtudiant((int) $_GET['editEtudiant']);

		} elseif (isset($_GET['etudiants'])) {
			etudiants((int) $_GET['etudiants']);

		} elseif (isset($_GET['delUE'])) {
			suppUe((int) $_GET['delUE']);

		} elseif (isset($_GET['fiches'])) {
			fiches((int) $_GET['fiches']);

		} elseif (isset($_GET['gestion-jury'])) {
			gestionJury();

		} elseif (isset($_GET['finance-etudiant'])) {
			financeEtudiant();

		} elseif (isset($_GET['titulaires'])) {
			gestionTitulaire((int) $_GET['titulaires']);

		} elseif (isset($_GET['profile-admin'])) {
			setProfileAdmin((int) $_GET['profile-admin']);

		} elseif (isset($_GET['perception'])) {
			perception((int) $_GET['perception']);

		} elseif (isset($_GET['print_recettes'])) {
			printRecettes($_GET['print_recettes'], $_GET['debut'], $_GET['fin']);
			
		} else {
			//Page d'acceuil
			dashboard();
		}	

	}else{
		if (isset($_GET['subscrib'])) {
			//Récupération du compte
			signin();

		} elseif (isset($_GET['etudiants'])) {
			//Access etudiant
			accessEtudiant();
		} elseif (isset($_GET['enseignants'])) {
			//Access etudiant
			accessEnseignant(); 
		} else {
			//Connexion au compte
			login();
		}		
	}
}catch(Exception $e){
	//Appel page erreur
	erreur($e->getMessage());
}