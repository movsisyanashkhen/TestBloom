<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    /**
     * Display a listing of the contracts.
     */

    
    public function index()
    {
        $contracts = Contract::latest()->paginate(10);

        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new contract.
     */
    public function create()
    {
        return view('contracts.create');
    }

    /**
     * Store a newly created contract in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'currency' => 'required|string|max:10',
            'category' => 'required|string|max:50',
            'status' => 'required|in:Active,Completed',
        ]);

        Contract::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'category' => $request->category,
            'status' => $request->status,
            'created_by' => Auth::id(), // Current logged-in user's ID
        ]);

        return redirect()->route('contracts.index')->with('success', 'Contract created successfully.');
    }

    /**
     * Display the specified contract.
     */
    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified contract.
     */
    public function edit(Contract $contract)
    {
        return view('contracts.edit', compact('contract'));
    }

    /**
     * Update the specified contract in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'currency' => 'required|string|max:10',
            'category' => 'required|string|max:50',
            'status' => 'required|in:Active,Completed',
        ]);

        $contract->update($request->all());

        return redirect()->route('contracts.index')->with('success', 'Contract updated successfully.');
    }

    /**
     * Remove the specified contract from storage (soft delete).
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')->with('success', 'Contract deleted successfully.');
    }


    /*  EXCEL export */

    public function exportToCSV()
    {
        $fileName = 'contracts.csv';
        $contracts = Contract::all(); // Ստուգիր, որ Contract մոդելը ճիշտ է և տվյալներ ունի:

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $columns = ['ID', 'Description', 'Amount', 'Currency', 'Category', 'Status', 'Created By', 'Created At'];

        $callback = function () use ($contracts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($contracts as $contract) {
                fputcsv($file, [
                    $contract->id,
                    $contract->description,
                    $contract->amount,
                    $contract->currency,
                    $contract->category,
                    $contract->status,
                    $contract->created_by,
                    $contract->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
