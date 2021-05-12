<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigPaytm extends Model
{
    protected $table = 'config_paytm';

    /**
     * The database primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'shop_id';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'sandbox' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'shop_id',
                        'm_id',
                        'm_key',
                        'channel_id',
					];

    /**
     * Setters.
     */

    public function setPublicKeyAttribute($value)
    {
        $this->attributes['m_id'] = trim($value);
    }
    public function setSecretAttribute($value)
    {
        $this->attributes['m_key'] = trim($value);
    }
    public function setSandboxAttribute($value)
    {
        $this->attributes['sandbox'] = (bool) $value;
    }
}
