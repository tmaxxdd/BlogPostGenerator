<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/component/Components.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/generator/ComponentsGenerator.php');

if ($_POST['ajax']) {
    
    $components = new Components();
    
    if(isset($_POST['position'])){
        $components->removeComponent(intval($_POST['position']));
    } else {
        $components->resetComponents();
    }
    
    $generator = new ComponentsGenerator();
    echo $generator->getComponentsViews($components->getComponents());

}