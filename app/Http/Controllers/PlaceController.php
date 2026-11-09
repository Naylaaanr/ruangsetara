<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'facilities' => ['nullable', 'array'],
            'facilities.*' => ['exists:facilities,id'],
        ]);

        $query = Place::query()
            ->where('status', Place::STATUS_SUDAH)
            ->with(['category', 'facilities']);

        if (!empty($validated['q'])) {
            $q = $validated['q'];
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('district', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%");
            });
        }

        if (!empty($validated['category_id'])) {
            $query->where('category_id', $validated['category_id']);
        }

        if (!empty($validated['facilities'])) {
            foreach ($validated['facilities'] as $facilityId) {
                $query->whereHas('facilities', function ($sub) use ($facilityId) {
                    $sub->where('facilities.id', $facilityId);
                });
            }
        }

        $places = $query->latest()->paginate(9)->withQueryString();

        $categories = Category::orderBy('name')->get();
        $facilitiesByNeed = Facility::orderBy('name')->get()->groupBy('need');

        return view('places.index', compact('places', 'categories', 'facilitiesByNeed'));
    }

    public function show(Place $place)
    {
        if ($place->status !== Place::STATUS_SUDAH) {
            abort(404);
        }

        $place->load(['category', 'facilities']);

        return view('places.show', compact('place'));
    }
}
