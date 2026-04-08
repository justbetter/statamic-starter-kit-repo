<?php

return [
    'robots' => [
        'default' => implode("\n", [
            'User-agent: *',
            'Disallow: /*?',
            'Disallow: /cp',
            'Sitemap: {site_url}/{sitemap_path}',
        ]),
    ],
];
