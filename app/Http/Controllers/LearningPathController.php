<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\LearningPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearningPathController extends Controller
{
    public function index()
    {
        $learning_path = LearningPath::all();
        foreach ($learning_path as $data)
        {
            $data->course_count = Course::where('learning_path_id', $data->id)->count('id');    
        }

        return response($learning_path, 200);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:learning_paths,name',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        LearningPath::create($request->all());

        return response('Data Created', 201);
    }

    public function update(Request $request, string $id)
    {
        $learning_path = LearningPath::find($id);
        $learning_path->update($request->all());
        return $learning_path;
    }

    public function destroy(string $id)
    {
        return LearningPath::destroy($id);
    }
}
