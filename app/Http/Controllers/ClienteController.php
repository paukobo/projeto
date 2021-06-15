<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use App\Http\Requests\ClientePost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function admin(Request $request)
    {
        /* $selectedCurso = $request->curso ?? ''; */
        $qry =  Cliente::query();
        /* if ($selectedCurso) {
            $qry->where('curso', $selectedCurso);
        } */
        $clientes = $qry->paginate(10);
        /* $cursos = Curso::pluck('nome', 'abreviatura');  */
        return view('clientes.admin', compact ('clientes'));//, compact('clientes'/* , 'cursos', 'selectedCurso' */));
    }

    public function edit(Cliente $cliente)
    {
        /* $cursos = Curso::pluck('nome', 'abreviatura'); */
        //return view('clientes.edit', compact('cliente'/* , 'cursos' */));
        return view('clientes.edit', compact ('cliente'));
    }
    public function create()
    {
        /* $cursos = Curso::pluck('nome', 'abreviatura'); */
        $cliente = new Cliente;
        $cliente->user = new User;
        //return view('clientes.create', compact('cliente'/* , 'cursos' */));
        return view('clientes.create', compact ('cliente'));
    }

    public function store(ClientePost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->fill($validated_data);
        $newUser->tipo = 'C';
        $newUser->password = Hash::make($request->password);
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos');
            $newUser->foto_url = basename($path);
        }
        $newUser->save();
        $cliente = new Cliente;
        $cliente->fill($validated_data);
        $cliente->id = $newUser->id;
        $cliente->save();
        //Enviar email para verificação do email:
        $cliente->user->sendEmailVerificationNotification();
        return redirect()->route('admin.clientes.edit', $cliente)
            ->with('alert-msg', 'Cliente "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(ClientePost $request, Cliente $cliente)
    {
        $validated_data = $request->validated();
        $cliente->user->fill($validated_data);
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos' . $cliente->user->foto_url);
            $path = $request->foto->store('public/fotos');
            $cliente->user->foto_url = basename($path);
        }
        $cliente->user->save();
        $cliente->fill($validated_data);
        $cliente->save();
        return redirect()->route('admin.clientes')
            ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Cliente $cliente)
    {
        $oldName = $cliente->user->name;
        $user = $cliente->user;
        /* if (count($cliente->encomendas)) {
            return redirect()->route('admin.clientes')
                ->with('alert-msg', 'Não foi possível apagar o Cliente "' . $oldName . '", porque este cliente tem encomenda(s) pendente(s)!')
                ->with('alert-type', 'danger');
        } */

        Storage::delete('public/fotos/' . $cliente->user->foto_url);
        $cliente->delete();
        $user->delete();

        return redirect()->route('admin.clientes')
            ->with('alert-msg', 'Cliente "' . $oldName . '" foi apagado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy_foto(Cliente $cliente)
    {
        Storage::delete('public/fotos/' . $cliente->user->foto_url);
        $cliente->user->foto_url = null;
        $cliente->user->save();
        return redirect()->route('admin.clientes.edit', ['cliente' => $cliente])
            ->with('alert-msg', 'Foto do cliente "' . $cliente->user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function sendVerificationEmail(Cliente $cliente)
    {
        $cliente->user->sendEmailVerificationNotification();
        return redirect()->route('admin.clientes.edit', ['cliente' => $cliente])
            ->with('alert-msg', 'Foi enviado novo email de verificação de email para: "' . $cliente->user->name . '"')
            ->with('alert-type', 'success');
    }
}
