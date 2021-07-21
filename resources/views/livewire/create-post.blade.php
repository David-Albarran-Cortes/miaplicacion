<div>
     <x-jet-danger-button wire:click="$set('open', true)">
         crear nuevo post
     </x-jet-danger-button>

     <x-jet-dialog-modal wire:model="open">
         <x-slot name="title">
        Crear nuevo pots
         </x-slot>

         <x-slot name="content">
 
          <div wire:loading wire:target="image" class="bg-red-100 border mb-4 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Cargando imagen</strong>
            <span class="block sm:inline">Espera un momento hasta que la imagne se haya procesado</span>
            
          </div>

          @if ($image)
          <img class="mb-4" src="{{$image->temporaryUrl()}}" alt="">
        
          @endif

          <div class="mb-4">
         <x-jet-label value="Titulo del post" />
         <x-jet-input type="text" class="w-full" wire:model="title"/>

          {{--componenete de jetstream--}}
         <x-jet-input-error for="title"/>

         


         </div>
        
         <div class="mb-4">
            <x-jet-label value="Contenido del post" />
           <textarea class="form-control w-full"  wire:model.defer="content"   rows="6"></textarea>
           @error('content')
              <span class="text-sm text-red-600">
                {{$message}}
              </span>
           @enderror
            </div>
            
            <button type="file" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition mt-2 mr-2" x-on:click.prevent="$refs.photo.click()">
              Select A New Photo
          </button>
          <input type="file" class="hidden"
          wire:model="image"
          x-ref="photo"
          x-on:change="
                  photoName = $refs.photo.files[0].name;
                  const reader = new FileReader();
                  reader.onload = (e) => {
                      photoPreview = e.target.result;
                  };
                  reader.readAsDataURL($refs.photo.files[0]);
          " />
             <div>
                   <input type="file" class="hidden"    wire:model="image" id="{{$identificador}}">
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
            Crea post
        </x-jet-danger-button>

        
        

        </x-slot>
     </x-jet-dialog-modal>

</div>
