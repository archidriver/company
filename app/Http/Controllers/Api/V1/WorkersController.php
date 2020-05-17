<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Workers;
use Illuminate\Http\Request;

class WorkersController extends Controller
{

    public function index()
    {
        return Workers::all();
    }

    public function show($id)
    {
        return Workers::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $worker = Workers::findOrFail($id);
        $worker->update($request->all());

        return $worker;
    }
    //public function upload(Request $request)
   // {
   //     $path = $request->file('image')->store('images', 'public');
   //     return ['path'->$path];
   // }
    public function store(Request $request)
    {
        $worker = Workers::create($request->all());
        return $worker;
    }

    public function destroy($id)
    {
        $worker = Workers::findOrFail($id);
        $worker->delete();
        return '';
    }
}
