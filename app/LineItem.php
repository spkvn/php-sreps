<?php

namespace PHPSREPS;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsto(Product::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
