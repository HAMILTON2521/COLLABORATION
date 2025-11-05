<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OtherPayment;
use App\Models\SelcomMerchantPayment;
use App\Models\SelcomPush;
use App\Models\Setting;
use App\Traits\GeneralHelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SelcomController extends Controller
{
    use GeneralHelperTrait;
    public function cancelOrder(): void
    {
        flash()->error('Please check your phone and confirm PIN');
    }

    public function callback(Request $request): void
    {
        info('Selcom Callback received', $request->all());

        if ($request && $request['resultcode']) {
            $push = SelcomPush::where('selcom_order_id', $request['order_id'])->first();

            if ($push) {
                $push->update([
                    'payment_status' => $request['payment_status'],
                    'is_paid' => $request['resultcode'] === '000',
                    'amount_paid' => $request['amount'] ? number_format((float) $request['amount'], 2, '.', '') : null,
                    'external_id' => $request['transid'],
                    'payment_result_code' => $request['resultcode'],
                    'payment_reference' => $request['reference'],
                    'channel' => $request['channel'],
                ]);
            }
        }
    }

    public function merchantValidation(Request $request)
    {
        $data = [
            'operator' => $request['operator'],
            'transid' => $request['transid'],
            'reference' => $request['reference'],
            'utilityref' => $request['utilityref'],
            'amount' => (float) $request['amount'],
            'msisdn' => $request['msisdn'],
        ];
        $setting = Setting::get('MINIMUM_PAYMENT_AMOUNT');
        $minimum_amount = (float) $setting;
        try {
            $rules = [
                'operator' => 'required|string',
                'transid' => 'required|string',
                'reference' => 'required|string',
                'utilityref' => 'required|string',
                'amount' => 'required|decimal:0,4|gte:' . $minimum_amount,
                'msisdn' => 'required|string'
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return response()->json([
                    'reference' => $data['reference'],
                    'resultcode' => $this->getErrorCode($validator->errors())['code'],
                    'result' => 'FAILED',
                    'message' => $this->getErrorCode($validator->errors())['message']
                ], 400);
            }
            $validated = $validator->validated();
            $customer = Customer::where('ref', $validated['utilityref'])->first();

            return response()->json([
                'reference' => $data['reference'],
                'resultcode' => '000',
                'result' => 'SUCCESS',
                'message' => 'Success',
                'name' => $customer ? $customer->full_name : 'SKT Tanzania Ltd'
            ]);

        } catch (\Exception $e) {
            Log::error(__FUNCTION__, ['exception' => $e->getMessage()]);
            return response()->json([
                'reference' => $data['reference'],
                'resultcode' => 400,
                'result' => 'FAILED',
                'message' => 'Validation failed'
            ], 400);
        }
    }

    public function getErrorCode($errors): array
    {
        Log::error(__FUNCTION__ . ' validation error', ['errors' => json_encode($errors)]);

        if ($errors->has('utilityref')) {
            return [
                'code' => '010',
                'message' => 'Invalid account or payment reference'
            ];
        }
        if ($errors->has('amount')) {
            return [
                'code' => '012',
                'message' => 'Invalid amount'
            ];
        }
        return [
            'code' => '400',
            'message' => 'Validation failed'
        ];
    }

    public function merchantPayment(Request $request)
    {
        info('Selcom Merchant Payment Received', $request->all());

        $data = [
            'operator' => $request['operator'],
            'transid' => $request['transid'],
            'reference' => $request['reference'],
            'utilityref' => $request['utilityref'],
            'amount' => (float) $request['amount'],
            'msisdn' => $request['msisdn'],
        ];
        $setting = Setting::get('MINIMUM_PAYMENT_AMOUNT');
        $minimum_amount = (float) $setting;

        try {
            $rules = [
                'operator' => 'required|string',
                'transid' => 'required|string',
                'reference' => 'required|string',
                'utilityref' => 'required|string',
                'amount' => 'required|decimal:0,4|gte:' . $minimum_amount,
                'msisdn' => 'required|string'
            ];

            $validator = Validator::make($data, $rules);


            if ($validator->fails()) {
                return response()->json([
                    'reference' => $data['reference'],
                    'resultcode' => $this->getErrorCode($validator->errors())['code'],
                    'result' => 'FAILED',
                    'message' => $this->getErrorCode($validator->errors())['message']
                ], 400);
            }
            $validated = $validator->validated();
            $validated['status'] = 'Received';

            $customer = Customer::where('ref', $this->createFullReference($validated['utilityref']))->first();

            if ($customer) {
                $customer->selcomMerchantPayments()->create($validated);
            } else {
                OtherPayment::create($validated);
            }

            return response()->json([
                'reference' => $data['reference'],
                'resultcode' => '000',
                'result' => 'SUCCESS',
                'message' => 'Success'
            ]);

        } catch (\Exception $e) {
            Log::error(__FUNCTION__, ['exception' => $e->getMessage()]);
            return response()->json([
                'reference' => $data['reference'],
                'resultcode' => 400,
                'result' => 'FAILED',
                'message' => 'Validation failed'
            ], 400);
        }
    }
}
