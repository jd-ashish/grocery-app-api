<?php


if (! function_exists('rzp_get_payments')) {
    function rzp_get_payments($key) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.razorpay.com/v1/payments/'.$key,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Basic cnpwX3Rlc3RfUVQ3ako2M0k1dFFEcU06WHNkaml5VnB6RkRHQkpBM05BUlZodDlh'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}

if (! function_exists('rzp_norman_refund')) {
    function rzp_norman_refund($pay_id,$amt) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.razorpay.com/v1/payments/'.$pay_id.'/refund',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "amount": $amt
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.env('RZP_AUTH'),
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
}

// CURLOPT_POSTFIELDS =>'{
//     "refund_amount": '',
//     "refund_id": "'.$refund_id.'",
//     "refund_note": "'.$refund_note.'",
// }',

if (! function_exists('cashFree_refund_order')) {
    function cashFree_refund_order($order_id,$refund_amount,$refund_id,$refund_note) {
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://sandbox.cashfree.com/pg/orders/".$order_id."/refunds",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"refund_amount\":".$refund_amount.",\"refund_note\":\"refund note for reference\",\"".$refund_note."\":\"".$refund_id."\"}",

        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "x-api-version: 2021-05-21",
            "x-client-id: ".env("APP_ID"),
            "x-client-secret: ".env("SecretKey")
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return  $response;
    }
}

