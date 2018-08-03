<?php 
  require_once('inc/back_head.php');
  $medium = selectMedium($_SESSION['member']['family']);

  foreach ($medium as $media) // we request all the medium from the database to display the results
  {
    $content .= '<div class="col-md-4">';
      $content .= '<a class="clickBoxes" href="media_page.php?id=' . $media['id_media'] . '">';
        $content .= '<div class="card mb-4 shadow-sm">';
        $content .= '<img class="card-img-top" src="uploads/img/' . $media['img_media'] . '" alt="' . $media['title'] . '">';
            $content .= '<div class="card-body">';
                $content .= '<p class="card-text">' . $media['description'] . '</p>';
                $content .= '<small class="text-muted">' . date("d-m-Y", strtotime($media['date_event'])) . '</small>';
                $content .= '<div class="d-flex justify-content-between align-items-center">';
                    // $content .= '<div class="btn-group">';
                    //     $content .= '<button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>';
                    //     // $content .= '<button type="button" class="btn btn-sm btn-outline-secondary">Liker</button>';
                    // $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
        $content .= '</div>';
      $content .= '</a>';
    $content .= '</div>';
  }

?>

  <section class="jumbotron text-center" id="welcomer">
    <div class="container" id="welcomer-text">
      <h1 class="jumbotron-heading">Bienvenue !</h1>
      <p class="lead text-muted">C'est un grand plaisir de vous accueillir sur cette plateforme. Profitez de tout le contenu et n'hésitez pas à écrire à l'Admin pour toute remarque via le menu cliquable en haut à droite.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Voir les vidéos</a>
        <a href="#" class="btn btn-secondary my-2">Voir les photos</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">

        <?= $content ?>
        
      </div>
    </div>
  </div>

<?php require_once('inc/back_foot.php') ?>