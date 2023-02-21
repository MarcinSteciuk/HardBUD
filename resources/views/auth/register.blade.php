<x-global>
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 80vh">

        <h1>Zarejestruj się</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="d-flex flex-column gap-2">
            @csrf
            <div class="form-group">
                <label for="name">Nazwa użytkownika</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @else is-valid @enderror">
            </div>
            <div class="form-group">
                <label for="email">Adres email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @else is-valid @enderror">
            </div>
            <div class="form-group">
                <label for="password">Hasło</label>
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @else is-valid @enderror">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Powtórz hasło</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="form-control @error('password_confirmation') is-invalid @else is-valid @enderror">
            </div>
            <div class="form-group d-flex justify-content-around mt-2 mb-2">
                <div class="form-check">
                    <input id="offer-maker"
                           name="role_id"
                           type="radio"
                           class="form-check-input @error('role_id') is-invalid @else is-valid @enderror"
                           value="2">

                    <label class="form-check-label" for="offer-maker">Chcę dodać ogłoszenia</label>
                </div>
                <div class="form-check">
                    <input id="offer-taker"
                           name="role_id"
                           type="radio"
                           class="form-check-input @error('role_id') is-invalid @else is-valid @enderror"
                           value="3">

                    <label class="form-check-label" for="offer-taker">Chcę wynająć sprzęt</label>
                </div>
            </div>
            <div class="form-group align-self-center">
                <input type="submit" value="Rejestracja" class="btn btn-primary">
            </div>
        </form>
    </div>
</x-global>
