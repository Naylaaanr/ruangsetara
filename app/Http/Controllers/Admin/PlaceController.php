<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::with('category')
            ->withCount('facilities')
            ->latest()
            ->paginate(10);

        return view('admin.places.index', compact('places'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();

        return view('admin.places.create', compact('categories', 'facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $facilityIds = $validated['facilities'] ?? [];
        unset($validated['facilities']);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('places', 'public');
        }
        $place = Place::create($validated);
        $place->facilities()->sync($facilityIds);

        return redirect()
            ->route('admin.places.index')
            ->with('success', 'Data tempat berhasil ditambahkan.');
    }

    public function edit(Place $place)
    {
        $categories = Category::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();
        $place->load('facilities');

        return view('admin.places.edit', compact('place', 'categories', 'facilities'));
    }

    public function update(Request $request, Place $place)
    {
        $validated = $request->validate($this->rules());

        $facilityIds = $validated['facilities'] ?? [];
        unset($validated['facilities']);
        if ($request->hasFile('photo')) {
            if ($place->photo) {
                Storage::disk('public')->delete($place->photo);
            }
            $validated['photo'] = $request->file('photo')->store('places', 'public');
        } else {
            unset($validated['photo']);
        }


        $place->update($validated);
        $place->facilities()->sync($facilityIds);

        return redirect()
            ->route('admin.places.index')
            ->with('success', 'Data tempat berhasil diperbarui.');
    }

    public function destroy(Place $place)
    {
        if ($place->photo) {
            Storage::disk('public')->delete($place->photo);
        }
        $place->delete();

        return redirect()
            ->route('admin.places.index')
            ->with('success', 'Data tempat berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'address' => ['required', 'string'],
            'district' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:30'],
            'opening_hours' => ['nullable', 'string', 'max:255'],
            'maps_url' => ['nullable', 'url', 'max:1000'],
            'status' => ['required', Rule::in([
                Place::STATUS_BELUM,
                Place::STATUS_SUDAH,
                Place::STATUS_PERIKSA,
            ])],
            'facilities' => ['nullable', 'array'],
            'facilities.*' => ['exists:facilities,id'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
