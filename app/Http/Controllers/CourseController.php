<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\LearningPath;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        foreach ($courses as $data)
        {
            $data->learning_path = !$data->learning_path_id ? null : LearningPath::find($data->learning_path_id)->name;
        }

        return response($courses, 200);
    }

    public function create(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'learning_path_id' => 'nullable|int'
        ]);

        Course::create($fields);
        return response('Course Added Successfully!', 201);
    }

    public function update(Request $request, string $id)
    {
        $course = Course::find($id);
        $course->update($request->all());
        return response('Course Updated Successfully!', 201);
    }
}
