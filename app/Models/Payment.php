<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use BalajiDharma\LaravelMenu\Traits\LaravelCategories;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use HasFactory, HasRoles, LaravelCategories, Notifiable;


    protected $fillable = [
        'user_id', 'amount', 'status', 'transaction_id', 'details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
