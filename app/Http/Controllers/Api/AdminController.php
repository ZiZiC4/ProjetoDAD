<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\DB;
use App\User;
use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Jsonable;






class AdminControllerAPI extends Controller
{

  public function index(Request $request)
  {


      return UserResource::collection(User::paginate(15));
      

  }



  public function register(Request $request){


        $request->validate([
            'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'email' => 'required|email|unique:users,email,',
            'password' => 'min:3|nullable',
            'password_confirmation' => 'required_with:password|same:password|min:3'

        ]);

        $user = new User();
        $user->fill($request->all());
        //user->fill()
        $user->password = Hash::make($user->password);
        //$user->photo = $request->photo['base64'] ? $request->photo['name'] : null;
        $user->save();


        return response()->json(new UserResource($user), 201);
  }


  public function getUsersFiltered(Request $request){

        if(!is_null($request->name) || !is_null($request->type) || !is_null($request->email) || !is_null($request->active)){

            if(!is_null($request->name)){
                $users = $users->where('name', 'like', $request->name . '%');
            }
            if(!is_null($request->type)){
                $users = $users->where('type', $request->type);
            }
            if(!is_null($request->email)){
                $users = $users->where('email', 'like', $request->email . '%');
            }
            if(!is_null($request->active)){
                if($request->type == null || $request->type == 'u'){
                    $users = $users->where('active', $request->active);
                }else{
                    return "Can't search by status and type if type is different form 'Platform User'!";
                }
            }

            $users = $users->paginate(15);
        return $users;
    }


    public function delete($id) {
      $user = User::findOrFail($id);
      $user->delete();
      return response()->json(null, 204);



}
