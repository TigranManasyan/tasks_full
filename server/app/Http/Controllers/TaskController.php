<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        return response()->json(Task::all(), 200);
    }

    public function store(Request $request) {
        $data = $request->only(['title', 'text', 'status']);
        $store = Task::create($data);
        if($store) {
            return response()->json(['message' => 'Task successfully created'], 200);
        } else {
            return response()->json(['message' => 'Task not created'], 401);

        }
    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

    }

    public function delete($id) {

    }
}
