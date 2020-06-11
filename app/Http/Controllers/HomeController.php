<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UsersResource;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        if($user->role === 'administrador') {
            return view('home')
                ->with('user', $user)
                ->with('users', $users);
        }else {
            return view('cliente')
                ->with('user', $user);
        }
    }

    public function store()
    {

        $validator = Validator::make(request()->all(), [
            'file' =>'required|mimes:jpg,jpeg,png,bmp|max:20000',
            'nombre' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer',
            'role' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Verifique la información',
                'errors'=> $validator->messages()
            ], 422);
        }

        if (request()->hasFile('file')){

            $file = request()->file('file');
            $cliente = User::create([
                'name' => request()->nombre,
                'lastname' => request()->lastname,
                'email' => request()->email,
                'phone' => request()->phone,
                'role' => request()->role,
                'password' => bcrypt(request()->password),
                'activo' => (request()->activo == 'true') ? '1' : '0',
                'path' => 'temp',
                'faker' => '0'
            ]);
            $id_cliente = $cliente->fresh()->id;
            $name_file = str_replace(' ', '_', $file->getClientOriginalName());
            $name_file =  preg_replace("/[^a-zA-Z0-9.]/", "", $name_file);
            $path = $id_cliente . '/' .$name_file;
            \Storage::disk('fotouser')->put($path,  \File::get($file));
            $cliente->foto = $path;
            $cliente->save();

        }

        return response()->json([
            'message'=>'Cliente agregado',
            'errors'=> '',
            'cliente' => $cliente
        ], 200);
        
    }

    public function allShow()
    {
        
        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $order = (request()->has('sort') && request()->sort != null) ? explode("|", request()->sort) : null;
        $name = $order != null ? $order[0] : 'created_at';
        $orderBy = $order != null ? $order[1] : 'DESC';

        $users = User::orderBy($name, $orderBy)->paginate($perPage);

        return UsersResource::collection($users);

    }

    public function change_status(Request $request, $id){

        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_activo' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Verefique la información',
                'errors'=> $validator->messages()
            ], 422);
        }

        $user->update(['activo' => $request->user_activo]);

        return response()->json([
            'message' => 'Estatus actualizado',
            'status' => 200
        ]);

    }

    public function update(Request $request, User $user)
    {

        $validator = Validator::make(request()->all(), [
            'nombre' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer',
            'role' => 'required',
            'activo' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'verifica la información',
                'errors'=> $validator->messages()
            ], 422);
        }

        $user->update(request()->all());

        return response()->json([
            'message'=>'Se Actualizo corretamente',
            'errors'=> '',
            'users' => $user
        ], 200);

    }

    public function destroy(User $user)
    {

        $user->delete();
        $clientes = User::all();
        return response()->json([
            'clientes' => $clientes,
            'errors'=> ''
        ], 200);

    }
    
}
