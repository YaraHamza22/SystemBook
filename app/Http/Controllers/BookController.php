<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    public function index()
    {

        $books = DB::table('books')->get();
        return response()->json($books);
    }

    public function store(Request $request)
    {
     $dataofBook = $request->validate([
         'name' => 'required|string|max:50',
         'authorname' => 'required|string|max:30',
         'age' => 'required|integer',
         'description' => 'required|string',
         'author_id' => 'required|integer|min:1',
     ]);
     $dataofBook['created_at'] = now();
     $dataofBook['updated_at'] = now();

     $id = DB::table('books')->insertGetId($dataofBook);

     return response()->json(['id' => $id], 201);
    }

    public function show($id)
{
    $books = DB::table('books')->where('id', $id)->first();

    if (!$books) {
        return response()->json([

            'message' => 'Book not found'
        ], 404);
    }

    return response()->json($books);
}

public function update(Request $request, $id)
{
    $dataofBook = $request->validate([
        'name' => 'required|string|max:50',
        'authorname' => 'required|string|max:30',
        'age' => 'required|integer',
        'description' => 'required|string',
        'author_id' => 'required|integer|min:1',
    ]);
    $dataofBook['updated_at'] = now();
    $updated = DB::table('books')->where('id', $id)->update($dataofBook);

    if ($updated) {
        return response()->json(['message' => 'Book updated successfully']);
    }

    return response()->json(['message' => 'Book not found'], 404);

}
public function delete($id)
    {

        $books = DB::table('books')->where('id', $id)->first();

        if (!$books) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        DB::table('books')->where('id', $id)->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }

}

