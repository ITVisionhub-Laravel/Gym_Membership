<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Expenses;
use App\Models\DebitAndCredit; 
use Illuminate\Support\Facades\DB;
use App\Contracts\ExpenseInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ExpensesResource;

class ExpensesController extends Controller
{
    // use UploadImageTrait;

    public Model $expense;
    private $expenseInterface;

    public function __construct(ExpenseInterface $expenseInterface)
    {
        $this->expenseInterface = $expenseInterface;
    }
    public function index()
    {
        $expenses = $this->expenseInterface->all('Expenses');
        if (request()->is('api/*')) {
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
        try {
            $validatedData = $request->validated(); 
            DB::beginTransaction();
            $this->expense = $this->expenseInterface->store('Expenses', $validatedData);
            $this->debitCreditInfos(); 
            DB::commit();
            if (request()->is('api/*')) {
                return new ExpensesResource($this->expense);
            }
            return redirect()->route('expenses.index')->with('message', Config::get('variables.SUCCESS_MESSAGES.CREATED_EXPENSE'));
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }           
    }

    public function edit(Expenses $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(ExpensesRequest $request, String $id)
    {
        try{
            $validatedData = $request->validated(); 
            DB::beginTransaction();
                $this->expense = $this->expenseInterface->update(
                    "Expenses",
                    $validatedData,
                    $id
                );
                $this->debitCreditInfos($id); 
            DB::commit();
            if (request()->expectsJson()) {
                return new ExpensesResource($this->expense);
            }
            return redirect()->route('expenses.index')->with('message', Config::get('variables.SUCCESS_MESSAGES.UPDATED_EXPENSE'));
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
            return redirect()->route('expenses.index')->with('message', Config::get('variables.SUCCESS_MESSAGES.DELETED_EXPENSE'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

   public function debitCreditInfos($id = '')
    {
        // Ensure $this->expense has required properties
        if (!isset($this->expense->name) || !isset($this->expense->amount)) {
            throw new \Exception('Expense properties are not set.');
        }

        // Initialize or update DebitAndCredit model
        $debitCredit = DebitAndCredit::where('related_info_id', $id)
            ->where('related_info_type', Config::get('variables.EXPENSES'))
            ->first();

        // Initialize new DebitAndCredit model
        // $new_debit_credit_info = new/.id = Config::get('variables.CREDIT');
        // $data = $new_debit_credit_info->toArray();

        if ($debitCredit) {
        // Update existing record
        $debitCredit->name = $this->expense->name;
        $debitCredit->amount = $this->expense->amount;
        $debitCredit->status_id = Config::get('variables.SUCCESS');
        $debitCredit->date = Carbon::now()->format('Y-m-d');
        $debitCredit->transaction_type_id = Config::get('variables.CREDIT');
        $debitCredit->save();
    } else {
        // Create new record
        $newDebitCredit = new DebitAndCredit();
        $newDebitCredit->name = $this->expense->name;
        $newDebitCredit->amount = $this->expense->amount;
        $newDebitCredit->status_id = Config::get('variables.SUCCESS');
        $newDebitCredit->date = Carbon::now()->format('Y-m-d');
        $newDebitCredit->related_info_id = $id;
        $newDebitCredit->related_info_type = Config::get('variables.EXPENSES');
        $newDebitCredit->transaction_type_id = Config::get('variables.CREDIT');
        $newDebitCredit->save();
    }

    }


}
