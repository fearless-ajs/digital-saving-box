<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'account_name',
      'account_number',
      'bank_name',
      'account_type'
    ];
}
