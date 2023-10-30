<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            // Get the authenticated user
            $user = auth()->user();

            // Title should not be empty and not be more than 255 characters
            if (empty($request->input('title')) || strlen($request->input('title')) > 255) {
                return response()->json([
                    'status' => false,
                    'message' => 'Title should not be empty and not be more than 255 characters',
                ], 400);
            }

            // Description should not be more than 1000 characters
            if (strlen($request->input('description')) > 1000) {
                return response()->json([
                    'status' => false,
                    'message' => 'Description should not be more than 1000 characters',
                ], 400);
            }

            // Status should not be empty and should be one of the following: pending, in_progress or completed
            if (empty($request->input('status')) || !in_array($request->input('status'), ['pending', 'in_progress', 'completed'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Status should not be empty and should be one of the following: pending, in_progress or completed',
                ], 400);
            }

            // Create and store a new task for the user
            $task = $user->tasks()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);

            // Return the created task as a resource
            return TaskResource::make($task)->response()->setStatusCode(201);

        } catch (\Throwable $th) {
            // Handle any exceptions
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the task with the specified id
     */
    public function show(Task $task)
    {

        // The $task parameter is already an instance of Task, no need to find it again
        // If the task was not found, Laravel will automatically return a 404 response

        // Return the task
        return TaskResource::make($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
