<?php
session_start();

require_once(realpath(dirname(__FILE__)) . '/php/component/GeneratorViewComponents.php');
require_once(realpath(dirname(__FILE__)) . '/php/model/Article.php');

$view = new GeneratorViewComponents();

?>

<html lang="en">
<head>
    <title>Blogpost generator</title>
    <meta charset="utf-8">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro:700|Dosis:700|Montserrat:400|Fira+Sans"
          rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <script type="text/javascript" async
            src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML"></script>
</head>
<body style="max-width: 1024px; margin: 0 auto;">
<h3>Blogpost generator `x^2`</h3>

<div class="row">

    <div class="col s6">
        <?php echo $view->getImageLoaderView(); ?>
    </div>

    <div class="col s6">
        <img id="image-view" src="" style="background-color: grey; width: 320px; height: 213px;"/>
    </div>

</div>

<form>
    <div class="row">
        <div class="col s6">
            <?php echo $view->getTimeView(); ?>
        </div>
        <div class="col s6">
            <?php echo $view->getSectionView(); ?>
        </div>
        <div class="col s12">
            <?php echo $view->getTitleView(); ?>
        </div>
        <div class="col s12">
            <?php echo $view->getDescriptionView(); ?>
        </div>
    </div>

    <h3>Content</h3>

    <?php echo $view->getModalView(); ?>
    <div class="row">
        <div class="col s6">
            <div id="component-view"></div>
        </div>
        <div class="col s6">
            <p class="center">Preview<a class="waves-effect waves-teal btn-flat" onclick="updatePreview();">
                    <i class="material-icons left">autorenew</i></a>
            </p>
            <div id="preview"></div>
        </div>
    </div>
    <?php echo $view->getNewComponentButtonView(); ?>
    <?php echo $view->getDropDataButtonView(); ?>
    <?php echo $view->getDeleteComponentsSection(); ?>
    <?php echo $view->getPublishButtonView(); ?>
</form>


<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="js/post_generator.js"></script>
</body>
</html>