<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberFormRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class MemberControlller extends Controller
{
    public function index()
    {
        $members=Customer::all();
        return view('admin.members.index',compact('members'));
    }
    public function create()
    {
        return view('admin.members.create');
    }
    public function store(MemberFormRequest $request)
    {
        // return $request;
        $validatedData=$request->validated();
        $member=new Customer();
        $member->name=$validatedData['name'];
        $member->age=$validatedData['age'];
        $member->height=$validatedData['height'];
        $member->weight=$validatedData['weight'];
        $member->phone_number=$validatedData['phone_number'];
        $member->emergency_phone=$validatedData['emergency_phone'];
        $member->save();
        // dd($member->save());
        return redirect('admin/members')->with('message','Member Added Successfully');
    }
    public function edit(Customer $member)
    {
        // dd("hello");
        return view('admin.members.edit',compact('member'));
    }
    public function update(MemberFormRequest $request,$member)
    {
        $validatedData=$request->validated();
        $member=Customer::findOrFail($member);
        $member->name=$validatedData['name'];
        $member->age=$validatedData['age'];
        $member->height=$validatedData['height'];
        $member->weight=$validatedData['weight'];
        $member->phone_number=$validatedData['phone_number'];
        $member->emergency_phone=$validatedData['emergency_phone'];
        $member->update();
        return redirect('admin/members')->with('message','Member Updated Successfully');
    }

    public function destroy($member_id)
    {
        $member=Customer::findOrFail($member_id);
        $member->delete();
        return redirect('admin/members')->with('message','Member Deleted Successfully');
    }
}
