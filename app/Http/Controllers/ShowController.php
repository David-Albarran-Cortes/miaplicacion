<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class ShowController extends Controller
{
    public function index()
    {
         
        $posts = Post::where('user_id', auth()->user()->id)
        ->orwhere('title', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->orwhere('content', 'like', '%' . $this->search . '%')
        ->paginate($this->cant);



    return view('livewire.show-posts', compact('posts'));
 
    }

}
