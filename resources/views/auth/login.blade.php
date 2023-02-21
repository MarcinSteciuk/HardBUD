<x-global>
    <div class="d-flex flex-column align-items-center justify-content-center gap-3" style="height: 80vh">


        <h1>Zaloguj się</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login.authenticate') }}" class="d-flex flex-column gap-3">
            @csrf
            <div class="form-group">
                <label for="email">Adres Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @else is-valid @enderror">
            </div>
            <div class="form-group">
                <label for="password">Hasło</label>
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @else is-valid @enderror">
            </div>
            <div class="form-group align-self-center">
                <input type="submit" value="Zaloguj" class="btn btn-primary">
            </div>
        </form>
    </div>
</x-global>
