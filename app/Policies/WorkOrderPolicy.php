<?php

namespace App\Policies;

use App\Models\User;

class WorkOrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

      /**
     * Determine whether the contractor can sign off on the work order line item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WorkOrderLineItem  $lineItem
     * @param  string $pin
     * @return bool
     */
    public function signOff(User $user, WorkOrderLineItem $lineItem, $pin)
    {
        // Ensure the user is associated with a contractor
        $contractor = Contractor::where('user_id', $user->id)->first();

        if ($contractor && $contractor->id === $lineItem->contractor_id) {
            // Check if the pin matches
            return $contractor->pin_number === $pin;
        }

        return false;
    }
}
