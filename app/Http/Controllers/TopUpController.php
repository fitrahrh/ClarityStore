<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;

class TopUpController extends Controller
{
    public function showForm()
    {
        return view('topup.form');
    }

    public function processTopUp(Request $request)
    {
        $merchantCode = 'T0001';
        $merchantRef = 'INV' . rand(1000, 9999);
        $amount = $request->amount; // Mengambil jumlah top-up dari form
        $privateKey = 'xaevY-KvGJD-jx1NF-AXDgC-ZZUy1';

        // Membuat signature
        $signature = hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey);

        // Menyimpan transaksi di database
        $transaction = Transaction::create([
            'merchant_ref' => $merchantRef,
            'user_name' => $request->username,
            'amount' => $amount,
            'status' => 'UNPAID',
        ]);

        // Request ke API TriPay untuk membuat transaksi
        $response = Http::withHeaders([
            'Authorization' => 'Bearer api_key_anda',
        ])->post('https://tripay.co.id/api-sandbox/transaction/create', [
            'method' => 'BRIVA',
            'merchant_ref' => $merchantRef,
            'amount' => $amount,
            'customer_name' => $request->username,
            'order_items' => [
                [
                    'sku' => 'MC01',
                    'name' => 'Minecraft Credit',
                    'price' => $amount,
                    'quantity' => 1,
                    'product_url' => 'https://tokokamu.com/product/minecraft-credit',
                    'image_url' => 'https://tokokamu.com/product/minecraft-credit.jpg',
                ]
            ],
            'return_url' => 'https://domainanda.com/return',
            'expired_time' => time() + (24 * 60 * 60), // 24 jam
            'signature' => $signature,
        ]);

        // Cek apakah transaksi berhasil dibuat
        $data = $response->json();

        if ($data['success']) {
            return redirect($data['data']['checkout_url']);
        } else {
            return back()->with('error', 'Gagal membuat transaksi');
        }
    }

    public function status(Request $request)
    {
        $transaction = Transaction::where('merchant_ref', $request->merchant_ref)->first();

        if ($transaction) {
            return view('topup.status', compact('transaction'));
        } else {
            return redirect('/')->with('error', 'Transaksi tidak ditemukan');
        }
    }
}

