<x-global>
    <div class="container mt-5 pt-4">
        <div class="d-flex col-12 justify-content-center">
            <img src="{{asset("storage/{$reservation->equipment->offer->image}")}}" class="img-fluid" style="max-height: 600px; margin: auto 0">
        </div>
        <h1 class="mt-4">{{ $reservation->equipment->name }}</h1>


        <h3 class="mt-5">Opis:</h3>
        <p>{{ $reservation->equipment->description }}</p>

        <h3 class="mt-5">Informacje:</h3>
        <p>Liczba dostępnych egzemplarzy: {{ $reservation->equipment->beds_amount }}</p>
        <p>Cena: {{$reservation->equipment->price}} zł/doba</p>

        <h3 class="mt-5">Oferta:</h3>
        <p>Rodzaj dostawy: {{$reservation->equipment->offer->accommodationType}}</p>
        <p>Lokalizacja: {{$reservation->equipment->offer->place}}</p>
        <p>Dodano przez: {{$reservation->equipment->offer->user->name}}</p>
        <p>Data dodania: {{$reservation->equipment->offer->created_at}}</p>

        <h3 class="mt-5">Wypożyczenie:</h3>
        <p>Data: {{$reservation->date_from}} - {{$reservation->date_to}}</p>
        <p>Do zapłaty: {{$reservation->price}} zł</p>
    </div>
</x-global>
