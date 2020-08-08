<?php

namespace App;
use App\Controller\BackofficeController;
use App\Controller\FrontofficeController;
use App\Controller\SecurityController;
use App\Service\Sanitizer;


class Router
{

    private $db;
    private $path = array('');
    private $global;
    private $sanitizer;
    private $post;
    private $sesssion;

    /**
     * Router constructor.
     * @param $db
     * @param $global
     * @throws \Exception
     */
    public function __construct($db, $global)
    {
        $this->db = $db;
        $this->global = $global;
        $this->sanitizer = new Sanitizer();
    }

    public function dispatch() {
        $path = $this->parse();

        //3 controleurs
        //back --> /admin
        //front -->
        //security --> /inscription /connection

        if (isset($this->global['_POST'])) {
            $this->post = $this->global['_POST'];
        }
        if (isset($this->global['_SESSION'])) {
            $this->sesssion = $this->global['_SESSION'];
        }
        if (isset($this->post['logout'])) {
            $disconnect = new SecurityController($this->post, $this->sesssion, $this->db);
            $disconnect->logout();
        } elseif (isset($this->sesssion['last_name']) && isset($this->sesssion['first_name']) && isset($this->sesssion['user_id'])) {
            if (isset($this->sesssion['admin_token'])) {
                $bc = new BackofficeController($this->path, $this->post, $this->sesssion, $this->db);
            } elseif (!isset($path[2])) {
                if ($path[1] == '' || $path[1] == 'index.php') {
                    $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                    $fc->getPageAccueil();
                } elseif ($path[1] == 'profil') {
                    $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                    $fc->getPageProfil();
                } elseif ($path[1] == 'mentions_legales') {
                    $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                    $fc->getPageMentionsLegales();
                } elseif ($path[1] == 'cgdv') {
                    $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                    $fc->getPageCGDV();
                } else {
                    throw new \Exception('Pas de route trouvée !');
                }
            } elseif (isset($path[2])) {
                if (!isset($path[4])) {
                    if ($path[1] == 'annonces') {
                        $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                        if ($path[3] == 'commenter') {
                            $fc->getPageCommenter();
                        } elseif (isset($path[3])) {
                            throw new \Exception('Pas de route trouvée !');
                        } else {
                            $fc->getPageAnnonce();
                        }
                    } elseif ($path[1] == 'vos_annonces') {
                        $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                        if (!isset($path[3])) {
                            if ($path[2] == 'deposer_annonce') {
                                $fc->getPageDeposerAnnonce();
                            } elseif(!isset($path[2])) {
                                $fc->getPageVosAnnonces();
                            } else {
                                $fc->getPageVotreAnnonce();
                            }
                        } elseif (isset($path[3])){
                            if ($path[3] == 'editer') {
                                $fc->editerAnnonce();
                            } else {
                                throw new \Exception('Pas de route trouvée !');
                            }
                        } else {
                            throw new \Exception('Pas de route trouvée !');
                        }
                    } else {
                        throw new \Exception('Pas de route trouvée !');
                    }
                } else {
                    throw new \Exception('Pas de route trouvée !');
                }
            }
        } elseif (isset($this->post['pseudo']) && ($this->post['password']) && ($this->post['lastname']) && ($this->post['firstname']) && ($this->post['email']) && ($this->post['phone_number']) && ($this->post['civilite'])) {
            $sc = new SecurityController($this->post, $this->sesssion, $this->db);
            $sc->createNewMembre();
        } elseif (isset($this->post['login']) && ($this->post['l-password'])) {
            $sc = new SecurityController($this->post, $this->sesssion, $this->db);
            $sc->logUser();
        } elseif (!isset($path[2])) {
            if ($path[1] == '' || $path[1] == 'index.php') {
                $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                $fc->getPageAccueil();
            } elseif ($path[1] == 'connexion') {
                $connexionPage = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                $connexionPage->getPageConnexion();
            } elseif ($path[1] == 'inscription') {
                $inscriptionPage = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                $inscriptionPage->getPageInscription();
            } elseif ($path[1] == 'mentions_legales') {
                $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                $fc->getPageMentionsLegales();
            } elseif ($path[1] == 'cgdv') {
                $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                $fc->getPageCGDV();
            } else {
                throw new \Exception('Pas de route trouvée !');
            }
        } elseif (isset($path[2])) {
            if (!isset($path[4])) {
                if ($path[1] == 'annonces') {
                    $fc = new FrontofficeController($this->path, $this->post, $this->sesssion, $this->db);
                    $fc->getPageAnnonce();
                } else {
                    throw new \Exception('Pas de route trouvée !');
                }
            } else {
                throw new \Exception('Pas de route trouvée !');
            }
        } else {
            throw new \Exception('Pas de route trouvée !');
        }
    }

    /**
     * @return false|string[]
     * si j'ai demandé locahost/annonces/4/edit
     * Il doit me retourner un array ['annonces', '4', 'edit']
     */
    private function parse()
    {
        $sanitizedPath = $this->sanitizer->sanitizeString($this->global['_SERVER']['REQUEST_URI']);
        $explodedPath = explode("/", $sanitizedPath);
        return $explodedPath;
        //un bon gros explode autour des /
        //explode doit te rendre les mots de l'url dans un tableau
        //return le tableau

        //http://localhost/security
            //http://localhost/login
            //http://localhost/register
            //http://localhost/profil
            //http://localhost/etc....
        //http://localhost/annonces
            //http://localhost/annonces/[id] (show)
            //http://localhost/annonces/[id] (comment/vote)(edit comment/vote)
        //http://localhost/vos_annonces/
            //http://localhost/vos_annonces/create
            //http://localhost/vos_annonces/[id] (show)
            //http://localhost/vos_annonces/[id]/edit (pour l'édition)
        //http://localhost/admin
            //http://localhost/admin/stats
            //http://localhost/admin/annonces
            //http://localhost/admin/categories
            //http://localhost/admin/notes
            //http://localhost/admin/membres

    }
}