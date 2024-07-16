<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bayar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BayarProsesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $bayar = Bayar::create([
            'invoice_number' => 'INV-' . uniqid(),
            'amount' => $request->amount,
            'status' => 'Created',
        ]);

        $resp = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ])->withBasicAuth('Mid-server-HvXUOTVIAKwubiwNalZ3H_CI', '')
        ->post('https://api.sandbox.midtrans.com/v2/charge', [
                'payment_type' => 'gopay',
                'transaction_details' => [
                'order_id' => $bayar->id,
                'gross_amount' => $bayar->amount
            ]
        ]);

        if ($resp->successful()) {
            $actions = $resp->json('actions');

            if (empty($actions)) {
                return response()->json(['message' => $resp['status_message']], 500);
            }

            $actionMap = [];

            foreach ($actions as $action) {
                $actionMap[$action['name']] = $action['url'];
            }

            return response()->json(['qr' => $actionMap['generate-qr-code']]);
        }

        return response()->json(['message' => $resp->body()], 500);
    }
}
