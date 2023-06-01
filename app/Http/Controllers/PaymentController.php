<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\Product;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function payment(Request $request)
    {
        $dataUser = DataUser::where('user_id', auth()->user()->id)->first();
        if ($request->quantity <= "0" || $request->quantity === null) {
            return redirect()->back()->with('error', 'Jumlah Pesanan Pada ' . $request->name_product . ' Tidak Valid');
        } else if ($dataUser->username === null) {
            return redirect()->route('dashboard.profile')->with('error', 'Lengkapi Profil Terlebih Dahulu Sebelum Membeli');
        } else {
            $user = DB::table('data_users')
                ->join('users', 'users.id', '=', 'data_users.user_id')
                ->where('users.id', auth()->user()->id)
                ->select('data_users.*', 'users.name', 'users.email')
                ->first();
            $product = Product::where('id', $request->id_product)->first();
            $list = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => ((int)$product->price * (int)$request->quantity) * 1000,
                'quantity' => $request->quantity,
            ];
            return view('dashboard.payment', ['user' => $user, 'list' => $list]);
        }
    }

    public function handlePayment(Request $request)
    {
        DB::transaction(function () use ($request) {
            $orderId = 'SANBOX-' . uniqid() . Carbon::now() . '-BangBeli';
            $payload = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => intval($request->product_price),
                ],
                'customer_details' => [
                    'first_name' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->telephone,
                    'address' => $request->address,
                ]
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);

            Payment::insert([
                'order_id' => $orderId,
                'user_id' => $request->user_id,
                'product_name' => $request->product_name,
                'price' => $request->product_price,
                'quantity' => $request->product_quantity,
                'snap_token' => $snapToken,
                'created_at' => Carbon::now(),
            ]);

            $this->response["snap_token"] = $snapToken;
        });
        return response()->json($this->response);
    }

    public function handleNotification()
    {
        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        $historyPayment = Payment::where("order_id", $order_id)->first();

        if ($transaction == "capture") {
            if ($type == "credit_card") {
                if ($fraud == "chalenge") {
                    $historyPayment->status = "pending";
                } else {
                    $historyPayment->status = "success";
                }
            }
        } else if ($transaction == "settlement") {
            $historyPayment->status = "success";
        } else if ($transaction == "pending" || $transaction == "deny") {
            $historyPayment->status = "pending";
        } else if ($transaction == "cancel") {
            $historyPayment->status = "canceled";
        } else {
            $historyPayment->status = "expired";
        }
        $historyPayment->save();
    }

    public function handleStock(Request $request)
    {
        $product = Product::where("id", $request->product_id)->first();
        $product->stock -= $request->product_quantity;
        $product->sold += $request->product_quantity;
        $product->save();
    }
}
