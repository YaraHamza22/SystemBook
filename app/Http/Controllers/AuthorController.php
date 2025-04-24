<?php

namespace App\Http\Controllers;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AuthorController extends Controller
{
    public function index()
    {
        $authors = DB::table('authors')->get();
        return response()->json($authors);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'age' => 'required|integer',
            'numberofBook' => 'required|integer',
            'nameofBook' => 'required|string',
        ]);

        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();

        $id = DB::table('authors')->insertGetId($validatedData);

        return response()->json(['id' => $id], 201);
    }

    public function show($id)
    {
        $author = DB::table('authors')->where('id', $id)->first();

        if (!$author) {
            return response()->json(['message' => 'The Author not found'], 404);
        }

        return response()->json($author);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'age' => 'required|integer',
            'numberofBook' => 'required|integer',
            'nameofBook' => 'required|string',
        ]);

        $validatedData['updated_at'] = now();

        $updated = DB::table('authors')->where('id', $id)->update($validatedData);

        if ($updated) {
            return response()->json(['message' => 'The Author updated successfully']);
        }

        return response()->json(['message' => 'The Author not found or no changes made'], 404);
    }

    public function delete($id)
    {
        $author = DB::table('authors')->where('id', $id)->first();

        if (!$author) {
            return response()->json(['message' => 'The Author not found'], 404);
        }

        DB::table('authors')->where('id', $id)->delete();

        return response()->json(['message' => 'The Author deleted successfully'], 200);
    }
}
