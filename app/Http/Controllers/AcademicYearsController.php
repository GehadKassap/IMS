<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\AcademicYear;

class AcademicYearsController extends Controller
{
    public function index(Request $request)
    {
        $data = AcademicYear::latest()->paginate(10);

        return Inertia::render('academic-year/index', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year_from' => 'required|max:4',
            'year_to' => 'required|max:4',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        AcademicYear::create(
            [
                'year_from' => $request->year_from,
                'year_to' => $request->year_to,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
            ]
        );

        return back()->with('status', ['type' => 'success', 'action' => 'Add New Record', 'text' => 'Record has been added successfully.']);

    }

    public function update(Request $request,AcademicYear $academicYear){

        $data = $request->validate([
            'year_from' => 'required|max:4',
            'year_to' => 'required|max:4',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $academicYear->update(
            [
                'year_from' => $request->year_from,
                'year_to' => $request->year_to,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
            ]
        );

        return back()->with('status', ['type' => 'success', 'action' => 'Updating Record', 'text' => 'Record has been updated successfully.']);

    }


    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        return back()->with('status', ['type' => 'success', 'action' => 'Deleting Record', 'text' => 'Record has been deleted successfully.']);

    }
}
