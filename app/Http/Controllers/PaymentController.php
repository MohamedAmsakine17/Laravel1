<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use AmrShawky\LaravelCurrency\Facade\Currency;


class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        $amountConverted = Currency::convert()->from('MAD')->to('USD')->amount($request->amount)->get();
        $amount = number_format((float) $amountConverted, 2, '.', ' ');
        try {
            $response = $this->gateway->purchase(
                array(
                    'amount' => $amount,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('success'),
                    'cancelUrl' => url('cancel'),
                )
            )->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {

        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(
                array(
                    'payer_id' => $request->input('PayerID'),
                    'transactionReference' => $request->input('paymentId')
                )
            );
            $response = $transaction->send();
            if ($response->isSuccessful()) {
                $arr = $response->getData();

                Payment::create([
                    'payment_id' => $arr['id'],
                    'payer_id' => $arr['payer']['payer_info']['payer_id'],
                    'payer_email' => $arr['payer']['payer_info']['email'],
                    'amount' => $arr['transactions'][0]['amount']['total'],
                    'currency' => env('PAYPAL_CURRENCY'),
                    'payment_status' => $arr['state'],
                ]);

                $user = Auth::user();
                foreach ($user->carts as $cart) {
                    $user->assets()->create([
                        'article_id' => $cart->article->id,
                        'category' => $cart->article->category,
                        'price' => $cart->article->price
                    ]);
                    $cart->delete();
                }

                return redirect(route('assets'));
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Payment declined!!';
        }
    }

    public function cancel()
    {
        return 'Paiment Canceled';
    }
}