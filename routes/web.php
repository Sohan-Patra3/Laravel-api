<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

Route::get('/', function () {
    return view('login');
});

Route::view('allposts' , 'allposts');

Route::view('addpost' , 'addpost');

Route::get('send-email' , [EmailController::class , 'SendEmail']);

Route::get('contactform' , [EmailController::class , 'contactForm']);
