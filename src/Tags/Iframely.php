<?php

namespace Tv2regionerne\StatamicIframely\Tags;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Statamic\Tags\Tags;

class Iframely extends Tags
{
    /**
     * The {{ statamic_iframely }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        $url = $this->params->get('url');
        $apiKey = config('statamic-iframely.api_key');
        $cache = config('statamic-iframely.cache_enabled');
        if (! $url || ! $apiKey) {
            return false;
        }

        $params = collect([
            'api_key' => $apiKey,
            'url' => $url,
            'iframe' => $this->params->get('iframe'),
            'id' => $this->params->get('id'),
            'omit_script' => $this->params->get('omit_script', '1'),
            'omit_css' => $this->params->get('omit_css', '1'),
            'import' => $this->params->get('import'),
            'align' => $this->params->get('align'),
            'lazy' => $this->params->get('lazy'),
            'playerjs' => $this->params->get('playerjs'),
            'click_to_play' => $this->params->get('click_to_play'),
            'consent' => $this->params->get('consent'),
            'theme' => $this->params->get('theme'),
            'language' => $this->params->get('language'),
            'ssl' => $this->params->get('ssl'),
            'media' => $this->params->get('media'),
            'autoplay' => $this->params->get('autoplay'),
            'maxwidth' => $this->params->get('maxwidth'),
            'maxheight' => $this->params->get('maxheight'),
            'origin' => $this->params->get('origin'),
            'title' => $this->params->get('title'),
        ])->whereNotNull()->toArray();

        $apiUrl = 'http://iframe.ly/api/iframely?'.http_build_query($params);

        if ($cache) {
            $cacheKey = md5($apiUrl);

            if ($html = Cache::tags(['iframely'])->get($cacheKey)) {
                return $html;
            }
        }

        $response = Http::retry(3)->get($apiUrl);

        if ($response->failed()) {
            return false;
        }

        if ($html = $response->object()->html) {
            if ($cache) {
                $cacheFor = Carbon::make($this->params->get('cache_for', config('statamic-iframely.cache_for')));
                Cache::tags(['iframely'])->put($cacheKey, $html, $cacheFor);
            }

            return $html;
        }

        return false;
    }
}
