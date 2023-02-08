<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Http\Requests\StorepostsRequest;
use App\Http\Requests\UpdatepostsRequest;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::orderBy('created_at', 'desc')->get();
        foreach ($posts as $item){
            $urlHost = parse_url($item->postLink);
            $item->base_url = $urlHost;
        }

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('posts.create');
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
        // $urlHost = $urlsplit['host'];
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

