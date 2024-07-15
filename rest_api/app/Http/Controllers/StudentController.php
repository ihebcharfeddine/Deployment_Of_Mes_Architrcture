<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();
        return response()->json($students);
    }

    public function show($id){
        $student = Student::find($id);
        if(!empty($student)){
            return response()->json($student);
        } else {
            return response()->json([ "message" => "student not found" ],404);
        }
    }

    public function update(Request $request, $id)
    {
        if (Student::where('id', $id)->exists()) {
            $student = Student:: find($id);
            $student->name = is_null($request->name) ? $student->name: $request->name;
            $student->age = is_null($request->age) ? $student->age: $request->age;
            $student->save();
            return response()->json(["message" => "Student updated successfully."], 200);
        } else {
            return response()->json(["message" => "Student not found."], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
        ]);

        $student = new Student([
            'name' => $request->name,
            'age' => $request->age,
        ]);

        $student->save();

        return response()->json(["message" => "Student created successfully."], 201);
    }

    public function destroy($id) {
        if (Student:: where('id', $id)->exists()) { 
            $student = Student:: find($id); 
            $student->delete();
            return response()->json([ "message" => "records deleted." ], 202);
        } else {
            return response()->json([ "message" => "student not found." ], 404);
        }
    }
}
