<?php

namespace App;

use App\Traits\Doctor\Presentable;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use Presentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'title', 'specialty', 'license', 'biography', 'color', 'app_slot', 'image'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['title_last_name'];

    /**
     * Get the doctor's user account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determine if the doctor has a user account.
     *
     * @return boolean
     */
    public function hasUser()
    {
        return $this->user;
    }

    /**
     * Delete the doctor.
     *
     * @return void
     */
    public function remove()
    {
        $this->image->removeFromStorage($this->image);

        optional($this->user)->delete();

        $this->delete();
    }

}
