<?php

namespace App\Http\Controllers\Endpoint;

use App\DTO\Endpoints\EndpointDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Endpoints\{StoreEndpointRequest, UpdateEndpointRequest};
use App\Models\Endpoints\Endpoint;
use App\Services\Endpoints\EndpointService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

final class EndpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse|View
     */
    public function index(string $siteUuid): RedirectResponse|View
    {
        if (! uuid_is_valid($siteUuid)) {
            return redirect()->route('dashboard.index')->withErrors("Invalid uuid {$siteUuid}");
        }

        $endpoints = EndpointService::index($siteUuid);

        return view('dashboard.endpoints.index', ['endpoints' => $endpoints, 'site' => $siteUuid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $site
     * @return View
     */
    public function create(string $site): View
    {
        $data = EndpointService::create();

        return view('dashboard.endpoints.create', [
            'site'        => $site,
            'http'        => $data['http'],
            'frequencies' => $data['frequencies']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEndpointRequest $request
     * @param string $site
     * @return RedirectResponse
     */
    public function store(StoreEndpointRequest $request, string $site): RedirectResponse
    {
        $endpointDTO = new EndpointDTO(...(
            array_merge($request->except(['_token']), ['site_id' => $site])
        ));

        $result = EndpointService::store($endpointDTO);

        if (array_key_exists('message', $result)) {
            return redirect()
                ->route('dashboard.endpoints.index', ['site' => $site])
                ->with('message', $result['message']);
        }

        return redirect()
            ->route('dashboard.endpoints.index')
            ->with('error', "Faield to create endpoint: {$request->endpoint}");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $site
     * @param Endpoint $endpoint
     * @return View
     */
    public function edit(string $site, Endpoint $endpoint): View
    {
        $result = EndpointService::edit($endpoint);

        return view('dashboard.endpoints.edit', [
            'site'        => $site,
            'endpoint'    => $endpoint,
            'http'        => $result['http'],
            'frequencies' => $result['frequencies']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEndpointRequest $request
     * @param string $siteId
     * @param string $endpointId
     * @return void
     */
    public function update(UpdateEndpointRequest $request, string $siteId, string $endpointId)
    {
        if (! uuid_is_valid($siteId) || ! uuid_is_valid($endpointId)) {
            return redirect()->back()->with('error', "Invalid uuid");
        }

        $endpointDTO = new EndpointDTO(...(
            array_merge($request->except(['_token', '_method']), ['site_id' => $siteId, 'id' => $endpointId])
        ));

        $result = EndpointService::update($endpointDTO);

        if (array_key_exists('message', $result)) {
            return redirect()
                ->route('dashboard.endpoints.index', ['site' => $siteId])
                ->with('message', $result['message']);
        }

        return redirect()
            ->route('dashboard.endpoints.index')
            ->with('error', "Faield to create site: {$request->name}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $siteId
     * @param string $endpointId
     * @return RedirectResponse
     */
    public function destroy(string $siteId, string $endpointId): RedirectResponse
    {
        $result = EndpointService::destroy($endpointId);

        if (array_key_exists('message', $result)) {
            return redirect()
                ->route('dashboard.endpoints.index', ['site' => $siteId])
                ->with('message', $result['message']);
        }

        return redirect()
            ->route('dashboard.endpoints.index', ['site' => $siteId])
            ->with('error', "Faield to delete endpoint");
    }
}
