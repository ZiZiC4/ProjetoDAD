<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
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
        $user->save();
        //return new UserResource($user);
        return response()->json(new UserResource($user), 201);
        //return $user;
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
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


    public function updateProfileWithPass(Request $request){
        $id = $request->userId;
        $user = User::findOrFail($id);
        if ($user->type == "C") {
            $request->validate([
            'name' => 'required|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            //'email' => 'email|unique:users,email,',
            //'nif'   => 'integer|digits:9',
            'password' => 'min:3',
            ]);
        }else {
            $request->validate([
            'name' => 'required|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            //'email' => 'email|unique:users,email,',
            'password' => 'min:3',
            ]);
        }

        $user->name = $request->name;
        //$user->email = $request->email;

        /*if (!Storage::disk('public')->exists('fotos/' . $request->photo_url)) {
            $photo = $request->photo_url;
            $photoB64 = $request->base64;
            $base64_string = explode(',', $photoB64);
            $imageBin = base64_decode($base64_string[1]);
            Storage::disk('public')->delete('fotos/' . $user->photo_url);
            Storage::disk('public')->put('fotos/' . $request->photo_url, $imageBin);
        }
        $user->photo = $request->photo;*/

        if (Hash::check($request->oldpassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return new UserResource($user);
        }
        return response()->json('Old password is incorrect!', 402);
    }

    public function updateProfileWithoutPass(Request $request){
        $id = $request->userId;
        $user = User::findOrFail($id);
        if ($user->type == "C") {
            $request->validate([
            'name' => 'required|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            //'email' => 'email|unique:users,email,',
            //'nif'   => 'integer|digits:9',
            ]);
        }else {
            $request->validate([
            'name' => 'required|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            //'email' => 'email|unique:users,email,',
            ]);
        }
        $user->name = $request->name;
        //$user->email = $request->email;

        /*if (!Storage::disk('public')->exists('fotos/' . $request->photo_url)) {
            $photo = $request->photo_url;
            $photoB64 = $request->base64;
            $base64_string = explode(',', $photoB64);
            $imageBin = base64_decode($base64_string[1]);
            Storage::disk('public')->delete('fotos/' . $user->photo_url);
            Storage::disk('public')->put('fotos/' . $request->photo_url, $imageBin);
        }
        $user->photo = $request->photo;*/
        $user->save();
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        //$user = User::find($id);
        if ($user->type == 'C') {
           $user->customer()->delete();
        }
        $user->delete();
        Storage::delete('public/fotos/' . $user->photo_url);
        return response()->json($user, 204);
    }



    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $blocked = DB::table('users')->select('blocked')->where('id', $id)->get();
        if ($blocked[0]->blocked == 0) {
            $user->blocked = 1;
            $user->save();
        } else {
            $user = User::findOrFail($id);
            $user->blocked = 0;
            $user->save();
            return new UserResource($user);
        }
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

    public function updateCookState(Request $request,User $user){
        
        
        if($request->state){
            $order = Order::where('prepared_by',$user->id)->where('status','P')->get();
            if(!$order){
                $tdate = date('Y-m-d H:i:s');
                $user->available_at = $tdate;
                $user->save();
            }

        }else{
            $user->available_at = null;
            $user->save();
        }

        return $request;
    }

    public function updateDelState(Request $request, User $user)
    {
        if($request->state){
            $order = Order::where('delivered_by',$user->id)->where('status','T')->get();
            if(!$order){
                $tdate = date('Y-m-d H:i:s');
                $user->available_at = $tdate;
                $user->save();
            }
        }else{
            $user->available_at = null;
            $user->save();
        }
    }
}
