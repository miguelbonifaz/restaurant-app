<?php

namespace App\Http\Controllers;

use App\Models\Order;

class FinalizeOrderController extends Controller
{
    public function __invoke(Order $order)
    {
        $order->finalize();

        return redirect()
            ->route('dashboard')
            ->with('message', "La Order #{$order->id} ha sido finalizada");
    }
}