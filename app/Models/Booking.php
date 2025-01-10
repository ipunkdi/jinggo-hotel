<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['reservation_id', 'booking_date', 'total_price'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
