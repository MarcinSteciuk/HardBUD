<div class="card">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{asset("storage/{$offer->image}")}}" class="img-fluid h-100 p-0 m-0" alt="img">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$offer->name}}</h5>
                <p class="card-text">{{$offer->description}}</p>
                @if($offer->equipments->count() > 0)
                    <p class="card-text"><small class="text-muted">Już od: {{ min(array_column($offer->equipments->all(), 'price')) }} zł za 24 godziny!</small></p>
                @else
                    <p class="card-text"><small class="text-muted" style="color: red !important">Produkt niedostępny</small></p>
                @endif

                <a href="{{route("offers.show", $offer->id)}}" class="btn btn-info">Sprawdź szczegóły</a>
                @if($canManage)
                    <a href="{{route("offers.edit", $offer->id)}}" class="btn btn-primary">Edytuj</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-equipment-modal-{{$offer->id}}">
                        Usuń
                    </button>

                    <form method="POST" action="{{route('offers.destroy', $offer->id)}}">
                        @csrf
                        @method("DELETE")
                        @include('components.form-modal',
                                 ['id' => "delete-equipment-modal-$offer->id",
                                 'title' => 'Uwaga!',
                                 'body' => "Czy na pewno chcesz na stałe usunąć: $offer->name.",
                                 'type' => 'danger',
                                 'button' => 'Usuń'])
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
