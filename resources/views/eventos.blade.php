@extends('layout.default')
@section('title', 'Eventos')
@section('content')
    @if($errors->any())
        <div class="erros">
            @foreach($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <header class="cabecalho">
        <h1>Eventos Disponíveis</h1>
        <div class="acoes">
            <button onclick="modalLogar()">Iniciar sessão</button>
            <button onclick="modalCadastrar()">Cadastrar-se</button>
        </div>
    </header>

    <div class="eventos">
        @foreach ($eventos as $evento)
            <div class="evento">
                <img src="{{ asset('storage/' . $evento->imagem) }}" width="100">
                <p>Título: {{ $evento->titulo }}</p>
                <p>Descrição: {{ $evento->descricao }}</p>
                <p>Preço do ingresso: {{ $evento->preco }}</p>
            </div>

        @endforeach
    </div>


    <div class="modalCadastrar">
        <form action="{{ route('gestaoDeEventos-cadastrar') }}" class="Cadastrar" method="post"
            enctype="multipart/form-data">
            @csrf
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha">
            <input type="file" name="foto" id="foto">
            <input type="submit" value="cadastrar">
        </form>
    </div>

    <div class="modalLogar">
        <form action="{{ route('gestaoDeEventos-logar') }}" class="Cadastrar" method="post">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha">
            <input type="submit" value="Login">
        </form>
    </div>
@endsection