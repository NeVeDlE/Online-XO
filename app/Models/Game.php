<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Game extends Model
{
    use HasFactory;
    protected $fillable=['player_one_id','player_two_id','state','player_turn','winner_id'];

    protected function casts(): array
    {
        return [
            'state' => 'json',
        ];
    }
    public function player_one(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'player_one_id');
    }

    public function player_two(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'player_two_id');
    }
    public function winner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
}
