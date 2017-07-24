<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotesController extends Controller
{

  /*
   * showNotes
   *
   * Serve the notes dashboard.
   */
  public function showNotes()
  {
    return view('notes-dashboard');
  }

  /*
   * getNotes
   *
   * Get all notes belonging to a user_id.
   * Verifies ownership of user_id against user in session.
   */
  public function getNotes($user_id)
  {
    // Verify user against session
    if ( !isset($_SESSION['user_id']) || $_SESSION['user_id'] != $user_id) {
      $response = "error";
      return $response;
    }

    $user = \App\Models\User::find($user_id);
    $notes = \App\Models\User::find($user_id)->notes;
    $response = ["user" => $user, "notes" => $notes];
    return response()->json($response);
  }

  /*
   * deleteNote
   *
   * Deletes a note based on the note's ID
   */
  public function deleteNote($id)
  {
    $note  = \App\Models\Note::find($id);

    // Verify user against session
    $user_id = $note->user_id;
    if ( !isset($_SESSION['user_id']) || $_SESSION['user_id'] != $user_id) {
      $response = "error";
      return $response;
    }

    $note->delete();
    return response()->json('success');
  }

  /*
   * editNote
   *
   * Edits a note's title and body.
   */
  public function editNote(Request $request,$id){
    $note  = \App\Models\Note::find($id);

    // Verify user against session
    $user_id = $note->user_id;
    if ( !isset($_SESSION['user_id']) || $_SESSION['user_id'] != $user_id) {
      $response = "error";
      return $response;
    }

    $note->title = $request->input('title');
    $note->body = $request->input('body');
    $note->save();
    return response()->json($note);
  }

  /*
   * saveNote
   *
   * Saves a brand new note.
   */
  public function saveNote(Request $request)
  {
    $note = \App\Models\Note::create($request->all());

    // Verify user against session
    $user_id = $note->user_id;
    if ( !isset($_SESSION['user_id']) || $_SESSION['user_id'] != $user_id) {
      $response = "error";
      return $response;
    }

    return response()->json($note);
  }
}
