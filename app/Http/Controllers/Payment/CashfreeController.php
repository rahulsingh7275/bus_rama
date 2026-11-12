<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\CashfreePayment;
use App\Models\Payment;
use App\Models\RazorpayPayment;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CashfreeController extends Controller
{
    
    public function store(Request $request,$id)
     {
          $validated = $request->validate([
            'mode' => 'required',
            'key_id' => 'required',
            'key_secret' => 'required',
            'name' => 'required|min:3',
            'email' => 'required',
            'mobile' => 'required',
            'amount' => 'required'
          ]);
               
          $appId = $request->key_id;
          $secretKey = $request->key_secret;
          $url = $request->mode === 'test' ? 'https://sandbox.cashfree.com/pg/orders' : 'https://api.cashfree.com/pg/orders';

          $headers = array(
               "Content-Type: application/json",
               "x-api-version: 2022-01-01",
               "x-client-id: ".$appId,
               "x-client-secret: ".$secretKey
          );

          $data_not_json = [
               'order_id' =>  'order_'.rand(1111111111,9999999999),
               'order_amount' => $validated['amount'],
               "order_currency" => "INR",
               "customer_details" => [
                    "customer_id" => 'customer_'.rand(111111111,999999999),
                    "customer_name" => $validated['name'],
                    "customer_email" => $validated['email'],
                    "customer_phone" => $validated['mobile'],
               ],
               "order_meta" => [
                    "return_url" => url('cashfree/payments/success').'/'.$id.'/?mode='.$request->mode.'&order_id={order_id}&order_token={order_token}'
               ]
          ];
          $data = json_encode($data_not_json);

          $curl = curl_init($url);

          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

          $resp = curl_exec($curl);
//          dd($resp);
          $json_data = json_decode($resp);
          if(!isset($json_data->payment_link)){
            return back()->with('error',$json_data->message);
          }

          curl_close($curl);

          return redirect()->to($json_data->payment_link);
     }

     public function success(Request $request)
     {
        // dd($request->all());
        $orderId = $request->order_id;
        $orderStatusResponse = $this->fetchOrderStatus($orderId,$request->mode);
        $orderStatus = json_decode($orderStatusResponse->getContent());
        if ($orderStatus->order_status == 'PAID') {
            $ticket = Ticket::find($request->id);
            if($ticket){
                $paymentRecord = Payment::create([
                    'gateway' => 'cashfree',
                    'gateway_mode' => $request->mode,
                    'ticket_id' => $request->id,
                    'order_id' => $request->order_id,
                    'contact' => $request->mobile,
                    'payment_id' => $request->order_token,
                    'amount' => $ticket->fare,
                    'receipt' => $request->order_token ?? null,
                    'status' => 'success',
                    'response' => json_encode($ticket), // Store full payment response as JSON
                ]);
                $ticket->payment_id = $paymentRecord->id;
                $ticket->save();
                return redirect('payment-process/'.$request->id)->with('success','Payment is successfully done.');
            }else{
                return redirect('payment-process/'.$request->id)->with('error','Payment failed.');
            }
        }else{
            return redirect('payment-process/'.$request->id)->with('error','Payment failed.');
        }
     }

    public function fetchOrderStatus($orderId,$mode)
    {
        $paymentSetting = \App\Models\PaymentSetting::where('gateway', 'cashfree')
            ->where('mode', $mode)
            ->first();
            
        $appId = $paymentSetting->key_id;
        $secretKey = $paymentSetting->key_secret;
        $url = $paymentSetting->mode === 'test' 
            ? "https://sandbox.cashfree.com/pg/orders/$orderId" 
            : "https://api.cashfree.com/pg/orders/$orderId";

        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . $appId,
            "x-client-secret: " . $secretKey
        ];

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        curl_close($curl);

        $jsonData = json_decode($response);

        if (!$jsonData || isset($jsonData->error)) {
            return response()->json(['error' => $jsonData->message ?? 'Unable to fetch order status.'], 500);
        }

        return response()->json($jsonData);
    }


}
