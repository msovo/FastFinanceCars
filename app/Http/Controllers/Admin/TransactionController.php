<?php

// app/Http/Controllers/Admin/TransactionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('admin.transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'buyer_id' => 'required|integer',
            'listing_id' => 'required|integer',
            'amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        Transaction::create($request->all());

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function edit(Transaction $transaction)
    {
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'buyer_id' => 'required|integer',
            'listing_id' => 'required|integer',
            'amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $transaction->update($request->all());

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
