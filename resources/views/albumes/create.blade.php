<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('albumes.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Foto -->
            <div>
                <x-input-label for="foto" :value="'Foto del Album'" />
                <x-text-input id="foto" class="block mt-1 w-full" type="file" name="foto" :value="old('foto')"
                    required autofocus autocomplete="foto" />
                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
            </div>

            <!-- Titulo -->
            <div>
                <x-input-label for="titulo" :value="'titulo del album'" />
                <x-text-input id="titulo" class="block mt-1 w-full"
                    type="text" name="titulo" :value="old('titulo')" required
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
                    Insertar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
