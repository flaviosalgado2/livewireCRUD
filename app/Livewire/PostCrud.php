<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostCrud extends Component
{
    public $posts, $title, $body, $post_id, $preco;
    public $isModalOpen = false;

    //regras de validacao
    protected $rules = [
        'title' => 'required|min:5',
        'preco' => 'required',
        'body' => 'required|min:10'
    ];

    //ao iniciar componente carregar posts
    public function mount()
    {
        $this->posts = Post::all();
    }

    //abrir modal
    public function openModal($flag = true)
    {
        if ($flag) {
            $this->resetInputFields();
        }
        $this->isModalOpen = true;
    }

    //fechar modal
    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    //limpar campos
    public function resetInputFields()
    {
        $this->title = '';
        $this->preco = 0.0;
        $this->body = '';
        $this->post_id = null;
    }

    public function savePost()
    {
        $this->validate();

        //dd($this);

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'preco' => $this->preco,
            'body' => $this->body,
        ]);

        session()->flash('message', $this->post_id ? 'Post atualizado.' : 'Post criado.');

        $this->closeModal();
        $this->mount(); // Atualizar lista de posts
    }

    // Editar post
    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        //dd($post);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->preco = $post->preco;
        $this->body = $post->body;

        //dd($this);

        $this->openModal(false);
    }

    // Deletar post
    public function deletePost($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post deletado.');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.post-crud')->layout('components.layouts.app');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
