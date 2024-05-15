<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityFormRequest;
use App\Models\City;

class CityController extends Controller
{

    public function index()
    {
        return view('admin.cities.index', [
            'cities' => City::paginate(25)
        ]);
    }

    public function create()
    {
        return view('admin.cities.form', [
            'city' => new City(),
        ]);
    }

    public function store(CityFormRequest $request)
    {
        $city = City::create($request->validated());
        return to_route('admin.city.index')->with('success', 'Ville créée');
    }


    public function edit(City $city)
    {
        return view('admin.cities.form', [
            'city' => $city,
        ]);
    }

    public function update(CityFormRequest $request, City $city)
    {
        $city->update($request->validated());
        return to_route('admin.city.index')->with('success', 'Ville éditée');
    }

    public function destroy(City $city)
    {
        if ($city->delete()) {
            return to_route('admin.city.index')->with('success', 'Ville supprimée');
        }
    }
}
