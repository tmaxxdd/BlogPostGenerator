$(document).ready(function(){
    $('.materialboxed').materialbox();
  });

/* Update year in footer */
$(document).ready(function() {
    $('#year').html(new Date().getFullYear());
});