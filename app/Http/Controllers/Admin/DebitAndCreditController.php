<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DebitAndCreditRequest;
use App\Models\DebitAndCredit;
use App\Models\Transaction;
use App\Models\TransactionType;

class DebitAndCreditController extends Controller
{
   public function index()
   {
        $debitCredits = DebitAndCredit::all();
        return view('debit_credit.index', compact('debitCredits'));
   }

    public function create()
    {
        return view('debit_credit.create');
    }

    public function store(DebitAndCreditRequest $request)
    {
        DebitAndCredit::create($request->validated());
        return redirect()->route('debit-credit.index')->with('message', 'Debit/Credit created successfully!');
    }

    public function show(DebitAndCredit $debitCredit)
    {
        return view('debit_credit.show', compact('debitCredit'));
    }

    public function edit(DebitAndCredit $debitCredit)
    {
        $transactionTypes = TransactionType::all();
        $transactions = Transaction::all();
        
        return view('debit_credit.edit', compact('debitCredit','transactionTypes', 'transactions'));
    }

    public function update(DebitAndCreditRequest $request, DebitAndCredit $debitCredit)
    {
        $debitCredit->update($request->validated());
        return redirect()->route('debit-credit.index')->with('message', 'Debit/Credit updated successfully!');
    }

    public function destroy(DebitAndCredit $debitCredit)
    {
        $debitCredit->delete();
        return redirect()->route('debit-credit.index')->with('message', 'Debit/Credit deleted successfully!');
    }

}