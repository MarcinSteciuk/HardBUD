<x-global>

    <div class="container mt-5 pt-5 d-flex gap-4 flex-column">
        @foreach($users as $user)
            <div class="card">
                <div class="card-header">
                    <h3>{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ $user->email }}</p>
                    <p>{{ $user->created_at }}</p>
                    @can('is-admin')
                        @if($user->id != Auth::User()->id)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-room-modal-{{$user->id}}">
                                Usuń
                            </button>


                            <form method="POST" action="{{route('users.destroy', $user->id)}}">
                                @csrf
                                @method("DELETE")
                                @include('components.form-modal',
                                         ['id' => "delete-room-modal-$user->id",
                                         'title' => 'Uwaga!',
                                         'body' => "Czy na pewno chcesz usunąć użytkownika: $user->name. Zmiany są nie odwracalne",
                                         'type' => 'danger',
                                         'button' => 'Usuń'])
                            </form>
                        @endif
                    @endcan
                </div>
            </div>
        @endforeach
    </div>


</x-global>
