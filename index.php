<?php
    require_once('inc/head.php');

    if($_POST)
    {
        debug($_POST);
        debug($_FILES);

        if(isset($_POST["inscription"]))
        {
            if(empty($_POST['prenom']) || empty($_POST['nom']))
            {
                $msg .= "<div class='alert alert-danger'>Veuillez rentrer un prénom et un nom valide.</div>";
            }

            // check email
            if (!empty($_POST['email'])) 
            {
                $email_verif = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

                $forbidden_mails = [
                        'mailinator.com',
                        'yopmail.com',
                        'mail.com'
                ];

                $email_domain = explode('@', $_POST['email']);

                if(!$email_verif || in_array($email_domain[1], $forbidden_mails))
                {
                        $msg .= "<div class='alert alert-danger'>Please enter a valid email.</div>";
                }

            }
            else
            {
                $msg .= "<div class='alert alert-danger'>Veuillez rentrer un email valide.</div>";
            }

            // check mot de passe
            if(!empty($_POST['mdp']) && !empty($_POST['mdp2'])) 
            {
                $verif_mdp = preg_match('#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*\'\?$@%_])([-+!*\?$\'@%_\w]{6,30})$#', $_POST['mdp']);

                if(!$verif_mdp)
                {
                    $msg .= "<div class='alert alert-danger'>Attention, votre mot de passe doit être composé de 5 à 30 caractères et doit contenir au moins une lettre minuscule & majuscule,un chiffre ainsi qu'un caractère spécial (- + ! * ? ' $ @ % ou _).</div>";
                }

                if($_POST['mdp'] != $_POST['mdp2'])
                {
                    $msg .= "<div class='alert alert-danger'>Attention, vos deux mots de passe ne sont pas identiques. Veuillez les rentrer à nouveau.</div>";
                }

            }
            else
            {
                $msg .= "<div class='alert alert-danger'>Veuillez rentrer un mot de passe valide et le confirmer.</div>";
            }

            if(empty($_POST['famille']) && ($_POST['famille'] != "rc") || ($_POST['famille'] != "s"))
            {
                $msg .= "<div class='alert alert-danger'>Veuillez choisir une des familles présentées.</div>";
            }

            if(!empty($_FILES['photoprofil']['name'])) 
            {
                $picture_name = $_POST['prenom'] . '-' . $_POST['nom'] . '_' . time() . '-' . rand(1,999) .  '_' . $_FILES['photoprofil']['name'];

                $picture_name = str_replace(' ', '-', $picture_name);
                
                $picture_path = ROOT_TREE . 'uploads/photoprofil/' . $picture_name;

                $max_size = 1000000;

                if($_FILES['photoprofil']['size'] > $max_size || empty($_FILES['photoprofil']['size']))
                {
                    $msg .= "<div class='alert alert-danger'>Veuillez sélectionner une photo de 1Mo maximum</div>";
                }

                $type_picture = ['image/jpeg', 'image/png', 'image/gif'];
                
                if(!in_array($_FILES['photoprofil']['type'], $type_picture) || empty($_FILES['photoprofil']['type']))
                {
                    $msg .= "<div class='alert alert-danger'>Veuillez sélectionner un fichier JPEG/JPG, PNG ou GIF.</div>";
                }

            }
            else
            {
                $picture_name = "default.jpg";
            }

            if(empty($msg))
            {
                if(!isset($picture_path) && empty($_FILES['photoprofil']['tmp_name']))
                {
                    $picture_path = "";
                    $copy_pic = "";
                }
                else 
                {
                    $copy_pic = $_FILES['photoprofil']['tmp_name'];
                }

                debug($copy_pic);

                insertMember($_POST, $picture_name, $picture_path, $copy_pic);
            }
        }
        
    }
?>
    
    <div class="text-center">

        <div>
            <img class="mb-4" src="assets/img/globe.png" alt="Le monde est rempli d'amis" width="72" height="72">
        </div>
        

        <h1>Bienvenue à vous !</h1>

        <h3>Souhaitez-vous vous <em>inscrire</em> <br>ou vous <em>connecter</em> à la plateforme <br>?</h3>

        <?= $msg ?>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body homeCardbox">
                        <h5 class="card-title">Je souhaite m'inscrire.</h5>
                        <p class="card-text">Veuillez cliquer sur le bouton ci-dessous, remplir et envoyer le formulaire avant d'informer l'administrateur que votre compte est en attente de validation.</p>
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalInscription">Je m'inscris</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                <div class="card-body homeCardbox">
                    <h5 class="card-title">Je souhaite me connecter.</h5>
                    <p class="card-text">Suite à la validation de votre compte, ils ne vous reste qu'à rentrer vos information pour profiter de la plateforme.</p>
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalConnexion">Je me connecte</a>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Inscription -->
        <div class="modal fade" id="modalInscription" tabindex="-1" role="dialog" aria-labelledby="modalInscriptionLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInscriptionLabel">Inscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <form action="" method="post" enctype="multipart/form-data">
            
                    <h1 class="h3 mb-3 font-weight-normal">Veuillez rentrer les informations suivantes et renvoyer le formulaire avant de prévenir l'administrateur.</h1>

                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Votre prénom" required>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Votre nom" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Adresse email" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="mdp">Mot de passe</label>
                        <small id="mdpHelp" class="form-text text-muted">Votre mot de passe doit être composé de 5 à 30 caractères et doit contenir au moins une lettre minuscule & majuscule,un chiffre ainsi qu'un caractère spécial <br>(- + ! * ? ' $ @ % ou _).</small>
                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Mot de passe" required>
                        <label for="mdp2" class="sr-only">Confirmez votre mot de passe</label>
                        <input type="password" name="mdp2" id="mdp2" class="form-control" placeholder="Confirmation du mot de passe" required>
                    </div>
                    <div class="form-group">
                        <label for="photoprofil">Votre photo de profil</label>
                        <small id="mdpHelp" class="form-text text-muted">Ceci n'est pas obligatoire, nous vous fournirons une photo de profil par défaut</small>
                        <input type="file" class="form-control-file" name="photoprofil" id="photoprofil">
                    </div>

                    <div class="form-group">
                        <label for="famille">Sélectionnez votre famille</label>
                        <select class="form-control" id="famille" name="famille">
                            <option selected disabled>Sélectionner</option>
                            <option value="rc">Robert-Casanova</option>
                            <option value="s">Sarron</option>
                        </select>
                    </div>

                    <div class="g-recaptcha" data-sitekey="6LeedGcUAAAAAL91FbcMppM-QnoXTsfDKCOdmnjh"></div>

                    <input type="submit" value="GO" class="btn btn-lg btn-warning btn-block" name="inscription">
                </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Connexion -->
        <div class="modal fade" id="modalConnexion" tabindex="-1" role="dialog" aria-labelledby="modalConnexionLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConnexionLabel">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <form action="" method="post">
            
                    <h1 class="h3 mb-3 font-weight-normal">Veuillez rappeler votre adresse email ainsi que votre mot de passe.</h1>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Adresse email" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Mot de passe" required>
                    </div>

                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me" name="toujoursConnecte"> Garder ma session ouverte
                        </label>
                    </div>

                    <input type="submit" value="GO" class="btn btn-lg btn-info btn-block" name="connexion">
                </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
                </div>
            </div>
        </div>



    </div>

<?php
    require_once('inc/foot.php');
?>