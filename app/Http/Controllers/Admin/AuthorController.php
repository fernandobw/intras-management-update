<?php

namespace App\Http\Controllers\Admin;

use App\ItemUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.authors');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newAuthor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $author = new ItemUser;

        $author->userName = $request->userName;
        $author->slug = Str::slug( $request->userName );
        $author->gender = $request->gender;
        $author->description = $request->description;

        $author->save();

        return redirect('/admin/authors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemUser  $itemUser
     * @return \Illuminate\Http\Response
     */
    public function show(ItemUser $itemUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemUser  $itemUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemUser $author){
        return view('admin.editAuthor')->with(compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemUser  $itemUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemUser $author){
        
        $author->userName = $request->userName;
        $author->slug = Str::slug( $request->userName );

        $author->id_sipgo = $request->id_sipgo;

        $author->gender = $request->gender;
        $author->description = $request->description;

        $author->update();

        return redirect('/admin/authors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemUser  $itemUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemUser $author)
    {
        $author->delete();

        return redirect('/admin/authors');
    }

    public function getAll()
    {
        $authors = ItemUser::all();

        return response()->json(['data' => $authors ]);
    }
}
