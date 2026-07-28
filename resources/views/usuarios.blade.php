@extends('layout.default')
@section('title', 'Usuarios')

@section('content')
    <div class="perfil">
        <a href="{{ route('gestaoDeEventos-eventos') }}">Voltar à página de eventos</a>
        <h1>Meu Perfil</h1>
        <img src="{{ asset('storage/' . $usuario->foto) }}" width="120" height="120" style="border-radius:50%">
        <p>Nome: {{ $usuario->nome }}</p>
        <p>Email: {{ $usuario->email }}</p>

        <h2>Meus Eventos</h2>
        @if($eventos->isEmpty())
            <p>Você ainda não tem nenhum evento</p>
        @else
            @foreach($eventos as $evento)
                <div class="eventos">
                    <img src="{{ asset('storage/' . $evento->imagem) }}" alt="">
                    <p>{{ $evento->titulo }}</p>
                    <p>{{ $evento->descricao }}</p>
                    <div class="acoes-evento">
                        <button class="btn-editar"
                            onclick="EditarEvento({{ $evento->id }}, '{{ $evento->titulo }}', '{{ $evento->descricao }}', {{ $evento->preco }})">
                            Editar
                        </button>
                        <form action="{{ route('gestaoDeEventos-excluirEvento', $evento->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-excluir">Excluir</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="acoes-">
            <button class="botao-criar" onclick="ModalCriarEvento()"> Criar evento</button>
            <a href="{{ route('gestaoDeEventos-lixeira') }}" class="botao-lixeira">Ver Lixeira</a>
        </div>
        <div class="modalCriarEvento">
            <div class="modal-content">
                <span class="close" onclick="ModalCriarEvento()">&times;</span>
                <form action="{{ route('gestaoDeEventos-criarEvento') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="usuario_id">Id do usuario</label>
                    <input type="number" name="usuario_id" id="usuario_id" value="{{ $usuario->id }}" required>
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" required>
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" required></textarea>
                    <label for="preco">Preço do ingresso</label>
                    <input type="number" name="preco" id="preco" required>
                    <label for="imagem">Imagem</label>
                    <input type="file" name="imagem" id="imagem" required>
                    <button type="submit">Criar evento</button>
                </form>
            </div>
        </div>

        <div class="modalEditarEvento">
            <div class="modal-content">
                <span class="close" onclick="ModalEditarEvento()">&times;</span>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="edit-titulo">Título</label>
                    <input type="text" name="titulo" id="edit-titulo" required>
                    <label for="edit-descricao">Descrição</label>
                    <textarea name="descricao" id="edit-descricao" required></textarea>
                    <label for="edit-preco">Preço do ingresso</label>
                    <input type="number" name="preco" id="edit-preco" required>
                    <label for="edit-imagem">Imagem</label>
                    <input type="file" name="imagem" id="edit-imagem">
                    <button type="submit">Salvar alterações</button>
                </form>
            </div>
        </div>
    </div>
@endsection