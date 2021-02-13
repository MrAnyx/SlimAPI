<?php


namespace App\Foundation;


use App\Controller\AbstractRestController;
use ReflectionClass;
use Slim\App;
use App\Attribute\Route;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControllerRegistration {

   public static function register(App $app, array $controllers) {
      foreach($controllers as $controller) {
         $class = new ReflectionClass($controller);
         $classAttribute = $class->getAttributes(Route::class);

         if(!empty($classAttribute)) $prefix = $classAttribute[0]->newInstance()->getUrl();

         $methods = $class->getMethods();
         foreach($methods as $method) {
            $routes = $method->getAttributes(Route::class);

            if(empty($routes)) continue;

            foreach($routes as $route) {
               /** @var Route $routeClass */
               $routeClass = $route->newInstance();
               $app->{$routeClass->getMethod()}($prefix . $routeClass->getUrl(), function (Request $request, Response $response, array $args) use ($method, $controller) {

                  $parameters = [];
                  foreach($method->getParameters() as $parameter) {
                     $parameters[] = match ($parameter->getName()) {
                        'request' => $request,
                        'response' => $response,
                        default => $args[$parameter->getName()] ?? null
                     };
                  }

                  $responseController = call_user_func_array([new $controller(), $method->getName()], $parameters);
                  if(is_string($responseController)) {
                     $response->getBody()->write($responseController);
                     return $response;
                  }
                  return $responseController;
               });
            }
         }
      }
   }

}