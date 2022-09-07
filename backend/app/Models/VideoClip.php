<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoClip extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'video_clips';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'standard',
        'definition',
        'description',
        'start',
        'end',
        'duration',
        'reel_id',
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    /**
     * Get the post that owns the comment.
     */
    public function Reel()
    {
        return $this->belongsTo(Reel::class, 'id');
    }
}
