<?php

namespace App\Livewire;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    public $account_name,$account_type,$currency,$initial_balance,$model_title="Add Account";
    use WithPagination;

    protected $rules = [
        'account_name'=>'required|max:255',
        'account_type'=>'required',
        'currency'=>'required|max:255',
        'initial_balance'=>'nullable',
    ];

    public function render()
    {
        $accounts=Account::paginate(15);
        return view('livewire.dashboard',compact("accounts"))->extends('website.layouts.master')->section('content');
    }

    public function statusAccount($id)
    {
        try {
            Account::where("id",$id)->update([
                'status'=>!Account::where("id",$id)->pluck('status')->first()
            ]);
            $this->dispatch('dismissmodal',message: 'Account Status Updated Successfully',parameter:'200');
        } catch (\Throwable $th) {
            $this->dispatch('dismissmodal',message: $th->getMessage(),parameter:'400');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        Session::flush();
        return redirect('/');
    }
}
