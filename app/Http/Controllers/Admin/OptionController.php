<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionFormRequest;
use App\Models\Option;

class OptionController extends Controller
{

    public function index()
    {
        return view('admin.options.index', [
            'options' => Option::paginate(25)
        ]);
    }

    public function create()
    {
        return view('admin.options.form', [
            'option' => new Option(),
        ]);
    }

    public function store(OptionFormRequest $request)
    {
        $option = Option::create($request->validated());
        return to_route('admin.option.index')->with('success', 'Option créée');
    }


    public function edit(Option $option)
    {
        return view('admin.options.form', [
            'option' => $option,
        ]);
    }

    public function update(OptionFormRequest $request, Option $option)
    {
        $option->update($request->validated());
        return to_route('admin.option.index')->with('success', 'Option éditée');
    }

    public function destroy(Option $option)
    {
        if ($option->delete()) {
            return to_route('admin.option.index')->with('success', 'Option supprimée');
        }
    }
}
