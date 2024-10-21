<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\College;
use App\Models\Department;

class DepartmentsController extends Controller
{
    public function index(Request $request)
    {
        $data = Department::with('college')->latest()->paginate(10);
        $colleges = College::all();

        return Inertia::render('department/index', [
            'data' => $data,
            'colleges' => $colleges,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required',
            'code' => 'required|max:255',
            'college_id' => 'required',
            'study_system' => 'required',
            'stages' => 'required',
            'ects_count' => $request->study_system == 'Bologna' ? 'required' : '',
        ]);

        Department::create(
            [
                'name' => [
                    'en' => $request->name_en,
                    'ku' => $request->name_ku,
                    'ar' => $request->name_ar
                ],
                'code' => $request->code,
                'college_id' => $request->college_id,
                'study_system' => $request->study_system,
                'stages' => $request->stages,
                'ects_count' => $request->ects_count,
            ]
        );

        return back()->with('status', ['type' => 'success', 'action' => 'Add New Record', 'text' => 'Record has been added successfully.']);

    }

    public function update(Request $request,Department $department){

        $data = $request->validate([
            'name_en' => 'required',
            'code' => 'required|max:255',
            'college_id' => 'required',
            'study_system' => 'required',
            'stages' => 'required',
        ]);

        $department->update(
            [
                'name' => [
                    'en' => $request->name_en,
                    'ku' => $request->name_ku,
                    'ar' => $request->name_ar
                ],
                'code' => $request->code,
                'college_id' => $request->college_id,
                'study_system' => $request->study_system,
                'stages' => $request->stages,
                'ects_count' => $request->ects_count,
            ]
        );

        return back()->with('status', ['type' => 'success', 'action' => 'Updating Record', 'text' => 'Record has been updated successfully.']);

    }


    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('status', ['type' => 'success', 'action' => 'Deleting Record', 'text' => 'Record has been deleted successfully.']);

    }
}
