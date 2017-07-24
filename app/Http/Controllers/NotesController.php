<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotesController extends Controller
{
   public function showNotes()
   {
     // Show login page.
     return view('notes-dashboard');
   }

   public function getNotes($user_id)
   {
     $user = \App\Models\User::find($user_id);
     $notes = \App\Models\User::find($user_id)->notes;
     $response = ["user" => $user, "notes" => $notes];
     return response()->json($response);
   }

    public function deleteNote($id)
    {
      $note  = \App\Models\Note::find($id);
      $note->delete();
      return response()->json('success');
    }

    public function editNote(Request $request,$id){
        $note  = \App\Models\Note::find($id);

        $note->title = $request->input('title');
        $note->body = $request->input('body');
        $note->save();

        return response()->json($note);
    }

    public function saveNote(Request $request)
    {
      $note = \App\Models\Note::create($request->all());
      return response()->json($note);
    }
}
