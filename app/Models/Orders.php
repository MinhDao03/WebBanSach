<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model 
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'phone',      
        'address',    
    ];

    // Quan hệ một-nhiều với OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class); 
    }

    // Quan hệ một-nhiều với User 
    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function items(){
        return $this->hasMany(OrderItems::class, 'order_id');
    }

}
