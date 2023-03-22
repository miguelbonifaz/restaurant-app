<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $plates = Menu::query()
            ->withAvailableOrders()
            ->with('media')
            ->latest()
            ->get(['id', 'name', 'description', 'price', 'quantity']);

        return Inertia::render('Home/Index', [
            'plates' => MenuResource::collection($plates),
        ]);
    }
}