<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('canciones.store') }}">
            @csrf

            <!-- Titulo -->
            <div>
                <x-input-label for="titulo" :value="'titulo del cancion'" />
                <x-text-input id="titulo" class="block mt-1 w-full"
                    type="text" name="titulo" :value="old('titulo')" required
                    autofocus autocomplete="titulo" />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="duracion" :value="'duracion del cancion'" />
                <x-text-input id="duracion" class="block mt-1 w-full"
                    type="text" name="duracion" :value="old('duracion')" required
                    autofocus autocomplete="duracion" />
                <x-input-error :messages="$errors->get('duracion')" class="mt-2" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('canciones.index') }}">
                    <x-secondary-button class="ms-4">
                        Volver
                        </x-primary-button>
                </a>
                <x-primary-button class="ms-4">
                    Insertar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
