<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
class BoardController extends Controller {

    //

    public function show($id) {
        $board = \App\Board::findOrFail($id);
        
        
        
        return Response::json($board);
    }

    public function store(Request $request) {
        $post = \App\Board::create($request->all());
        
        return Response::json($post);
    }

    public function update($id, Request $request) {
        $find = \App\Board::findOrFail($id);
        $find->update($request->all());
        return Response::json(array(TRUE));
    }

}
