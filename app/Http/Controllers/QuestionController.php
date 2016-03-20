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

    public function index() {
        $answers = \App\Question::orderBy('created_at', 'desc')->paginate(15);

        foreach ($answers as $as) {
            $as->user;
        }

        return Response::json($answers);
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