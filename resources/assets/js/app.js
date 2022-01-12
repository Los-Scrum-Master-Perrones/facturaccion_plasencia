import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

$('.datepicker').datepicker();

$(document).ready(function() {
    $("#navMenu").click(function() {
     //$(".nav").toggleClass("small");
      if ($(".nav").hasClass("small")) {
        $(".nav").removeClass("small");
      } else {
        $(".nav").addClass("small");
      }
    });
  });