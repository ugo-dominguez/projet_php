# Présentation du projet :
L'application a été développé en PHP.  
C'est une application permetant de présenter un Quizz à partir d'un fichier .json  
Le groupe est constitué de : Ugo DOMINGUEZ et Jules GRUSON--DELANNOY.  

# Comment lancer l'application ?
Il vous suffit d'exécuter la commande suivante à la racine du projet :
```bash
  $ php -S localhost:8000 -t public
```

Un fichier .json de base est fournit dans le projet, vous pourrez baser de potentiel nouveaux QCM sur ce fichier.  
Pour utiliser un fichier .json en particulier, il suffit de modifier la variable `$quizzFile` dans le fichier `index.php`.  

# Fonctionnalités :
- Organisation du code dans une arborescence cohérente
- Utilisation des namespaces
- Utilisation d’un provider pour charger le fichier JSON contenant les questions et leurs réponses
- Utilisation d'un autoloader pour charger les classes d’objets nécessaires
- Utilisation de sessions pour stocker les réponses fournies par les utilisateurs et calculer un score.
- Utilisation de classes PHP pour programmer votre application orientée objet
- Utilisation d’un contrôleur dans index.php piloté par GET['action']
- Un import/export de quizz et de questions en JSON

# Fonctionnalités non-ajoutées :
- Utilisation de PDO avec base de données sqlite pour stocker le score et le nom du joueur
- Ajoutez la possibilité de configurer le nombre de questions par quiz
- Ajouter éventuellement un système de login et de gestion des utilisateurs.
- Ajouter éventuellement un CRUD sur les quizz et les questions.

# Détails :
Une IA (Claude) a été utilisée pour générer une partie de CSS et pour s'informer sur l'utilisation de composer.
