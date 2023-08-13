<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cve extends Model
{
    use HasFactory;

    protected $table = 'cves';

    protected $fillable = [
        'id_cve',
        'description',
        'last_update',
        'publication_date',
        'threat',
        'threat_score',
        'url_recerences',
        'json'
    ];
}
