<div>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- This example requires Tailwind CSS v2.0+ -->
        <x-table>
            <div class="col-span-6 sm:col-span-3 px-6 py-4 flex items-center">

                <div class=" flex items-center">
                    <label class="block text-sm font-medium text-gray-700"> numero de filas</label>

                    <select wire:model="cant"
                        class="mx-2 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm  ">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>

                    </select>
                </div>

                <input type="text" wire:model="search" placeholder="Buscar" autocomplete="given-name"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block flex-1 mr-4 shadow-sm sm:text-sm border-gray-300 rounded-md">

                @livewire('create-post' )

            </div>

            @if ($posts->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')">

                                Id

                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('title')">
                                Title
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('content')">
                                Content
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('content')">
                                Image
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('content')">
                               User_id
                            </th>


                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $item)


                            <tr>

                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->id }}</div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->title }}</div>
                                </td>
                                <td class="px-6 py-4  text-sm text-gray-500">
                                    {{ $item->content }}
                                </td>
                                <td class="px-6 py-4  text-sm text-gray-500">

                                    <img class="h-10 w-10 rounded-full" src="{{ Storage::url($item->image) }}" alt="">
                                </td>

                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->user_id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap   text-sm font-medium">

                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}

                                    <a wire:click="edit({{ $item }})" class="px-6 py-4">

                                        <button type="button"
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <!-- Heroicon name: solid/pencil -->
                                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Edit
                                        </button>

                                    </a>

                                    <a wire:click="$emit('deletePost',{{$item->id}})" class="px-6 py-4">

                                        <button type="button"
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <!-- Heroicon name: solid/pencil -->
                                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>

                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
            @else

                <div class="px-6 py-4">
                    <span class="block xl:inline text-center text-red-900">El registro "{{ $search }}" no existe
                    </span>
                </div>
            @endif

            @if ($posts->hasPages())
                <div class="px6 py-3">
                    {{ $posts->links() }}
                </div>

            @endif


        </x-table>



    </div>


    <x-jet-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            Editar el post
        </x-slot>

        <x-slot name="content">

            <div wire:loading wire:target="image"
                class="bg-red-100 border mb-4 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Cargando imagen</strong>
                <span class="block sm:inline">Espera un momento hasta que la imagne se haya procesado</span>

            </div>

            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">

            @else

                <img class="mb-4" src="{{ Storage::url($post->image) }}" alt="">

            @endif


            <div class="mb-4">

                <x-jet-label value="Titulo del pots" />
                <x-jet-input type="text" class="w-full" wire:model="post.title" />
                {{-- componenete de jetstream --}}
                <x-jet-input-error for="post.title" />
            </div>

            <div>
                <x-jet-label value="Contenido del pots" />
                <textarea class="form-control w-full" wire:model.defer="post.content" rows="6"></textarea>
                <x-jet-input-error for="post.content" />
            </div>

            <div>
                <input type="file" wire:model="image" id="{{ $identificador }}">
                {{-- componenete de jetstream --}}
                <x-jet-input-error for="image" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
            {{-- Estados de carga --}}
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save , image"
                class="disabled:opacity-25">
                Acutalizar post
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
    <script src="sweetalert2.all.min.js"></script>

    <script>
        livewire.on('deletePost', postId => {
            Swal.fire({
                title: 'Estas seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    livewire.emitTo('show-posts','delete', postId);

                    Swal.fire(
                        '¡Eliminado!',
                        'El post ha sido eliminado.',
                        'success'
                    )
                }
            })
        });

    </script>
    @endpush


    
</div>
