<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

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
            // Convert XML to an array
            $xml = new SimpleXMLElement($xmlContent);
            $data = json_decode(json_encode($xml), true); // Convert to an associative array

            // Log or process the data
            // $customer_phone = $data['CUSTOMERMSISDN'];
            Log::info('Received Data:', $data);

            /**
             * Validate against the backend
             */

            // Build XML response
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '200');
            $responseXml->addChild('MESSAGE', 'Success');

            return response($responseXml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid XML format'], 400);
        }
    }
    public function process(Request $request)
    {
        $xmlContent = $request->getContent();
        try {
            // Convert XML to an array
            $xml = new SimpleXMLElement($xmlContent);
            $data = json_decode(json_encode($xml), true); // Convert to an associative array

            // Log or process the data
            // $customer_phone = $data['CUSTOMERMSISDN'];
            Log::info('Received Data:', $data);

            /**
             * Process in the backend
             */

            // Build XML response
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '200');
            $responseXml->addChild('TXNID', 'BillerTxnId00001');
            $responseXml->addChild('MESSAGE', 'Success');

            return response($responseXml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid XML format'], 400);
        }
    }
    public function enquiry(Request $request)
    {

        $xmlContent = $request->getContent();
        try {
            // Convert XML to an array
            $xml = new SimpleXMLElement($xmlContent);
            $data = json_decode(json_encode($xml), true); // Convert to an associative array

            // Log or process the data
            // $customer_phone = $data['CUSTOMERMSISDN'];
            Log::info('Received Data:', $data);

            /**
             * Check in the backend
             * 200 for a successful transaction
             * 400 for a failed transaction or bad request
             * 404 if transaction doesn't exist
             */

            // Build XML response
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '200');
            $responseXml->addChild('MESSAGE', 'Success');
            $responseXml->addChild('REF', 'BillerTxnId00001');

            return response($responseXml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid XML format'], 400);
        }
    }
    public function fetchBill(Request $request)
    {
        $xmlContent = $request->getContent();
        try {
            // Convert XML to an array
            $xml = new SimpleXMLElement($xmlContent);
            $data = json_decode(json_encode($xml), true); // Convert to an associative array

            // Log or process the data
            // $customer_phone = $data['CUSTOMERMSISDN'];
            Log::info('Received Data:', $data);

            /**
             * Check in the backend
             * 200 if bill exists
             * 404 otherwise
             */

            // Build XML response
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '200');
            $responseXml->addChild('FIRSTNAME', 'Bryson');
            $responseXml->addChild('LASTNAME', 'Mahuvi');
            $responseXml->addChild('DUEDATE', '2024-02-20');
            $responseXml->addChild('AMOUNT', 10000);
            $responseXml->addChild('CURRENCY', 'TZS');
            $responseXml->addChild('MESSAGE', 'Bill for gas');

            return response($responseXml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('XML Parsing Error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid XML format'], 400);
        }
    }
}
