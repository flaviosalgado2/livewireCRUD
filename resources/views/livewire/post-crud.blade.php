<div class="container mt-4">
    <div class="card p-4 mt-2 mb-4 col-3 ms-auto">
        <h4>Bem-vindo, {{ Auth::user()->name }}</h4>
        <button wire:click="logout" class="btn btn-danger">Sair do Login</button>
    </div>
    <button wire:click="openModal" class="btn btn-primary">Criar Entrada de Caixa</button>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Título Entrada</th>
                <th>Preço</th>
                <th>Obvervações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->preco }}</td>
                <td>{{ $post->body }}</td>
                <td>
                    <button wire:click="editPost({{ $post->id }})" class="btn btn-primary">Editar</button>
                    <button wire:click="deletePost({{ $post->id }})" class="btn btn-danger">Deletar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if($isModalOpen)
        <div class="modal show" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $post_id ? 'Editar Post' : 'Criar Novo Post' }}</h5>
                        <button type="button" wire:click="closeModal" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" wire:model="title" placeholder="Título" class="form-control">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror

                        <input type="text" wire:model="preco" placeholder="Preço" class="form-control mt-2">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror

                        <textarea wire:model="body" placeholder="Conteúdo" class="form-control mt-2"></textarea>
                        @error('body') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button wire:click="savePost" class="btn btn-success">Salvar</button>
                        <button wire:click="closeModal" class="btn btn-secondary">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

