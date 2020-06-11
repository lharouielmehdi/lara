<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
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
        $this->authorize('isAdmin');
        return user::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:2'],
        ]);
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type'=>$request['type'],
            'phone'=>$request['phone'],
            'bio'=>$request['bio'],
            'password' => Hash::make($request['password']),
        ]);
    }

    public function updateProfile(Request $request)
    {
     $user=  auth('api')->user();
     $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['sometimes','required', 'string', 'min:2'],
    ]);
    if(!empty($request->password)){
    $request->merge(['password' => Hash::make($request['password'])]);
    }
    $user->update($request->all());
     return ['message'=>'updateProfile'];
    }

    public function profile()
    {
        return auth('api')->user();
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

        $user =User::findOrFail($id);


        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'string', 'min:2'],
        ]);
        if(!empty($request->password)){
    $request->merge(['password' => Hash::make($request['password'])]);
    }
        $user->update($request->all());
        return['message'=>'update from'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::findOrFail($id);
        $user->delete();
        return ['message'=>'delete sucsusfully'];
    }
    public function searchit(){
        if($search = \Request::get('q')){
            $users=User::where(function($query)use($search){
                $query->where('name','LIKE',"%$search%")
                         ->orwhere('email','LIKE',"%$search%");
            })->paginate(10);
        }else{
            return user::latest()->paginate(10);
        }
        return $users;

    }
}
