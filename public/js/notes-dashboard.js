$(document).ready(function() {

  $("form").submit( function(e) {
    e.preventDefault();
  });

  var source = $("#notes-template").html();
  var template = Handlebars.compile(source);

  var loadNotes = function(){

    $('#note-modal').modal('hide');

    $.ajax({
      method: 'GET',
      url: `notes/1`,
      cache: false,
      async: false,
      data: {},
      success: function(response){
          console.log(response);
          console.log(template);
          var html = template(response);
          console.log(html);
          $("#notes-dashboard").html(html);
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      }
    });

  };
  loadNotes();

  $('#note-modal').on('show.bs.modal', function(e) {
    //console.log(e);
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

  var deleteClick = function(e) {
    var noteId = $(e.target).attr('note-id');
    var reload = e.data.reloadCallback;

    var successCallback = function(response){
      console.log("SUCCESS CALLBACK - DELETE CLICK");
      console.log(response);
      console.log(reload);
      reload();
    };
    var errorCallback = function(jqXHR, textStatus, errorThrown) {
      console.log("SUCCESS CALLBACK - DELETE CLICK");
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

  var saveClick = function(e) {
    var title = $("#title-input").val();
    var body = $("#body-input").val();
    var noteId = $("#note-id").val();
    var userId = window.localStorage.getItem("user_id");
    var reload = e.data.reloadCallback;

    var successCallback = function(response){
      console.log("SUCCESS CALLBACK - SAVE CLICK");
      console.log(response);
      console.log(reload);
      reload();

    };
    var errorCallback = function(jqXHR, textStatus, errorThrown) {
      console.log("ERROR CALLBACK - SAVE CLICK");
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    };

    console.log(title);
    console.log(body);
    console.log(noteId);

    if(!title) {
      // TODO: We require a title; Add validation msg.
      return;
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

      console.log(`USER ID: ${userId}`);
      console.log(successCallback);
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
  //$("#save-note").click( {reloadCallback: loadNotes}, saveClick );
  $(document).on( "click", "#save-note", {reloadCallback: loadNotes}, saveClick );
});
