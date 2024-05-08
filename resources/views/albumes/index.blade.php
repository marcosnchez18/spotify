<x-app-layout>
    <div class="relative overflow-x-auto w-3/4 mx-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>

                    <th class="px-6 py-3">
                        Imagen     <!-- Para imágenes -->
                    </th>
                    <th  class="px-6 py-3">
                        Titulo
                    </th>

                    <th  class="px-6 py-3">
                        Duración del album
                    </th>

                    <th  class="px-6 py-3">
                        Editar
                    </th>
                    <th  class="px-6 py-3">
                        Borrar
                    </th>
                </tr>
            </thead>
            <br><br><br>
            <tbody>
                @foreach ($albumes as $album)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($album->existeImagen())
                                <img src="{{ asset($album->imagen_url) }}" />     <!-- Para imágenes -->
                            @endif
                        </th>
                        <th  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <a href="{{ route('albumes.show', ['album' => $album]) }}" class="text-blue-500">
                                {{ $album->titulo }}
                            </a>
                        </th>
                        <th  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <a href="{{ route('albumes.show', ['album' => $album]) }}" class="text-blue-500">
                                {!! $album->duracion_album() !!}
                            </a>
                        </th>

                        <td class="px-6 py-4">
                            <a href="{{ route('albumes.edit', ['album' => $album]) }}" class="font-medium text-blue-600 hover:underline">
                                <x-primary-button>
                                    Editar
                                </x-primary-button>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('albumes.destroy', ['album' => $album]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="bg-red-500">
                                    Borrar
                                </x-primary-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('albumes.create') }}" class="flex justify-center mt-4 mb-4">
            <x-primary-button class="bg-green-500">Insertar un nuevo album</x-primary-button>
        </form>
    </div>
</x-app-layout>
