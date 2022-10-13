<?php

namespace App\Http\Controllers;

use App\Models\Example;

class ExampleController extends Controller
{
    public function index()
    {
        $data = Example::all();
        return view('examples.index', compact('data'));
    }

    public function create()
    {
        return view('examples.create');
    }

    public function edit(Example $example)
    {
        return view('examples.edit', compact('example'));
    }

    public function store()
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        Example::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
        ]);

        flash('Data berhasil ditambahkan!');
        return redirect()->route('examples.index');
    }

    public function update(Example $example)
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $example->update([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
        ]);

        flash('Data berhasil diedit!');
        return redirect()->route('examples.index');
    }

    public function destroy(Example $example)
    {
        $example->delete();
        flash('Data berhasil diedit!');
        return redirect()->route('examples.index');
    }
}
