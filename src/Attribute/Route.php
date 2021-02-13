<?php

namespace App\Attribute;

use Attribute;
use Slim\Exception\HttpBadRequestException;
use Slim\Factory\Psr17\ServerRequestCreator;

#[Attribute(Attribute::TARGET_METHOD|Attribute::TARGET_CLASS)]
class Route
{

   /**
    * Route constructor.
    * @param string $url
    * @param string $method
    */
   public function __construct(
      private string $url,
      private string $method = "GET"
   ){}

   /**
    * @return string
    */
   public function getUrl(): string
   {
      return $this->url;
   }

   /**
    * @return string|null
    */
   public function getMethod(): ?string
   {
      $methodToLower = strtolower($this->method);
      return in_array($methodToLower, ["get", "post", "patch", "delete", "put"]) ? $methodToLower : null;
   }

}