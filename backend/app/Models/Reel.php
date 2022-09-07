<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reels';

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
    protected $fillable = ['name', 'standard', 'definition'];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get the clip videos for the reel.
     */
    public function clipVideos()
    {
        return $this->hasMany(VideoClip::class, 'reel_id');
    }
}
