<?php
namespace App\Helper; 
use App\StateDivision;
use App\Township;
use App\LicenceGroup;
use App\FuelShop;
use App\FuelType;
use App\ReportTime;
use App\LicGrade;
use App\LicenceName;
use App\Terminal;
use App\Car;

class Helpers{

  public static function state_divisions(){
     $state_divisions = StateDivision::all();
     return $state_divisions;
  }

  public static function townships(){
    $townships = Township::all();
    return $townships;
  }

  public static function licences()
  {
    $licences = LicenceName::all();
    return $licences;
  }

  public static function fuel_shops()
  {
    $fuel_shops = FuelShop::where('shop_status',1)->get();
    return $fuel_shops;
  }

  public static function fuel_types()
  {
    $fuel_types = FuelType::where('status',1)->get();
    return $fuel_types;
  }

  public static function report_times($shop_type)
  {
    if ($shop_type == 0) {
      $report_times = ReportTime::where('shop_type','1')->where('active_status',1)->get();
    }else{
      $report_times = ReportTime::where('active_status',1)->get();
    }

    return $report_times;
  }

  public static function lic_grades()
  {
    $lic_grades = LicGrade::all();
    return $lic_grades;
  }

  public static function terminals()
  {
    $terminals = Terminal::all();
    return $terminals;
  }

  public static function cars()
  {
    $cars = Car::all();
    return $cars;
  }

}