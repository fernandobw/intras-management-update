<?php

namespace App\Http\Controllers;

use App\Tag;
use App\TagXref;
use App\Author;
use App\Article;
use App\Category;
use Goutte\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

use Carbon\Carbon;
use App\Repositories\Posts;
use Spatie\SchemaOrg\Schema;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $posts;

    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }


    public function index(){

        $lastCategory = Tag::where('published', '1')
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategory = Tag::where('published', '1')
                             ->where('id', '<', $lastCategory->id)
                             ->orderBy('id', 'desc')
                             ->first();

        $lastCategoryXrefs = TagXref::where('tagID', $lastCategory->id)
                                     ->orderBy('itemID', 'desc')
                                     ->get()
                                     ->pluck('itemID')
                                     ->toArray();

        $previousCategoryXrefs = TagXref::where('tagID', $previousCategory->id)
                                     ->orderBy('itemID', 'desc')
                                     ->get()
                                     ->pluck('itemID')
                                     ->toArray();

        $articles = Article::whereIn('id', $lastCategoryXrefs)
                            ->where('published', '1')
                            ->orderBy('order', 'asc')
                            ->get();



        // $previousArticles = Article::whereIn('id', $previousCategoryXrefs)
        // ->with('tag')
        // ->where('published', 1)
        // ->inRandomOrder()
        // ->limit(3)
        // ->get();

        $edicionesAnteriores = Tag::with('articles')
        ->selectRaw(
            'vdyvi_k2_tags.*, (select itemID from vdyvi_k2_tags_xref where tagID = vdyvi_k2_tags.id order by itemID desc limit 1) as articleID'
        )
        ->where('published', 1)
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();

        $articleFeatured = Article::where('featured', '1')
        ->where('published', '1')
        ->orderBy('id', 'desc')
        ->first();


        $datosSeminarios = Storage::disk('root')->get('seminarios.json');


        // Obeteniendo los seminarios de Sipgo

        $from = Carbon::now()->format('Y-m-d');
        $to = Carbon::now()->addYear()->format('Y-m-d'); // one year more

        $events =  $this->posts->lastEvents(6, $from, $to);


        return view('home')->with(compact('articleFeatured', 'articles', 'lastCategory', 'events', 'edicionesAnteriores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    public function facilitador(Request $request, Article $article){

        $slug = $request->facilitador;

        $author = Author::where('slug', $slug)->first();
        //$id_sipgo = $author->id_sipgo;

        // Articles
        $articles = Article::where( 'id_facilitador', $author->userID)->latest()->get();

        return view( 'facilitador', ['author'=>$author,'articles'=>$articles] );
    }

    public function facilitador_redirect(Request $request){

        $id = $request->facilitador_id;

        $author = Author::where('id_sipgo', $id)->first();

        if( !isset( $author->slug ) ){

            return redirect('/');
        }

        return redirect('/facilitador/'. $author->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($category, Article $article, $alias){
        
        $datosSeminarios = Storage::disk('root')->get('seminarios.json');

        $datosSeminariosTodos = Storage::disk('root')->get('seminarios-todos.json');

        $jsonSeminarios = json_decode($datosSeminarios, true);

        $lastCategory = Tag::where('published', '1')
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategory = Tag::where('published', '1')
                             ->where('id', '<', $lastCategory->id)
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategoryXrefs = TagXref::where('tagID', $previousCategory->id)
                                     ->orderBy('itemID', 'desc')
                                     ->get()
                                     ->pluck('itemID')
                                     ->toArray();

        $previousArticles = Article::whereIn('id', $previousCategoryXrefs)
        ->with('tag')
        ->where('published', 1)
        ->inRandomOrder()
        ->limit(3)
        ->get();

        $previousArticle = Article::where('id', '<', $article->id)
                                   ->where('published', '1')
                                   ->orderBy('id', 'desc')
                                   ->first();

        $nextArticle = Article::where('id', '>', $article->id)
                                   ->where('published', '1')
                                   ->orderBy('id', 'asc')
                                   ->first();

        $relatedArticles = Article::where('catid', $article->catid)
                                ->where('published', '1')
                                ->where('id', '<>', $article->id)
                                ->inRandomOrder()
                                ->limit(5)
                                ->get();

        $article->hits += 1; // contador de visitas

        $article->save(); // salvando conteo

        $facilitador = (object) array('cantidad' => 0);
        $lineaTematica = (object) array('cantidad' => 0);
        $tdv = (object) array('cantidad' => 0);
        $gestion = (object) array('cantidad' => 0);

        //  Hackery to allow HTTPS
        // $guzzleclient = new \GuzzleHttp\Client([
        // 'timeout' => 60,
        // 'verify' => false,
        // ]);


        if (isset($article->id_facilitador) && $article->id_facilitador !== 0) {
            if (isset($article->id_lineatematica) && $article->id_lineatematica !== 0) {
                $lineaTematica = '';
            }
            $facilitador = "";

            $tdv = '';

            $gestion = '';
        } else {
            $categoria = 0;
        }

        /**Schema */
        if (class_exists(Schema::class)) {
            $schemaScript = Schema::article()
                                ->dateModified($article->updated_at)
                                ->datePublished($article->created_at ?? $article->created)
                                ->headline(substr($article->title, 0, 110))
                                ->image($article->imageLocal ? url($article->imageLocal) : '')
                                ->toScript();
        } else {
            $schemaData = [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'dateModified' => $article->updated_at,
                'datePublished' => $article->created_at ?? $article->created,
                'headline' => substr($article->title, 0, 110),
                'image' => $article->imageLocal ? url($article->imageLocal) : '',
            ];
            $schemaScript = '<script type="application/ld+json">' . json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
        }

        // Facilitador
        $facilitador_id = $article->id_facilitador;
        $facilitador = Author::where('userID',$facilitador_id)->first();

        // Obtener sitios con artículos del sujeto
        $intras_sites = [];

        if( isset( $facilitador->id_sipgo ) ){

            $intras_sites = file_get_contents( 'https://intras.com.do/wp-json/intras/ecosystem?facilitator_id='. $facilitador->id_sipgo .'&site=managementupdate.com' );
            $intras_sites = json_decode( $intras_sites );
        }

        return view('article')->with(compact('article', 'intras_sites', 'schemaScript', 'datosSeminarios', 'previousArticle', 'nextArticle', 'jsonSeminarios', 'previousArticles', 'datosSeminariosTodos', 'relatedArticles', 'lineaTematica', 'facilitador', 'tdv', 'gestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function category($alias){

        $category = Category::where([['alias', $alias]])
                              ->first();

        /*$articles = Article::where('id_lineatematica', '=', $category->id)
        ->orderBy('id', 'desc')
        ->paginate(10);*/

        $articles = $category->articles()
                             ->where('published', '1')
                             ->orderBy('id', 'desc')
                             ->paginate(10);

        $datosSeminarios = Storage::disk('root')->get('seminarios.json');

        $jsonSeminarios = json_decode($datosSeminarios, true);

        $lastCategory = Tag::where('published', '1')
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategory = Tag::where('published', '1')
                             ->where('id', '<', $lastCategory->id)
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategoryXrefs = TagXref::where('tagID', $previousCategory->id)
                                     ->orderBy('itemID', 'desc')
                                     ->get()
                                     ->pluck('itemID')
                                     ->toArray();

        $previousArticles = Article::whereIn('id', $previousCategoryXrefs)
        ->with('tag')
        ->where('published', '1')
        ->inRandomOrder()
        ->limit(3)
        ->get();

        return view('categoria')->with(compact('articles', 'category', 'jsonSeminarios', 'previousArticles'));
    }

    public function author( $autor ){

        return $autor;
    }

    public function edition($alias)
    {
        $aliasOrg = explode("-", $alias);

        $alias = explode('-', $alias);

        if (strlen($alias[1]) == 1) {
            $alias[1] = '00'.$alias[1];
        }

        if (strlen($alias[1]) == 2) {
            $alias[1] = '0'.$alias[1];
        }

        $edicion = Tag::where('name', $alias[0].' '.$alias[1])
                       ->firstOrFail();

        $id = $edicion->id;

        $articlesIds = $edicion->tagXrefs()->pluck('itemID');

        $articles = Article::whereIn('id', $articlesIds)
                            ->where('published', '1')
                            ->orderBy('id', 'desc')
                            ->paginate(10);

        $datosSeminarios = Storage::disk('root')->get('seminarios.json');


        $jsonSeminarios = json_decode($datosSeminarios, true);

        $lastCategory = Tag::where('published', '1')
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategory = Tag::where('published', '1')
                             ->where('id', '<', $lastCategory->id)
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategoryXrefs = TagXref::where('tagID', $previousCategory->id)
                                     ->orderBy('itemID', 'desc')
                                     ->get()
                                     ->pluck('itemID')
                                     ->toArray();

        $previousArticles = Article::whereIn('id', $previousCategoryXrefs)
                            ->where('published', '1')
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();

        $edicionesAnteriores = Tag::with('articles')
                                ->selectRaw(
                                    "vdyvi_k2_tags.*, (select itemID from vdyvi_k2_tags_xref where tagID = vdyvi_k2_tags.id order by itemID desc limit 1) as articleID"
                                )
                                ->orderBy('id', 'desc')
                                ->limit(3)
                                ->whereRaw("vdyvi_k2_tags.id < $id")
                                ->get();

        return view('home')->with(compact('articles', 'edicion', 'jsonSeminarios', 'previousArticles', 'aliasOrg', 'edicionesAnteriores'));
    }

    public function about()
    {
        $datosSeminarios = Storage::disk('root')->get('seminarios.json');

        $jsonSeminarios = json_decode($datosSeminarios, true);

        $lastCategory = Tag::where('published', '1')
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategory = Tag::where('published', '1')
                             ->where('id', '<', $lastCategory->id)
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategoryXrefs = TagXref::where('tagID', $previousCategory->id)
                                     ->orderBy('itemID', 'desc')
                                     ->get()
                                     ->pluck('itemID')
                                     ->toArray();

        $previousArticles = Article::whereIn('id', $previousCategoryXrefs)
                            ->where('published', '1')
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();

        return view('sobre')->with(compact('jsonSeminarios', 'previousArticles'));
    }

    public function search(Request $request, $query = null)
    {
        if (null !== $request->query('searchword')) {
            $query = $request->query('searchword');
        }

        $datosSeminarios = Storage::disk('root')->get('seminarios.json');

        $jsonSeminarios = json_decode($datosSeminarios, true);

        $lastCategory = Tag::where('published', '1')
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategory = Tag::where('published', '1')
                             ->where('id', '<', $lastCategory->id)
                             ->orderBy('id', 'desc')
                             ->first();

        $previousCategoryXrefs = TagXref::where('tagID', $previousCategory->id)
                                     ->orderBy('itemID', 'desc')
                                     ->get()
                                     ->pluck('itemID')
                                     ->toArray();

        $previousArticles = Article::whereIn('id', $previousCategoryXrefs)
                            ->where('published', '1')
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();

        $articles = Article::where('title', 'like', '%'.$query.'%')
                             ->orWhere('introtext', 'like', '%'.$query.'%')
                             ->orWhere('nombre_seminario', 'like', '%'.$query.'%')
                             ->orWhere('nombre_seminario', 'like', '%'.$query.'%')
                             ->orderBy('id', 'desc')
                             ->paginate(10)
                             ->withQueryString();

        $all = Article::where('title', 'like', '%'.$query.'%')
        ->orWhere('introtext', 'like', '%'.$query.'%')
        ->orWhere('nombre_seminario', 'like', '%'.$query.'%')
        ->orWhere('nombre_seminario', 'like', '%'.$query.'%')->get();
        $total = count($all);

        return view('busqueda')->with(compact('jsonSeminarios', 'previousArticles', 'articles', 'query', 'total'));
    }

    public function getSeminarios()
    {
        $client = new Client();

        //  Hackery to allow HTTPS
        $guzzleclient = new \GuzzleHttp\Client([
        'timeout' => 60,
        'verify' => false,
        ]);

        //  Hackery to allow HTTPS
        $client->setClient($guzzleclient);

        $seminarios = $guzzleclient->request('GET', 'https://intras.com.do/api/seminarios-todos');

        $seminarios = json_decode($seminarios->getBody());

        $json_string = json_encode($seminarios);

        Storage::disk('root')->put('seminarios-todos.json', $json_string);
    }

    public function getProxSeminarios()
    {
        $client = new Client();

        //  Hackery to allow HTTPS
        $guzzleclient = new \GuzzleHttp\Client([
        'timeout' => 60,
        'verify' => false,
        ]);

        //  Hackery to allow HTTPS
        $client->setClient($guzzleclient);

        $seminarios = $guzzleclient->request('GET', 'https://intras.com.do/api/seminarios-prox');

        $seminarios = json_decode($seminarios->getBody());

        $json_string = json_encode($seminarios);

        Storage::disk('root')->put('seminarios.json', $json_string);
    }

    public function lastItems()
    {
        $articles = Article::where('published', '1')
                            ->orderBy('id', 'DESC')
                            ->limit(10)

                            ->get();

        foreach ($articles as $article) {
            //echo $article->id;
        }

        return $articles;
    }

    public function lastItemsIntras(){
        $articles = Article::where('published', '1')
                            ->orderBy('id', 'DESC')
                            ->limit(6)

                            ->get();
        $the_items;

        foreach ($articles as $article) {
            
            $the_item['id'] = $article->id;
            $the_item['title'] = $article->title;
            $the_item['slug'] = $article->alias;
            $the_item['excerpt'] = $article->introtext;
            $the_item['url'] = $article->getUrlAttribute();
            $the_item['image'] = $article->getImageAttribute() . '?w=500&h=249&fit=crop';
            $the_item['image_large'] = $article->getImageAttribute();

            $the_items[] = $the_item;
        }

        return $the_items;
    }
}
