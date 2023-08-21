<?php

namespace App\Http\Integrations\SWAPI;

use App\Http\Integrations\SWAPI\Resources\FilmsResource;
use App\Http\Integrations\SWAPI\Resources\PeopleResource;
use App\Http\Integrations\SWAPI\Resources\PlanetsResource;
use App\Http\Integrations\SWAPI\Resources\SpeciesResource;
use App\Http\Integrations\SWAPI\Resources\StarhsipsResource;
use App\Http\Integrations\SWAPI\Resources\VehicleResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use JustSteveKing\HttpHelpers\Enums\Method;
final readonly class SWAPIConnector
{
    public function __construct(
        private PendingRequest $request,
    ) {
    }

    public static function register(Application $app): void
    {
        $app->bind(
            abstract: SWAPIConnector::class,
            concrete: fn () => new SWAPIConnector(
                request: Http::baseUrl(
                    url: config('services.swapi.url'),
                )->timeout(
                    seconds: 15,
                )->withHeaders(
                    headers: [],
                )->asJson()->acceptJson(),
            ),
        );
    }

    public function send(Method $method, string $uri, array $options = []): Response
    {
        return $this->request->send(
            method: $method->value,
            url: $uri,
            options: $options,
        )->throw();
    }

    public function people(): PeopleResource
    {
        return new PeopleResource(
            connector: $this,
        );
    }

    public function vehicles(): VehicleResource
    {
        return new VehicleResource(
            connector: $this,
        );
    }

    public function planets(): PlanetsResource
    {
        return new PlanetsResource(
            connector: $this,
        );
    }

    public function films(): FilmsResource
    {
        return new FilmsResource(
            connector: $this,
        );
    }

    public function starships(): StarhsipsResource
    {
        return new StarhsipsResource(
            connector: $this,
        );
    }

    public function species(): SpeciesResource
    {
        return new SpeciesResource(
            connector: $this,
        );
    }
}
