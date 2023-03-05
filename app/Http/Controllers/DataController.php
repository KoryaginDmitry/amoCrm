<?php

namespace App\Http\Controllers;

use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMMissedTokenException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use App\Models\Lead;
use App\Support\Traits\AmoCRMTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DataController extends Controller
{
    use AmoCRMTrait;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function getDealFromDB(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('data', [
            'leads' => Lead::all()
        ]);
    }

    /**
     * @return RedirectResponse
     * @throws AmoCRMApiException
     * @throws AmoCRMMissedTokenException
     * @throws AmoCRMoAuthApiException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updateDealFromAmoCRM(): RedirectResponse
    {
        $apiClient = $this->getObjectAmoCRM();

        foreach ($apiClient->leads()->get() as $lead){
            Lead::updateOrCreate(
                [
                    'amo_crm_id' => $lead->id
                ],
                [
                    'name' => $lead->name,
                    'responsibleUserId' => $lead->responsibleUserId,
                    'groupId' => $lead->groupId,
                    'createdBy' => $lead->createdBy,
                    'updatedBy' => $lead->updatedBy,
                    'createdAt' => $lead->createdAt,
                    'updatedAt' => $lead->updatedAt,
                    'accountId' => $lead->accountId,
                    'pipelineId' => $lead->pipelineId,
                    'statusId' => $lead->statusId,
                    'closedAt' => $lead->closedAt,
                    'closestTaskAt' => $lead->closestTaskAt,
                    'price' => $lead->price
                ]
            );
        }

        return redirect()->route('deal.list');
    }
}
