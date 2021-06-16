<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserPost;
use App\Http\Requests\PasswordPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function admin(Request $request)
    {
        /* $selectedCurso = $request->curso ?? ''; */
        $qry =  User::query();
        /* if ($selectedCurso) {
            $qry->where('curso', $selectedCurso);
        } */
        $users = $qry->paginate(10);
        /* $cursos = Curso::pluck('nome', 'abreviatura');  */
        return view('users.admin', compact ('users'));//, compact('clientes'/* , 'cursos', 'selectedCurso' */));
    }

    public function view(User $user){
        return view('users.view', compact ('user'));
    }

    public function edit(User $user)
    {
        /* $cursos = Curso::pluck('nome', 'abreviatura'); */
        //return view('clientes.edit', compact('cliente'/* , 'cursos' */));
        return view('users.edit', compact ('user'));
    }
    public function create(User $user)
    {
        /* $cursos = Curso::pluck('nome', 'abreviatura'); */
        $user = new User;
        //return view('clientes.create', compact('cliente'/* , 'cursos' */));
        return view('users.create', compact ('user'));
    }

    public function store(UserPost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->fill($validated_data);
        $newUser->tipo = $request->tipo;
        $newUser->password = Hash::make('123'); //default porque é o admin que cria
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos');
            $newUser->foto_url = basename($path);
        }
        $newUser->save();
        //Enviar email para verificação do email:
        $newUser->sendEmailVerificationNotification();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        $user->fill($validated_data);
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos' . $user->foto_url);
            $path = $request->foto->store('public/fotos');
            $user->foto_url = basename($path);
        }
        $user->save();

        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(User $user)
    {
        $oldName = $user->name;

        Storage::delete('public/fotos/' . $user->foto_url);
        $user->delete();

        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $oldName . '" foi apagado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function block(User $user){

        if($user->bloqueado == 0){
            $user->bloqueado = 1;
            $user->save();

            return redirect()->route('admin.users')
                ->with('alert-msg', 'User "' . $user->name . '" foi bloqueado com sucesso!')
                ->with('alert-type', 'success');
        }

        if($user->bloqueado == 1){
            $user->bloqueado = 0;
            $user->save();

            return redirect()->route('admin.users')
                ->with('alert-msg', 'User "' . $user->name . '" foi desbloqueado com sucesso!')
                ->with('alert-type', 'success');
        }
    }

    public function destroy_foto(User $user)
    {
        Storage::delete('public/fotos/' . $user->foto_url);
        $user->foto_url = null;
        $user->save();
        return redirect()->route('admin.users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do user "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function sendVerificationEmail(User $user)
    {
        $user->sendEmailVerificationNotification();
        return redirect()->route('admin.users.edit', ['user' => $user])
            ->with('alert-msg', 'Foi enviado novo email de verificação de email para: "' . $user->name . '"')
            ->with('alert-type', 'success');
    }

    public function editPassword(){
        return view('users.resetPass');
    }

    public function updatePassword(PasswordPost $request){
        $user=auth()->user();
        $user->password=Hash::make($request->password);//se a password for a nova
        $user->save();

        return redirect()->route('admin.users')
            ->with('alert-msg', ' A Password foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }
}
