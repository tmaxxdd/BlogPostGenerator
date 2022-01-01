<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/component/Components.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/generator/ComponentsGenerator.php');

if ($_POST['ajax']) {
    
        if($_POST['component']){
            $components = new Components();
            switch($_POST['component']) {
                case "header":
                    $components->addComponent("header");
                    break;
                case "text":
                    $components->addComponent("text");
                    break;
                case "image":
                    $components->addComponent("image");
                    break;
                case "code":
                    $components->addComponent("code");
                    break;
                case "link":
                    $components->addComponent("link");
                    break;
                case "table":
                    $components->addComponent("table");
                    break;
            }
            
            $generator = new ComponentsGenerator();
            echo $generator->getComponentsViews($components->getComponents());
            
        } else {
            http_response_code(500);
        }
    
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}