<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Models\equipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\View\View;

class ReservationController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Reservation::class, 'reservation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {

        if(Auth::user()->isAdmin()){
            $reservations = Reservation::all();
        }else{
            $reservations = Reservation::where('user_id', Auth::user()->id)->get();
        }

        return view('reservations.index', [
            'reservations' => $reservations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $equipmentId
     * @return View
     */
    public function create(int $equipmentId): View
    {
        $equipment = equipment::where('deleted', '<>', true)->findOrFail($equipmentId);
        $disabledDates = $equipment->reservations->map(function ($reservation) {
            return [
                'start' => $reservation->date_from,
                'end' => $reservation->date_to,
            ];
        });
        return view("reservations.create", ["equipment" => $equipment, "offer" => $equipment->offer, "disabledDates" => $disabledDates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreReservationRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $requestData = $request->all();
        $equipment = equipment::where('deleted', '<>', true)->findOrFail($request->equipment_id);

        foreach ($equipment->reservations as $reservation)
            if ($reservation->date_from <= $request->date_to and $request->date_from <= $reservation->date_to)
                return redirect()->back()->withErrors(['date_from' => 'Pokój jest już zarezerwowany w tym terminie']);

        $totalPrice = $equipment->price * Date::createFromFormat('Y-m-d', $request->date_to)->diffInDays(Date::createFromFormat('Y-m-d', $request->date_from));

        $requestData['user_id'] = Auth::id();
        $requestData['price'] = $totalPrice;
        Reservation::create($requestData);
        return redirect()->route('reservations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Reservation $reservation
     * @return View
     */
    public function show(Reservation $reservation): View
    {
        return view('reservations.show', ['reservation' => $reservation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reservation $reservation
     * @return RedirectResponse
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation = equipment::findOrFail($reservation->id);
        $reservation->delete();
        return redirect()->route('reservations.index.show');
    }
}
