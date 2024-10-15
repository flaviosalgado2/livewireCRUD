<div class="container mt-5">
    <h1 class="mb-4">Login</h1>

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
        <div class="card p-4">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" wire:model="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" wire:model="password" id="password" class="form-control" required>
            </div>

            <button class="btn btn-primary" wire:click="login">Entrar</button>
        </div>
</div>