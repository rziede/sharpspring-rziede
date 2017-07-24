<html>
  <head>
    <title>Notes Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://localhost/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://localhost/css/notes.css" rel="stylesheet" media="screen">
    <script src="http://localhost/js/jquery-3.2.1.js"></script>
    <script src="http://localhost/js/handlebars-v4.0.10.js"></script>
    <script src="http://localhost/js/bootstrap.js"></script>
    <script src="http://localhost/js/notes-dashboard.js"></script>

    <!-- Handlebars.js Template for notes display -->
    <script id="notes-template" type="text/x-handlebars-template">
      <br>
      <div class="container">

        <div class="row">
            <div class="col-md-10">
              <h1>Notes Dashboard</h1>
            </div>
            <div class="col-md-2">
              <h3 class="text-info"><span class="glyphicon glyphicon-user"></span> User: {{user.name}}</h3>
            </div>
        </div> <!-- row -->

        <button type="button" class="btn btn-primary modal-btn" id="add-note" data-toggle="modal" data-target="#note-modal"><span class="glyphicon glyphicon-plus"></span> New Note</button>
        <button type="button" class="btn btn-warning" id="logout"><span class="glyphicon glyphicon-log-out"></span></span> Log Out</button><br><br>

        {{#each notes}}
          <div class="well">
            <div class="row">
              <div class="col-md-10">
                <h3 class="note-header" id="title-{{id}}">{{title}}</h3>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary modal-btn" id="edit-{{id}}" note-id="{{id}}" data-toggle="modal" data-target="#note-modal"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
                <button type="button" class="btn btn-danger delete-btn" id="delete-{{id}}" note-id="{{id}}"><span class="glyphicon glyphicon-remove"></span> Delete</button>
              </div>
            </div><br> <!-- row -->
            <div class="row">
              <div class="col-md-12">
                <blockquote><p id="body-{{id}}">{{body}}</p></blockquote>
              </div>
            </div><br> <!-- row -->
            <div class="row">
              <div class="col-md-3">
                <p class="text-muted">Created by: {{../user.name}}</p>
              </div>
              <div class="col-md-3">
                <p class="text-muted">Updated: {{updated_at}}</p>
              </div>
            </div> <!-- row -->
          </div> <!-- well -->
        {{/each}}
      </div> <!-- container -->
    </script> <!-- END Handlebars Template -->
  </head>

  <body>
    <!-- Main content container -->
    <div class="container" id="notes-dashboard"></div>

    <!-- Note input modal -->
    <div class="modal fade" id="note-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal-header"></h4>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <input type="hidden" id="note-id" value="" />
            <form id="note-form">
              <div class="form-group">
                <label for="title-input">Note Title</label>
                <input type="text" class="form-control" id="title-input" placeholder="Title..." maxlength="120" required>
                <small id="title-help" class="form-text text-muted">120 character limit.</small>
              </div>
              <div class="form-group">
                <label for="body-input">Note</label>
                <textarea class="form-control" id="body-input" rows="5" placeholder="Note..."></textarea>
              </div>
            </form>
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="save-note">Save Note</button>
          </div>

        </div> <!-- Modal Content-->
      </div> <!-- Modal Dialog-->
    </div> <!-- Modal -->
  </body>
</html>
