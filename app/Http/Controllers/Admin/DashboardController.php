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
use App\Http\Resources\DashboardResource;
use App\Models\PaymentExpiredMembers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(auth()->user());
        // if (auth()->guest() || !auth()->user()->role_as == Config::get('variables.ADMIN')) {
        //     return redirect('/')->with('status', 'Logged In Successfully');
        // }
        // dd("Hello");
        $expiredDate = '';

        $data['members'] = User::where('role_as', Config::get('variables.ZERO'))->get();
        $data['buying_price'] = Products::sum('buying_price');
         
        $prices = 0;
        $paymentRecords = PaymentRecord::get();
        
        foreach ($paymentRecords as $paymentPrice) {
            $prices += $paymentPrice->package->promotion_price;
        }
        $data['price'] = $prices;

        $data['paymentRecords'] = PaymentRecord::get();

        // For Attendenced Members
        $todayDate = new DateTimeImmutable(Carbon::now()->format('Y-m-d'));
        $data['attendedMembers'] = Attendent::where(
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

        // End of Expired Payment Member

        $data['trainers'] = Trainer::get();

        $data['yufc_income'] = ProfitSharingView::get()->sum('YUFC_25_percent');
        $ourIncome = ProfitSharingView::get()->sum('FSA_75_percent');

        $allDebitCreditData = DebitAndCredit::get(); 

        $expense = $allDebitCreditData->where('transaction_type_id', Config::get('variables.CREDIT'))->sum('amount');
        $total_income = $allDebitCreditData->where('status_id', Config::get('variables.SUCCESS'))->where('transaction_type_id', Config::get('variables.DEBIT'))->sum('amount');

        $our_revenue = $ourIncome - $expense;

        $data['expenses'] = $expense;
        $data['total_income'] = $total_income;
        $data['our_revenue'] = $our_revenue;
        
        if(request()->expectsJson()){
            return new DashboardResource($data);
        }
        return view('admin.dashboard.index', $data);
    }

    public function show(int $memberId)
    {
        $memberDetails = User::where('id', $memberId)->get();
        return view('members.profile', compact('memberDetails'));
    }
}
