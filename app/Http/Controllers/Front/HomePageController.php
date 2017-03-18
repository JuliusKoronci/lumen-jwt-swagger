<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

/**
 *
 */
class HomePageController extends Controller
{
    public function index()
    {
      return [
          'test' => 'whatever',
      ];
    }
}
