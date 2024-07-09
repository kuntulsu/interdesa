<?php

use App\Http\Controllers\NotificationController;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PPPoEController;

Route::get('/', function (Request $request) {
    return view('welcome');
});

Route::get("/testing", function() {
    
    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/server/{server}/pppoe', [PPPoEController::class, "list"])->name("dashboard.pppoe");
    Route::get('/server/{server}/pppoe/{secret}', [PPPoEController::class, "secret_mgmt"])->name("dashboard.pppoe.mgmt");
    Route::get("/server/{server}/notifications", [NotificationController::class, "settings"])->name("notification.index");
    Route::get("/server/settings", [PPPoEController::class, 'server_mgmt'])->name("server.settings");


    //payment page, maybe think a better implementation?
    Route::get("payment/print/{payment}", function(Request $request, Payment $payment) {
        $referer = $request->header("referer");

        $parsed_referer = $referer ? parse_url($referer)['host'] : null;

        $host = $request->host();

        $is_samehost = $parsed_referer == $host;

        if(!$referer || !$is_samehost) {
            abort(403);
        }

        $payload = [
            "payment" => $payment
        ];
        
        return view("payment-page", $payload);
    })->name("payment.print");
});
