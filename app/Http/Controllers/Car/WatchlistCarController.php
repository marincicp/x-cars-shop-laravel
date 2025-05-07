<?php

namespace App\Http\Controllers\Car;

use App\Events\WatchlistedCar;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CarRepository;
use App\Models\Car;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WatchlistCarController extends Controller
{
    public function __construct(protected CarRepository $carRepo) {}

    /**
     * Show the user's car watchlist
     */
    public function index(): View
    {
        $cars = $this->carRepo->getCurrentUserFavoriteCars();

        return view('car.watchlist', ['cars' => $cars]);
    }

    /**
     * Add a car to the user's watchlist
     */
    public function store(Car $car): RedirectResponse
    {
        $res = $this->carRepo->addToWatchilst($car);
        if (! $res) {
            return back();
        }

        event(new WatchlistedCar($car));

        return back()->with('message.success', 'Car successfully added to watchlist');
    }

    /**
     * Remove a car from the user's watchlist
     */
    public function destroy(Car $car): RedirectResponse
    {
        $res = $this->carRepo->removeFromWatchlist($car);

        if (! $res) {
            return back();
        }

        return back()->with('message.success', 'Car successfully removed from watchlist');
    }
}
