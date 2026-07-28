@extends('layout.default')
@section('title', 'Lixeira')

@section('content')
    <div class="perfil">
        <h1>Lixeira de Eventos</h1>
        <a href="{{ route('gestaoDeEventos-usuarios') }}" style="margin-left: -300px;">Voltar</a>

        @foreach($eventosDeletados as $evento)
            <div class="eventos">
                <p>{{ $evento->titulo }}</p>
                <div class="acoes-evento">
                    <form action="{{ route('gestaoDeEventos-restaurar', $evento->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-editar">Restaurar</button>
                    </form>
                    <form action="{{ route('gestaoDeEventos-deletarPermanente', $evento->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-excluir" style="color: red;">Apagar Definitivo</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection