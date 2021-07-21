<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Component
{

    use WithFileUploads;


    public $open = false;

    public $title, $content, $image, $user_id, $identificador;

    //metodo para resetear  la img
    public function mount()
    {
        $this->identificador = rand();
    }

    //empesamos a craer las validaciones
    protected $rules = [
        'title' => 'required ',
        'content' => 'required ',
        'image' => 'required|image|max:2048',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //guardar el posts en la db
    public function save()
    {



        //el metodo v alidate valida las reglas y si se cumplen las guarda yejecuta las acciones
        $this->validate();

        //guardar imagen
        $image = $this->image->store('public/posts');
        $user_id = Auth::id();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' =>  $image,
            'user_id' => $user_id
        ]);
        //resetear el modal
        $this->reset(['open', 'title', 'content', 'image', 'user_id']);

        $this->identificador = rand();

        //crearemos un evento 
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'El post se creo con exito');
    }



    public function render()
    {
        return view('livewire.create-post');
    }
}
