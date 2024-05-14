<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\City;
use App\Models\Property;

class PropertyController extends Controller
{

    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }

    public function create()
    {
        return view('admin.properties.form', [
            'property' => new Property(),
            'cities' => City::all()
        ]);
    }

    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());
        return to_route('admin.property.index')->with('success', 'Bien créé');
    }


    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'cities' => City::all()
        ]);
    }

    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->update($request->validated());
        return to_route('admin.property.index')->with('success', 'Bien édité');
    }

    public function destroy(Property $property)
    {
        if ($property->delete()) {
            return to_route('admin.property.index')->with('success', 'Bien supprimé');
        }else{
            return to_route('admin.property.index')->with('error', 'Une erreur est survenue');
        }
    }
}
