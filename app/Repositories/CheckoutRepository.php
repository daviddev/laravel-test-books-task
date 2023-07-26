<?php

namespace App\Repositories;

use App\Models\Checkout;

class CheckoutRepository
{
    /**
     * Update checkout.
     *
     * @param Checkout $checkout
     * @param array $data
     * @return Checkout
     */
    public function updateCheckout(Checkout $checkout, array $data): Checkout
    {
        $checkout->update($data);
        $checkout->refresh();

        return $checkout;
    }
}
