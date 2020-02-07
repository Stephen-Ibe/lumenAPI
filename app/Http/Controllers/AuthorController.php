<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function showAllAuthors(){
        return response()->json(Author::all());
    }

    public function showOneAuthor($id){
        return response()->json(Author::find($id));
    }

    public function create(Request $request){
        // validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'location' => 'required|alpha'
        ]);

        // insert record
        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    public function update($id, Request $request){
        // validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        // update record
        $author = Author::findOrFail($id);
        $author->update($request->all());
        return response()->json($author, 200);
    }

    public function delete($id){
        Author::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
