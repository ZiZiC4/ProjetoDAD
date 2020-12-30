<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\Models\User;
use App\Models\Customer;
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

    public function index(Request $request)
    {
        $users = auth()->user()->id;
        if ($request->has('page')) {

            $users = User::query();

            if ($request->filled('type')) {
                $users->where('type', '=', $request->type);
            }
            if ($request->filled('name')) {
                $users->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('email')) {
                $users->where('email', 'like', $request->email . '%');
            }

            if ($request->filled('blocked')) {
                $users->where('blocked', '=', $request->blocked);
            }
            $users = UserResource::collection($users->paginate(10));
        } else {
            $users = UserResource::collection(User::all());
        }
        return $users;
    }

    public function me(Request $request)
    {
        return $request->user();
        // Alternative:
        // return Auth::user();
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function storeCustomer(Request $request){
        $request->validate([
            'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'address' => 'required|min:5',
            'phone' => 'integer|min:9',
            'nif' => 'nullable|integer|digits:9'
        ]);
        if ($request->photo['base64']) {
            $photo = $request->photo;
            $base64str = explode(',', $photo['base64']);
            $imageBin = base64_decode($base64str[1]);
            if (!Storage::disk('public')->exists('fotos/' . $photo['name'])) {
                Storage::disk('public')->put('fotos/' . $photo['name'], $imageBin);
            }
        }
        
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($user->password);
        $user->photo_url = $request->photo['base64'] ? $request->photo['name'] : null;
        $user->save();//primeiro grava-se os users e depois associa-se o customer
        $customer = new Customer();
        $customer->user()->associate($user);
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->nif = $request->nif;
        $customer->save();
        return response()->json(new UserResource($user), 201);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'type' => 'required|in:EM,ED,EC'
        ]);

        if ($request->photo['base64']) {
            $photo = $request->photo;
            $base64str = explode(',', $photo['base64']);
            $imageBin = base64_decode($base64str[1]);
            if (!Storage::disk('public')->exists('fotos/' . $photo['name'])) {
                Storage::disk('public')->put('fotos/' . $photo['name'], $imageBin);
            }
        }

        $user = new User();
        $user->fill($request->all());
        //$user->fill($request->validated());
        $user->password = Hash::make($user->password);
        $user->photo_url = $request->photo['base64'] ? $request->photo['name'] : null;
        //$user->customer()->nif = $request->nif;
        $user->save();
        //return new UserResource($user);
        return response()->json(new UserResource($user), 201);
        //return $user;
    }


    public function update(Request $request, User $id)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'email' => 'required|email|unique;users,email,' . $id,
        ]);
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return new UserResource($user);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }

    public function blockedUser($id)
    {
        $user = User::findOrFail($id);
        $blocked = DB::table('users')->select('blocked')->where('id', $id)->get();
        if ($blocked[0]->blocked == 0) {
            $user->blocked = 1;
            $user->save();
        } else {
            $user = User::findOrFail($id);
            $user->active = 0;
            $user->save();
            return new UserResource($user);
        }
        return new UserResource($user);
    }

    public function profileRefresh(Request $request)
    {
        return new UserResource($request->user());
    }

    public function emailAvailable(Request $request)
    {
        $totalEmail = 1;
        if ($request->has('email') && $request->has('id')) {
            $totalEmail = DB::table('users')->where('email', '=', $request->email)->where('id', '<>', $request->id)->count();
        } else if ($request->has('email')) {
            $totalEmail = DB::table('users')->where('email', '=', $request->email)->count();
        }
        return response()->json($totalEmail == 0);
    }


    public function updateProfilewithPass(Request $request)
    {
        $id = $request->userId;
        $user = User::findOrFail($id);
        if ($user->type == "C") {
            $request->validate([
                'name'      => 'required|regex:/^[a-zA-Zà-Ú ]+$/',
                'nif'       => 'integer|digits:9',
                'password' => 'min:3',
                // 'photo' => 'regex:/png$/',
            ]);
        } else {
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

        //verificar o reset da password
        if (Hash::check($request->oldpassword, $user->password)) {
            //  console.log("Password Igual");
            $user->password = Hash::make($request->password);
            $user->save();
            return new UserResource($user);
        }
        return response()->json('Old Password is incorrect !', 402);
    }


    public function updateProfilewithoutPass(Request $request)
    {
        $id = $request->userId;
        $user = User::findOrFail($id);
        if ($user->type == "C") {
            $request->validate([
                'name'      => 'required|regex:/^[a-zA-Zà-Ú ]+$/',
                'nif'       => 'integer|digits:9',
                //   'photo'     => 'required|regex:/^.+\.((jpg)|(gif)|(png))$/' 
            ]);
        } else {
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

    public function getAllUsersBlocked()
    {
        $blocked = UserResource::collection(User::where('type', 'C')->where('blocked', '1')->get());
        $active = UserResource::collection(User::where('type', 'C')->where('blocked', '0')->get());

        $totalBlocked = sizeof($blocked);
        $totalActive = sizeof($active);

        $total[0] = $totalBlocked;
        $total[1] = $totalActive;

        return $total;
    }
}
