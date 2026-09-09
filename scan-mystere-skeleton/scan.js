/**
 * scan.js — Gère la persistance du nombre affiché, SANS cookie et SANS base de données.
 *
 * BATIMENT et POINT sont déjà disponibles (définis dans scan.php, chargés avant ce fichier).
 *
 * Rappel du mécanisme attendu (cahier des charges, section 4) :
 *   1. Construire une clé de stockage unique pour ce point de scan
 *      (elle doit dépendre à la fois de BATIMENT et de POINT)
 *   2. Vérifier si le navigateur a déjà cette clé en localStorage
 *   3a. Si oui  -> afficher directement la valeur stockée, SANS appeler generate.php
 *   3b. Si non  -> appeler generate.php en fetch, récupérer le nombre renvoyé,
 *                  le stocker en localStorage, puis l'afficher
 */

const numberEl = document.getElementById("number");

// TODO 1 : construire une clé de stockage unique à partir de BATIMENT et POINT
// Indice : une simple concaténation de chaînes suffit, ex. "scan_" + BATIMENT + "_" + POINT
const storageKey = 'scan_' + BATIMENT + '_' + POINT; // TODO

// TODO 2 : vérifier si cette clé existe déjà dans localStorage
// Indice : localStorage.getItem(storageKey) renvoie null si la clé n'existe pas
const storedKey = localStorage.getItem(storageKey);

// TODO 3a : si elle existe déjà -> afficher sa valeur dans numberEl.textContent
if (storedKey !== null) {
    numberEl.textContent = storedKey
} else {
// TODO 3b : si elle n'existe pas -> appeler generate.php avec fetch(), récupérer le nombre, le stocker avec localStorage.setItem(storageKey, ...), puis l'afficher
// Indice fetch :
//   fetch(`generate.php?batiment=${BATIMENT}&point=${POINT}`)
//     .then(reponse => reponse.text())
//     .then(nombre => {
//       // ... stocker et afficher nombre
//     });
    fetch(`generate.php?batiment=${BATIMENT}&point=${POINT}`)
    .then(reponse => reponse.text())
    .then(nombre => {
        localStorage.setItem(storageKey, nombre)
        numberEl.textContent = nombre;
    });
}




