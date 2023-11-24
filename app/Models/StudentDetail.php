<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $offense_id
 * @property integer $addition_id
 * @property integer $student_id
 * @property int $current_point
 * @property string $editor
 * @property string $created_at
 * @property string $updated_at
 * @property Student $student
 * @property Offense $offense
 * @property Addition $addition
 */
class StudentDetail extends Model
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
    protected $fillable = ['offense_id', 'addition_id', 'student_id', 'current_point', 'editor', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offense()
    {
        return $this->belongsTo('App\Models\Offense');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addition()
    {
        return $this->belongsTo('App\Models\Addition');
    }
}
