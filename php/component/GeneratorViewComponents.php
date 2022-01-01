<?php

class GeneratorViewComponents
{

    function __construct()
    {

    }

    function getSectionView()
    {
        return
            '<h5>Section</h5>'
            . '*Input a section name for the article'
            . '<div class="input-field">'
            . '<textarea id="section" class="materialize-textarea" data-length="20"></textarea>'
            . '<label for="section">Input e.g. Kotlin, Android</label>'
            . '</div>';
    }

    function getTimeView()
    {
        return '<h5>Time</h5>'
            . '<input id="picker_date" type="text" class="datepicker">'
            . '<label for="picker_date" class="">Input a date</label>'
            . '<input id="picker_time" type="text" class="timepicker">'
            . '<label for="picker_time" class="">Input a time</label>';
    }

    function getImageLoaderView()
    {
        return
            '<h5>Photo</h5>'
            . '<form id="upload-image" action="/upload_image.php" method="post" enctype="multipart/form-data">'
            . 'Select image to upload:'
            . '<br>'
            . '<input type="file" name="fileToUpload" id="fileToUpload">'
            . '<br>'
            . 'Image name:'
            . '<br>'
            . '<div class="input-field">'
            . '<input id="image-name-input" type="text" name="image_name">'
            . '</div>'
            . '<br>'
            . '<input type="submit" value="Upload Image" name="submit">'
            . '<br>'
            . '<div id="form-messages"></div>'
            . '<br>'
            . '</form>';
    }

    function getTitleView()
    {
        return
            '<h5>Title</h5>'
            . '* Title will be a H1 header and metadata title'
            . '<div class="input-field">'
            . '<textarea id="title" class="materialize-textarea" data-length="60"></textarea>'
            . '<label for="title">Input a title. Remember about series!</label>'
            . '</div>'
            . '<br>';
    }

    function getDescriptionView()
    {
        return
            '<h5>Description</h5>'
            . '* Description will be an introduction in the article and description in a metadata'
            . '<br>'
            . '<div class="input-field">'
            . '<textarea id="description" class="materialize-textarea" data-length="160"></textarea>'
            . '<label for="description">Input the description. Remember about the keywords!</label>'
            . '</div>';
    }

    function getModalView()
    {
        return
            '<div id="component-modal" class="modal" style="height: 80%;">'
            . '<div class="modal-content">'
            . '<h4>Select a component</h4>'
            . '<div class="input-field col s12">'
            . '<select id="select-component">'
            . '<option value="" disabled selected>Select a component</option>'
            . '<option value="header">Header</option>'
            . '<option value="text">Text</option>'
            . '<option value="image">Photo</option>'
            . '<option value="code">Gist</option>'
            . '<option value="link">Link</option>'
            . '<option value="table">Table</option>'
            . '</select>'
            . '</div>'
            . '</div>'
            . '<div class="modal-footer">'
            . '<a id="select-btn" class="modal-close waves-effect waves-green btn-flat">Select</a>'
            . '</div>'
            . '</div>';
    }

    function getNewComponentButtonView()
    {
        return
            '<br>'
            . '<div style="text-align: center;">'
            . '<button data-target="component-modal" class="btn modal-trigger" href="#component-modal">Add a component</button>'
            . '</div>'
            . '<br>';
    }

    function getDeleteComponentsSection()
    {
        return
            '<br>'
            . '<div style="text-align: right;">'
            . '<button id="delete-all-component" class="btn red white-text">Delete all components</button>'
            . '</div>';
    }

    function getDropDataButtonView()
    {
        return
            '<br>'
            . '<div style="text-align: left;">'
            . '<button onclick="dropData();" class="btn green">Drop snapshot</button>'
            . '</div>'
            . '<br>';
    }

    function getPublishButtonView()
    {
        return '<br>'
            . '<div style="text-align: center;">'
            . '<button onclick="publish();" class="btn green">Publish</button>'
            . '</div>'
            . '<br>';
    }

}