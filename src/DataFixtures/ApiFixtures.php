<?php

namespace App\DataFixtures;

use App\Entity\Airline;
use App\Entity\Airport;
use App\Entity\City;
use App\Entity\Flight;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class ApiFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->generateAirlines($manager);
        $this->generateCitiesAndAirports($manager);
        $manager->flush();
        $this->generateFlights($manager);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param bool $flush
     * @return void
     */
    private function generateAirlines(ObjectManager $manager, bool $flush = true): void
    {
        $manager->persist(
            $this->createAirline(
                'AC',
                'Air Canade'
            )
        );
        $manager->persist(
            $this->createAirline(
                'AF',
                'Air France'
            )
        );
        $manager->persist(
            $this->createAirline(
                'AA',
                'American Airlines'
            )
        );
        if ($flush === true) {
            $manager->flush();
        }
    }

    private function generateCitiesAndAirports(ObjectManager $manager): void
    {
        $city = $this->createCity('YMQ', 'Montreal', 'CA', 'QC');
        $manager->persist($city);
        $airport = $this->createAirport(
            'YUL',
            'Pierre Elliott Trudeau International',
            $city,
            45.457714,
            -73.749908,
            'America/Montreal'
        );
        $manager->persist($airport);
        $city = $this->createCity('YVR', 'Vancouver', 'CA', 'BC');
        $manager->persist($city);
        $airport = $this->createAirport(
            'YVR',
            'Vancouver International',
            $city,
            49.194698,
            -123.179192,
            'America/Vancouver'
        );
        $manager->persist($airport);
    }

    /**
     * @param ObjectManager $manager
     * @return void
     * @throws Exception
     */
    public function generateFlights(ObjectManager $manager): void
    {
        $airlineRepo = $manager->getRepository(Airline::class);
        /** @var Airline $airline */
        $airline = $airlineRepo->findOneBy(array('code' => 'AC'));
        $airportRepo = $manager->getRepository(Airport::class);
        /** @var Airport $departureAirport */
        $departureAirport = $airportRepo->findOneBy(array('code' => 'YUL'));
        /** @var Airport $arrivalAirport */
        $arrivalAirport = $airportRepo->findOneBy(array('code' => 'YVR'));
        $today = new DateTimeImmutable();
        for ($i = 0; $i < 100; $i++) {
            $departureDate = $today
                ->setTimezone(new DateTimeZone($departureAirport->getTimezone()))
                ->setTime(7, 35)
                ->modify('+' . $i . ' days');
            $arrivalDate = $today
                ->setTimezone(new DateTimeZone($arrivalAirport->getTimezone()))
                ->setTime(10, 05)
                ->modify('+' . $i . ' days');
            $flight = $this->createFlight(
                $airline,
                301,
                $departureAirport,
                $departureDate,
                $arrivalAirport,
                $arrivalDate,
                273.23
            );
            $manager->persist($flight);
            $departureDate = $today
                ->setTimezone(new DateTimeZone($arrivalAirport->getTimezone()))
                ->setTime(11, 30)
                ->modify('+' . $i . ' days');
            $arrivalDate = $today
                ->setTimezone(new DateTimeZone($departureAirport->getTimezone()))
                ->setTime(19, 11)
                ->modify('+' . $i . ' days');
            $flight = $this->createFlight(
                $airline,
                302,
                $departureAirport,
                $departureDate,
                $arrivalAirport,
                $arrivalDate,
                220.63
            );
            $manager->persist($flight);
        }
    }

    /**
     * @param string $code
     * @param string $name
     * @return Airline
     */
    private function createAirline(string $code, string $name): Airline
    {
        $airline = new Airline();
        $airline->setCode($code)
            ->setName($name);

        return $airline;
    }

    /**
     * @param string $code
     * @param string $name
     * @param string $countryCode
     * @param string $regionCode
     * @return City
     */
    private function createCity(
        string $code,
        string $name,
        string $countryCode,
        string $regionCode
    ): City {
        $city = new City();
        $city
            ->setCode($code)
            ->setName($name)
            ->setCountryCode($countryCode)
            ->setRegionCode($regionCode);

        return $city;
    }

    /**
     * @param string $code
     * @param string $name
     * @param City $city
     * @param float $latitude
     * @param float $longitude
     * @param string $timeZone
     * @return Airport
     */
    private function createAirport(
        string $code,
        string $name,
        City $city,
        float $latitude,
        float $longitude,
        string $timeZone
    ): Airport {
        $airport = new Airport();
        $airport
            ->setCode($code)
            ->setName($name)
            ->setCity($city)
            ->setLatitude($latitude)
            ->setLongitude($longitude)
            ->setTimezone($timeZone);

        return $airport;
    }

    /**
     * @param Airline $airline
     * @param int $number
     * @param Airport $departureAirport
     * @param DateTimeImmutable $departureTime
     * @param Airport $arrivalAirport
     * @param DateTimeImmutable $arrivalTime
     * @param float $price
     * @return Flight
     */
    private function createFlight(
        Airline $airline,
        int $number,
        Airport $departureAirport,
        DateTimeImmutable $departureTime,
        Airport $arrivalAirport,
        DateTimeImmutable $arrivalTime,
        float $price
    ): Flight {
        $flight = new Flight();
        $flight
            ->setAirline($airline)
            ->setNumber($number)
            ->setDepartureAirport($departureAirport)
            ->setDepartureTime($departureTime)
            ->setArrivalAirport($arrivalAirport)
            ->setArrivalTime($arrivalTime)
            ->setPrice($price);

        return $flight;
    }
}
