<?php

namespace App\Http\Controllers;

use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function show($id) {
        $questions = \App\Question::where('board_id', '=', $id)->paginate(15);

        foreach ($questions as $question) {
            $question->element->user;
        }

        return Response::json($questions);
    }

    public function store(Request $request) {
        $post = \App\Question::create($request->all());
        $post->user;

        return Response::json($post);
    }

    public function update($id, Request $request) {
        $find = \App\Question::find($id);
        $find->update($request->all());
    }

}
