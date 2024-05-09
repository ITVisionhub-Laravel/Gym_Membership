<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Expenses;
use App\Models\DebitAndCredit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use App\Http\Resources\ExpensesResource;
use App\Traits\UploadImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class ExpensesController extends Controller
{
    use UploadImageTrait;

    public Model $expenses;
    public function index()
    {
        $expenses = Expenses::paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
        if (request()->expectsJson()) {
            return ExpensesResource::collection($expenses);
        }
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
            $this->expenses = new Expenses();
            $this->expenses->fill($validatedData);
            $this->uploadImage($request, $this->expenses, 'expenses', 'invoice_slip');

            $this->expenses->save();
            $this->debitCreditInfos();

            DB::commit();
            if (request()->expectsJson()) {
                return new ExpensesResource($this->expenses);
            }
            return redirect()->route('expenses.index')->with('message', 'Expenses created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }
    }

    public function edit(Expenses $transaction)
    {
        return view('expenses.edit', compact('transaction'));
    }

    public function update(ExpensesRequest $request, Expenses $expense)
    {
        $this->expenses = Expenses::findOrFail($expense->id);
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            // $this->expenses->fill($validatedData);
            $this->expenses->name = $validatedData['name'];
            $this->expenses->amount = $validatedData['amount'];
            $this->expenses->invoice_id = $validatedData['invoice_id'];
            $this->uploadImage($request, $expense, 'expenses', 'invoice_slip');

            $this->expenses->save();
            $this->debitCreditInfos($expense->invoice_id);
            DB::commit();
            if (request()->expectsJson()) {
                return new ExpensesResource($this->expenses);
            }
            return redirect()->route('expenses.index')->with('message', 'Expenses updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function destroy(Expenses $expense)
    {
        DB::beginTransaction();
        try {
            $expenses = Expenses::findOrFail($expense->id);
            $debit_credit = DebitAndCredit::where('related_info_id', $expense->invoice_id)->first();
            $debit_credit->delete();
            $this->deleteImage($expense, $expense->invoice_slip);
            $success = $expenses->delete();
            DB::commit();
            if (request()->expectsJson()) {
                return $success ? response(status: 204) : response(status: 500);
            }
            return redirect()->route('expenses.index')->with('message', 'Expenses deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function debitCreditInfos($invoice_id = '')
    {
        if ($invoice_id !== '') {
            $new_debit_credit_info = DebitAndCredit::where('related_info_id', $invoice_id)->first();
        } else {
            $new_debit_credit_info = new DebitAndCredit();
        }
        // return $new_debit_credit_info;
        $new_debit_credit_info->name = $this->expenses->name;
        $new_debit_credit_info->amount = $this->expenses->amount;
        $new_debit_credit_info->status_id = Config::get('variables.SUCCESS');
        $new_debit_credit_info->date = Carbon::now()->format('Y-m-d');
        $new_debit_credit_info->related_info_id = $this->expenses->invoice_id;
        $new_debit_credit_info->related_info_type = Config::get('variables.EXPENSES');
        $new_debit_credit_info->transaction_type_id = Config::get('variables.CREDIT');
        $new_debit_credit_info->save();
    }
}
