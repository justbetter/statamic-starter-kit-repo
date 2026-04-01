<?php

namespace Feature\Controllers;

use PHPUnit\Framework\Attributes\Test;
use Statamic\Facades\Blink;
use Statamic\Facades\GlobalSet as GlobalSetFacade;
use Statamic\Facades\Site;
use Statamic\Globals\GlobalSet;
use Tests\TestCase;

class RobotsTest extends TestCase
{
    #[Test]
    public function it_returns_the_localized_robots_global_when_it_has_content(): void
    {
        /** @var \Statamic\Sites\Site $defaultSite */
        $defaultSite = Site::default();

        /** @var GlobalSet $set */
        $set = GlobalSetFacade::findByHandle('robots');

        $variables = $set->in($defaultSite->handle()) ?? $set->makeLocalization($defaultSite->handle());

        $variables->data([
            'robots' => "User-agent: *\nDisallow: /private",
        ])->save();

        Blink::flush();

        $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('content-type', 'text/plain; charset=UTF-8')
            ->assertSeeTextInOrder(['User-agent: *', 'Disallow: /private'], false);
    }

    #[Test]
    public function it_returns_robots_fallback_when_the_global_is_empty(): void
    {
        /** @var \Statamic\Sites\Site $defaultSite */
        $defaultSite = Site::default();

        /** @var GlobalSet $set */
        $set = GlobalSetFacade::findByHandle('robots');

        $variables = $set->in($defaultSite->handle()) ?? $set->makeLocalization($defaultSite->handle());

        $variables->data([
            'robots' => '   ',
        ])->save();

        Blink::flush();

        $siteUrl = rtrim($defaultSite->absoluteUrl(), '/');

        $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('content-type', 'text/plain; charset=UTF-8')
            ->assertSeeText('User-agent: *', false)
            ->assertSeeText('Disallow:', false)
            ->assertSeeText("Sitemap: $siteUrl/sitemap.xml", false);
    }

    #[Test]
    public function it_uses_the_current_sites_sitemap_url_in_the_fallback(): void
    {
        config()->set('statamic.system.multisite', true);

        Site::setSites([
            'nl' => [
                'name' => 'NL',
                'locale' => 'nl_NL',
                'lang' => 'nl',
                'url' => 'https://test.nl/',
            ],
            'en' => [
                'name' => 'EN',
                'locale' => 'en_US',
                'lang' => 'en',
                'url' => 'https://test.com/',
            ],
        ]);

        /** @var GlobalSet $set */
        $set = GlobalSetFacade::findByHandle('robots');

        foreach (['nl', 'en'] as $handle) {
            $variables = $set->in($handle) ?? $set->makeLocalization($handle);
            $variables->data(['robots' => '   '])->save();
        }

        Blink::flush();

        $this->get('https://test.nl/robots.txt')
            ->assertOk()
            ->assertSeeText('Sitemap: https://test.nl/sitemap.xml', false);

        $this->get('https://test.com/robots.txt')
            ->assertOk()
            ->assertSeeText('Sitemap: https://test.com/sitemap.xml', false);
    }
}
