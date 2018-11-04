<?php

namespace App\ResponseResolver;

use App\CQRS\Bus\SimpleBus;
use App\CQRS\Intention\AddVehicleIntention;
use App\CQRS\Intention\DeleteVehicleIntention;
use App\Storage\VehicleShelf;
use App\System\Request;
use App\System\Response;
use Ramsey\Uuid\Uuid;

class VehicleResponseResolver
{
    private $shelf;
    private $bus;

    public function __construct(SimpleBus $bus, VehicleShelf $shelf)
    {
        $this->shelf = $shelf;
        $this->bus = $bus;
    }

    public function getAction(Request $request): Response
    {
        if ($request->getParameters()->hasGet('identifier')) {
            $id = $request->getParameters()->getGet('identifier');
            $result = $this->shelf->take($id);
        } else {
            $result = $this->shelf->takeAll();
        }

        return new Response(\json_encode($result), 200);
    }

    public function addAction(Request $request): Response
    {
        $type = $request->getParameters()->getGet('type');
        $number = $request->getParameters()->getGet('number');
        $id = Uuid::uuid4();

        $intention = new AddVehicleIntention($id, $number, $type);
        $this->bus->handle($intention);

        return new Response(\json_encode(['id' => $id]), 201);
    }

    public function deleteAction(Request $request): Response
    {
        if ($request->getParameters()->hasGet('identifier')) {
            $id = $request->getParameters()->getGet('identifier');
            $this->bus->handle(new DeleteVehicleIntention($id));
        }

        return new Response(\json_encode(['id' => $id]), 200);
    }
}