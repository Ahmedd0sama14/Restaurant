<?php

namespace App\Http\Controllers;

use App\Models\c;
use App\Models\Solider;
use Illuminate\Http\Request;
use App\Imports\SoliderImport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\PhpWord;

class solidersController extends Controller
{
    public static function arabicNumbers($number)
{
    return str_replace(
        ['0','1','2','3','4','5','6','7','8','9'],
        ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'],
        $number
    );

}
public static function formatArabicDate($date)
{
    if (!$date) return '-';
    return str_replace(
        ['0','1','2','3','4','5','6','7','8','9'],
        ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'],
        \Carbon\Carbon::parse($date)->format('Y/m/d')
    );
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }


    public function store(Request $request)
    {

    $data = $request->validate([
        'excel_file' => 'required|mimes:xls,xlsx'
    ]);



    Excel::import(new SoliderImport, $data['excel_file']);
    return redirect()->route('soliders.showAll')->with('success', 'Soldiers imported successfully.');

        // Process the uploaded file as needed
        // For example, you can read its contents or store it
    }
    public function showAll(Request $request)
    {
        $soliders = Solider::orderBy('military_number', 'asc')->paginate(10);
        if (request('search')) {

            $soliders = Solider::where('name', 'like', '%' . request('search') . '%')
                ->orWhere('military_number', 'like', '%' . request('search') . '%')
                ->orderBy('military_number', 'asc')
                ->paginate(10);

        }
        return view('solidersAll', compact('soliders'));
    }

    public function showFill(Request $request)
    {
        $soliders = [];

        if ($request->has('release_date')) {
            $soliders = Solider::where('release_date', $request->input('release_date'))->get();

        }

        return view('solidersFill', compact('soliders'));
    }
    public function export(Request $request)
    {
        
    }
}

