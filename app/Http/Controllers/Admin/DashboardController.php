<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Place;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_places' => Place::count(),
            'verified' => Place::where('status', Place::STATUS_SUDAH)->count(),
            'unverified' => Place::where('status', Place::STATUS_BELUM)->count(),
            'needs_review' => Place::where('status', Place::STATUS_PERIKSA)->count(),
            'total_categories' => Category::count(),
            'total_facilities' => Facility::count(),
            'total_users' => User::count(),
        ];

        $placesPerCategory = Category::withCount('places')->orderBy('name')->get();

        $latestPlaces = Place::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'placesPerCategory', 'latestPlaces'));
    }
}
