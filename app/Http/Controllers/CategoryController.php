<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::orderByDesc('created_at')->get();
        $responseBody = $categories;
        $responseCode = 200;

        return response($responseBody, $responseCode)
            ->header('Content-Type', 'application/json');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:categories', 'max:400']
        ]);
        if ($validator->fails()) {
            $response = response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ],400);
            throw new HttpResponseException($response);
        }
        
        Category::create([
            'name' => $request->name
        ]);
        
        $responseBody = 'ok';
        $responseCode = 200;
        
        return response($responseBody, $responseCode)
            ->header('Content-Type', 'text/plain');
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string', 'unique:categories', 'max:400']
        ]);
        if ($validator->fails()) {
            $response = response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ],400);
            throw new HttpResponseException($response);
        }

        
        $category->name = $request->name;
        $category->save();

        $responseBody = 'ok';
        $responseCode = 200;

        return response($responseBody, $responseCode)
            ->header('Content-Type', 'text/plain');
    }
}
