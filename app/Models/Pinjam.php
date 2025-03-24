<?php

namespace App\Models;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pinjam extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pinjams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'buku_id', 'user_id', 'tanggal_pinjam', 'tanggal_kembali', 'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }
}
