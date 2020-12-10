<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Jsonable;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('manager');
    }

    public function index(Request $request)
    {
        if ($request->has('page')) {
            return UserResource::collection(User::paginate(5));
        } else {
            return UserResource::collection(User::all());
    }
    }

    public function me (Request $request)
 {
     return Auth::user();
 }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->validated());
        $user->password = bcrypt($user->password);
        $user->save();
        return new UserResource($user);
        //return response()->json(new UserResource($user), 201);
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user);
    }


    public function destroy(User $user)
    {
        $user->delete();
        //return response()->json(null, 204);
    }


    public function emailAvailable(Request $request)
    {
        $totalEmail = 1;
        if ($request->has('email') && $request->has('id')) {
            $totalEmail = User::where('email', '=', $request->email)->where('id', '<>', $request->id)->count();
        } else if ($request->has('email')) {
            $totalEmail = User::where('email', '=', $request->email)->count();
        }
        return response()->json($totalEmail == 0);
    }





    public function profileRefresh(Request $request)
    {
        return new UserResource($request->user());
    }



    

    public function updateProfilewithPass(Request $request){
        $id = $request->userId;
        $user = User::findOrFail($id);  
        if($user->type == "u"){
            $request->validate([
                'name'      => 'required|regex:/^[a-zA-Zà-Ú ]+$/',
                'nif'       => 'integer|digits:9',   
                'password' => 'min:3',
               // 'photo' => 'regex:/png$/',
            ]);    
        }else{
            $request->validate([
                'name'      => 'required|regex:/^[a-zA-Zà-Ú ]+$/', 
                'password' => 'min:3', 
                //'photo'     => 'required|regex:/^.+/.((jpg)|(gif)|(png))+$/'
            ]);
        }

        $user->name = $request->name;
    
        $user->nif = $request->nif;

        if (!Storage::disk('public')->exists('fotos/' . $request->photo)) {
            $photo = $request->photo;
            $photoB64 = $request->base64;
            $base64_string = explode(',', $photoB64);
            $imageBin = base64_decode($base64_string[1]);
            Storage::disk('public')->delete('fotos/' . $user->photo);
            Storage::disk('public')->put('fotos/' . $request->photo, $imageBin);
        }
        $user->photo = $request->photo; 


        if (Hash::check($request->oldpassword, $user->password)) {
            //  console.log("Password Igual");
            $user->password = Hash::make($request->password);
            $user->save(); 
            return new UserResource($user);
        }
        return response()->json('Old Password is incorrect !', 402);    
    }


    public function updateProfilewithoutPass(Request $request){
        $id = $request->userId;
        $user = User::findOrFail($id);   
        if($user->type == "u"){
            $request->validate([
                'name'      => 'required|regex:/^[a-zA-Zà-Ú ]+$/',
                'nif'       => 'integer|digits:9',   
             //   'photo'     => 'required|regex:/^.+\.((jpg)|(gif)|(png))$/' 
            ]);   
        }else{
            //return response()->json($request->photo,402);
            $request->validate([
                'name'      => 'required|regex:/^[a-zA-Zà-Ú ]+$/',
                //'photo'     => 'required|regex:/(\d)+.(?:jpg|png|gif)+$/',
                //'photo'     => 'required|regex:/^[(jpg)|(gif)|(png)]+$/'
            ]);
        }
       
        $user->name = $request->name;
        
        if (!Storage::disk('public')->exists('fotos/' . $request->photo)) {
            $photo = $request->photo;
            $photoB64 = $request->base64;
            $base64_string = explode(',', $photoB64);
            $imageBin = base64_decode($base64_string[1]);
            Storage::disk('public')->delete('fotos/' . $user->photo);
            Storage::disk('public')->put('fotos/' . $request->photo, $imageBin);
        }
        $user->photo = $request->photo; 
        $user->nif = $request->nif;
        $user->save();
        //return response()->json($user->name,402);
        return new UserResource($user);
    }

}
