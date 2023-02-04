<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return Group::all();
    }

    public function store(Request $request)
    {
        $group = Group::create($request->all());
        return response()->json($group, 201);
    }

    public function show($id)
    {
        $group = Group::find($id);
        return response()->json($group);
    }

    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $group->update($request->all());
        return response()->json($group, 200);
    }
}
