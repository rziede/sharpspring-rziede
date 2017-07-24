$(document).ready(function() {

  $("form").submit( function(e) {
    e.preventDefault();
  });

  $("#login-button").click( function() {

    $.ajax({
      method: 'POST',
      url: 'login',
      cache: false,
      async: false,
      dataType: "json",
      data: {
        email: $("#email").val(),
        password: $("#password").val()
      },
      success: function(response){

        if( response["logged_in"] ) {
          var userId = response["user_id"];
          var userName = response["user_name"];
          window.localStorage.setItem("user_id", userId);
          window.localStorage.setItem("user_name", userName);
          window.location.href = `user/notes`;
        } else {
          //localStorage.removeItem("user_id");
          //localStorage.removeItem("user_name");
          $("#login-warn").show();
          $("#password").val("");
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      }
    });
  });
});
