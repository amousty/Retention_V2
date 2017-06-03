$(document).ready(function(){
     // Starting
     $("#signup-div").hide();
     $("#signin-div").hide();

     // Onlick
        $( "#signin-trigger" ).click(function() {
             $("#signup-div:visible").hide("fadeOut");
             $("#signin-div").show("fadeIn");
        });

        $( "#signup-trigger" ).click(function() {
             $("#signin-div:visible").hide("fadeOut");
             $("#signup-div").show("fadeIn");
        });
     });
