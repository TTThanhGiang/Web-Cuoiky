<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\VerifyAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(){
        return view('web.index');
    }

    public function sendEmail(){
        try {
            $toEmailAddress = "ruunng@gmail.com";
            $welcomeMessage = "Giang";
            $response = Mail::to($toEmailAddress)->send(new VerifyAccount($welcomeMessage));
            dd($response);
        } catch (Exception $e) {
            Log::error("Unable to send email", $e->getMessage());
        }
        
    }
}
