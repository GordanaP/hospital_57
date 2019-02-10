<?php

namespace App;

use App\Traits\Doctor\HasAttributes;
use App\Traits\Doctor\HasUser;
use App\Traits\Doctor\Crudable;
use App\Traits\Doctor\Presentable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasAttributes, HasUser, Crudable, Presentable;

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
     * Get doctors without user account.
     *
     * @param \App\User | null $user
     * @return Illuminate\Support\Collection
     */
    public static function hasNoAccountCollection($user = null)
    {
        $available_doctors = static::doesnthave('user')->get();

        optional($user)->doctor ? $available_doctors->push($user->doctor) : '';

        return $available_doctors;
    }
}
