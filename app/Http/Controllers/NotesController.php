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
    // TODO: Verify user against session
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
    // TODO: Verify note ownership against user against session
    $note  = \App\Models\Note::find($id);
    $note->delete();
    return response()->json('success');
  }

  /*
   * editNote
   *
   * Edits a note's title and body.
   */
  public function editNote(Request $request,$id){
    // TODO: Verify note ownership against user against session
    $note  = \App\Models\Note::find($id);
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
    // TODO: Verify note ownership against user against session
    $note = \App\Models\Note::create($request->all());
    return response()->json($note);
  }
}
