<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu titulo')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #1B2430;
            color: #FFF9EC;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2 {
            font-family: serif;
            font-weight: 700;
            margin: 0;
        }

        :focus-visible {
            outline: 3px solid #F2A93B;
            outline-offset: 2px;
        }

        .cabecalho {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 32px 48px;
            border-bottom: 2px solid #F2A93B;
        }

        .cabecalho h1 {
            font-size: clamp(1.5rem, 4vw + 1rem, 2rem);
            color: #FFF9EC;
        }

        .cabecalho h1::before {
            content: "Bilheteria";
            display: block;
            font-family: monospace;
            font-size: .7rem;
            letter-spacing: .35em;
            text-transform: uppercase;
            color: #F2A93B;
            margin-bottom: 8px;
        }

        .cabecalho .acoes {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .cabecalho button {
            cursor: pointer;
            font-family: monospace;
            font-size: .8rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 12px 22px;
            border-radius: 999px;
            border: 2px solid #F2A93B;
            background: transparent;
            color: #F2A93B;
            transition: background .2s, color .2s;
        }

        .erros {
            margin: 24px 24px 0;
            padding: 16px 22px;
            background: #C1432F;
            color: #FFF9EC;
            border-radius: 10px;
            font-family: monospace;
            font-size: .85rem;
        }

        .erros p {
            margin: 4px 0;
        }


        .eventos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 32px;
            padding: 40px 24px 70px;
        }

        .evento {
            position: relative;
            background: #FFF9EC;
            color: #2A2A2A;
            border-radius: 18px 18px 6px 6px;
            overflow: hidden;
            box-shadow: 0 16px 34px rgba(0, 0, 0, .28);
            transition: transform .25s ease;
        }

        .evento:hover {
            transform: translateY(-6px);
        }

        .evento img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: block;
            border-bottom: 3px solid #1B2430;
        }

        .evento::before,
        .evento::after {
            content: "";
            position: absolute;
            top: 178px;
            width: 24px;
            height: 24px;
            background: #1B2430;
            border-radius: 50%;
        }

        .evento::before {
            left: -12px;
        }

        .evento::after {
            right: -12px;
        }

        .evento p {
            margin: 0;
            padding: 0 22px;
            overflow-wrap: break-word;
        }

        .evento p:nth-of-type(1) {
            font-family: serif;
            font-size: 1.15rem;
            font-weight: 700;
            margin-top: 22px;
        }

        .evento p:nth-of-type(2) {
            font-size: .9rem;
            line-height: 1.55;
            color: #555;
            margin-top: 8px;
        }

        .evento p:nth-of-type(3) {
            margin-top: 16px;
            margin-bottom: 26px;
            font-weight: 700;
        }

        .perfil {
            max-width: 680px;
            margin: 56px auto;
            padding: 44px;
            background: #FFF9EC;
            color: #2A2A2A;
            border-radius: 22px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .28);
            text-align: center;
        }

        .perfil h1 {
            color: #1B2430;
            margin-bottom: 22px;
        }

        .perfil>img {
            box-shadow: 0 0 0 4px #FFF9EC, 0 12px 26px rgba(0, 0, 0, .3);
        }

        .perfil>p {
            font-family: monospace;
            font-size: .9rem;
            letter-spacing: .03em;
            margin: 10px 0;
        }

        .perfil h2 {
            color: #1B2430;
            font-size: 1.3rem;
            margin: 38px 0 22px;
            text-align: left;
        }


        .perfil .eventos {
            display: inline-block;
            width: calc(50% - 9px);
            vertical-align: top;
            margin: 0 18px 18px 0;
            padding: 0;
            position: relative;
            background: #FFF9EC;
            border: 1px solid #ECE0C2;
            border-radius: 18px 18px 6px 6px;
            overflow: hidden;
            box-shadow: 0 10px 24px rgba(0, 0, 0, .28);
            text-align: left;
            transition: transform .25s ease;
        }

        .perfil .eventos:nth-of-type(even) {
            margin-right: 0;
        }

        .perfil .eventos:hover {
            transform: translateY(-4px);
        }

        .perfil .eventos img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            display: block;
            border: none;
            border-bottom: 3px solid #1B2430;
            box-shadow: none;
        }

        .perfil .eventos p {
            padding: 0 16px;
            font-family: sans-serif;
            letter-spacing: normal;
            overflow-wrap: break-word;
        }

        .perfil .eventos p:nth-of-type(1) {
            font-family: serif;
            font-weight: 700;
            font-size: 1rem;
            margin-top: 14px;
        }

        .perfil .eventos p:nth-of-type(2) {
            font-size: .82rem;
            color: #666;
            margin: 6px 0 12px;
            line-height: 1.4;
        }


        .acoes-evento {
            display: flex;
            gap: 8px;
            padding: 0 16px 16px;
        }

        .btn-editar,
        .btn-excluir,
        .btn-criar {
            cursor: pointer;
            font-family: monospace;
            font-size: .72rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1.5px solid;
            background: transparent;
            transition: background .18s, color .18s;
            line-height: 1;
        }

        .btn-editar {
            color: #1B2430;
            border-color: #1B2430;
        }


        .btn-excluir {
            color: #C1432F;
            border-color: #C1432F;
        }

        .acoes-criar-lixeira {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 16px;
        }

        @media (min-width: 600px) {
            .acoes-criar-lixeira {
                flex-direction: row;
            }
        }

        .botao-criar,
        .botao-lixeira {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 12px 24px;
            border-radius: 8px;
            border: 2px solid #F2A93B;
            background: #F2A93B;
            color: #1B2430;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }


        .modalLogar,
        .modalCadastrar,
        .modalCriarEvento,
        .modalEditarEvento {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(15, 20, 28, .82);
        }

        .modalLogar.modalAberto,
        .modalCadastrar.modalAberto,
        .modalCriarEvento.modalAberto,
        .modalEditarEvento.modalAberto {
            display: flex;
            animation: surgirFundo .2s ease;
        }

        .modalLogar form,
        .modalCadastrar form {
            position: relative;
            width: 100%;
            max-width: 380px;
            max-height: 90vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            background: #FFF9EC;
            color: #2A2A2A;
            padding: 46px 32px 32px;
            border-radius: 16px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, .45);
            animation: surgirTicket .3s ease forwards;
        }

        .modalLogar form::before,
        .modalCadastrar form::before {
            position: absolute;
            top: 14px;
            right: 22px;
            font-family: monospace;
            font-size: .68rem;
            letter-spacing: .14em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 4px;
            transform: rotate(-5deg);
            color: #FFF9EC;
        }

        .modalLogar label,
        .modalCadastrar label {
            font-family: monospace;
            font-size: .7rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #1B2430;
            opacity: .7;
            margin-top: 16px;
        }

        .modalLogar label:first-of-type,
        .modalCadastrar label:first-of-type {
            margin-top: 4px;
        }

        .modalLogar input,
        .modalCadastrar input {
            border: none;
            border-bottom: 2px solid #ECE0C2;
            background: transparent;
            padding: 10px 4px;
            font-size: 1rem;
            color: #1B2430;
            margin-top: 6px;
            transition: border-color .2s ease;
        }

        .modalLogar input[type="file"],
        .modalCadastrar input[type="file"] {
            border-bottom: none;
            font-size: .82rem;
            padding-top: 14px;
        }

        .modalLogar input:focus,
        .modalCadastrar input:focus {
            outline: none;
            border-bottom-color: #F2A93B;
        }

        .modalLogar input[type="submit"],
        .modalCadastrar input[type="submit"] {
            margin-top: 28px;
            cursor: pointer;
            background: transparent;
            border-radius: 999px;
            padding: 14px;
            font-family: monospace;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .modalLogar input[type="submit"] {
            border: 2px solid #C1432F;
            color: #C1432F;
        }

        .modalCadastrar input[type="submit"] {
            border: 2px solid #F2A93B;
            color: #1B2430;
        }

        .modalLogar form::after,
        .modalCadastrar form::after {
            content: "toque fora do bilhete para fechar";
            display: block;
            margin-top: 18px;
            text-align: center;
            font-family: monospace;
            font-size: .68rem;
            letter-spacing: .06em;
            color: #1B2430;
            opacity: .5;
        }


        .modal-content {
            position: relative;
            width: 100%;
            max-width: 440px;
            max-height: 90vh;
            overflow-y: auto;
            background: #FFF9EC;
            color: #2A2A2A;
            border-radius: 18px;
            padding: 48px 36px 36px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, .45);
            animation: surgirTicket .3s ease forwards;
        }

        .modal-content .close {
            position: absolute;
            top: 16px;
            right: 20px;
            font-size: 1.4rem;
            cursor: pointer;
            color: #888;
            line-height: 1;
            transition: color .15s;
        }

        .modal-content .close:hover {
            color: #C1432F;
        }

        .modal-content form {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .modal-content label {
            font-family: monospace;
            font-size: .68rem;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: #1B2430;
            opacity: .65;
            margin-top: 18px;
        }

        .modal-content label:first-of-type {
            margin-top: 0;
        }

        .modal-content input[type="text"],
        .modal-content input[type="number"],
        .modal-content textarea {
            border: none;
            border-bottom: 2px solid #ECE0C2;
            background: transparent;
            padding: 10px 4px;
            font-size: .95rem;
            color: #1B2430;
            font-family: sans-serif;
            margin-top: 6px;
            transition: border-color .2s;
            width: 100%;
        }

        .modal-content textarea {
            resize: vertical;
            min-height: 80px;
        }

        .modal-content input:focus,
        .modal-content textarea:focus {
            outline: none;
            border-bottom-color: #F2A93B;
        }

        .modal-content input[type="file"] {
            margin-top: 10px;
            font-size: .82rem;
            color: #555;
        }

        .modal-content button[type="submit"] {
            margin-top: 28px;
            cursor: pointer;
            background: #F2A93B;
            color: #1B2430;
            border: none;
            border-radius: 999px;
            padding: 14px;
            font-family: monospace;
            font-weight: 700;
            font-size: .85rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            transition: opacity .18s;
        }

        .modal-content button[type="submit"]:hover {
            opacity: .85;
        }


        #usuario_id {
            display: none;
        }

        label[for="usuario_id"] {
            display: none;
        }

        .perfil a {
            text-decoration: none;
            color: black;
            opacity: 0.5;
            font-family: monospace;
            font-size: .8rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 12px 24px;
            border-radius: 999px;
            cursor: pointer;
            transition: background .18s, color .18s;
            font-weight: 700;
            margin-left: -400px;
        }


        @keyframes surgirFundo {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes surgirTicket {
            from {
                opacity: 0;
                transform: translateY(16px) scale(.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .evento,
            .perfil .eventos,
            .modalLogar form,
            .modalCadastrar form,
            .modal-content {
                animation: none !important;
                transition: none !important;
            }
        }

        @media (max-width: 640px) {
            .cabecalho {
                flex-direction: column;
                align-items: flex-start;
                padding: 24px 22px;
            }

            .cabecalho .acoes {
                width: 100%;
            }

            .cabecalho .acoes button {
                flex: 1 1 auto;
            }

            .eventos {
                gap: 24px;
                padding: 28px 18px 50px;
            }

            .perfil {
                margin: 28px 16px;
                padding: 30px 22px;
            }

            .perfil .eventos {
                width: 100%;
                margin-right: 0;
            }

            .modalLogar form,
            .modalCadastrar form {
                padding: 40px 22px 24px;
            }

            .modal-content {
                padding: 40px 22px 28px;
            }
        }

        @media (max-width: 420px) {
            .erros {
                margin: 18px 16px 0;
            }

            .eventos {
                padding: 24px 16px 40px;
            }

            .evento img {
                height: 160px;
            }

            .evento::before,
            .evento::after {
                top: 148px;
            }

            .perfil {
                padding: 24px 18px;
            }
        }
    </style>
</head>

<body>
    @yield('content')

    <script>
        const todosOsModais = document.querySelectorAll(
            '.modalLogar, .modalCadastrar, .modalCriarEvento, .modalEditarEvento'
        );

        function fecharTodosOsModais() {
            todosOsModais.forEach(function (modal) {
                modal.classList.remove('modalAberto');
            });
            document.body.style.overflow = '';
        }

        function alternarModal(seletor) {
            const modal = document.querySelector(seletor);
            if (!modal) return;
            const jaEstaAberto = modal.classList.contains('modalAberto');
            fecharTodosOsModais();
            if (!jaEstaAberto) {
                modal.classList.add('modalAberto');
                document.body.style.overflow = 'hidden';
            }
        }

        function modalLogar() { alternarModal('.modalLogar'); }
        function modalCadastrar() { alternarModal('.modalCadastrar'); }
        function ModalCriarEvento() { alternarModal('.modalCriarEvento'); }
        function ModalEditarEvento() { fecharTodosOsModais(); }

        todosOsModais.forEach(function (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) fecharTodosOsModais();
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') fecharTodosOsModais();
        });

        function EditarEvento(id, titulo, descricao, preco) {
            document.querySelector('.modalEditarEvento form').action =
                '/GestaoDeEventos/editarEvento/' + id;
            document.getElementById('edit-titulo').value = titulo;
            document.getElementById('edit-descricao').value = descricao;
            document.getElementById('edit-preco').value = preco;
            alternarModal('.modalEditarEvento');
        }
    </script>
</body>

</html>