<?php

namespace App\Console\Commands;

use App\Enums\HTTP\HTTPEnum;
use App\Models\Endpoints\Endpoint;
use App\Models\Site\Site;
use App\Services\Check\CheckService;
use App\Utils\DateUtil;
use App\Utils\RequestUtil;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Response;

class CheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Observer all endpoints and check current date with next check';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sites = Site::all();

        $sites->map(function (Site $site) {

            $site->endpoints->map(function (Endpoint $endpoint) use ($site) {

                $currentDate = Carbon::now()->format('Y-m-d H:i');

                $checkEndpoint = CheckService::show($endpoint->id);

                if (is_null($checkEndpoint)) {
                    return;
                }

                $checkDate = Carbon::createFromDate($checkEndpoint->next_check)->format('Y-m-d H:i');

                if ($currentDate === $checkDate) {
                    $httpMethod = strtolower(HTTPEnum::getHTTPMethod($endpoint->http)->name);

                    $url = "{$site->name}{$endpoint->name}";

                    /* @var Response $response */
                    $response = RequestUtil::$httpMethod($url);

                    $nextCheck = DateUtil::getDateDiff($endpoint->frequency, $endpoint->frequency_interval);

                    CheckService::update($checkEndpoint->id, [
                        'http_code'   => $response->status(),
                        'response'    => json_encode($response->body()),
                        'last_check'  => $currentDate,
                        'next_check'  => $nextCheck
                    ]);
                }
            });
        });
    }
}
