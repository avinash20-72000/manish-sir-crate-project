<?php

namespace App\Models;

use App\Models\CrateTransfer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crate extends Model
{
    use HasFactory;

    protected $table    =   'crates';
    protected $guarded  =   ['id'];

    public function crateTransfers():HasMany
    {
        return $this->hasMany(CrateTransfer::class);
    }
}
