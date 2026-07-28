<?php

namespace App\Http\Controllers;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class GestaoDeEvenosController extends Controller
{
    public function eventos()
    {
        $eventos = Evento::latest()->paginate(15);
        return view('eventos', compact('eventos'));
    }


    public function cadastrar(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|max:2048',
        ]);
        $dados['password'] = Hash::make($request->password);
        if ($request->hasFile('foto')) {
            $dados['foto'] = $request->file('foto')->store('usuarios', 'public');
        }
        Usuario::create($dados);
        return redirect()->route('gestaoDeEventos-eventos');
    }

    public function logar(Request $request)
    {
        $credenciais = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            return redirect()->route('gestaoDeEventos-usuarios');
        }
        return back()->withErrors(['email' => 'Email ou senha incorretos.'])->onlyInput('email');
    }

    public function usuarios()
    {
        $usuario = Auth::user();
        if (!$usuario)
            return redirect()->route('gestaoDeEventos-eventos');

        $eventos = Evento::where('usuario_id', $usuario->id)->get();
        return view('usuarios', compact('usuario', 'eventos'));
    }

    public function criarEvento(Request $request)
    {
        $dados = $request->validate([
            'usuario_id' => 'required|numeric',
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('eventos', 'public');
        }

        Evento::create($dados);
        return redirect()->route('gestaoDeEventos-usuarios');
    }

    public function editarEvento(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);


        if ($evento->usuario_id !== Auth::id()) {
            abort(403);
        }

        $dados = $request->only('titulo', 'descricao', 'preco');
        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('eventos', 'public');
        }
        $evento->update($dados);
        return redirect()->route('gestaoDeEventos-usuarios');
    }

    public function excluirEvento($id)
    {
        $evento = Evento::findOrFail($id);

        if ($evento->usuario_id !== Auth::id()) {
            abort(403);
        }

        $evento->delete();
        return redirect()->route('gestaoDeEventos-usuarios');
    }


    public function lixeira()
    {
        $usuario = Auth::user();
        $eventosDeletados = Evento::onlyTrashed()
            ->where('usuario_id', $usuario->id)
            ->get();
        return view('lixeira', compact('eventosDeletados'));
    }


    public function restaurarEvento($id)
    {
        $evento = Evento::onlyTrashed()->findOrFail($id);
        if ($evento->usuario_id !== Auth::id())
            abort(403);

        $evento->restore();
        return redirect()->route('gestaoDeEventos-lixeira')->with('success', 'Evento restaurado!');
    }


    public function deletarPermanente($id)
    {
        $evento = Evento::onlyTrashed()->findOrFail($id);
        if ($evento->usuario_id !== Auth::id())
            abort(403);

        $evento->forceDelete();
        return redirect()->route('gestaoDeEventos-lixeira')->with('success', 'Evento removido permanentemente!');
    }

}