<x-app-layout>
    <div class="relative overflow-x-auto w-3/4 mx-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>

                    <th class="px-6 py-3">
                        Foto
                    </th>

                    <th class="px-6 py-3">
                        Título
                    </th>


                    <th class="px-6 py-3">
                        Duración del album
                    </th>

                    <th class="px-6 py-3">
                        Artistas
                    </th>
                    <th class="px-6 py-3">
                        Canciones
                    </th>

                    <th class="px-6 py-3">
                        Duraciones
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($album->existeImagen())
                            <img src="{{ asset($album->imagen_url) }}" /> <!-- Para imágenes -->
                        @endif
                    </th>

                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $album->titulo }}
                    </td>

                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {!! $album->duracion_album() !!}
                    </th>

                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {!! $album->artistas_album() !!}
                    </th>

                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {!! $album->nombres_canciones() !!}
                    </th>

                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {!! $album->duraciones() !!}
                    </th>






                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
