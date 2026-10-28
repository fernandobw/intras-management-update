<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function index(){
    	return view('admin.tag.index');
    }

    public function getAll() {

        $tags = Tag::withCount('articles')->get();

        return response()->json(['data' => $tags]);
    }

    public function updateField(Request $request, Tag $tag, $field)
    {
        $tag->$field = !$tag->$field;

        $tag->update();

        return back();
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return back()->with('success', "Articulo {$tag->name} eliminado correctamente.");
    }
}
