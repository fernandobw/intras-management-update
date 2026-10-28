<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Article as Item;
use App\Author;
use App\ItemUser;
use App\Category;
use App\Tag as ItemTag;
use App\Facilitator;
use App\TagXref as ItemTagXref;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\Filesystem;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->paginate(15);

        return view('admin.items');
        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = ItemUser::orderBy('userID', 'desc')->get();
        return view('admin.newItem')->with(compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now()->toDateTimeString();

        $request->validate([
            'title' => 'required',
            'created_by' => 'required',
            'catid' => 'required',
            'image' => 'required|image',
            'introtext' => 'required',
        ]);

        $item = new Item;

        $item->id = $request->id;
        $item->title = $request->title;
        $item->alias = Str::slug($request->title, "-");
        $item->catid = $request->catid;
        $item->created_by = explode(':', $request->created_by)[0];
        $item->modified_by = explode(':', $request->created_by)[0];
        $item->created_by_alias = $request->created_by_alias;
        $item->nombre_seminario = '';
        $item->video = '{YouTube}'.$request->video.'{/YouTube}';
        $item->created = $now;
        $item->featured = 0;
        if (isset($item->featured)) {
            $item->featured = $request->featured;
        }
        $item->published = $request->published ?? 0;
        $item->introtext = html_entity_decode($request->introtext);

        if (isset($request->alias)) {
            $item->alias = Str::slug($request->alias, "-");
        }


        $item->save();

        foreach (explode(",", $request->tags) as $key => $tag) {
            $tagResult = DB::select('SELECT * FROM `vdyvi_k2_tags` WHERE `name` = ? LIMIT 1', [$tag]);
            if (count($tagResult) == 0) {
                $newTag = new ItemTag;

                $newTag->name = $tag;
                $newTag->published = 1;

                $newTag->save();

                $tagsXref = new ItemTagXref;

                $tagsXref->tagID = $newTag->id;
                $tagsXref->itemID = $item->id;

                $tagsXref->save();
            } else {
                $tagsXref = new ItemTagXref;

                $tagsXref->tagID = $tagResult[0]->id;
                $tagsXref->itemID = $item->id;

                $tagsXref->save();
            }
        }

        $fileName = md5("Image".$item->id);

        $fileExtension = $request->image->getClientOriginalExtension();

        $path = $request->image->storeAs('articles', $fileName.'.'.$fileExtension);

        return redirect('/admin/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item){

        $facilitators = Author::all();
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = ItemUser::orderBy('userID', 'desc')->get();
        /*$facilitators = Facilitator::orderBy('id','desc')->get();*/
        //$facilitators = [];
        $tags = DB::select('SELECT * FROM `vdyvi_k2_tags_xref` tx JOIN `vdyvi_k2_tags` t ON tx.tagID = t.id WHERE tx.itemID = ?', [$item->id]);
        $tagsStr = "";
        foreach ($tags as $tag) {
            $tagsStr .= $tag->name.",";
        }
        $tagsStr = rtrim($tagsStr, ",");
        return view('admin.editItem')->with(compact('item', 'authors', 'categories', 'tagsStr', 'facilitators'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, Filesystem $filesystem){

        $now = Carbon::now()->toDateTimeString();

        $fields = $request->validate([
            'title' => 'required',
            'created_by' => 'required',
            'catid' => 'required',
            'image' => 'image',
            'introtext' => 'required',
        ]);

        $item->title = $request->title;
        $item->alias = $request->alias;
        $item->catid = $request->catid;
        $item->created_by = explode(':', $request->created_by)[0];
        $item->created_by_alias = $request->created_by_alias;
        $item->modified_by = auth()->user()->id;
        $item->featured = $request->featured;
        $item->published = $request->published ?? 0;
        $item->video = '{YouTube}'.$request->video.'{/YouTube}';
        $item->introtext = html_entity_decode($request->introtext);
        $item->modified = $now;

        $item->id_facilitador = $request->idfacilitador;
        
        // $item->tags = $request->tags; 

        if (!is_null($request->image)) {
            logger('tamo recibiendo ya tu sa');
            $fileName = md5("Image".$item->id);
            $fileExtension = $request->image->getClientOriginalExtension();
            $deleted = $this->removeFile($fileName);
            // $a = File::delete(public_path().'resize/articles/'.$fileName.$fileExtension);
            logger($deleted);
            $path = $request->image->storeAs('articles', $fileName.'.'.$fileExtension);
        }

        // Imagen
        //$item->image = $path;

        $item->id_lineatematica = $request->idlineatematica;

        $item->save();

        DB::table('vdyvi_k2_tags_xref')->where('itemID', $item->id)->delete();

        foreach (explode(",", $request->tags) as $key => $tag) {

            $tagResult = DB::select('SELECT * FROM `vdyvi_k2_tags` WHERE `name` = ? LIMIT 1', [$tag]);

            if (count($tagResult) == 0) {

                $newTag = new ItemTag;

                $newTag->name = $tag;
                $newTag->published = 1;

                $newTag->save();

                $tagsXref = new ItemTagXref;

                $tagsXref->tagID = $newTag->id;
                $tagsXref->itemID = $item->id;

                $tagsXref->save();

            } else {
                $tagsXref = new ItemTagXref;

                $tagsXref->tagID = $tagResult[0]->id;
                $tagsXref->itemID = $item->id;

                $tagsXref->save();
            }
        }

        // abort(500);

        return redirect('/admin/items')->with('success', 'Articulo actualizado correctamente.');
    }

    protected function removeFile($fileName)
    {
        $extensions = [ 'jpg', 'png', 'jpeg', 'svg', 'gif', 'bmp' ];
        $result = 0;

        foreach ($extensions as $extension) {
            $fileWithExtension = $fileName. '.'. $extension;
            $fileCachePathOld = public_path().'/resize/.cache/articles/'. $fileWithExtension;
            $fileCachePath = public_path().'/images/.cache/articles/'. $fileWithExtension;
            $fileSourcePath = public_path(). '/resize/articles/'. $fileWithExtension;

            // logger('cache old: '.$fileCachePathOld);
            if (is_dir($fileCachePathOld)) {
                // logger('lo encontre papi');
                File::deleteDirectory($fileCachePathOld);
                // rmdir($fileCachePath);
                $result = +1;
            }

            // logger('cache: '.$fileCachePath);
            if (is_dir($fileCachePath)) {
                // logger('lo encontre papi');
                File::deleteDirectory($fileCachePath);
                // rmdir($fileCachePath);
                $result = +1;
            }
            // logger('normal: '.$fileSourcePath);

            if (file_exists($fileSourcePath)) {
                // logger('deleting el original');
                File::delete($fileSourcePath);
                $result = +1;
            }

            $filePath = public_path(). '/images/articles/'. $fileWithExtension;

            // logger('images: '.$filePath);

            if (file_exists($filePath)) {
                // logger('borrando el real de los reales');
                File::delete($filePath);
                $result = +1;
            }

            if ($result >= 1) {
                break;
            }
        }

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect('/admin/items');
    }

    public function getAll()
    {
        $items = Item::with('tag')->orderBy('id', 'desc')->take(100)->get(['title','featured','published','catid','created_by','created','modified','id']);

        $items->map(function ($item) {
            $item['category_name'] = $item['category']['name'];
            $item['tag_name'] = $item->tag[0]->name ?? '';
        });

        return response()->json(['data' => $items]);
    }

    public function remove(Request $request, $id)
    {
        $article = Item::findOrFail($id);
        $article->delete();
        return back()->with('success', "Articulo {$id} eliminado correctamente.");
    }

    public function updateField(Request $request, Item $item, $field)
    {
        $item->$field = !$item->$field;

        $item->update();

        return back();
    }
}
