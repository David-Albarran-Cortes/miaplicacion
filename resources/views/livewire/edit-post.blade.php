<div >
    <a  wire:click="$set('open',true)" class="px-6 py-4">
    
        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <!-- Heroicon name: solid/pencil -->
          <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
          </svg>
          Edit
        </button>
       
    </a> 
     
    {{--llamamos al componente de jetstrean llamado--}}

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Editar el post 
        </x-slot>

        <x-slot name="content"> 

            <div wire:loading wire:target="image" class="bg-red-100 border mb-4 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Cargando imagen</strong>
                <span class="block sm:inline">Espera un momento hasta que la imagne se haya procesado</span>
                
              </div>

           @if ($image)
          <img class="mb-4" src="{{$image->temporaryUrl()}}" alt="">

          @else 
   
          <img class="mb-4" src="{{Storage::url($post->image)}}" alt="">

          @endif


            <div class="mb-4">

                <x-jet-label value="Titulo del pots"/> 
                <x-jet-input type="text" class="w-full" wire:model="post.title"  /> 
                {{--componenete de jetstream--}}
               <x-jet-input-error for="post.title"/>
            </div>

            <div>
                <x-jet-label value="Contenido del pots"/> 
                <textarea class="form-control w-full"  wire:model.defer="post.content"    rows="6"></textarea>
                <x-jet-input-error for="post.content"/>
            </div>

            <div>
                <input type="file" wire:model="image" id="{{$identificador}}">
                 {{--componenete de jetstream--}}
                 <x-jet-input-error for="image"/>
           </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
              </x-jet-secondary-button>
             {{--Estados de carga--}}
              <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save , image" class="disabled:opacity-25">
                Acutalizar post
             </x-jet-danger-button>
     
        </x-slot>

    </x-jet-dialog-modal>
    

</div>
