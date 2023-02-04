<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'users' => $users
        ], 200);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nom' => 'required',
            'prenom' => 'required',
            'actif' => 'required|boolean',
            'group_id' => 'required|exists:groups,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            'email' => $request->email,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'actif' => $request->actif,
            'date_creation' => now(),
            'group_id' => $request->group_id,
        ]);

        return response()->json([
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        $user->update([
            'email' => $request->email,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'actif' => $request->actif,
            'group_id' => $request->group_id,
        ]);

        return response()->json([
            'user' => $user
        ], 200);
    }

    public function createUserInGroup(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'nom' => 'required',
            'prenom' => 'required',
            'actif' => 'required',
            'group_id' => 'required'
        ]);

        $user = User::create([
            'email' => $data['email'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'actif' => $data['actif'],
            'group_id' => $data['group_id']
        ]);

        return response()->json(['message' => 'User has been created in the group successfully'], 201);
    }

    public function checkUserActiveStatus($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if ($user->actif == 0) {
            return response()->json(['message' => 'User is not active'], 400);
        }
        return response()->json(['message' => 'User is active'], 200);
    }

    public function addUsersToGroup($groupId, $userIds)
    {
        $group = Group::find($groupId);

        if (!$group) {
            return response()->json(['error' => 'Groupe not found'], 404);
        }

        $users = User::whereIn('id', $userIds)->get();

        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found with the given IDs'], 404);
        }

        foreach ($users as $user) {
            $user->group_id = $groupId;
            $user->save();
        }

        return response()->json(['message' => 'Users added to group successfully'], 200);
    }




}
