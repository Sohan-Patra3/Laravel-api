<?php

namespace App\Http\Controllers;

use App\Mail\Welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(){
        $toEmail = 'nareshbscct107@gmail.com';
        $message = 'Hello , welcome to our website';
        $subject = 'Welcome to web Dev';
        $details = [
            'name'=>'john doe',
            'product'=>'test product',
            'price'=>'500'
        ];

       $request= Mail::to($toEmail)->send(new Welcomeemail($message , $subject , $details));

       dd($request);
    }

    public function contactForm(){
        return view('contact-form');
    }
}
