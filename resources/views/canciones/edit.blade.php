<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST"
            action="{{ route('canciones.update', ['cancion' => $cancion]) }}">
            @csrf
            @method('PUT')

            <!-- Titulo -->
            <div>
                <x-input-label for="titulo" :value="'Titulo del cancion'" />
                <x-text-input id="titulo" class="block mt-1 w-full"
                    type="text" name="titulo" :value="old('titulo', $cancion->titulo)" required
                    autofocus autocomplete="titulo" />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="duracion" :value="'duracion del cancion'" />
                <x-text-input id="duracion" class="block mt-1 w-full"
                    type="text" name="duracion" :value="old('duracion', $cancion->duracion)" required
                    autofocus autocomplete="duracion" />                                                       <!-- Ojo con esas cosas , que es para que se guarde la antigua -->
                <x-input-error :messages="$errors->get('duracion')" class="mt-2" />
            </div>



            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('canciones.index') }}">
                    <x-secondary-button class="ms-4">
                        Volver
                        </x-primary-button>
                </a>
                <x-primary-button class="ms-4">
                    Editar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
