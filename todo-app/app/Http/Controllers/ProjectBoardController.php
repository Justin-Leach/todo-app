<?php

namespace App\Http\Controllers;

class ProjectBoardController extends Controller
{
    public function index()
    {
        return view("project-board.index");
    }

    public function backlog()
    {
        return view("project-board.backlog");
    }
}
