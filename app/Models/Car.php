<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends EloquentModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'maker_id',
        'model_id',
        'year',
        'car_type_id',
        'city_id',
        'vin',
        'mileage',
        'price',
        'fuel_type_id',
        'address',
        'description',
        'phone'
    ];

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }

    public function carType(): BelongsTo
    {
        return $this->BelongsTo(CarType::class);
    }

    public function maker(): BelongsTo
    {
        return $this->belongsTo(Maker::class);
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(Model::class);
    }


    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function favoritedCars(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "favorite_cars");
    }
    public function features(): HasOne
    {
        return $this->hasOne(CarFeatures::class);
    }


    public function primaryImage(): HasOne
    {

        return $this->hasOne(CarImage::class)->oldestOfMany("position");
    }



    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class)->orderBy("position");
    }


    public function getCreateDate(): string
    {


        return (new Carbon($this->created_at))->format("Y-m-d");
    }
}
