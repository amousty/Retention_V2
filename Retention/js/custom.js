$(document).ready(function(){
     // Starting
     $("#signup-div").hide();
     $("#signin-div").hide();


     // RPCS
     ////////////////////////////////////////////////////////////////////////////////////
     // CheckLoginRPC() : Try to connect the user.
     ////////////////////////////////////////////////////////////////////////////////////
     function CheckLoginRPC()
     {
       var xhttp=getXHR();
       var url     ="php/login.php";
       // On récupère les valeurs du pseudo et du mdp et on les envoie à la requête
       var pseudo  = $('pseudoLogin').value;
       var pass    = $('passwordLogin').value;
       var param   ="login="+ pseudo + "&passwd=" + pass;
       // -> fonction de common.js
       xhttp.onreadystatechange = function()
       {
         if (xhttp.readyState == 4 && xhttp.status == 200)
           {
             // Quand il est pret le responseText est envoyé à la fonction d'affichage
             AfficherGameScreen(xhttp.responseText);
           }
       };
       xhttp.open("POST",url,true);
       xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
       xhttp.send(param);
     }

     $("#signin-form").submit(function(){
         /* stop form from submitting normally */
         event.preventDefault();

         /* get the action attribute from the <form action=""> element */
         var $form = $( this );
          var url = $form.attr( 'action' );

          /* Send the data using post with element id name and name2*/
        var posting = $.post( url, { login : 'jean', passwd : 'pass' });

        /* Alerts the results */
          posting.success(function( data ) {
              var res = data;
            alert(res);
          });
    });

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
