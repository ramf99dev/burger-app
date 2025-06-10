<x-admin-layout>
    <div class="my-3 w-fit gap-4 space-y-3 place-self-center self-center rounded-lg bg-white p-4 shadow md:w-96">
        <form action="{{ route('usuario.store') }}" method="POST" class="text-pink-600">
            @csrf
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="rounded-lg border-pink-600">
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email">Correo</label>
                    <input type="text" name="email" value="{{ old('email') }}" required
                        class="rounded-lg border-pink-600">
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" required class="rounded-lg border-pink-600">
                </div>


                <div class="mt-3 flex flex-col gap-1">
                    <label for="telefono">Telefono</label>
                    <input class="rounded-lg border-pink-600" type="tel" step="1" min="0"
                        name="telefono" id="telefono" value="{{ old('telefono') }}" required>
                </div>
            </div>

            @if ($errors->any())
                <div class="mt-3 rounded-lg p-2 text-start text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-6 flex flex-row place-content-between gap-4">
                <x-cancel-button ruta="usuario.index"></x-cancel-button>
                <x-save-button></x-save-button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('telefono');

            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    const formatted = formatPhoneNumber(e.target.value);
                    if (formatted !== e.target.value) {
                        e.target.value = formatted;
                    }
                });
            }
        });

        function formatPhoneNumber(value) {
            let phoneNumber = value.replace(/[^\d-]/g, '');

            const parts = phoneNumber.split('-');
            phoneNumber = parts.join('');

            if (phoneNumber.length > 4) {
                phoneNumber = phoneNumber.substring(0, 4) + '-' + phoneNumber.substring(4);
            }

            return phoneNumber;
        }
    </script>

</x-admin-layout>
