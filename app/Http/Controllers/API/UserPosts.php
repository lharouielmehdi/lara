<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use Illuminate\Support\Facades\DB;

class UserPosts extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $ai=auth('api')->user()->id;
        /*$list =Post::all();
        return $list;*/
      /*  $post = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')

        ->where('user_id', '=', auth('api')->user()->id)
        ->select('posts.namee', 'posts.description','users.name','posts.id','posts.owner','posts.owner_phone','posts.ville','posts.place','posts.date')->get();
        return $post;*/
        $post = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.namee', 'posts.description','users.name','posts.id','posts.owner','posts.owner_phone','posts.ville','posts.place','posts.date')->get();
        return $post;
       // return post::latest()->paginate(10);
      //  return Post:: auth('api')->user()->posts;
     //   return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =new Post();
        $this->validate($request,[
            'namee' => ['required', 'string', 'max:255'],
            'date' => ['required', 'Date',  'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'place' => ['required', 'integer', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
        ]);
       /* return Post::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'ville'=>$request['ville'],
            'place'=>$request['place'],
            'owner'=>$request['owner'],
            'date' => $request['date'],
            'owner_phone' => $request['owner_phone'],

            ]);*/
        $user->namee=$request->input('namee');
        $user->description=$request->input('description');
        $user->owner=$request->input('owner');
        $user->owner_phone=$request->input('owner_phone');
        $user->ville=$request->input('ville');
        $user->date=$request->input('date');
        $user->place=$request->input('place');
          $user->user_id=auth('api')->user()->id;
           /* if($request->hasFile('photo')){

               $user->photo= $request->photo->store('imag');
            }*/
          $user->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $detail = DB::table('posts')
        ->where('posts.id', '=', $id)->get();
        return $detail;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->validate($request,[
            'namee' => ['required', 'string', 'max:255'],
            'date' => ['required', 'Date',  'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'place' => ['required', 'integer', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
        ]);

        $post->update($request->all());
        return['message'=>'salut from update'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::findOrFail($id);

        $post->delete();
    }
    public function detail(){
      /* $detail = Post::all();
        return $detail;*/
         $post = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')

        ->where('user_id', '=', auth('api')->user()->id)
        ->select('posts.namee', 'posts.description','users.name','posts.id','posts.owner','posts.owner_phone','posts.ville','posts.place','posts.date')->get();
        return $post;
      /*  $detail = DB::table('posts')
        ->where('posts.id', '=', $id)->get();
        return $detail;*/
      /*  $post = DB::table('posts')
        ->where('post.id', '=', $id)
        ->select('posts.namee', 'posts.description','users.name','posts.id','posts.owner','posts.owner_phone','posts.ville','posts.place','posts.date')->get();
        return $post;*/
    }

}
