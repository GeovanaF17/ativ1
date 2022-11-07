@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center bg-light border border-2 p-3 my-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#criaranotacao">
            Criar Anotação
        </button>

        <!-- Modal -->
        <div class="modal fade" id="criaranotacao" tabindex="-1" aria-labelledby="criaranotacaoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="criaranotacaoLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('create.note') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <label>Título:</label>
                            <input class="form-control" type="text" name="title">
                            <label>Conteúdo:</label>
                            <textarea class="form-control" name="content" cols="30" rows="4" class=""></textarea>
                            <label>Cor:</label>
                            <input class="form-control" type="color" name="color">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Criar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex flex-wrap justify-content-around gap-2">
        @forelse ($notes as $note)
            <div class="card border border-2 shadow p-3" style="background-color: {{ $note->color }};">
                <div class="card-header">{{ $note->title }}</div>
                <div class="card-body">{{ $note->content }}</div>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar_anotacao" data-bs-note="{{json_encode($note)}}">
                    Editar
                </button>

                <form action="{{ route('delete.note')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $note->id}}">
                    <button class="btn btn-danger" type=" submit"> Excluir</button>
                </form>
            </div>

        </div>
        @empty
            <div class=" alert alert-danger">
                Nenhuma anotação cadastrada!
            </div>
        @endforelse

        <!-- Modal -->
        <div class="modal fade" id="editar_anotacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('update.note') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <label>Título:</label>
                            <input class="form-control" type="text" name="title"  id="title">
                            <label>Conteúdo:</label>
                            <textarea class="form-control" name="content" cols="30" rows="4"  id="content"></textarea>
                            <label>Cor:</label>
                            <input class="form-control" type="color" name="color"  id="color">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            const exampleModal = document.getElementById('editar_anotacao')
            exampleModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const recipient = button.getAttribute('data-bs-note')
                const note = JSON.parse(recipient);
                document.getElementById('id').value = note.id;
                document.getElementById('title').value = note.title;
                document.getElementById('content').value = note.content;
                document.getElementById('color').value = note.color;


            })
        </script>
    @endsection
