<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use DateTimeImmutable;
use App\Models\Trainer;
use App\Models\Products;
use App\Models\Attendent;
use App\Models\PaymentRecord;
use App\Models\CustomerQRCode;
use App\Models\DebitAndCredit;
use App\Models\ProfitSharingView;
use App\Http\Controllers\Controller;
use App\Models\PaymentExpiredMembers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->guest() || !auth()->user()->role_as == Config::get('variables.ADMIN')) {
            return redirect('/')->with('status', 'Logged In Successfully');
        }
        $expiredDate = '';

        $data['members'] = User::get();
        $data['buying_price'] = Products::sum('buying_price');
        // dd($data["user_profile"]);
        $prices = 0;
        $paymentRecords = PaymentRecord::get();
        // dd($paymentRecord[0]->paymentprovider);
        foreach ($paymentRecords as $paymentPrice) {
            $prices += $paymentPrice->package->promotion_price;
        }
        $data['price'] = $prices;

        $data['paymentRecords'] = PaymentRecord::get();

        // For Attendenced Members
        $todayDate = new DateTimeImmutable(Carbon::now()->format('Y-m-d'));
        $data['attendencedMembers'] = Attendent::where(
            'attendent_date',
            $todayDate
        )->get();

        // For Bar Chart
        $monthlyEarnings = PaymentRecord::select('record_date')
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
                        'customer_id' => $paymentRecord->user_id,
                    ],
                    [
                        'expired_date' => $packageExpiredDate->format('Y-m-d'),
                        'extra_days' => $expiredDate,
                    ]
                );

                $data['ExpiredPaymentMember'] = true;
                CustomerQRCode::where(
                    'user_id',
                    $paymentRecord->user_id
                )->delete();
            } else {
                $payment_expired_members
                    ->where('user_id', $paymentRecord->user_id)
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
        $data['yufcIncome'] = ProfitSharingView::first()->YUFC_25_percent;
        $ourIncome = ProfitSharingView::first()->FSA_75_percent;

        $yearlyData = DebitAndCredit::whereYear('date', '=', $now->year)
                        // ->whereMonth('date', '=', $now->month)
                        ->get();

        $expense = $yearlyData->where('transaction_type_id', $variablesTwoData)->sum('amount');

        $income = $yearlyData->where('transaction_type_id', $variablesOneData)->sum('amount');

        $profit = $ourIncome - $expense;

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
