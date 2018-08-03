<?php 

    require_once('inc/back_head.php');

    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
    {
        $media = selectMediaById($_GET['id']);

        debug($media);

        if($media["tag_media"] == "video")
        {   
            $content .= '<div class="embed-responsive embed-responsive-21by9">';
                $content .= '<video width="320" height="240" controls>';
                    $content .= '<source src="uploads/video/' . $media['media'] . '" type="video/mp4">';
                    $content .= 'Your browser does not support the video tag.';
                $content .= '</video>';
            $content .= '</div>';
        }
        else
        {

        }

    }

?>

    <?= $content ?>

<?php require_once('inc/back_foot.php') ?>