<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Offer;
use Auth;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
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
        $post = DB::table('offers')
        ->join('users', 'offers.user_id', '=', 'users.id')
        ->select('offers.namee', 'offers.description','users.name','offers.id','offers.owner','offers.owner_phone','offers.ville','offers.place','offers.date')->get();
        return $post;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user =new offer();
        $this->validate($request,[
            'namee' => ['required', 'string', 'max:255'],
            'date' => ['required', 'Date',  'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'place' => ['required', 'integer', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
        ]);

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
        //
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
        $post = Offer::findOrFail($id);
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
        $post =Offer::findOrFail($id);

        $post->delete();
    }
}
