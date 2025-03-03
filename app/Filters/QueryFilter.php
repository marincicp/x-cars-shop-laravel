<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{


   public static function apply(Builder $query, Request $request): Builder
   {
      $filters = ["maker_id", "model_id", "city_id", "car_type_id", "fuel_type_id", "mileage"];

      array_walk($filters, fn($filter) => $query->when($request->filled($filter), fn($q) => $q->where($filter, $request->input($filter))));

      self::handleYearFilter($request, $query);

      self::handlePriceFilter($request, $query);

      self::handleStateFilter($request, $query);

      self::handleOrderByFilter($request, $query);

      return $query;
   }



   private static function handlePriceFilter(Request $request, Builder $query)
   {
      if ($request->filled("price_from") || $request->filled("price_to")) {
         $query->whereBetween("price", [$request->input("price_from", 0), $request->input("price_to", 999999999)]);
      };
   }

   private static function handleYearFilter(Request $request, Builder $query)
   {
      if ($request->filled("year_from") || $request->filled("year_to")) {
         $query->whereBetween("year", [$request->input("year_from", 1970), $request->input("year_to", date("Y"))]);
      };
   }

   private static function handleStateFilter(Request $request, Builder $query)
   {
      $query->when($request->filled("state_id"), fn($q) =>
      $q->join("cities", "cities.id", "cars.city_id")->join("states", "states.id", "cities.state_id")->where("states.id", $request->input("state_id"))->addSelect("states.name as state_name"));
   }

   private static function handleOrderByFilter(Request $request, Builder $query)
   {
      $priceFilter = ["priceasc" => "asc", "pricedesc" => "desc"];

      if ($request->filled("sort") && in_array($request->input("sort"), array_keys($priceFilter))) {
         $query->orderBy("price", $priceFilter[$request->input("sort")]);
      } else {
         $query->orderBy("published_at", "desc");
      }
   }
}
