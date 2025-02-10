<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SimpleXMLElement;
use Illuminate\Support\Str;

class Airtel extends Controller
{
    public function callback(Request $request)
    {
        Log::info(json_encode($request->all()));

        return response()->json([
            'status' => 'Success',
            'message' => 'Callback received successfully'
        ]);
    }
    public function validate(Request $request)
    {
        $xmlContent = $request->getContent();
        try {
            $xml = new SimpleXMLElement($xmlContent);
            $data = json_decode(json_encode($xml), true);

            Log::info('Received Data:', $data);

            $rules = [
                'TYPE' => 'required|uppercase|in:C2B',
                'CUSTOMERMSISDN' => 'required|string|starts_with:255|size:12',
                'MERCHANTMSISDN' => 'required|string',
                'AMOUNT' => 'required|decimal:0,4|min:1',
                'REFERENCE1' => 'required|string',
                'REFERENCE' => 'nullable|exists:customers,ref',
                'CUSTOMERNAME' => 'nullable',
                'USERNAME' => 'nullable',
                'PASSWORD' => 'nullable',
                'PIN' => 'nullable',
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                Log::error(json_encode($validator->errors()));

                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '400');
                $responseXml->addChild('MESSAGE', 'Validation failed');

                return response($responseXml->asXML(), 400)
                    ->header('Content-Type', 'application/xml');
            }

            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '200');
            $responseXml->addChild('MESSAGE', 'Success');

            return response($responseXml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());

            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'System error occured');

            return response($responseXml->asXML(), 400)
                ->header('Content-Type', 'application/xml');
        }
    }
    public function process(Request $request)
    {
        $xmlContent = $request->getContent();
        try {
            $xml = new SimpleXMLElement($xmlContent);
            $data = json_decode(json_encode($xml), true);

            $rules = [
                'TYPE' => 'required|uppercase|in:C2B',
                'CUSTOMERMSISDN' => 'required|string|starts_with:255|size:12',
                'MERCHANTMSISDN' => 'required|string',
                'AMOUNT' => 'required|decimal:0,4|min:1',
                'REFERENCE1' => 'required|string|unique:payments,external_id',
                'REFERENCE' => 'nullable|exists:customers,ref',
                'REFERENCE2' => 'nullable',
                'CUSTOMERNAME' => 'nullable',
                'USERNAME' => 'nullable',
                'PASSWORD' => 'nullable',
                'PIN' => 'nullable',
            ];

            $validator = Validator::make($data, $rules);
            $txn_id = (string) Str::uuid();

            if ($validator->fails()) {
                Log::error(json_encode($validator->errors()));

                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '400');
                $responseXml->addChild('MESSAGE', 'Validation failed');
                $responseXml->addChild('REF', $txn_id);

                return response($responseXml->asXML(), 400)
                    ->header('Content-Type', 'application/xml');
            }

            $validated = $validator->validated();

            $customer = empty($validated['REFERENCE']) ? null : Customer::where('ref', $validated['REFERENCE'])->first();

            $payment = Payment::create([
                'customer_id' => $customer == null ? null : $customer->id,
                'msisdn' => $validated['CUSTOMERMSISDN'],
                'reference' => empty($validated['REFERENCE']) ? null : $validated['REFERENCE'],
                'payer_name' => empty($validated['CUSTOMERNAME']) ? null : $validated['CUSTOMERNAME'],
                'amount' => $validated['AMOUNT'],
                'internal_txn_id' => $txn_id,
                'merchant' => $validated['MERCHANTMSISDN'],
                'external_id' => $validated['REFERENCE1'],
                'external_reference' => empty($validated['REFERENCE2']) ? null : $validated['REFERENCE2']
            ]);

            if ($payment) {
                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '200');
                $responseXml->addChild('TXNID', $payment->internal_txn_id);
                $responseXml->addChild('MESSAGE', 'Transaction received successfully');

                return response($responseXml->asXML(), 200)
                    ->header('Content-Type', 'application/xml');
            }
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'System error occured');

            return response($responseXml->asXML(), 400)
                ->header('Content-Type', 'application/xml');
        }
    }
    public function enquiry(Request $request)
    {
        $xmlContent = $request->getContent();
        try {
            $xml = new SimpleXMLElement($xmlContent);
            $data = json_decode(json_encode($xml), true);

            $rules = [
                'TXNID' => 'required|string',
                'MSISDN' => 'required|string'
            ];

            $validator = Validator::make($data, $rules);
            $txn_id = (string) Str::uuid();

            if ($validator->fails()) {
                Log::error(json_encode($validator->errors()));

                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '400');
                $responseXml->addChild('MESSAGE', 'Validation failed');
                $responseXml->addChild('REF', $txn_id);

                return response($responseXml->asXML(), 400)
                    ->header('Content-Type', 'application/xml');
            }

            $validated = $validator->validated();

            $payment = Payment::where(['external_id' => $validated['TXNID'], 'msisdn' => $validated['MSISDN']])->first();
            if ($payment) {
                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '200');
                $responseXml->addChild('MESSAGE', 'Transaction was successfull');
                $responseXml->addChild('REF', $payment->internal_txn_id);

                return response($responseXml->asXML(), 200)
                    ->header('Content-Type', 'application/xml');
            }
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '404');
            $responseXml->addChild('MESSAGE', 'Transaction not found');
            $responseXml->addChild('REF', $txn_id);

            return response($responseXml->asXML(), 404)
                ->header('Content-Type', 'application/xml');

            return response($responseXml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'System error occured');

            return response($responseXml->asXML(), 400)
                ->header('Content-Type', 'application/xml');
        }
    }
    public function fetchBill(Request $request)
    {
        $xmlContent = $request->getContent();
        try {
            $xml = new SimpleXMLElement($xmlContent);
            $data = json_decode(json_encode($xml), true);

            $rules = [
                'TYPE' => 'required|uppercase|in:BILLFETCH',
                'CUSTOMERMSISDN' => 'required|string',
                'CUSTOMERREF' => 'nullable',
                'USERNAME' => 'nullable',
                'PASSWORD' => 'nullable',
                'PIN' => 'nullable',
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '404');
                $responseXml->addChild('MESSAGE', 'Validation failed');

                return response($responseXml->asXML(), 404)
                    ->header('Content-Type', 'application/xml');
            }

            $validated = $validator->validated();

            $customer = Customer::where('ref', $validated['CUSTOMERREF'])->first();
            if ($customer) {
                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '200');
                $responseXml->addChild('FIRSTNAME', $customer->first_name);
                $responseXml->addChild('LASTNAME', $customer->last_name);
                $responseXml->addChild('DUEDATE', Carbon::tomorrow()->addDays(10)->format('Y-m-d'));
                $responseXml->addChild('AMOUNT', 10000);
                $responseXml->addChild('CURRENCY', 'TZS');
                $responseXml->addChild('MESSAGE', 'Bill for gas');

                return response($responseXml->asXML(), 200)
                    ->header('Content-Type', 'application/xml');
            }
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '404');
            $responseXml->addChild('MESSAGE', 'Customer not found');

            return response($responseXml->asXML(), 404)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'System error occured');

            return response($responseXml->asXML(), 400)
                ->header('Content-Type', 'application/xml');
        }
    }
}
