<?php
/**
 * Created by PhpStorm.
 * User: mihai
 * Date: 12/5/17
 * Time: 1:36 PM.
 */

namespace LaravelEnso\AddressesManager\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;

class Address extends Model
{
    use CreatedBy;

    protected $fillable = ['country_id', 'type', 'is_default', 'apartment', 'floor', 'entry', 'building', 'number', 'street',
        'sub_administrative_area', 'city', 'administrative_area', 'postal_area', 'obs', ];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'created_by', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class );
    }

    public function addressable()
    {
        return $this->morphTo();
    }

    public function getOwnerAttribute()
    {
        $owner = [
            'fullName'  => $this->user->fullName,
            'avatarId'  => $this->user->avatarId,
        ];

        unset($this->user);

        return $owner;
    }
}
