<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\Nkf;
use App\Models\flat;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorepostsRequest;
use App\Http\Requests\UpdatepostsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{     public function __construct(){
    $this->middleware('permission:post-view', ['only'=>['index',"showLast"]]);
    $this->middleware('permission:post-create', ['only'=>['create','store']]);
    $this->middleware('permission:post-edit', ['only'=>['edit','update']]);
    $this->middleware('permission:post-delete', ['only'=>['destroy']]);
    $this->middleware('permission:post-show', ['only'=>['show']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $title = 'Naujienos';
        $user = auth::user();

        $house_id = flat::where('id',auth::user()->flat_id)->pluck('house_id');
        $nkfLastFive=Nkf::where('house_id',$house_id)->where('type','planas')->orderBy('nkfs.id','desc')->take(5)->get();
        foreach ($nkfLastFive as $listitem){
        $likes = DB::table('votes')->where('nkf_id', $listitem->id)->sum('like');
        $dislikes = DB::table('votes')->where('nkf_id', $listitem->id)->sum('dislike');
        $listitem->likes = $likes;
        $listitem->dislikes = $dislikes;}


        $posts = Posts::orderBy('created_at', 'desc')->get();
        foreach ($posts as $item){
            $urlHost = parse_url($item->postLink);
            $item->base_url = $urlHost;
        }

        return view('posts.index', ['posts' => $posts, 'nkfLastFive'=>$nkfLastFive, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $title = 'Pridėti naujieną';
        return view ('posts.create',['title'=>$title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepostsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepostsRequest $request)
    {   $request->validate([
        'postName'=>'required|min:4|string',
        'postBody'=>'required|min:30|string',
        'postImage'=>'required|image|mimes:jpeg,png,jpg,gif|max:2500',
      ],[],[
        'postName'=>'antraštė',
        'postBody'=>'skelbimo tekstas',
        'postImage'=>'nuotrauka',
      ]);

        if($request->hasFile('postImage')){
            $originalFileName = $request->file('postImage')->getClientOriginalName();
            $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
            $extension = $request->file('postImage')->getClientOriginalExtension();
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            $path = $request->file('postImage')->storeAs('public/cover_images',$fileNameToStore);

            $name = $fileNameToStore;
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $url = request('postLink');
        $urlsplit = parse_url($url);
        $urlPath = $urlsplit['path'];
        $urlSave ="https://".$urlPath;

        $post = new Posts ();
        $post->postName = request('postName');
        $post->postBody = request('postBody');
        $post->postLink = $urlSave;
        $post->postImage = $fileNameToStore;
        $post->uploadedBy = auth()->user()->id;
        $post->save();
        return redirect ('home')->with('good_message', 'Dėkui, Jūs sėkmingai pasidalinote naujiena!');;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(posts $posts)
    {
        $posts = Posts::findOrFail($posts->id);
        return view ('posts/show',['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(posts $posts)
    {
        return view('posts.edit', ['posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepostsRequest  $request
     * @param  \App\Models\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepostsRequest $request, posts $posts)
    {   $request->validate([
            'postName'=>'required|min:4|string',
            'postBody'=>'required|min:30|string',
            'postImage'=>'required|image|mimes:jpeg,png,jpg,gif|max:2500',
        ],[],[
            'postName'=>'antraštė',
            'postBody'=>'skelbimo tekstas',
            'postImage'=>'nuotrauka',
        ]);

        if($request->hasFile('postImage')){
            // Pasiemam originalu failo pavadinima. Isskaidom i pavadinima ir galune. Sugeneruojam originalu pavadinima
            // Pavadinimas = pavadinimas.data.galune
            $originalFileName = $request->file('postImage')->getClientOriginalName();
            $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
            $extension = $request->file('postImage')->getClientOriginalExtension();
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            $path = $request->file('postImage')->storeAs('public/cover_images',$fileNameToStore);
        }

        $posts->postName = $request->postName;
        $posts->postBody = $request->postBody;
        $posts->postLink = $request->postLink;

        if($request->hasFile('postImage')){
            $posts->postImage = $fileNameToStore;
        }

        $posts->uploadedBy = auth()->user()->id;
        $posts->save();
        return redirect ('home')->with('good_message', 'Jūs sėkmingai redagavote įrasą!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(posts $posts)
    {
        $posts->delete();
        return redirect('home')->with('good_message', 'Jūs sėkmingai ištrynėte įrasą!');
        }
    }

