# Squelette — Projet « Scan Mystère »

Ce dossier est un point de départ, pas une solution. Il vous fait gagner du temps sur
la partie qui n'a aucun intérêt pédagogique (arborescence, page HTML, feuille de style)
pour que vous concentriez votre semaine sur la partie qui compte : le mécanisme de
persistance sans cookie ni base de données (cahier des charges, section 4).

## Arborescence fournie

```
scan-mystere/
├── scan.php        # page affichée après le scan — TODO : lire batiment/point dans l'URL
├── generate.php     # génère le nombre et l'écrit dans le CSV — TODO : toute la logique
├── scan.js          # décide d'appeler generate.php ou pas — TODO : toute la logique
├── style.css         # fourni complet, rien à faire ici
└── data/
    └── scans.csv      # déjà créé, avec uniquement la ligne d'en-têtes
```

## Ce qui est déjà fait pour vous

- la structure des fichiers et leurs rôles respectifs
- la page HTML et son style (mobile-first)
- le fichier CSV avec ses en-têtes
- le fil du raisonnement, en commentaires `TODO`, dans chaque fichier

## Ce qu'il vous reste à faire

Trois blocs de logique, exactement ceux décrits section 4 du cahier des charges :

1. **`scan.php`** — récupérer `batiment` et `point` depuis l'URL
2. **`scan.js`** — vérifier le localStorage, et n'appeler `generate.php` que si nécessaire
3. **`generate.php`** — générer le nombre, calculer l'identifiant auto-incrémenté, écrire
   la ligne dans `data/scans.csv`

Chaque fichier contient des commentaires `TODO` numérotés avec des indices (noms de
fonctions à chercher), mais pas de code prêt à copier.

## Pour tester en local

Une fois les TODO complétés, une URL de test ressemble à :

```
scan.php?batiment=Batiment_6&point=1
```

Testez bien le rescan du même lien depuis le même téléphone : le nombre affiché ne doit
pas changer. Testez aussi deux points différents : les nombres doivent être différents.

## Rappels de contraintes (ne pas s'en écarter)

- pas de cookie
- pas de base de données — uniquement le fichier CSV
- pas d'authentification
- une seule ligne par terminal et par point, même en cas de rescan
