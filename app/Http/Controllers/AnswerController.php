<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class AnswerController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
         $answer = \App\Answers::paginate(15);
         
         return Response::json($answer);
    }
    
    public function show($id) {
        $answers = \App\Answers::where('question_id', '=', $id)->get();
        
        foreach ($answers as $answer){
            $answer->element->user;
        }
        
        return Response::json($answers);
    }
    
    
    public function store(Request $request) {
        $post = \App\Answers::create($request->all());
        $post->user;
        $find = \App\Question::find($request->input('question_id'));
        $find->answers++;
        $find->save();
        
        return Response::json($post);
    }
    
    public function update($id, Request $request) {
        $find = \App\Post::find($id);
        $find->update($request->all());
    }

}
