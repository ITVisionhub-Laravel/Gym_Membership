<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Expenses;
use App\Models\DebitAndCredit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use Illuminate\Support\Facades\Config;

class ExpensesController extends Controller
{
    public $expensesInfo;
    public function index()
    {
        $expenses = Expenses::all();
        
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(ExpensesRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            $this->expensesInfo = Expenses::create($validatedData);
            $this->debitCreditInfos();
            DB::commit();
            return redirect()->route('expenses.index')->with('message', 'Expenses created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            $this->emit('checkoutFailed', 'Checkout failed. Please try again later.');
        }
    }

    public function debitCreditInfos()
    {
        $new_debit_credit_info = new DebitAndCredit();
        $new_debit_credit_info->name = $this->expensesInfo->name;
        $new_debit_credit_info->amount = $this->expensesInfo->amount;
        $new_debit_credit_info->status_id = Config::get('variables.SUCCESS');
        $new_debit_credit_info->date = Carbon::now()->format('Y-m-d');
        $new_debit_credit_info->related_info_id = $this->expensesInfo->invoice_id;
        $new_debit_credit_info->related_info_type = Config::get('variables.EXPENSES');
        $new_debit_credit_info->transaction_type_id = Config::get('variables.CREDIT');
        $new_debit_credit_info->save(); 
    }

    public function edit(Expenses $transaction)
    {
        return view('expenses.edit', compact('transaction'));
    }

    public function update(ExpensesRequest $request, Expenses $transaction)
    {
        $transaction->update($request->validated());
        
        return redirect()->route('expenses.index')->with('message', 'Expenses updated successfully.');
    }

    public function destroy(Expenses $transaction)
    {
        $transaction->delete();

        return redirect()->route('expenses.index')->with('message', 'Expenses deleted successfully.');
    }
}