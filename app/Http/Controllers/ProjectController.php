<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller {

//
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        /* Build Menu Projects. 
         * Elements table is the conection to know all projects that a user is in */
        $projects = \App\Element::where('user_id', '=', Auth::user()->id)->paginate(5);

        foreach ($projects as $project) {
            $project->team->project;
            $project->role;
        }

        return Response::json($projects);
    }

    public function show($id) {
        $project = \App\Project::findOrFail($id);

         $project->team;
         $project->board;
         
        
        return Response::json($project);
    }

}
