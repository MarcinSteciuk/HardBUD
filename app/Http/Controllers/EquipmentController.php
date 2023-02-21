<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\equipment;
use App\Http\Requests\StoreequipmentRequest;
use App\Http\Requests\UpdateequipmentRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class equipmentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(equipment::class, 'equipment');
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
        $this->authorize('create', [equipment::class, $offer]);
        return view('equipments.create', ['offer' => $offer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreequipmentRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(StoreequipmentRequest $request): RedirectResponse
    {
        $offer = Offer::where('deleted', '<>', true)->findOrFail($request->offer_id);
        $this->authorize('create', [equipment::class, $offer]);
        $requestData = $request->all();
        $equipment = equipment::create($requestData);
        return redirect()->route('offers.show', $equipment->offer_id);
    }

    /**
     * Display the specified resource.
     *
     * @param equipment $equipment
     * @return View
     * @throws AuthorizationException
     */
    public function show(equipment $equipment): View
    {
        $equipment = equipment::where('deleted', '<>', true)->findOrFail($equipment->id);
        $disabledDates = $equipment->reservations->map(function ($reservation) {
            return [
                'start' => $reservation->date_from,
                'end' => $reservation->date_to,
            ];
        });

        return view('equipments.show', [
            'equipment' => $equipment,
            'disabledDates' => $disabledDates
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param equipment $equipment
     * @return View
     */
    public function edit(equipment $equipment): View
    {
        $equipment = equipment::where('deleted', '<>', true)->findOrFail($equipment->id);
        $offer = $equipment->offer;
        return view('equipments.create', ['equipment' => $equipment, 'offer' => $offer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateequipmentRequest $request
     * @param equipment $equipment
     * @return RedirectResponse
     */
    public function update(UpdateequipmentRequest $request, equipment $equipment): RedirectResponse
    {
        $equipment = equipment::where('deleted', '<>', true)->findOrFail($equipment->id);
        $input = $request->all();
        $equipment->update($input);
        return redirect()->route('equipments.show', $equipment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param equipment $equipment
     * @return RedirectResponse
     */
    public function destroy(equipment $equipment): RedirectResponse
    {
        $equipment = equipment::where('deleted', '<>', true)->findOrFail($equipment->id);
        $equipment->deleted = true;
        $equipment->save();
        return redirect()->route('offers.show', $equipment->offer_id);
    }
}
