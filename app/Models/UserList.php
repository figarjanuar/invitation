<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    use HasFactory;

    public function invitation()
    {
        return $this->hasOne(InvitationLists::class, 'user_id');
    }
}
