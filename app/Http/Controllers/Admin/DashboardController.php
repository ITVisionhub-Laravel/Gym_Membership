<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use DateTimeImmutable;
use App\Models\Trainer;
use App\Models\Customer;
use App\Models\Products;
use App\Models\Attendent;
use App\Models\PaymentRecord;
use App\Models\CustomerQRCode;
use App\Models\DebitAndCredit;
use App\Http\Controllers\Controller;
use App\Models\PaymentExpiredMembers;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->guest() || !auth()->user()->role_as == '1') {
            return redirect('/')->with('status', 'Logged In Successfully');
        }
        $expiredDate = '';

        $data['members'] = Customer::get();
        $data['buying_price'] = Products::sum('buying_price');
        // dd($data['buying_price']);
        $prices = 0;
        foreach (PaymentRecord::get() as $paymentPrice) {
            $prices += (int) $paymentPrice->price;
        }
        $data['price'] = $prices;
        $data['paymentRecords'] = PaymentRecord::get();
        $paymentRecords = PaymentRecord::get();

        // For Attendenced Members
        $todayDate = new DateTimeImmutable(Carbon::now()->format('Y-m-d'));
        $data['attendencedMembers'] = Attendent::where(
            'attendent_date',
            $todayDate
        )->get();

        // For Bar Chart
        $monthlyEarnings = PaymentRecord::select('price', 'record_date')
            ->get()
            ->groupBy(function ($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->record_date); // grouping by months
            });
        // if ($monthlyEarnings) {
        $monthlyPrice = 0;
        $monthlyEarningMoney = [];
        $month = [];

        foreach ($monthlyEarnings as $key => $monthlyEarning) {
            foreach ($monthlyEarning as $earning) {
                $monthlyPrice += (int) $earning->price;
            }
            $arrayKeys = Carbon::parse($key)->format('F');

            if (!in_array($arrayKeys, $month)) {
                $month[] = $arrayKeys;
            }

            if (array_key_exists($arrayKeys, $monthlyEarningMoney)) {
                $monthlyEarningMoney[$arrayKeys] =
                    $monthlyEarningMoney[$arrayKeys] + $monthlyPrice;
            } else {
                $monthlyEarningMoney[$arrayKeys] = $monthlyPrice;
            }

            // dd($monthlyEarningMoney[$arrayKeys] + $monthlyPrice);

            $monthlyPrice = 0;
        }
        if ($monthlyEarningMoney) {
            $data['monthlyEarningMoney'] = $monthlyEarningMoney;
            $data['month'] = $month;
        } else {
            $data['monthlyEarningMoney'] = false;
            $data['month'] = $month;
        }
        // End of Bar Chart

        // For Expired Payment Member

        $data['expiredPaymentMember'] = false;
        foreach ($paymentRecords as $paymentRecord) {
            $packageName = $paymentRecord->package->package;
            if (stripos($packageName, 'month') !== false) {
                // It represents months
                $packageDate = (int) explode('month', $packageName)[0];
                $packageExpiredDate = new DateTimeImmutable(
                    Carbon::parse($paymentRecord->record_date)->addMonths(
                        $packageDate
                    )
                );
            } elseif (stripos($packageName, 'week') !== false) {
                // It represents weeks
                $packageDate = (int) explode('week', $packageName)[0];
                $packageExpiredDate = new DateTimeImmutable(
                    Carbon::parse($paymentRecord->record_date)->addWeeks(
                        $packageDate
                    )
                );
            } elseif (stripos($packageName, 'year') !== false) {
                // It represents years
                $packageDate = (int) explode('year', $packageName)[0];
                $packageExpiredDate = new DateTimeImmutable(
                    Carbon::parse($paymentRecord->record_date)->addYears(
                        $packageDate
                    )
                );
            } else {
                $packageDate = (int) explode('week', $packageName)[0];
                $packageExpiredDate = new DateTimeImmutable(
                    Carbon::parse($paymentRecord->record_date)->addWeeks(
                        $packageDate
                    )
                );
            }

            $interval = date_diff($todayDate, $packageExpiredDate);
            if ($interval->invert) {
                $expiredDate = -$interval->days;
            } else {
                $expiredDate = $interval->days;
            }

            $payment_expired_members = new PaymentExpiredMembers();

            if ($expiredDate <= 3) {
                $payment_expired_members->updateOrCreate(
                    [
                        'customer_id' => $paymentRecord->customer_id,
                    ],
                    [
                        'expired_date' => $packageExpiredDate->format('Y-m-d'),
                        'extra_days' => $expiredDate,
                    ]
                );

                $data['ExpiredPaymentMember'] = true;
                CustomerQRCode::where(
                    'user_id',
                    $paymentRecord->customer_id
                )->delete();
            } else {
                $payment_expired_members
                    ->where('customer_id', $paymentRecord->customer_id)
                    ->delete();
            }
        }
        $payment_expired_members = new PaymentExpiredMembers();

        $data['payment'] = $payment_expired_members->get()->count();
        if (!$data['payment']) {
            $data['ExpiredPaymentMember'] = false;
        }

        $data['trainers'] = Trainer::get();

        // $results = DebitAndCredit::select('name', DB::raw('SUM(amount) as total_amount'), DB::raw('COUNT(name) as name_count'))
        // ->groupBy('name')
        //     ->havingRaw('COUNT(name) = (SELECT MAX(name_count) FROM (SELECT COUNT(name) as name_count FROM debit_and_credits GROUP BY name) AS subquery)')
        //     ->get();
        $now = now();
        
        $variablesOneData = Config::get('variables.ONE');
        $variablesTwoData = Config::get('variables.TWO');
        
        $monthlyData = DebitAndCredit::whereYear('date', '=', $now->year)
                        ->whereMonth('date', '=', $now->month)
                        ->get();
                        
        $expense = $monthlyData->where('transaction_type_id', $variablesOneData)->sum('amount');
        
        $income = $monthlyData->where('transaction_type_id', $variablesTwoData)->sum('amount');
        
        $profit = $income - $expense;
        
        $data['expenses'] = $expense;
        $data['incomes'] = $income;
        $data['profits'] = $profit;
        return view('admin.dashboard.index', $data);
    }

    public function show(int $memberId)
    {
        $memberDetails = User::where('id', $memberId)->get();
        return view('members.profile', compact('memberDetails'));
    }
}