<?php

namespace App;
use App\Controller\BackofficeController;
use App\Controller\FrontofficeController;
use App\Service\Sanitizer;
use App\Service\UserManager;

class Router
{
    const PATH_CONNEXION = 'connexion';
    const PATH_INSCRIPTION = 'inscription';
    const PATH_ACCUEIL = 'accueil';

    private $db;
    private $path;
    private $sessionLastName;
    private $sessionFirstName;
    private $sessionUserId;
    private $server;

    /**
     * Router constructor.
     * @param null $path
     * @throws \Exception
     */
    public function __construct($db, $server)
    {
        $this->db = $db;
        $this->server = $server;
    }

    public function dispatch() {
        $path = $this->parse();
        if ($path[0] == 'admin') {
            $bo = new BackofficeController($path, $this->server, $this->db);
        }

        //3 controleurs
        //back --> /admin
        //front -->
        //security -->

        if (isset($_POST['deconnexion'])) {
            $sanitizedPostDeconnexion = htmlspecialchars($_POST['deconnexion']);
            $this->path = $sanitizedPostDeconnexion;
            //deconnexion();
        }
        elseif (isset($_SESSION['last_name']) && isset($_SESSION['first_name']) && isset($_SESSION['user_id'])) {
//            $sanitizedFirstName = htmlspecialchars($_SESSION['last_name']);
//            $this->sessionFirstName = $sanitizedFirstName;
//            $sanitizedFirstName = htmlspecialchars($_SESSION['first_name']);
//            $this->sessionFirstName = $sanitizedFirstName;
//            $sanitizedFirstName = htmlspecialchars($_SESSION['user_id']);
//            $this->sessionFirstName = $sanitizedFirstName;
            if (isset($_GET['page'])) {
                $sanitizedPath = htmlspecialchars($_GET['page']);
                $this->path = $sanitizedPath;
                if ($_GET['page'] == 'deconnexion') {
                    //deconnexion();
                }
                elseif ($_GET['page'] == 'mentionslegales') {
                    //mentionslegales();
                }
                elseif ($_GET['page'] == 'contact') {
                    //contact();
                }
                elseif ($_GET['page'] == 'parametrescompte') {
                    //paramCompte($_SESSION['user_id']);
                }
                elseif (($_GET['page'] == 'acteur') && (isset($_GET['acteurid']))) {
                    if (isset($_POST['commentaire'])) {
                        //postCommentaire($_GET['acteurid'], $_SESSION['user_id'], htmlspecialchars($_POST['commentaire']));
                    }
                    elseif (isset($_POST['like'])) {
                        //postLike($_GET['acteurid'], $_SESSION['user_id']);
                    }
                    elseif (isset($_POST['dislike'])) {
                        //postDislike($_GET['acteurid'], $_SESSION['user_id']);
                    }
                    //acteur($_GET['acteurid'], $_SESSION['user_id']);
                }
                elseif ($_GET['page'] == 'paramcompte') {
                    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['user_name'])) {
                        //modifierIdentite(htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom']), htmlspecialchars($_POST['user_name']), $_SESSION['user_id']);
                    }
                    elseif (isset($_POST['mdp']) && isset($_POST['confirm_mdp'])) {
                        //modifierMotDePasse(htmlspecialchars($_POST['mdp']), htmlspecialchars($_POST['confirm_mdp']), $_SESSION['user_id']);
                    }
                    elseif (isset($_POST['question']) && isset($_POST['reponse'])) {
                        //modifierQuestionReponse(htmlspecialchars($_POST['question']), htmlspecialchars($_POST['reponse']), $_SESSION['user_id']);
                    }
                    else {
                        //paramCompte($_SESSION['user_id']);
                    }
                }
                else {
                    //pageNonTrouvee();
                }
            }
            else {
                //pageActeurs();
            }
        } elseif (isset($_POST['pseudo']) && ($_POST['password']) && ($_POST['lastname']) && ($_POST['firstname']) && ($_POST['email']) && ($_POST['phone_number']) && ($_POST['sex'])) {
            $sanitizedPostValues = new Sanitizer([$_POST['pseudo'], $_POST['password'], $_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['phone_number'], $_POST['sex']]);
            $backofficeController = new BackofficeController($this->db);
            $backofficeController->registerNewUser($sanitizedPostValues->sanatizedItems);
        }
        elseif (isset($this->get['page'])) {
            $sanitizedPath = new Sanitizer([$_GET['page']]);
            $this->path = $sanitizedPath->sanatizedItems[0];
            if ($this->path == self::PATH_CONNEXION) {
                $pageConnexion = new FrontofficeController(self::PATH_CONNEXION);
                $pageConnexion->getPageConnexion();
            } elseif ($this->path == self::PATH_INSCRIPTION) {
                $pageInscription = new FrontofficeController(self::PATH_INSCRIPTION);
                $pageInscription->getPageInsciption();
            }
            elseif ($_GET['page'] == 'oublimdp') {
                if (isset($_POST['userNameMdpReset'])) {
                    //reinitMdpQuestion(htmlspecialchars($_POST['userNameMdpReset']));
                }
                elseif (isset($_POST['reponseMdpReset'])) {
                    //reinitMdpReponse($_SESSION["userName"],htmlspecialchars($_POST['reponseMdpReset']));
                }
                elseif ((isset($_POST['nouveauMdp'])) && (isset($_POST['confirmNouveauMdp']))) {
                    //reinitMdpNouveauMdp($_SESSION["userName"], htmlspecialchars($_POST['nouveauMdp']), htmlspecialchars($_POST['confirmNouveauMdp']));
                }
                else {
                    //reinitMdp();
                }
            }
            elseif ($_GET['page'] == 'mentionslegales') {
                //mentionslegales();
            }
            elseif ($_GET['page'] == 'contact') {
                //contact();
            }
            else {
                echo 'nul part get page';
            }
        }
        elseif (isset($_POST['nom']) && ($_POST['prenom']) && ($_POST['userName']) && ($_POST['mdp']) && ($_POST['confirmMdp']) && ($_POST['questionSecrete']) && ($_POST['reponseSecrete'])) {
            $inscription = new BackofficeController();
            $pageAccueil = new FrontofficeController(self::PATH_ACCUEIL);
            $pageAccueil->getPageAccueil();
            //nouvelUtilisateur(htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom']), htmlspecialchars($_POST['userName']), htmlspecialchars($_POST['mdp']), htmlspecialchars($_POST['confirmMdp']), htmlspecialchars($_POST['questionSecrete']), htmlspecialchars($_POST['reponseSecrete']));
        }
        elseif ((isset($_POST['identifiant'])) && (isset($_POST['motDePasse']))) {
            //connexion(htmlspecialchars($_POST['identifiant']), htmlspecialchars($_POST['motDePasse']));
            //pageActeurs();
        }
        else {
            throw new \Exception('nul part de chez nul part');
        }
//        if ($this->path == self::PATH_CONNEXION) {
//            $pageConnexion = new FrontofficeController(self::PATH_CONNEXION);
//            $pageConnexion->getPageConnexion();
//        } elseif($this->path == self::PATH_INSCRIPTION) {
//            $pageInscription = new FrontofficeController(self::PATH_INSCRIPTION);
//            $pageInscription->getPageInsciption();
//        } elseif($this->path == self::PATH_ACCUEIL || $this->path == null) {
//            $pageAccueil = new FrontofficeController(self::PATH_ACCUEIL);
//            $pageAccueil->getPageAccueil();
//        } else {
//            //Ici on suppose qu'aucune route n'a matché donc c'est plutôt une erreur métier
//            throw new \Exception("Pas de route trouvée !");
//        }
    }

    /**
     * @return array|bool
     * si j'ai demandé locahost/annonces/4/edit
     * Il doit me retourner un array ['annonces', '4', 'edit']
     */
    private function parse(): array
    {
        //un bon gros explode autour des /
        //ton explode doit te rendre les mots de l'url dans un tableau
        //return le tableau

        //http://localhost/security
            //http://localhost/security/login
            //http://localhost/security/register
            //http://localhost/security/profil
            //http://localhost/security/etc....
        //http://localhost/annonces
            //http://localhost/annonces/index
            //http://localhost/annnonces/[id] (show)
            //http://localhost/annonces/create
            //http://localhost/annonces/[id]/edit (pour l'édition)
        //http://localhost/admin
            //http://localhost/admin/stats
            //http://localhost/admin/annonces
            //http://localhost/admin/categories
            //http://localhost/admin/notes
            //http://localhost/admin/membres

        //ce qui est en dessous c'est foiré
        //du post
            //login
            //register
            //tous les formulaires genre noter une annonce, poster une annonce, ...

        //du get
            //récupérer toutes les pages.

        return [
            'admin',
            'stats',
        ];
    }

    public function __toString()
    {
        return $this->path;
    }


}