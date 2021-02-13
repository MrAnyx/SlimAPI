<?php

namespace App\Controller;

use App\Attribute\Route;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

#[Route(url: "/api")]
class RestController extends AbstractRestController
{

   #[Route(url: "/", method: "GET")]
   public function index(Response $response)
   {
      return $this->json($response, [
         "bonjour" => "test"
      ]);

   }

}