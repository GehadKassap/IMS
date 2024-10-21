<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\College;

class CollegesController extends Controller
{
    public function index(Request $request)
    {
        $data = College::latest()->paginate(10);

        return Inertia::render('college/index', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required',
            'code' => 'required|max:255',
        ]);

        College::create(
            [
                'name' => [
                    'en' => $request->name_en,
                    'ku' => $request->name_ku,
                    'ar' => $request->name_ar
                ],
                'code' => $request->code
            ]
        );

        return back()->with('status', ['type' => 'success', 'action' => 'Add New Record', 'text' => 'Record has been added successfully.']);

    }

    public function update(Request $request,College $college){

        $data = $request->validate([
            'name_en' => 'required',
            'code' => 'required|max:255',
        ]);

        $college->update(
            [
                'name' => [
                   'en' => $request->name_en,
                   'ku' => $request->name_ku,
                   'ar' => $request->name_ar
                ],
                'code' => $request->code
            ]
        );

        return back()->with('status', ['type' => 'success', 'action' => 'Updating Record', 'text' => 'Record has been updated successfully.']);

    }


    public function destroy(College $college)
    {
        $college->delete();
        return back()->with('status', ['type' => 'success', 'action' => 'Deleting Record', 'text' => 'Record has been deleted successfully.']);

    }
}
