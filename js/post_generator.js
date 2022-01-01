/* Uploading an image */

$(function () {
    // Get the form.
    var form = $('#upload-image');

    // Get the messages div.
    var formMessages = $('#form-messages');

    var imageView = $('#image-view');

    // Set up an event listener for the contact form.
    $(form).submit(function (event) {
        // Stop the browser from submitting the form.
        event.preventDefault();

        //Reset previous image
        $(imageView).attr('src', "");

        // Serialize the form data.
        var formData = $(form).serialize();

        var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];
        fd.append('file', files);
        fd.append('image_name', $('#image-name-input').val());

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: fd,
            contentType: false,
            processData: false
        }).done(function (response) {
            console.log("Response from image: " + response);
            var data = JSON.parse(response);
            $(formMessages).text(data.message);
            //Update the preview's image
            $(imageView).attr('src', data.image_path);
        }).fail(function (data) {
            // Set the message text.
            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('Oops! An error occurred and your image could not be uploaded.');
            }
        });
    });

});

var componentsData = {};

/* Modal with the component options */

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('#component-modal');
    var instances = M.Modal.init(elems);
});

/* Components options */

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});

/* Delete old component on start */

$(document).ready(function () {
    componentsData = {};
    deleteAllComponents();
});

/* Datepicker */

var datePickerOptions = {
    defaultDate: Date(),
    setDefaultDate: true,
    format: 'yyyy-mm-dd',
    autoClose: true,
};


document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, datePickerOptions);
    var elem = $('.datepicker').first();
    var instance = M.Datepicker.getInstance(elem);
    instance.setDate(new Date());
});

/* Timepicker */

var timePickerOptions = {
    defaultTime: "now",
    twelveHour: false,
    autoClose: true,
    showClearBtn: true
};

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.timepicker');
    var instances = M.Timepicker.init(elems, timePickerOptions);
    var elem = $('.timepicker').first();
    var instance = M.Timepicker.getInstance(elem);
    instance.clear();
});

/* Detect refreshing page */

window.onbeforeunload = function (e) {
    return 'Are you sure you want to leave? You are in the middle of writing.';
};

$(document).ready(function () {
    $('#delete-all-component').click(function (event) {

        if (confirmModal("Do you really want to DELETE ALL elements?")) {
            // Stop the browser from submitting the form.
            event.preventDefault();

            deleteAllComponents();
        } else {
            // Stop the browser from submitting the form.
            event.preventDefault();
        }
    });
});

/* Add component button */

$(document).ready(function () {
    $('#select-btn').on('click', function () {
        $.ajax({
            method: 'post',
            url: '../php/component/ComponentInterpreter.php',
            data: {
                'component': $('#select-component').val(),
                'ajax': true
            }
        })
            .done(response => {
                storeData();
                $('#component-view').html(response);
                restoreData();
                updatePreview();
            })
            .fail(() => {
                $('#component-view').html("Error generating component");
            });
    });
});

function deleteAllComponents() {

    $.ajax({
        method: 'post',
        url: '../reset_components.php',
        data: {
            'ajax': true
        }
    })
        .done(response => {
            $('#component-view').html(response);
            componentsData = {};
            updatePreview();
        })
        .fail(() => {
            $('#component-view').html("Cannot delete all component");
        });

}

function deleteComponentAt(position) {

    if (confirmModal("Do you want to delete element at " + position)) {
        $.ajax({
            method: 'post',
            url: '../reset_components.php',
            data: {
                'ajax': true,
                'position': position
            }
        })
            .done(response => {
                storeData();
                removeComponentsData(position);
                $('#component-view').html(response);
                restoreData();
                updatePreview();
            })
            .fail(() => {
                $('#component-view').html("Cannot delete component at " + position.toString());
            });
    }
}

function storeData() {

    $('.component').each(function (index) {

        if (!$(this).hasClass('link') && !$(this).hasClass('table')) {
            componentsData[$(this).attr('id')] = $(this).val();
        } else {

            if ($(this).hasClass('link')) {
                var link = $(this).children('.input-field');
                componentsData[$(this).attr('id')] = {
                    href: link.children('#link_href').val(),
                    name: link.children('#link_name').val()
                };
            }

            if ($(this).hasClass('table')) {
                var chips = M.Chips.getInstance($(this));
                componentsData[$(this).attr('id')] = chips.chipsData;
            }

        }
    });

    console.log("Stored data: ");
    console.log(componentsData);
}

function collectComponents() {

    var components = [];

    $('.component').each(function (index) {

        var singleComponent = {};

        if (!$(this).hasClass('link') && !$(this).hasClass('table')) {
            //Receive data from component with single data like text or header
            singleComponent[$(this).attr('id')] = $(this).val();
            singleComponent['type'] = whichComponent($(this).attr('class'));
        } else {
            //From link get name and href
            if ($(this).hasClass('link')) {
                var link = $(this).children('.input-field');
                var data = {'href': link.children('#link_href').val(), 'name': link.children('#link_name').val()};
                singleComponent[$(this).attr('id')] = data;
                singleComponent['type'] = whichComponent($(this).attr('class'));
            }

            //Get all items from collection
            if ($(this).hasClass('table')) {
                var chipsArray = [];
                for (let chip of M.Chips.getInstance($(this)).chipsData) {
                    chipsArray.push(chip.tag);
                }
                singleComponent[$(this).attr('id')] = chipsArray;
                singleComponent['type'] = whichComponent($(this).attr('class'));
            }

        }

        components.push(singleComponent);
    });

    console.log('New component = ' + JSON.stringify(components));

    return components;
}

function collectAllTheData() {

    var collectedComponents = collectComponents();

    return JSON.stringify({
        post_image: $('#image-view').attr('src'),
        post_date: $('.datepicker').val(),
        post_time: $('.timepicker').val(),
        post_section: $('#section').val(),
        post_title: $('#title').val(),
        post_description: $('#description').val(),
        post_content: collectedComponents
    });
}

function removeComponentsData(position) {
    const newArray = {};
    for (const k in componentsData) {
        if (k !== "component-" + position) {
            newArray[k] = componentsData[k];
        }
    }
    componentsData = newArray;
}

function publish() {
    event.preventDefault();

    var collectedData = collectAllTheData();
    console.log("Collected data = " + collectedData.toString());
    if (validateData()) {
        if (confirmModal('Do you want to publish the article with current content?')) {
            runPostGenerator(collectedData);
        }
    }
    ``
}

function restoreData() {
    var elems = document.querySelectorAll('.chips');
    M.Chips.init(elems);

    $('.component').each(function (index) {

        if (!$(this).hasClass('link') && !$(this).hasClass('table')) {
            $(this).val(componentsData[$(this).attr('id')]);
        } else {

            if ($(this).hasClass('link')) {
                var data = componentsData[$(this).attr('id')];
                if (data !== undefined) {
                    var base = $(this).children('.input-field');
                    base.children('#link_href').val(data.href);
                    base.children('#link_name').val(data.name);
                }
            }

            if ($(this).hasClass('table')) {
                var elements = componentsData[$(this).attr('id')];
                console.log("Chips = " + elements?.toString());
                $(this).chips({data: elements ?? []});
            }
        }
    });

    console.log("Restored data: ");
    console.log(componentsData);
}

function dropData() {
    event.preventDefault();

    var collectedComponentsData = "";

    $('.component').each(function (index) {
        if (!$(this).hasClass('link') && !$(this).hasClass('table')) {
            collectedComponentsData += "For item " + index + " data: \n " + $(this).val() + "  ";
        } else {

            if ($(this).hasClass('link')) {
                var link = $(this).children('.input-field');
                var data = {'href': link.children('#link_href').val(), 'name': link.children('#link_name').val()};
                collectedComponentsData += "For item " + index + " data: \n " + data.name + " = " + data.href + "  ";
            }

            if ($(this).hasClass('table')) {
                var chips = M.Chips.getInstance($(this));
                collectedComponentsData += "For item " + index + " data: \n " + JSON.stringify(chips.chipsData) + "  ";
            }

        }
    });

    $.ajax({
        method: 'post',
        url: 'drop_data.php',
        data: {
            'ajax': true,
            'blog_data': collectedComponentsData
        }
    })
        .done(response => {
            window.location = response;
        })
        .fail(() => {
            alert("Cannot drop a data");
        });
}

function updatePreview() {

    var preview = document.getElementById("preview");
    //Clear old data
    preview.innerHTML = "";

    $('.component').each(function (index) {
        if (!$(this).hasClass('link') && !$(this).hasClass('table')) {
            var previewData = generatePreview($(this).attr('class'), $(this).val());
        } else {
            if ($(this).hasClass('link')) {
                var link = $(this).children('.input-field');
                var data = {href: link.children('#link_href').val(), name: link.children('#link_name').val()}
                console.log("link data = " + data);
                var previewData = generatePreview($(this).attr('class'), data);
            }

            if ($(this).hasClass('table')) {
                var chips = M.Chips.getInstance($(this));
                var previewData = generatePreview($(this).attr('class'), chips.chipsData);
            }

        }

        $("#preview").append(previewData);
    });

}

function whichComponent(classOfItem) {
    switch (classOfItem) {
        case 'component header':
            return 'header';
            break;
        case 'component text':
            return 'text';
            break;
        case 'component image':
            return 'image';
            break;
        case 'component code':
            return 'code';
            break;
        case 'component link row':
            return 'link';
            break;
        case 'component table chips chips-initial input-field':
            return 'table';
            break;
    }
}

function generatePreview(classOfItem, value) {
    var type = whichComponent(classOfItem);
    switch (type) {
        case 'header':
            return '<h2 class="fira black-text medium-text center">' + value + '</h2>';
            break;
        case 'text':
            return '<p class="montserrat small-text grey-text center">' + value + '</p>';
            break;
        case 'image':
            return '<img src="' + value + '" class="full-width-image">';
            break;
        case 'code':
            return addDynamicGist(value);
            break;
        case 'link':
            return '<blockquote style="border-width: 2px;"> <a class="green-text" href="' + value.href + '" target="_blank">' + value.name + '</a> </blockquote>';
            break;
        case 'table':
            var tableView = '<ul class="collection">';
            for (let chip of value) {
                tableView += '<li class="collection-item">' + chip.tag + '</li>';
            }
            tableView += '</ul>';
            return tableView;
            break;
        default:
            return 'Wrong component';
            break;
    }
}

function runPostGenerator(data) {
    $.ajax({
        method: 'post',
        url: '../create_post.php',
        data: {
            'ajax': true,
            'post_data': data
        }
    })
        .done(response => {
            alert(response);
            window.open(response, "_blank");
        })
        .fail(() => {
            alert("Error with creating a post!");
        });
}

function confirmModal(message) {
    return confirm(message);
}

function validateData() {

    if ($('#image-view').attr('src') == '') {
        alert("Please select an image");
        return false;
    }

    if ($('.datepicker').val() == '' || $('.datepicker').val() == 'Input a date') {
        alert("Please input a date");
        return false;
    }

    if ($('.timepicker').val() == '' || $('.timepicker').val() == 'Input a time') {
        alert("Please input a time");
        return false;
    }

    if ($('#section').val() == '') {
        alert("Please input a section name");
        return false;
    }

    if ($('#title').val() == '') {
        alert("Please input a title");
        return false;
    }

    if ($('#description').val() == '') {
        alert("Please input a description");
        return false;
    }

    if (Object.size(componentsData) < 1) {
        alert("Please input at least two content elements");
        return false;
    }

    return true;
}

function addDynamicGist(value) {
    // Create an iframe, append it to this document where specified
    var gistFrame = document.createElement("iframe");
    gistFrame.setAttribute("width", "100%");
    gistFrame.id = "gistFrame";
    gistFrame.style = "border: none;";

    var zone = document.getElementById("preview");
    //zone.innerHTML = "";
    zone.appendChild(gistFrame);

    // Create the iframe's document
    var gistFrameHTML = '<html><body onload="parent.adjustIframeSize(document.body.scrollHeight)"><scr' + 'ipt type="text/javascript" src="https://gist.github.com/' + value + '.js"></sc' + 'ript></body></html>';

    // Set iframe's document with a trigger for this document to adjust the height
    var gistFrameDoc = gistFrame.document;

    if (gistFrame.contentDocument) {
        gistFrameDoc = gistFrame.contentDocument;
    } else if (gistFrame.contentWindow) {
        gistFrameDoc = gistFrame.contentWindow.document;
    }

    gistFrameDoc.open();
    gistFrameDoc.writeln(gistFrameHTML);
    gistFrameDoc.close();
}

function adjustIframeSize(newHeight) {
    var i = document.getElementById("gistFrame");
    i.style.height = parseInt(newHeight) + "px";
    console.log("size adjusted", newHeight);
}

Object.size = function (obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

