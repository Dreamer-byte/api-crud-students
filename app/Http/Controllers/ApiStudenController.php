<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiStudenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();

        if($students->isEmpty()){
            $data = [
                "message" => "No hay estudiantes registrado",
                "status" => 200,
            ];
            return response()->json($data);
        }

       $data = [
            'status' => 200,
            'students' => $students,
       ];
        return response()->json($data);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required|max:255",
            "email" => "required|email|unique:students",
            "phone" => "required|digits:10|unique:students",
            "language" => "required|in:es,en",
        ]);

        if($validator->fails()){
            $data = [
                "message" => "Error en la validacion de datos",
                "errors" => $validator->errors(),
                "status" => 400,
            ];
            return response()->json($data,400);
        }

        $student =    Student::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "language" => $request->language,
        ]);

        if(!$student){
            $data = [
                "message" => "Error al crear el estudiante",
                "status" => 500,
            ];

            return response()->json($data,500);

        }

        $data = [
            "student" => $student,
            "status" => 201,
        ];
        return response()->json($data,201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);

        if(!$student){
            $data = [
                "message" => "Estudiante no encontrado",
                "status" => 404,
            ];
            return response()->json($data,404);
        }

        $data = [
            "student" => $student,
            "status" => 200,
        ];
        return response()->json($data,200);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $student = Student::find($id);

        if(!$student){
            $data = [
                "message" => "Estudiante no encontrado",
                "status" => 404,
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request->all(),[
            "name" => "required|max:255",
            "email" => "required",
            "phone" => "required|digits:10",
            "language" => "required|in:es,en",
        ]);

        $validator->sometimes(['email', 'phone'],
        [
            Rule::unique('students')->ignore($id)
        ], function ($input) use ($student) {
            // Aplicar la regla única solo si el email o el teléfono son diferentes a los actuales del estudiante
            return $input->email !== $student->email || $input->phone !== $student->phone;
        });

        
        if($validator->fails()){
            $data = [
                "message" => "Error en la validacion de datos",
                "errors" => $validator->errors(),
                "status" => 400,
            ];
            return response()->json($data,400);
        }

        if($student->name != $request->name)
        {
            $student->name = $request->name;
        }
        
        if( $student->email != $request->email)
        {
            $student->email = $request->email;
        }

        if( $student->phone != $request->phone)
        {
            $student->phone = $request->phone;
        }

        if($student->language != $request->language)
        {
            $student->language = $request->language;
        }

        $student->save();

        if(!$student){
            $data = [
                "message" => "Estudiante no actualizado",
                "status" => 404,
            ];
            return response()->json($data,404);
        }

        $data = [
            "message" => "Estudiante actualizado",
            "student" => $student,
            "status" => 200,
        ];
        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if(!$student){
            $data = [
                "message" => "Estudiante no encontrado",
                "status" => 404,
            ];
            return response()->json($data,404);
        }
        $student->delete();
        $data = [
            "message" => "Estudiante eliminado",
            "status" => 200,
        ];
        return response()->json($data,200);
    }
}
