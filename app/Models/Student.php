<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $nim
 * @property string $study_program
 * @property int $entry_year
 * @property string $category
 * @property string $thumbnail
 * @property int $point
 * @property string $offense
 * @property string $created_at
 * @property string $updated_at
 * @property StudentDetail $studentDetail
 */
class Student extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'nim', 'study_program', 'entry_year', 'category', 'thumbnail', 'point', 'offense', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentDetail()
    {
        return $this->hasOne('App\Models\StudentDetail', 'id');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('nim', 'like', '%'.$query.'%')
                ->orWhere('category', 'like', '%'.$query.'%');
    }
    public static function searchFront($query)
    {
        return empty($query) ? static::whereId(-1)
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('nim', 'like', '%'.$query.'%')
                ->orWhere('category', 'like', '%'.$query.'%');
    }

}
