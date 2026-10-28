<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Mail;
use App\Mail\MailSuscription;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'name' => 'nullable|string|max:100',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'El captcha es obligatorio.',
            'g-recaptcha-response.captcha' => 'El captcha no es válido.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $email = $request->get('email');

        Mail::to('llandry.soto@gestion.com.do')->send(new MailSuscription($request->firstname, $request->lastname, $request->email, $request->company));

        // return response()->json($request->all());
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://restapi.fromdoppler.com/accounts/info@contactointras.com/lists/27335728/subscribers/import",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"fields\": [],\r\n  \"items\": [ \r\n    { \"email\": \"$email\" }\r\n  ],\r\n  \"callback\": \"http://my.own.server.com/my/own/resource\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer C5F350B5BD945D564DD042020479A6CB",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json(['error' => 'No se pudo suscribir porque ocurrió un error, por favor, intente de nuevo.'], 500);
        } else {
            return response()->json(['status' => 'ok'], 201);
        }
    }
}
