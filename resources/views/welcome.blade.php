<x-global>
    <div class="img-text-container">
        <img src="{{ asset('img/banner.jpg') }}" alt="banner">
        <p class="centered-img-text">Niemożliwe z nami nie istnieje</p>
    </div>

    <div class="container d-flex justify-content-center flex-column" style="margin-top: -10em;
    z-index: 1;
    position: relative;
    background-color: #F2CD5C;
    padding:18px;">
        <div>
            <h1 class="text-center p-5">Mamy cięzki sprzęt właśnie dla ciebie!</h1>
        </div>
        @include("components.offers-filter-form")
        <br>
    </div>
</x-global>
