<?php

namespace App\Entity\Api;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\TripController;
use App\Dto\FlightDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Action\NotFoundAction;

/**
 * @ApiResource(
 *     collectionOperations={
 *      "search_flights" = {
 *          "method" = "GET",
 *          "path" = "/search_flights",
 *          "controller" = TripController::class,
 *          "read"=false,
 *          "openapi_context" = {
 *              "parameters" = {
 *           {
 *             "name" = "airline",
 *             "in" = "query",
 *             "description" = "the code of the airline",
 *             "type" = "string",
 *             "required" = false,
 *             "example"= "AC",
 *           },
 *           {
 *             "name" = "departureDate",
 *             "in" = "query",
 *             "description" = "Departure date",
 *             "type" = "datetime",
 *             "required" = true,
 *             "example"= "2023-05-15",
 *           },
 *           {
 *             "name" = "returnDate",
 *             "in" = "query",
 *             "description" = "Return date, must be > departureDate",
 *             "type" = "datetime",
 *             "required" = false,
 *             "example"= "2023-06-15",
 *           },
 *           {
 *             "name" = "departureAirport",
 *             "in" = "query",
 *             "description" = "The departure airport",
 *             "type" = "string",
 *             "required" = true,
 *             "example"= "YUL",
 *           },
 *           {
 *             "name" = "arrivalAirport",
 *             "in" = "query",
 *             "description" = "The arrival airport",
 *             "type" = "string",
 *             "required" = true,
 *             "example"= "YVR",
 *           },
 *           {
 *             "name" = "tripType",
 *             "in" = "query",
 *             "description" = "The type of trip : round_trip or one_way",
 *             "type" = "string",
 *             "required" = true,
 *             "example"= "round_trip",
 *           },
 *         },
 *       },
 *     }
 * },
 *     itemOperations={
 *         "get"={
 *             "controller"=NotFoundAction::class,
 *             "read"=false,
 *             "output"=false,
 *              "swagger_context"={"parameters"={}},
 *              "openapi_context"={
 *                  "parameters"={},
 *                 "description"="Retrieves a Foo resource. #withoutIdentifier",
 *             },
 *         },
 *     }
 * )
 */
class Trip
{
    /**
     * @var string
     */
    #[ApiProperty(identifier: true)]
    public $id;
    /**
     * @var float $price
     */
    public $price;
    /**
     * @var Collection|FlightDto[]
     */
    public $flights;

    public function __construct(float $price = 0, Collection $flights = new ArrayCollection())
    {
        $this->id = uniqid();
        $this->price = $price;
        $this->flights = $flights;
    }
}
