<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Address;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\RegisterUserFormRequest;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // dd($request);
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'position_id' => 0,
        //     'reporting_to' => 0,
        //     'image' => ''
        // ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function userInfoStore(RegisterUserFormRequest $request)
    {
        $validatedData = $request->validated();
        $user = new User();
        $address = new Address();

        $user->age = $validatedData['age'];
        $user->member_card = time();
        $user->height = $validatedData['height'];
        $user->weight = $validatedData['weight'];
        $user->class_id = $validatedData['gymclass'];

        if (
            DB::table('addresses')
            ->where('street_id', $request->street)
            ->exists()
        ) {
            $addressField = Address::where(
                'street_id',
                $request->street
            )->get();
            $user->address_id = $addressField[0]->id;
            // dd($addressField);
        } else {
            $address->street_id = $request->street;
            $address->save();
            $addressField = Address::where(
                'street_id',
                $request->street
            )->get();
            $user->address_id = $addressField[0]->id;
        }

        $user->phone_number = $validatedData['phone_number'];
        $user->emergency_phone = $validatedData['emergency_phone'];
        $user->facebook = $validatedData['facebook'];
        $user->twitter = $validatedData['twitter'];
        $user->linkedIn = $validatedData['linkedIn'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/user/', $filename);
            $user->image = $filename;
        }

        if ($user->save()) {
            return redirect('admin/users')->with(
                'message',
                'User Added Successfully'
            );
        }
    }
}
