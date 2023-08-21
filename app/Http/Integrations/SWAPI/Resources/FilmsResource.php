<?php

namespace App\Http\Integrations\SWAPI\Resources;

use App\Http\Integrations\SWAPI\SWAPIConnector;
use Exception;
use Http\Discovery\Exception\NotFoundException;
use Illuminate\Support\Collection;
use JustSteveKing\HttpHelpers\Enums\Method;
use Throwable;

final readonly class FilmsResource
{
    public function __construct(
        private SWAPIConnector $connector,
    ) {}
    public function list(): String
    {
        try {
            $response = $this->connector->send(
                method: Method::GET,
                uri: "https://swapi.dev/api/films"
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
          uri: "https://swapi.dev/api/films/$id"
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
          uri: "https://swapi.dev/api/films/schema"
        );
      } catch (Throwable $th) {
        throw new NotFoundException($th->getMessage());
      }

      return $response->body();
    }

}