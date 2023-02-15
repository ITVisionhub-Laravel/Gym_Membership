<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use DateTimeImmutable;
use App\Models\Product;
use App\Models\Trainer;
use App\Models\Customer;
use App\Models\Attendent;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->guest() || !auth()->user()->role_as=='1'){
            abort(403);
    }
        $expiredDate = '';

        $data['members'] = Customer::get();
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
        $monthlyEarningMoney = false;
        $month = false;

        foreach ($monthlyEarnings as $key => $monthlyEarning) {
            foreach ($monthlyEarning as $earning) {
                $monthlyPrice += (int) $earning->price;
            }
            $month[] = Carbon::parse($key)->format('F');
            $monthlyEarningMoney[
                Carbon::parse($key)->format('F')
            ] = $monthlyPrice;
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
            $packageDate = (int) explode('month', $packageName)[0];
            $packageExpiredDate = new DateTimeImmutable(
                Carbon::parse($paymentRecord->record_date)->addMonths(
                    $packageDate
                )
            );

            // $paymentDate = new DateTimeImmutable($paymentRecord->record_date);
            // @dd($packageExpiredDate);
            // @dd($todayDate);
            $interval = date_diff($todayDate, $packageExpiredDate);
            if ($interval->invert) {
                $expiredDate = -$interval->days;
            } else {
                $expiredDate = $interval->days;
            }

            if ($expiredDate <= 3) {
                $data['expiredPaymentMember'] = Customer::where(
                    'id',
                    $paymentRecord->customer_id
                )->get();
                $data['noExpiredPaymentMember'] = false;
            }
        }
        // $expiredPaymentMember = $data['expiredPaymentMember'];
        if (!$data['expiredPaymentMember']) {
            $data['noExpiredPaymentMember'] = true;
        }

        $data['trainers'] = Trainer::get();

        return view('admin.dashboard.index', $data);
    }
    public function show(int $memberId)
    {
        $memberDetails = Customer::where('id', $memberId)->get();
        return view('members.profile', compact('memberDetails'));
    }
}
