<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $table = 'platforms';

    public function SubscriptionPlan()
    {
    	return $this->hasmany(SubscriptionPlan::class);
    }

    public function Blog()
    {
    	return $this->hasmany(Blog::class);
    }

    public function Faq()
    {
    	return $this->hasmany(Faq::class);
    }
}
