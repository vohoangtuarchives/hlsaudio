<?php

namespace App\Http\Controllers\Dashboard;

use App\Datatables\CustomerTables;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CustomerTables $datatables){
        return $datatables->render("dashboard.pages.customers.index");
    }


    public function edit($id){
        $user =Customer::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.customers.partials.edit", [
                'user' => $user,
            ]);
        }
        abort(404);

    }

    public function update($id, Request $request){
        $user = Customer::find($id);

        $input = $request->except('_token');

        foreach ( $input as $key => $value){

            if($key == 'password'){
                if(is_null($value)) continue;
                else $user->{$key} = Hash::make($value);
            }
        }

        $user->save();

        return redirect()->back()->with('alert_success', 'User Updated');

    }

    public function store(Request $request){

        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user =  Customer::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        Event::dispatch('customers.after.store', $user);

        return redirect()->back();

    }

    public function delete(){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                Role::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}