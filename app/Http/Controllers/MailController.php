<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUP;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendMail(){
        Mail::to("fake@mail.com")->send(new SignUP);
        return "Send Email";
    }
}