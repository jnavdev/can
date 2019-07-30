<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Deal;
use App\Role;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
	public function data()
    {
        $users = User::with('role')->orderBy('id', 'DESC')->get();

        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                return '<a href="'.url('usuario/editar/' . $user->id).'" class="btn btn-sm btn-warning">Editar</a> <button data-id="'.$user->id.'" type="button" class="btn btn-sm btn-danger delete-user">Eliminar</button>';
            })->editColumn('created_at', function ($user) {
                return $user->created_at->format('d-m-Y');
            })->rawColumns(['actions'])
            ->make(true);
    }

	public function index()
    {
    	return view('frontEnd.users.index');
	}

	public function perfil(Request $request)
	{
		$user = User::find(Auth::user()->id);
		$deals = Deal::where('creator_id', $user->id)->get();
		return view('frontEnd.users.perfil', compact('deals'));
	}

	public function photoavatar(Request $request)
	{
		$user = User::find($request->id);
		return view('frontEnd.users.changepicture', compact('user'));
	}

	public function changephoto(Request $request)
	{
        $user = User::find($request->id);
        
		if ($request->file('file')) {
            $fileName = "/uploads/users/{$user->id}/" . time() . '-' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path("/uploads/users/{$user->id}/"), $fileName);
            $user->profile_picture = $fileName;
        }
        
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

    	return redirect('perfil')->with('success', 'Guardado con éxito!');
	}

	public function create()
    {
     	$roles = Role::pluck('name', 'id');   
        return view('frontEnd.users.create', compact('roles'));
    }

     public function store(Request $request)
    {
    	$this->validate($request, [
            'rut' => 'required|unique:users,rut',
    		'full_name' => 'required',
    		'email' => 'required|unique:users,email',
    		'password' => 'required',
    		'role_id' => 'required'
    	]);

    	$password = bcrypt($request->password);

    	$user = User::create([
            'rut' => $request->input('rut'),
            'full_name' => $request->input('full_name'),
    		'password' => $password,
    		'role_id' => $request->input('role_id'),
    		'profile_picture' => '/uploads/users/avatar.png',
    		'email' => $request->input('email')
    	]);

    	if ($request->file('file')) {
            $fileName = "/uploads/users/{$user->id}/" . time() . '-' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path("/uploads/users/{$user->id}/"), $fileName);
            $user->profile_picture = $fileName;
            $user->save();
    	}

    	return redirect('usuarios')->with('success', 'Guardado con éxito!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');   
        return view('frontEnd.users.edit', compact('user','roles'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'rut' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);

        $user = User::find($id);

        if ($request->file('file')) {
            $fileName = "/uploads/users/{$user->id}/" . time() . '-' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path("/uploads/users/{$user->id}/"), $fileName);
            $user->profile_picture = $fileName;
        }

        $user->rut = $request->input('rut');
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect('usuarios')->with('success', 'Guardado con éxito!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('usuarios')->with('success', 'Eliminado con éxito!');
    }
}
