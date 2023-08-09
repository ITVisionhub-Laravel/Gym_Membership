<?php

namespace App\Http\Controllers\Admin\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delivery\DeliveryTypeFormRequest;
use App\Models\DeliveryType;
use App\Models\Township;
use Illuminate\Http\Request;

class DeliveryTypeController extends Controller
{
    public function index()
    {
        $data['delivertypes'] = DeliveryType::get();

        return view('admin.deliverytypes.index', $data);
    }
    public function create()
    {
        $data['townships'] = Township::get();
        return view('admin.deliverytypes.create', $data);
    }
    public function store(DeliveryTypeFormRequest $request)
    {
        $validatedData = $request->validated();
        $deliver = new DeliveryType();
        $deliver->name = $validatedData['name'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/deliverytypes/', $filename);
            $deliver->image = "uploads/deliverytypes/$filename";
        }
        $deliver->kg = $validatedData['kg'];
        $deliver->township_id = $validatedData['township_id'];
        $deliver->cost = $validatedData['cost'];
        $deliver->waiting_time = $validatedData['waiting-time'];
        $deliver->save();
        return redirect('admin/deliverytypes')->with(
            'message',
            'DeliverType Added Successfully'
        );
    }
    public function edit(DeliveryType $deliver)
    {
        $data['townships'] = Township::get();
        return view('admin.deliverytypes.edit', compact('deliver'), $data);
    }
    public function update(DeliveryTypeFormRequest $request, $deliver)
    {
        $validatedData = $request->validated();
        $deliver = DeliveryType::findOrFail($deliver);
        $deliver->name = $validatedData['name'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/deliverytypes/', $filename);
            $deliver->image = "uploads/deliverytypes/$filename";
        }
        $deliver->kg = $validatedData['kg'];
        $deliver->township_id = $validatedData['township_id'];
        $deliver->cost = $validatedData['cost'];
        $deliver->waiting_time = $validatedData['waiting-time'];
        $deliver->update();
        return redirect('admin/deliverytypes')->with(
            'message',
            'DeliverType Updated Successfully'
        );
    }
    public function destroy($deliver_id)
    {
        $deliver = DeliveryType::findOrFail($deliver_id);
        $deliver->delete();
        return redirect('admin/deliverytypes')->with(
            'message',
            'DeliveryType Deleted Successfully'
        );
    }
}
