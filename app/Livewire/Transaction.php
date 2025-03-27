<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Transaction as ModelsTransaction;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Transaction extends Component
{
    public $amount,$description,$account_id,$accounts=[],$model_title="Add Transactions",$type;

    protected $rules = [
        'type'=>'required',
        'amount'=>'required|numeric',
        'description'=>'required',
        'account_id'=>'required',
    ];

    public function render()
    {
        $this->accounts=Account::select("id","account_name","account_number")->get();
        $transactions=ModelsTransaction::latest()->paginate(10);
        return view('livewire.transaction',compact("transactions"))->extends('website.layouts.master')->section('content');
    }

    public function addTransaction()
    {
        $this->validate();
        try {
            $userAccount=Account::where("id",$this->account_id)->first();
            if($userAccount!=null)
            {
                if($this->type=="Credit")
                {
                    $userAccount->balance=$userAccount->balance+$this->amount;
                    $userAccount->save();

                    ModelsTransaction::create([
                        "type"=>$this->type,
                        'amount'=>$this->amount,
                        'description'=>$this->description,
                        'account_id'=>$this->account_id,
                    ]);
                    $text='Transaction Added Successfully';
                    $this->dispatch('dismissmodal',message:$text ,parameter:'200');
                }else{
                    if($userAccount->balance>$this->amount)
                    {
                        $userAccount->balance=$userAccount->balance-$this->amount;
                        $userAccount->save();
                        ModelsTransaction::create([
                            "type"=>$this->type,
                            'amount'=>$this->amount,
                            'description'=>$this->description,
                            'account_id'=>$this->account_id,
                        ]);
                        $text='Transaction Added Successfully';
                        $this->dispatch('dismissmodal',message:$text ,parameter:'200');
                    }else{
                        $this->dispatch('dismissmodal',message: "Insufficient Balance",parameter:'400');
                    }
                }
            }
        } catch (\Exception $e) {
            Log::info($e);
            $this->dispatch('dismissmodal',message: $e->getMessage(),parameter:'400');
        }
    }

    public function showTransaction($id)
    {
        $transaction=ModelsTransaction::where('id',$id)->first();
        $this->model_title="Show Transaction";
        if($transaction!=null)
        {
            $this->type=$transaction->type;
            $this->amount=$transaction->amount;
            $this->description=$transaction->description;
            $this->account_id=$transaction->account_id;
            $this->dispatch("message",parameter:"200");
        }else{
            $this->dispatch("message",message:"Transaction Not Found",parameter:"400");
        }

        return true;
    }

}
