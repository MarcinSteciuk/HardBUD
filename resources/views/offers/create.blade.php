<x-global>
    <div class="mt-5 container">
        <h1 class="p-5 text-center">
        @isset($offer)
            Edytuj Sprzęt
        @else
            Dodaj Sprzęt
        @endisset
        </h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="row g-3 align-items-end" method="POST" action="{{isset($offer) ? route("offers.update", $offer->id) : route("offers.store")}}" enctype="multipart/form-data">
            @csrf
            @isset($offer)
                @method('PUT')
            @endisset
            <div class="col-6">
                <label for="name" class="form-label">Nazwa</label>
                <input value="{{$offer->name ?? ''}}" name="name" type="text" class="form-control @error('name') is-invalid @else is-valid @enderror" id="name" placeholder="Betoniarka">
            </div>
            <div class="col-6">
                <label for="place" class="form-label">Lokalizacja</label>
                <input value="{{$offer->place ?? ''}}" name="place" type="text" class="form-control @error('place') is-invalid @else is-valid @enderror" id="place" placeholder="Kraków ul. Jana Pawła II 30">
            </div>
            <div class="col-6">
                <label for="accommodationType" class="form-label">Odbiór</label>

                <select id="accommodationType" name="accommodationType" class="form-select @error('accommodationType') is-invalid @else is-valid @enderror" aria-label="Default select example">
                    <option @if(!isset($offer)) selected @endif>Wybierz</option>
                    <option @if(isset($offer) and $offer->accommodationType == 'Osobisty') selected @endif value="Osobisty">Osobisty</option>
                    <option @if(isset($offer) and $offer->accommodationType == 'Dostawa do 100km') selected @endif value="Dostawa do 100km">Dostawa do 100km</option>
                    <option @if(isset($offer) and $offer->accommodationType == 'Dostawa do 500km') selected @endif value="Dostawa do 500km">Dostawa do 500km</option>
                    <option @if(isset($offer) and $offer->accommodationType == 'Dostawa na terenie całej polski') selected @endif value="Dostawa na terenie całej polski">Dostawa na terenie całej polski</option>
                </select>
            </div>
            @if(!isset($offer))
                <div class="col-6">
                    <label for="image" class="form-label">Dodaj zdjęcia</label>
                    <input value="{{$offer->image ?? ''}}" name="image" class="form-control @error('image') is-invalid @else is-valid @enderror" type="file" id="image" multiple>
                </div>
            @endif
            <div class="col-12">
                <label for="description" class="form-label">Opis sprzętu</label>
                <textarea name="description" class="form-control @error('description') is-invalid @else is-valid @enderror" id="description" rows="7" placeholder="Super oferta">{{$offer->description ?? ''}}</textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Zapisz</button>
            </div>
        </form>
    </div>
</x-global>
