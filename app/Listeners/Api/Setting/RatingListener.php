<?php

namespace App\Listeners\Api\Setting;

use App\Models\Acl\Agency;
use App\Models\Acl\Agent;
use App\Models\Acl\Developer;
use App\Models\Property\Property;
use App\Repositories\Acl\AgencyRepository;
use App\Repositories\Acl\AgentRepository;
use App\Repositories\Acl\DeveloperRepository;
use App\Repositories\Acl\UserRepository;
use App\Repositories\Property\PropertyRepository;
use App\Repositories\Setting\ReviewRepository;

class RatingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $reviewRepository, $userRepository, $agencyRepository, $propertyRepository, $developerRepository, $agentRepository;

    public function __construct(ReviewRepository $ReviewRepository, UserRepository $UserRepository, AgencyRepository $AgencyRepository,
                                PropertyRepository $PropertyRepository, AgentRepository $AgentRepository, DeveloperRepository $DeveloperRepository)
    {
        $this->reviewRepository = $ReviewRepository;
        $this->userRepository = $UserRepository;
        $this->agencyRepository = $AgencyRepository;
        $this->propertyRepository = $PropertyRepository;
        $this->developerRepository = $DeveloperRepository;
        $this->agentRepository = $AgentRepository;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $data['avg'] = $this->reviewRepository->avgRating($event->id, $event->type);
        if ($event->type == Agency::class) {
            $id = $this->agencyRepository->showData($event->id)->user_id;
            $this->userRepository->updateData($data, $id);
        } elseif ($event->type == Agent::class) {
            $id = $this->agentRepository->showData($event->id)->user_id;
            $this->userRepository->updateData($data, $id);
        } elseif ($event->type == Developer::class) {
            $id = $this->developerRepository->showData($event->id)->user_id;
            $this->userRepository->updateData($data, $id);
        } elseif ($event->type == Property::class) {
          //  $this->propertyRepository->updateData($data, $event->id);
        }
    }
}
