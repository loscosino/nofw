<?php

declare(strict_types=1);

namespace App\ResponseResolver;

use App\CQRS\Bus\SimpleBus;
use App\CQRS\Intention\ParkIntention;
use App\System\Request;
use App\System\Response;

class SpaceResponseResolver
{
    private $bus;

    public function __construct(SimpleBus $bus)
    {
        $this->bus = $bus;
    }

    public function takeAction(Request $request): Response
    {
        $placeCode = $request->getParameters()->getPost('parkingCode');
        $intention = new ParkIntention($request->getParameters()->getPost('vehicleId'), $placeCode);
        $this->bus->handle($intention);

        return new Response(\json_encode(['code' => $placeCode]), '200');
    }
}