<?php

namespace App\Http\Controllers\Site;

use App\DTO\Site\SiteDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\{StoreSiteRequest, UpdateSiteRequest};
use App\Models\Site\Site;
use App\Services\Sites\SiteService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSiteRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSiteRequest $request): RedirectResponse
    {
        $result = SiteService::store(
            new SiteDTO(...$request->except(['_token']))
        );

        if (array_key_exists('message', $result)) {
            return redirect()->route('dashboard.index')->with('message', $result['message']);
        }

        return redirect()->route('dashboard.index')->with('error', "Faield to create site: {$request->name}");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        return view('dashboard.sites.edit', ['site' => $site]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param UpdateSiteRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UpdateSiteRequest $request, string $id)
    {
        if (! uuid_is_valid($id)) {
            return redirect()->back()->with('error', "Invalid uuid");
        }

        $result = SiteService::update(
            new SiteDTO(...$request->except(['_token', '_method'])),
            $id
        );

        if (array_key_exists('message', $result)) {
            return redirect()->route('dashboard.index')->with('message', $result['message']);
        }

        return redirect()->route('dashboard.index')->with('error', "Faield to update site: {$request->name}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Site $site
     */
    public function destroy(Site $site)
    {
        $oldName = $site->name;

        $result = SiteService::destroy($site);

        if (array_key_exists('message', $result)) {
            return redirect()->route('dashboard.index')->with('message', $result['message']);
        }

        return redirect()->route('dashboard.index')->with('error', "Faield to update site: {$oldName}");
    }
}
