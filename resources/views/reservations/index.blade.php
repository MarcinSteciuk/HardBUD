<x-global>
    <div class="container mt-3">
        <h1 class="text-center">Wypożyczenia</h1>
        <div class="row mt-5">
            <div class="d-flex gap-2 flex-column col-12 p-0">
                @foreach($reservations as $reservation)
                        <div class="card mb-3">
                            <img src="{{asset("storage/{$reservation->room->offer->image}")}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="{{route("reservations.show", $reservation->id)}}" style="text-decoration: none; color: inherit">
                                    <h5 class="card-title">{{ $reservation->room->name }}</h5>
                                </a>
                                <p class="card-text">{{ $reservation->room->description }}</p>
                                <p class="card-text"><small class="text-muted">Data: {{ $reservation->date_from }} - {{ $reservation->date_to }}</small></p>

                                @can('delete', [$reservation])
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-room-modal-{{$reservation->id}}">
                                        Usuń
                                    </button>

                                    <form method="POST" action="{{route('reservations.destroy', $reservation->id)}}">
                                        @csrf
                                        @method("DELETE")
                                        @include('components.form-modal',
                                                 ['id' => "delete-room-modal-$reservation->id",
                                                 'title' => 'Uwaga!',
                                                 'body' => "Czy na pewno chcesz usunąć wypożyczenie?",
                                                 'type' => 'danger',
                                                 'button' => 'Usuń'])
                                    </form>
                                @endcan
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
</x-global>
