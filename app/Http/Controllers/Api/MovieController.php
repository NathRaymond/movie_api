<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        // check if there is record
        if ($movies->count() > 0) {
            return response()->json([
                'status' => 200,
                'movies' => $movies
            ], 200);
        } else {
            return response()->json([
                'status' => 200,
                'movies' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'release_date' => 'required|string|max:191',
            'director' => 'required|string|max:191',
            'genre' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $movie = Movie::create([
                'title' => $request->title,
                'release_date' => $request->release_date,
                'director' => $request->director,
                'genre' => $request->genre,
            ]);

            if ($movie) {
                return response()->json([
                    'status' => 200,
                    'message' => "Movie Created Sucessfully"
                ], 200);
            } else {
                response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        if ($movie) {

            return response()->json([
                'status' => 200,
                'movie' => $movie
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Student Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        if ($movie) {

            return response()->json([
                'status' => 200,
                'movie' => $movie
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Student Found!"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'release_date' => 'required|string|max:191',
            'director' => 'required|string|max:191',
            'genre' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $movie = Movie::find($id);

            if ($movie) {
                $movie->update([
                    'title' => $request->title,
                    'release_date' => $request->release_date,
                    'director' => $request->director,
                    'genre' => $request->genre,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Movie Updated Sucessfully"
                ], 200);
            } else {
                response()->json([
                    'status' => 404,
                    'message' => "No Such Student Found!"
                ], 404);
            }
        }
    }

    public function destroy($id){
        $movie = Movie::find($id);
        if($movie){
            $movie->delete();
            return response()->json([
                'status' => 200,
                'message' => "Movie Deleted Sucessfully"
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Movie Found!"
            ], 404);
        }
    }
}
