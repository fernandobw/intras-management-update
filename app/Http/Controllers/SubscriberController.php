<?php

namespace App\Http\Controllers;

use Validator;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function subscribe(Request $request){

    	$rules = [
    		'email' => 'required|email|unique:vdyvi_acymailing_subscriber',
    	];

    	$messages = [
    		'required' => 'Debe ingresar un correo electrónico',
    		'email' => 'Ingrese un correo electrónico válido',
    		'unique' => 'Ya está suscrito',
    	];

    	$validator = Validator::make($request->all(),$rules,$messages);

    	if($validator->fails()){
    		return response()->json(['errors' => $validator->errors()]);
    	}

    	$subscriber = new Subscriber;

    	$subscriber->email = $request->input('email');

    	$subscriber->save();

    	return response()->json(['success' => 'Se ha suscrito correctamente']);
    	
    }
}
