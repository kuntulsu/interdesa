<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ["customer_id", "user_id", "amount", "note"];
    protected $with = ["customer", "admin"];
    public function customer()
    {
        return $this->hasOne(Customer::class, "id", "customer_id");
    }
    public function admin()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
    public function period()
    {
        $this->hasOne(Period::class);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function(Model $model) {

            // increment "jatuh_tempo" by one month
            $customer = Customer::find($model->customer_id);
            $customer->jatuh_tempo = now()->addMonth(1)->day(7);
            $customer->save();

            // activate the user (if disabled)
            $router = $customer->server->connect();

            $router->ppp()->enableSecret($customer->secret_id);
        });
    }
}
