<?php

namespace App\Models;

use App\Traits\FilterableByDatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProfitSharingView extends Model
{
    use HasFactory;
    use FilterableByDatesTrait;

    protected $table = 'profit_sharing_view';


}
