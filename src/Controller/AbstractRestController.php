<?php

namespace App\Controller;

use App\Attribute\Register;
use Psr\Http\Message\ResponseInterface as Response;


abstract class AbstractRestController
{
   public function json(Response $response, array $params)
   {
      $response->getBody()->write(json_encode($params));
      return $response->withHeader('Content-Type', 'application/json');
   }
}