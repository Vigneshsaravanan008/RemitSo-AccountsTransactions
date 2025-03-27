<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function accounts(Request $request)
    {
        $requestObject = $request->all();

        $rules =[
            'account_name'=>'required|max:255',
            'account_type'=>'required',
            'currency'=>'required|max:255',
            'balance'=>'nullable',
        ];

        $validator = Validator::make($requestObject, $rules);
        $account=null;

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'error' => $validator->errors()], 400);
        } else {
            $user_id=User::create([
                "id"=>Str::uuid(),
                "name"=>$request->account_name,
                "password" => Hash::make('RemitSo'),
            ])->id;

            $account_number = $this->generateLuhnAccountNumber(16);

            $account=Account::create([
                "user_id"=>$user_id,
                'account_name'=>$request->account_name,
                'account_number'=>$account_number,
                'account_type'=>$request->account_type,
                'currency'=>$request->currency,
                'balance'=>$request->balance
            ]);
        }

        return response()->json(['status'=>200,'message'=>"Account Created Successfully",'account'=>$account]);
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

    public function accountDetails($account_number)
    {
        $accounts=Account::where("id",$account_number)->first();
        return response()->json(['status'=>200,'accounts'=>$accounts]);
    }

    public function accountUpdateDetails(Request $request,$account_number)
    {
        $requestObject = $request->all();

        $rules =[
            'account_name'=>'required|max:255',
            'account_type'=>'required',
            'currency'=>'required|max:255',
            'balance'=>'nullable',
        ];

        $validator = Validator::make($requestObject, $rules);
        $account=null;
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'error' => $validator->errors()], 400);
        } else {
            $account=Account::where("id",$account_number)->update([
                'account_name'=>$request->account_name,
                'account_type'=>$request->account_type,
                'currency'=>$request->currency,
                'balance'=>$request->balance
            ]);
        }

        return response()->json(['status'=>200,'message'=>"Account Updated Successfully",'account'=>$account]);
    }

    public function accountDeleteDetails($account_number)
    {
        $account=Account::where("id",$account_number)->update([
            'status'=>0
        ]);

        return response()->json(['status'=>200,'message'=>"Account Deactivated Successfully",'account'=>$account]);
    }
}
