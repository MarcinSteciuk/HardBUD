<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\room;
use App\Http\Requests\StoreroomRequest;
use App\Http\Requests\UpdateroomRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class roomController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(room::class, 'room');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap(): array
    {
        return [
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $offerId
     * @return View
     * @throws AuthorizationException
     */
    public function create(int $offerId): View
    {
        $offer = Offer::where('deleted', '<>', true)->findOrFail($offerId);
        $this->authorize('create', [room::class, $offer]);
        return view('rooms.create', ['offer' => $offer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreroomRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(StoreroomRequest $request): RedirectResponse
    {
        $offer = Offer::where('deleted', '<>', true)->findOrFail($request->offer_id);
        $this->authorize('create', [room::class, $offer]);
        $requestData = $request->all();
        $room = room::create($requestData);
        return redirect()->route('offers.show', $room->offer_id);
    }

    /**
     * Display the specified resource.
     *
     * @param room $room
     * @return View
     * @throws AuthorizationException
     */
    public function show(room $room): View
    {
        $room = room::where('deleted', '<>', true)->findOrFail($room->id);
        $disabledDates = $room->reservations->map(function ($reservation) {
            return [
                'start' => $reservation->date_from,
                'end' => $reservation->date_to,
            ];
        });

        return view('rooms.show', [
            'room' => $room,
            'disabledDates' => $disabledDates
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param room $room
     * @return View
     */
    public function edit(room $room): View
    {
        $room = room::where('deleted', '<>', true)->findOrFail($room->id);
        $offer = $room->offer;
        return view('rooms.create', ['room' => $room, 'offer' => $offer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateroomRequest $request
     * @param room $room
     * @return RedirectResponse
     */
    public function update(UpdateroomRequest $request, room $room): RedirectResponse
    {
        $room = room::where('deleted', '<>', true)->findOrFail($room->id);
        $input = $request->all();
        $room->update($input);
        return redirect()->route('rooms.show', $room->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param room $room
     * @return RedirectResponse
     */
    public function destroy(room $room): RedirectResponse
    {
        $room = room::where('deleted', '<>', true)->findOrFail($room->id);
        $room->deleted = true;
        $room->save();
        return redirect()->route('offers.show', $room->offer_id);
    }
}
