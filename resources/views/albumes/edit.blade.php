<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST"
            action="{{ route('albumes.update', ['album' => $album]) }}">
            @csrf
            @method('PUT')

            <!-- Titulo -->
            <div>
                <x-input-label for="titulo" :value="'Titulo del album'" />
                <x-text-input id="titulo" class="block mt-1 w-full"
                    type="text" name="titulo" :value="old('titulo', $album->titulo)" required
                    autofocus autocomplete="titulo" />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
            </div>



            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('albumes.index') }}">
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
