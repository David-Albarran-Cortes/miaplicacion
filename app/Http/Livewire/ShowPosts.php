<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShowPosts extends Component
{

    use WithFileUploads;
    use WithPagination;
    //$post, $image, $identificador; son  para editar 
    public $search, $post, $image, $identificador;
    public $sort = 'id';
    public $direction = 'desc';

     //14 - Query String
    public $cant= '10';

    //15 - Aplazar carga
    public $readyToLoad = false;

    //area de editar post
    public $open_edit = false;
 
    //14 - Query String
    protected $queryString = [
     'cant'=>['except' => '10'],
     'sort'=>['except' => 'id'],
     'direction'=>['except' => 'desc']
    ];

    public function mount()
    {
        $this->identificador = rand();
        $this->post = new Post();
    }

    public function updatingSearch(){
       $this->resetPage();
    }

    //creamos las raglas de validacion
    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',

    ];
    //---------------------------

    //esta propiedad escuchara el evento llamado render
    protected $listeners = ['render' , 'delete'];

 
    public function render()
    {
         
 
        $posts = Post::where('user_id',auth()->user()->id)
            ->orwhere('id',  'like', '%' . $this->search . '%')
            ->orwhere('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->orwhere('content', 'like', '%' . $this->search . '%')
            ->paginate($this->cant);



        return view('livewire.show-posts', compact('posts'));
    }
    public function order($sort)
    {

        if ($this->sort == $sort) {

            if ($this->direction == 'desc') {

                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Post $post)
    {

        $this->post = $post;

        $this->open_edit = true;
    }
    public function update()
    {
        $this->validate();

        //al actualizar preguntamos si ya existe una imagen ,si existe una imagne este la eliminara papra subir una nueva
        if ($this->image) {
            Storage::delete([$this->post->image]);

            $this->post->image = $this->image->store('public/posts');
        }

        $this->post->save();

        $this->reset(['open_edit', 'image']);
        $this->identificador = rand();
        //$this->emitTo('show-posts', 'render');
        $this->emit('alert', 'El post actualizo con exito');
    }

    public function delete(Post $post){
      $post->delete();
    }
}
