<?php
/**
 * Created by PhpStorm.
 * User: Louisian
 * Date: 2016/3/6
 * Time: 14:27
 */
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class RebackyxController extends Controller{
    public function get(Request $request){
        return view("photoshow.photoshow");

    }
}