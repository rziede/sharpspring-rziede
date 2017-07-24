$(document).ready(function() {

  // Block submit behavior.
  $("form").submit( function(e) {
    e.preventDefault();
  });

  // Handle login form submission.
  var submitLoginForm = function() {

    var successCallback = function(response) {

      // If user successfully logged in...
      if( response["logged_in"] ) {

        // Update local storage and redirect to notes dashboard.
        var userId = response["user_id"];
        var userName = response["user_name"];
        window.localStorage.setItem("user_id", userId);
        window.localStorage.setItem("user_name", userName);
        window.location.href = `user/notes`;

      // If login failed...
      } else {

        // Clear local storage, display error and clear PW.
        localStorage.removeItem("user_id");
        localStorage.removeItem("user_name");
        $("#login-warn").show();
        $("#password").val("");
      }
    };

    var errorCallback = function(jqXHR, textStatus, errorThrown) {
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    };

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
      success: successCallback,
      error: errorCallback
    });
  };

  // Assign handler.
  $("#login-button").click( submitLoginForm );
});
