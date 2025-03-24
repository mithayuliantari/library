<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Testing\Fluent\Concerns\Has;

class Pengembalian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengembalians';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'pinjam_id', 'tanggal_pengembalian', 'denda'];

    public function pinjam(): BelongsTo
    {
        return $this->belongsTo(Pinjam::class, 'pinjam_id', 'id');
    }
}
