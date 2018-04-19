<?php

namespace PHPSREPS;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Tip: Fillable / Guarded properties
    // Models by default protect all their fields from mass assignment.
    // to prevent this we can set fillable or guarded. By guarding only the id,
    // all other properties can be assigned.

    // All properties can be assigned, except ID
    protected $guarded = ['id'];

    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }
}
