<?php

namespace App\Lib;
use App\permission;
use Illuminate\Support\Facades\DB;

class My_func
{
  public static function searchPersonName($array,$persons_id)
  {
$keyIndex = array_search($persons_id, array_column($array, 'persons_id'));
$result = $array[$keyIndex];
echo $result->persons_name;
  }

    public static function searchProductName($array,$products_id)
  {

if($products_id){

foreach ((array)$array as $key => $value) {
$keyIndex = array_search($products_id, array_column($value, 'products_id'));
$result = $array[$keyIndex];
echo $result->products_name;
}
  }
}

  public static function searchProductOptionName($array,$products_options_id)
  {

if($products_options_id){
  
foreach ((array)$array as $key => $value) {
$keyIndex = array_search($products_options_id, array_column($value, 'products_options_id'));
$result = $array[$keyIndex];
echo $result->products_options_name;
}

  }
}




    public static function permission_id()
  {
    $permission = DB::select('select * from permissions');
foreach ((array)$permission as $key => $value) {
echo '<option value="'.$value->id.'">';
echo $value->name;
echo "</option>";
}

}




//    public static function searchProductNameWithId($array,$products_id)
//   {


// foreach ((array)$array as $key => $value) {
// $keyIndex = array_search($products_number, array_column($value, 'products_number'));
// $result = $array[$keyIndex];
// echo $result->products_name;

//   }
// }
//     public static function searchProductOptionNameWithId($array,$products_options_id)
//   {


// foreach ((array)$array as $key => $value) {
// $keyIndex = array_search($products_options_id, array_column($value, 'products_options_id'));
// $result = $array[$keyIndex];
// echo $result->products_options_name;

//   }
// }

}