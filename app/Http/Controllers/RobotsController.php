<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Statamic\Facades\GlobalSet;
use Statamic\Facades\Site as SiteFacade;
use Statamic\Sites\Site;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $robots = GlobalSet::findByHandle('robots')?->inCurrentSite()?->get('robots');

        if (filled($robots)) {
            $contents = trim((string) $robots);
        } else {
            $contents = $this->fallback();
        }

        return response($contents, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    protected function fallback(): string
    {
        /** @var Site $currentSite */
        $currentSite = SiteFacade::current();

        $siteUrl = rtrim($currentSite->absoluteUrl() ?? config('app.url'), '/');
        $sitemapPath = ltrim(config()->string('statamic.seo-pro.sitemap.url', 'sitemap.xml'), '/');

        /** @var string $default */
        $default = config('seo.robots.default');

        if (filled($default)) {
            return strtr($default, [
                '{site_url}' => $siteUrl,
                '{sitemap_path}' => $sitemapPath,
            ]);
        }

        return implode("\n", [
            'User-agent: *',
            'Disallow: /*?',
            'Disallow: /cp',
            'Sitemap: '.$siteUrl.'/'.$sitemapPath,
        ]);
    }
}
