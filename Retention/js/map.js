// https://scotch.io/bar-talk/4-javascript-design-patterns-you-should-know
// -> Module Design Pattern

var map = (function(){
   // PRIVATE
   var init = function(){
      generateMap();
   }

   // PUBLIC
   return {
    callInit: function() {
      init();
    }
  };
})();

// CALL METHODS

$(document).ready(function(){
  map.callInit();
});

// RPCS
function generateMap(){
  var $form = $(this);
  var url = "../php/rpc/map.php";
  /* Send the data using post with element id name and name2*/
  $.post(url).success(
      function( data ) {
        if(data != "OK"){
          alert(data);
        }
      }
  );
} // end function

   // Redirect to the error page
   function redirectToErrorPage(errorText){
     //$('#errorText').val(errorText);
     window.location.href = "views/error.php?err=" + errorText;
   }
