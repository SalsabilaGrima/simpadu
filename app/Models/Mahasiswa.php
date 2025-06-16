<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
  //
  protected $table = 'mahasiswa';
  protected $primaryKey = 'nim';
  protected $keyType = 'string';
  
  protected $fillable = [
    'nim',
    'nama',
    'tanggal_lahir',
    'telepon',
    'email',
    'password',
    'foto',
    'id',
  ];
  public function prodi (): BelongsTo
  {
    return $this->belongsTo(prodi::class, 'id', 'id');
  }
}
