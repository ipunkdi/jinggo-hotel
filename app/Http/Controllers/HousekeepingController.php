<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Housekeeping;
use Illuminate\Http\Request;

class HousekeepingController extends Controller
{
    public function index()
    {
        $housekeepings = Housekeeping::all();
        $inventories = Inventory::with('unit', 'unitgroup')->get();

        // Menghitung status unit
        $dirtyUnits = Housekeeping::where('current_condition', 'dirty')->count();
        $inspectUnits = Housekeeping::where('current_condition', 'Inspect')->count();
        $cleanUnits = Housekeeping::where('current_condition', 'clean')->count();
        // $outOfServices = Unit::where('status', 'out_of_service')->count();
        // $outOfOrderUnits = Unit::where('status', 'out_of_order')->count();

        // Mengirim data ke tampilan
        return view('housekeeping.index', [
            'title' => 'Housekeeping',
            'inventories' => $inventories,
            'housekeepings' => $housekeepings,
            'dirtyUnits' => $dirtyUnits,
            'inspectUnits' => $inspectUnits,
            'cleanUnits' => $cleanUnits
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $housekeeping = Housekeeping::findOrFail($id);

        $request->validate([
            'status' => 'required|in:clean,Inspect,dirty'
        ]);

        // Update status berdasarkan input dari form
        $housekeeping->current_condition = $request->input('status');
        $housekeeping->save();

        return redirect()->route('housekeeping.index')->with('success', 'Status kamar berhasil diperbarui.');
    }


    // public function getUnitData()
    // {
    //     $units = Unit::all();
    //     return response()->json($units);
    // }

    // public function getUnitGroup()
    // {
    //     $unitGroups = UnitGroup::all();
    //     return response()->json($unitGroups);
    // }

    public function searchData(Request $request)
    {
        $keyword = $request->input('keyword');
        $results = Housekeeping::with('unitgroup')
            ->where('type', 'like', "%$keyword%")
            ->orWhereHas('unit', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->get();

        return response()->json($results);
    }
}
