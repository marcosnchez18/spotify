
<x-app-layout>
    <div class="relative overflow-x-auto w-3/4 mx-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('canciones.index', ['order' => 'titulo', 'order_dir' => order_dir($order == 'titulo', $order_dir)]) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            Titulo {{ order_dir_arrow($order == 'titulo', $order_dir) }}
                        </a>
                    </th>
                    <th  class="px-6 py-3">
                        Duración
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
                @foreach ($canciones as $cancion)
                    <tr class="bg-white border-b">
                        <th  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <a href="{{ route('canciones.show', ['cancion' => $cancion]) }}" class="text-blue-500">
                                {{ $cancion->titulo }}
                            </a>
                        </th>

                        <th  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $cancion->duracion }}
                        </th>

                        <td class="px-6 py-4">
                            <a href="{{ route('canciones.edit', ['cancion' => $cancion]) }}" class="font-medium text-blue-600 hover:underline">
                                <x-primary-button>
                                    Editar
                                </x-primary-button>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('canciones.destroy', ['cancion' => $cancion]) }}" method="POST">
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
        <form action="{{ route('canciones.create') }}" class="flex justify-center mt-4 mb-4">
            <x-primary-button class="bg-green-500">Insertar un nuevo cancion</x-primary-button>
        </form>
        {{$canciones->links()}}
    </div>
</x-app-layout>
