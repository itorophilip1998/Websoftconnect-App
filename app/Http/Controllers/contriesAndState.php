<?php

namespace App\Http\Controllers;
 
use CountryState as Code;

class contriesAndState extends Controller
{
     public function contries(){
        $countries = Code::getCountries();
        return   $countries;
     }
     public function state($contry){
        $states = Code::getStates($contry);
        return   $states;
     }

}
