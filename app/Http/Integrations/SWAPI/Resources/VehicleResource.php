<?php

namespace App\Http\Integrations\SWAPI\Resources;

use App\Http\Integrations\SWAPI\SWAPIConnector;
use Exception;
use Http\Discovery\Exception\NotFoundException;
use JustSteveKing\HttpHelpers\Enums\Method;
use Throwable;

final readonly class VehicleResource
{
    public function __construct(
        private SWAPIConnector $connector,
    ) {}
        public function list(): String
        {
            try {
                $response = $this->connector->send(
                    method: Method::GET,
                    uri: "https://swapi.dev/api/vehicles"
                );
    
            } catch (Throwable $th) {
                throw new Exception($th->getMessage());
            }
            return $response->body();
        }
        public function get(int $id)
        {
          try {
            $response = $this->connector->send(
              method: Method::GET,
              uri: "https://swapi.dev/api/vehicles/$id"
            );
          } catch (Throwable $th) {
            throw new NotFoundException($th->getMessage());
          }
    
          return $response->body();
        }
        public function schema()
        {
          try {
            $response = $this->connector->send(
              method: Method::GET,
              uri: "https://swapi.dev/api/vehicles/schema"
            );
          } catch (Throwable $th) {
            dd($th);
            throw new NotFoundException($th->getMessage());
          }
    
          return $response->body();
        }
}