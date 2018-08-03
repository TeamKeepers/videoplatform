<?php 
    require_once('../inc/ini/init.php');
    require_once('../inc/function.php');
    require_once('../inc/ini/function_dtb.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="TeamKeepers - Guillaume">

    <link rel="icon" href="../assets/img/globe.png">

    <title>Vidéo & Photo</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">Le projet</h4>
              <p class="text-muted">Ce site a pour vocation de réunir des vidéos.</p>
              <h6><a href="mailto:" class="text-white">Contacter l'Admin</a></h6>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Rechercher par:</h4>
              <ul class="list-unstyled">
                <li><a href="?media=video" class="text-white">Vidéos</a></li>
                <li><a href="?media=photo" class="text-white">Photos</a></li>    
              </ul>

              <form action="" method="get">
                <div class="form-group">
                   <label for="annee" class="text-white">Année</label>
                  <select name="annee" id="annee" class="form-control">
                    <?php for($i=date("Y"); $i >= 1980 ; $i--) : ?>
                      <option value="<?=$i?>"><?= $i ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
                <input type="submit" class="btn btn-primary" value="GO">
              </form>
                
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="dashboard.php" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Media platform</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">