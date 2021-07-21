<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{   
    //esta clase nos per ite subir imganes al servidor
    use WithFileUploads;

    public $open = false;

    //definimos la propiedad llamada post
    public $post , $image, $identificador;

    //creamos las raglas de validacion
    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',

    ];

    //creamos el metodo mount / recibimos el parametro que mandamos,decimos que se ttrta de una instancia del modelo post
    public function mount(Post $post){
        //asignamos el valor a esta propiedad
        $this->post = $post;

        //metodo para resetear  la img
        $this->identificador = rand() ;

    }

    public function save(){

        $this->validate();
       
        //al actualizar preguntamos si ya existe una imagen ,si existe una imagne este la eliminara papra subir una nueva
        if ($this->image) {
            Storage::delete([$this->post->image]);

            $this->post->image = $this->image->store('public/posts');
        }
        
        $this->post->save();

    $this->reset(['open', 'image']);
    $this->identificador = rand();
    $this->emitTo('show-posts','render');
    $this->emit('alert','El post actualizo con exito');
    }

    public function render()
    {

        return view('livewire.edit-post');
    }
}
