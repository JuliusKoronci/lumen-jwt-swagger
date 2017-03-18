<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="api.app",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="This is my website cool API",
 *         description="Api description...",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="jk@web-solutions.sk"
 *         ),
 *         @SWG\License(
 *             name="Private License",
 *             url="URL to the license"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="Find out more about my website",
 *         url="http://www.web-solutions.sk"
 *     )
 * )
 */
class Controller extends BaseController
{
    public function test(){
      echo 1;
    }
}
