<?php

namespace App\Http\Controllers;

use App\Models\IncomingRequest;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PushRequest;
use App\Models\Setting;
use App\Traits\GeneralHelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SimpleXMLElement;
use Illuminate\Support\Str;

class Airtel extends Controller
{
    use GeneralHelperTrait;

    public function callback(Request $request)
    {
        $data = $request->all();

        if ($data['transaction']) {
            if ($data['transaction']['id']) {
                $pushRequest =  PushRequest::findOrFail($data['transaction']['id']);

                if ($pushRequest) {
                    $pushRequest->update([
                        'status' => $data['transaction']['status_code'] === 'TS' ? 'Success' : 'Failed',
                        'mno_txn_id' => $data['transaction']['airtel_money_id'],
                        'mno_result_code' => $data['transaction']['code'] ?? $pushRequest->mno_result_code,
                        'mno_message' => $data['transaction']['message']
                    ]);
                }
            }
        }
    }
    public function generateResponse($xml)
    {
        $xmlString = $xml->asXML();
        $xmlStringWithoutDeclaration = preg_replace('/<\?xml.*?\?>\n?/', '', $xmlString);

        return $xmlStringWithoutDeclaration;
    }
    public function validate(Request $request)
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
                'REFERENCE1' => 'required|string',
                'REFERENCE' => 'nullable|exists:customers,ref',
                'CUSTOMERNAME' => 'nullable',
                'USERNAME' => 'nullable',
                'PASSWORD' => 'nullable',
                'PIN' => 'nullable',
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                $req =  IncomingRequest::create([
                    'type' => $data['TYPE'],
                    'request' => 'Validate',
                    'channel' => 'Airtel',
                    'customer_msisdn' => $data['CUSTOMERMSISDN'],
                    'merchant_msisdn' => $data['MERCHANTMSISDN'],
                    'amount' => $data['AMOUNT'],
                    'user_name' => empty($data['USERNAME']) ? null : $data['USERNAME'],
                    'password' => empty($data['PASSWORD']) ? null : $data['PASSWORD'],
                    'pin' => empty($data['PIN']) ? null : $data['PIN'],
                    'customer_name' => empty($data['CUSTOMERNAME']) ? null : $data['CUSTOMERNAME'],
                    'reference' => empty($data['REFERENCE']) ? null : $data['REFERENCE'],
                    'reference_1' => $data['REFERENCE1'],
                    'error_details' => json_encode($validator->errors()),
                ]);
                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '400');
                $responseXml->addChild('MESSAGE', 'Validation failed');

                return response($this->generateResponse($responseXml), 400)
                    ->header('Content-Type', 'application/xml')
                    ->header('Authorization', $this->getAuthToken($req->id));
            }

            $validated = $validator->validated();

            IncomingRequest::create([
                'type' => $validated['TYPE'],
                'request' => 'Validate',
                'channel' => 'Airtel',
                'customer_msisdn' => $validated['CUSTOMERMSISDN'],
                'merchant_msisdn' => $validated['MERCHANTMSISDN'],
                'amount' => $validated['AMOUNT'],
                'user_name' => empty($validated['USERNAME']) ? null : $validated['USERNAME'],
                'password' => empty($validated['PASSWORD']) ? null : $validated['PASSWORD'],
                'pin' => empty($validated['PIN']) ? null : $validated['PIN'],
                'customer_name' => empty($validated['CUSTOMERNAME']) ? null : $validated['CUSTOMERNAME'],
                'reference' => empty($validated['REFERENCE']) ? null : $validated['REFERENCE'],
                'reference_1' => $validated['REFERENCE1'],
                'status' => 'Success',
                'error_message' => null
            ]);

            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '200');
            $responseXml->addChild('MESSAGE', 'Success');

            return response($this->generateResponse($responseXml), 200)
                ->header('Content-Type', 'application/xml')
                ->header('Authorization', $this->getAuthToken($data['REFERENCE1']));
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());

            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'System error occured');

            return response($this->generateResponse($responseXml), 400)
                ->header('Content-Type', 'application/xml')
                ->header('Authorization', $this->getAuthToken((string) Str::uuid()));
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

            if ($validator->fails()) {
                $req = IncomingRequest::create([
                    'type' => $data['TYPE'],
                    'channel' => 'Airtel',
                    'request' => 'Process',
                    'customer_msisdn' => $data['CUSTOMERMSISDN'],
                    'merchant_msisdn' => $data['MERCHANTMSISDN'],
                    'amount' => $data['AMOUNT'],
                    'user_name' => empty($data['USERNAME']) ? null : $data['USERNAME'],
                    'password' => empty($data['PASSWORD']) ? null : $data['PASSWORD'],
                    'pin' => empty($data['PIN']) ? null : $data['PIN'],
                    'customer_name' => empty($data['CUSTOMERNAME']) ? null : $data['CUSTOMERNAME'],
                    'reference' => empty($data['REFERENCE']) ? null : $data['REFERENCE'],
                    'reference_1' => $data['REFERENCE1'],
                    'reference_2' => empty($data['REFERENCE2']) ? null : $data['REFERENCE2'],
                    'error_details' => json_encode($validator->errors()),
                ]);


                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '400');
                $responseXml->addChild('TXNID', $req->id);
                $responseXml->addChild('MESSAGE', 'Validation failed');

                return response($this->generateResponse($responseXml), 400)
                    ->header('Content-Type', 'application/xml')
                    ->header('Authorization', $this->getAuthToken($req->id));
            }

            $validated = $validator->validated();

            $req = IncomingRequest::create([
                'type' => $validated['TYPE'],
                'request' => 'Process',
                'channel' => 'Airtel',
                'customer_msisdn' => $validated['CUSTOMERMSISDN'],
                'merchant_msisdn' => $validated['MERCHANTMSISDN'],
                'amount' => $validated['AMOUNT'],
                'user_name' => empty($validated['USERNAME']) ? null : $validated['USERNAME'],
                'password' => empty($validated['PASSWORD']) ? null : $validated['PASSWORD'],
                'pin' => empty($validated['PIN']) ? null : $validated['PIN'],
                'customer_name' => empty($validated['CUSTOMERNAME']) ? null : $validated['CUSTOMERNAME'],
                'reference' => empty($validated['REFERENCE']) ? null : $validated['REFERENCE'],
                'reference_1' => $validated['REFERENCE1'],
                'reference_2' => empty($validated['REFERENCE2']) ? null : $validated['REFERENCE2'],
                'status' => 'Success',
                'error_message' => null
            ]);

            $customer = empty($validated['REFERENCE']) ?
                null : Customer::where('ref', $validated['REFERENCE'])->first();

            $payment = Payment::create([
                'customer_id' => $customer == null ? null : $customer->id,
                'amount' => $validated['AMOUNT'],
                'channel' => 'Airtel',
                'internal_txn_id' => $req->id,
                'msisdn' => $validated['CUSTOMERMSISDN'],
                'external_id' => $validated['REFERENCE1'],
                'channel' => 'Airtel'
            ]);

            if ($payment) {
                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '200');
                $responseXml->addChild('TXNID', $payment->internal_txn_id);
                $responseXml->addChild('MESSAGE', 'Transaction received successfully');

                return response($this->generateResponse($responseXml), 200)
                    ->header('Content-Type', 'application/xml')
                    ->header('Authorization', $this->getAuthToken($payment->internal_txn_id));
            }
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('TXNID', $req->id);
            $responseXml->addChild('MESSAGE', 'System error occured');

            return response($this->generateResponse($responseXml), 400)
                ->header('Content-Type', 'application/xml')
                ->header('Authorization', $this->getAuthToken((string) Str::uuid()));
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

            if ($validator->fails()) {
                $req =  IncomingRequest::create([
                    'type' => 'C2B',
                    'request' => 'Enquiry',
                    'channel' => 'Airtel',
                    'customer_msisdn' => $data['MSISDN'],
                    'enquiry_txn_id' => $data['TXNID'],
                    'error_details' => json_encode($validator->errors()),
                ]);

                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '400');
                $responseXml->addChild('MESSAGE', 'Validation failed');
                $responseXml->addChild('REF', $req->id);

                return response($this->generateResponse($responseXml), 400)
                    ->header('Content-Type', 'application/xml')
                    ->header('Authorization', $this->getAuthToken($req->id));
            }

            $validated = $validator->validated();

            $payment = Payment::where(['external_id' => $validated['TXNID']])->first();
            if ($payment) {
                $req = IncomingRequest::create([
                    'type' => 'C2B',
                    'channel' => 'Airtel',
                    'request' => 'Enquiry',
                    'customer_msisdn' => $validated['MSISDN'],
                    'enquiry_txn_id' => $validated['TXNID'],
                    'status' => 'Success',
                    'error_message' => null
                ]);
                $responseXml = new SimpleXMLElement('<COMMAND/>');
                $responseXml->addChild('STATUS', '200');
                $responseXml->addChild('MESSAGE', 'Transaction was successfull');
                $responseXml->addChild('REF', $payment->internal_txn_id);

                return response($this->generateResponse($responseXml), 200)
                    ->header('Content-Type', 'application/xml')
                    ->header('Authorization', $this->getAuthToken($payment->internal_txn_id));
            }
            $req = IncomingRequest::create([
                'type' => 'C2B',
                'request' => 'Enquiry',
                'channel' => 'Airtel',
                'customer_msisdn' => $validated['MSISDN'],
                'enquiry_txn_id' => $validated['TXNID'],
                'status' => 'Not Found',
                'error_message' => null
            ]);
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '404');
            $responseXml->addChild('MESSAGE', 'Transaction not found');
            $responseXml->addChild('REF', $req->id);

            return response($this->generateResponse($responseXml), 404)
                ->header('Content-Type', 'application/xml')
                ->header('Authorization', $this->getAuthToken($req->id));
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'System error occured' . $e->getMessage());
            $responseXml->addChild('REF', (string) Str::uuid());

            return response($this->generateResponse($responseXml), 400)
                ->header('Content-Type', 'application/xml')
                ->header('Authorization', $this->getAuthToken((string) Str::uuid()));
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

                return response($this->generateResponse($responseXml), 404)
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

                return response($this->generateResponse($responseXml), 200)
                    ->header('Content-Type', 'application/xml');
            }
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '404');
            $responseXml->addChild('MESSAGE', 'Customer not found');

            return response($this->generateResponse($responseXml), 404)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'System error occured');

            return response($this->generateResponse($responseXml), 400)
                ->header('Content-Type', 'application/xml');
        }
    }
    public function getAuthToken(string $uniqueId)
    {
        $key = Setting::where('key', 'JWT_AIRTEL_SECRET')->first()->value;
        $sec = Setting::where('key', 'JWT_AIRTEL_EXPIRY_SECONDS')->first()->value;
        $iss = Setting::where('key', 'JWT_AIRTEL_SUB')->first()->value;
        return $this->generateJWTToken(
            uniqueId: $uniqueId,
            key: $key,
            jwtExpiryInSeconds: $sec,
            sub: $iss,
            iss: $iss
        );
    }

    public function validateJWT(Request $request)
    {
        $key = Setting::where('key', 'JWT_AIRTEL_SECRET')->first()->value;
        return $this->decodeJWTToken(
            token: $request->header('Authorization'),
            key: $key,
        );
    }
    public function genNew()
    {
        $key = Setting::where('key', 'JWT_AIRTEL_SECRET')->first()->value;
        $sec = Setting::where('key', 'JWT_AIRTEL_EXPIRY_SECONDS')->first()->value;
        $iss = Setting::where('key', 'JWT_AIRTEL_SUB')->first()->value;
        return json_encode([
            'token' => $this->generateJWTToken(
                uniqueId: Str::ulid(),
                key: $key,
                jwtExpiryInSeconds: (int) $sec,
                iss: $iss,
                sub: $iss,
            )
        ]);
    }
}
