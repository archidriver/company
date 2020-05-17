<?php

namespace App\Http\Controllers;

use App\Workers;
use Illuminate\Http\Request;

class WorkersController extends Controller
{
    //public function index()
   // {
   //     return view('workers.index');
   // }
    /*public function table()
    {
        return view('workers.table');
    }*/

    public function wood(Workers $WorkersManager)
    {
        $rootManager = $WorkersManager->rootManager();
        return view('workers.wood', ['rootManager' => $rootManager,]);
    }

    //
}
