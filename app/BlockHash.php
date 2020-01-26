<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockHash extends Model {
	protected $table = 'block_hash';
	protected $fillable = ['block_hash', 'flag', 'metadata'];
}
