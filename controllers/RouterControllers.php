<?php

require_once __DIR__ . '/CommentaireController.php';
require_once __DIR__ . '/PlaneteController.php';
require_once __DIR__ . '/EspeceController.php';


function actionPlaneteRouter(string $action): void {
    switch ($action) {
        case 'planeteListe':
            actionPlaneteIndex();
            break;
        case 'planeteDetail':
            actionPlaneteDetail();
            break;
        case 'planeteAjouter':
            actionPlaneteAjouter();
            break;
        case 'planeteModifier':
            actionPlaneteModifier();
            break;
        case 'planeteSupprimer':
            actionPlaneteSupprimer();
            break;
    }
}

function actionEspeceRouter(string $action): void {
    switch ($action) {
        case 'especeListe':
            actionEspeceIndex();
            break;
        case 'especeDetail':
            actionEspeceDetail();
            break;
        case 'especeAjouter':
            actionEspeceAjouter();
            break;
        case 'especeModifier':
            actionEspeceModifier();
            break;
        case 'especeSupprimer':
            actionEspeceSupprimer();
            break;
    }
}





function actionAffiliationRouter(string $action): void {
    switch ($action) {
        case 'affiliationListe':
            actionAffiliationIndex();
            break;
        case 'affiliationDetail':
            actionAffiliationDetail();
            break;
        case 'affiliationAjouter':
            actionAffiliationAjouter();
            break;
        case 'affiliationModifier':
            actionAffiliationModifier();
            break;
        case 'affiliationSupprimer':
            actionAffiliationSupprimer();
            break;
    }
}

function actionCommentaireRouter(string $action): void {
    switch ($action) {
        case 'commentaireListe':
            actionCommentaireIndex();
            break;
        case 'commentaireAjouter':
            actionCommentaireAjouter();
            break;
        case 'commentaireSupprimer':
            actionCommentaireSupprimer();
            break;
        
    }
}

