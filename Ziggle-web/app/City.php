<?php

namespace App;

class City extends BaseModel
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'city_list';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Get the country of the state.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Check if the state is in active business area
     *
     * @return bool
     */
   
}
