$(document).ready(function(){
        $( "#signin-trigger" ).click(function() {
             alert("test");
             var link = $(this).attr("href");
             $("#signin-trigger").load(link);
             event.preventDefault();
        });

        $( "#signup-trigger" ).click(function() {
             alert("test");
             var link = $(this).attr("href");
             $("#signup-trigger").load(link);
             event.preventDefault();
        });
     });
