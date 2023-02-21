<form class="row g-3 align-items-end" method="get" action="{{route("offers.index")}}">
    <div class="col-12">
        <label for="name" class="form-label">Nazwa sprzętu</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Betoniarka">
    </div>
    <div class="col-md-6">
        <label for="dateFrom" class="form-label">Od kiedy chcesz wynająć</label>
        <input name="dateFrom" type="date" class="form-control" id="dateFrom">
    </div>
    <div class="col-md-6">
        <label for="dateTo" class="form-label">Data zwrotu</label>
        <input name="dateTo" type="date" class="form-control" id="dateTo">
    </div>
    <div class="col-12">
        <label for="place" class="form-label">Skąd chcesz odebrać sprzęt:</label>
        <input name="place" type="text" class="form-control" id="place" placeholder="Kraków">
    </div>
    <div class="col-md-6">
        <label for="priceFrom" class="form-label">Cena od</label>
        <input name="priceFrom" type="number" class="form-control" id="priceFrom">
    </div>
    <div class="col-md-6">
        <label for="priceTo" class="form-label">Cena do</label>
        <input name="priceTo" type="number" class="form-control" id="priceTo">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Szukaj</button>
    </div>
</form>
