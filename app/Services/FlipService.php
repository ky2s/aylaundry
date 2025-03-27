<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlipService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('flip.base_url');
        $this->apiKey = config('flip.api_key');
    }

    public function createVirtualAccount($customer)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/v2/payouts", [
            'bank_code' => 'bca',
            'account_number' => $customer->phone, // Bisa pakai nomor HP sebagai nomor unik
            'amount' => 10000, // Nominal contoh
            'recipient_name' => $customer->name,
            'email' => $customer->email,
        ]);

        return $response->json();
    }

    public function transferToBank($bankCode, $accountNumber, $amount, $recipientName)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/v2/payouts", [
            'bank_code' => $bankCode,
            'account_number' => $accountNumber,
            'amount' => $amount,
            'recipient_name' => $recipientName,
        ]);

        return $response->json();
    }
}