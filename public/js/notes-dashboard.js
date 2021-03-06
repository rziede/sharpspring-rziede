$(document).ready(function() {

  // Block submit behavior.
  $("form").submit( function(e) {
    e.preventDefault();
  });

  // Compile Handlebars.js template.
  var source = $("#notes-template").html();
  var template = Handlebars.compile(source);

  // Handle updating notes display.
  var loadNotes = function(){

    $('#note-modal').modal('hide');

    var successCallback = function(response){
        // Update template context and deliver to content div.
        var html = template(response);
        $("#notes-dashboard").html(html);
    };

    var errorCallback = function(jqXHR, textStatus, errorThrown) {
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    };

    var user_id = window.localStorage.getItem("user_id");

    $.ajax({
      method: 'GET',
      url: `notes/${user_id}`,
      cache: false,
      async: false,
      data: {},
      success: successCallback,
      error: errorCallback
    });
  };

  // Initialize the notes list on page load.
  loadNotes();

  // Varies note-modal display based on context. Pre-loads fields for Edit.
  $('#note-modal').on('show.bs.modal', function(e) {
    var noteId = $(e.relatedTarget).attr('note-id');

    if( noteId ) {
      var title = $(`#title-${noteId}`).html();
      var body = $(`#body-${noteId}`).html();
      $("#modal-header").html("Edit Note");
      $("#title-input").val(title);
      $("#body-input").val(body);
      $("#note-id").val(noteId);
    } else {
      $("#modal-header").html("New Note");
      $("#title-input").val("");
      $("#body-input").val("");
      $("#note-id").val("");
    }
  });

  // Deletes a note and refreshes the list.
  var deleteClick = function(e) {
    var noteId = $(e.target).attr('note-id');
    var reload = e.data.reloadCallback;

    var successCallback = function(response){
      reload();
    };
    var errorCallback = function(jqXHR, textStatus, errorThrown) {
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    };

    $.ajax({
      method: 'DELETE',
      url: `notes/${noteId}`,
      cache: false,
      async: false,
      success: successCallback,
      error: errorCallback
    });
  };
  $(document).on( "click", ".delete-btn", {reloadCallback: loadNotes}, deleteClick );

  // Saves or Updates a note and refreshes the list.
  var saveClick = function(e) {
    var title = $("#title-input").val();
    var body = $("#body-input").val();
    var noteId = $("#note-id").val();
    var userId = window.localStorage.getItem("user_id");
    var reload = e.data.reloadCallback;

    var successCallback = function(response){
      reload();

    };
    var errorCallback = function(jqXHR, textStatus, errorThrown) {
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    };

    if(!title) {
      //We require a title; Style validation hint.
      $("#title-label").addClass("text-danger");
      return;
    } else {
      $("#title-label").removeClass("text-danger");
    }

    // If we are editing pre-existing note...
    if( noteId ) {

      $.ajax({
        method: 'PUT',
        url: `notes/${noteId}`,
        cache: false,
        async: false,
        data: {
          "title": title,
          "body": body
        },
        success: successCallback,
        error: errorCallback
      });

    // If we are setting a new note...
    } else {

      $.ajax({
        method: 'POST',
        url: `notes`,
        cache: false,
        async: false,
        data: {
          "user_id": userId,
          "title": title,
          "body": body
        },
        success: successCallback,
        error: errorCallback
      });
    }
  }
  $(document).on( "click", "#save-note", {reloadCallback: loadNotes}, saveClick );

  // Logout button behavior.
  $(document).on("click", "#logout",{}, function(){
    window.location.href = `../login`;
  });
});
