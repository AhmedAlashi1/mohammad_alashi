<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use App\DataTables\InventoriesDataTable;

class InventoryController extends Controller
{
    public function index(InventoriesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.inventories.index');
    }

    public function create()
    {
        return view('dashboard.admin.inventories.create');
    }

    public function store(StoreInventoryRequest $request)
    {
        Inventory::create($request->validated());

        return redirect()->route('admin.inventories.index')
            ->with('success', 'created successfully.');
    }

    public function edit(Inventory $inventory)
    {
        return view('dashboard.admin.inventories.edit', compact('inventory'));
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());

        return redirect()->route('admin.inventories.index')
            ->with('success', 'updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return response()->json(['status' => true, 'message' => 'Deleted successfully']);
    }
}
