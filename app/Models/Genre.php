<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public static function getAll() {
        return [
            ['id' => 1, 'name' => 'Fantasy'],
            ['id' => 2, 'name' => 'Science Fiction'],
            ['id' => 3, 'name' => 'Mystery'],
            ['id' => 4, 'name' => 'Romance'],
            ['id' => 5, 'name' => 'Horror']
        ];
    }
}
