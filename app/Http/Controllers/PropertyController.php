<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\PropertyFormRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;
use App\Models\City;
use App\Models\Option;
use App\Models\Picture;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{

    // *****************

    // PUBLIC

    // *****************

    public function index(SearchPropertiesRequest $request)
    {

        $query = Property::where('sold', false);

        $filters = [
            'price' => '<=',
            'surfaceMin' => '>=',
            'surfaceMax' => '<=',
            'nmbRoom' => '>=',
            'nmbBedroom' => '>=',
        ];

        foreach ($filters as $field => $operator) {

            $inputField = $field;
            if ($field === 'surfaceMin' || $field === 'surfaceMax') {
                $inputField = 'surface';
            }

            if ($request->validated($field)) {
                $query = $query->where($inputField, $operator, $request->validated($field));
            }
        }

        if ($request->validated('title')) {
            $query = $query->where('title', 'like', "%{$request->validated('title')}%");
        }

        return view('public.properties.index', [
            'properties' => $query->orderBy('created_at', 'desc')->paginate(12),
            'input' => $request->validated()
        ]);
    }


    public function show(string $slug, Property $property)
    {
        $expectedSlug = $property->getSlug();
        if ($slug === $expectedSlug) {
            return view('public.properties.show', [
                'slug' => $expectedSlug,
                'property' => $property,
            ]);
        }

        return view('public.properties.show', [
            'property' => $property,
        ]);
    }

    public function contact(Property $property, PropertyContactRequest $request)
    {
        Mail::send(new PropertyContactMail($property, $request->validated()));
        return back()->with('success', 'Message envoye');
    }

    // *****************

    // ADMIN

    // *****************


    public function indexAdmin()
    {
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }

    public function create()
    {
        return view('admin.properties.form', [
            'property' => new Property(),
            'cities' => City::pluck('name', 'id'),
            'options' => Option::pluck('name', 'id')
        ]);
    }

    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());
        $property->options()->sync($request->validated(('options')));
        if ($request->validated('pictures')) {
            $property->attachFiles($request->validated('pictures'));
        }

        return to_route('admin.property.index')->with('success', 'Bien créé');
    }


    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'cities' => City::pluck('name', 'id'),
            'options' => Option::pluck('name', 'id')
        ]);
    }

    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->options()->sync($request->validated(('options')));
        if ($request->validated('pictures')) {
            $property->attachFiles($request->validated('pictures'));
        }
        $property->update($request->validated());
        return to_route('admin.property.index')->with('success', 'Bien édité');
    }

    public function destroy(Property $property)
    {
        Picture::destroy($property->pictures()->pluck('id'));
        $directoryPath = 'public/properties/' . $property->id;

        if (Storage::exists($directoryPath)) {
            Storage::deleteDirectory($directoryPath);
        }

        if ($property->delete()) {
            return to_route('admin.property.index')->with('success', 'Bien supprimé');
        }
    }
}
