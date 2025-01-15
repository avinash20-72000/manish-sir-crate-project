<?php

namespace App\Models;

use App\Models\Crate;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrateTransfer extends Model
{
    use HasFactory;

    protected $table    =   'crate_transfers';
    protected $guarded  =   ['id'];

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Define a belongs-to relationship with Crate.
     */
    public function crate():BelongsTo
    {
        return $this->belongsTo(Crate::class);
    }
}
