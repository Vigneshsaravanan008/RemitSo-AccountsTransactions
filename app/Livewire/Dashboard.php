<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Dashboard extends Component
{
    public $account_name,$account_type,$currency,$balance,$model_title="Add Account",$id,$account_number;
    use WithPagination;

    protected $rules = [
        'account_name'=>'required|max:255',
        'account_type'=>'required',
        'currency'=>'required|max:255',
        'balance'=>'nullable',
    ];

    public function render()
    {
        $accounts=Account::paginate(15);
        return view('livewire.dashboard',compact("accounts"))->extends('website.layouts.master')->section('content');
    }

    public function addAccount()
    {
        $this->validate();
        try {
            $user_id=User::create([
                "id"=>Str::uuid(),
                "name"=>$this->account_name,
                "password" => Hash::make('RemitSo'),
            ])->id;

            $account_number = $this->generateLuhnAccountNumber(16);

            Account::create([
                "user_id"=>$user_id,
                'account_name'=>$this->account_name,
                'account_number'=>$account_number,
                'account_type'=>$this->account_type,
                'currency'=>$this->currency,
                'balance'=>$this->balance
            ]);
            $text='Accounts Added Successfully';
            $this->dispatch('dismissmodal',message:$text ,parameter:'200');
        } catch (\Exception $e) {
            Log::info($e);
            $this->dispatch('dismissmodal',message: $e->getMessage(),parameter:'400');
        }
    }

    public function editAccount($id)
    {
        $account=Account::where('id',$id)->first();
        $this->model_title="Edit Account";
        if($account!=null)
        {
            $this->id=$account->id;
            $this->account_name=$account->account_name;
            $this->account_type=$account->account_type;
            $this->account_number=$account->account_number;
            $this->currency=$account->currency;
            $this->balance=$account->balance;
            $this->dispatch("message",parameter:"200");
        }else{
            $this->dispatch("message",message:"Account Not Found",parameter:"400");
        }

        return true;
    }

    public function updateAccount()
    {
        $this->validate();
        try {
            Account::where("id",$this->id)->update([
                'account_name'=>$this->account_name,
                'account_type'=>$this->account_type,
                'currency'=>$this->currency,
                'balance'=>($this->balance=="")?0.00:$this->balance,
            ]);

            $text='Accounts Updated Successfully';
            $this->dispatch('dismissmodal',message:$text ,parameter:'200');
        } catch (\Exception $e) {
            Log::info($e);
            $this->dispatch('dismissmodal',message: $e->getMessage(),parameter:'400');
        }
    }

    public function generateLuhnAccountNumber($length = 16)
    {
        $account_number = '';
        for ($i = 0; $i < $length - 1; $i++) {
            $account_number .= rand(0, 9);
        }
        $checksum = $this->calculateLuhnChecksum($account_number);
        $account_number .= $checksum;
        return $account_number;
    }

    public function calculateLuhnChecksum($number)
    {
        $sum = 0;
        $reverse_digits = strrev($number);
        for ($i = 0; $i < strlen($reverse_digits); $i++) {
            $digit = (int)$reverse_digits[$i];
            if ($i % 2 != 0) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }
        $checksum = (10 - ($sum % 10)) % 10;
        return $checksum;
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
        Auth::logout();
        return redirect('/');
    }
}
