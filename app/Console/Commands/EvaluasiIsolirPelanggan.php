<?php

namespace App\Console\Commands;

use App\Exceptions\MikrotikConnectionError;
use App\Models\Customer;
use App\Models\Server;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class EvaluasiIsolirPelanggan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:evaluasi-isolir-pelanggan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek Pelanggan Apakah Lewat dari Jatuh Tempo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $customer = Customer::query()
            ->whereDate("jatuh_tempo", "<" , now())
            ->get();

        if($customer){
            $groupedByServer = $customer->groupBy("server_id");
            foreach($groupedByServer as $key => $value){
                $server = Server::find($key);
                if($server) {
                    $router = $server->connect();
                    if(!$router->connected){
                        Log::alert("{$router->hostname} : cannot connect to the router");
                    };
                    $ids = $value->pluck("secret_id")->toArray();
                    // get the secrets
                    $secrets = $router->ppp()->getSecret(id: $ids);
                    $secrets = collect($secrets);

                    $secret_names = $secrets->pluck("name")->toArray();

                    // disable the secrets and drop its connection
                    $router->ppp()->disableSecret($ids);
                    $router->ppp()->dropActiveConnection($secret_names);

                    Log::info("Evaluasi Isolir Pelanggan Berhasil");                 
                }
            }
        }
    }
}
