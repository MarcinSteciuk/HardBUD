<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->isOfferTaker() || $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return bool
     */
    public function view(User $user, Reservation $reservation): bool
    {
        return ($reservation->user_id == $user->id) || $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->isOfferTaker() || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return bool
     * @throws Exception
     */
    public function delete(User $user, Reservation $reservation): bool
    {
        return $user->isAdmin();
    }
}
