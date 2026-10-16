<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramFeedService
{
    public function latest(): array
    {
        $userId = config('services.instagram.user_id');
        $accessToken = config('services.instagram.access_token');

        if (!$userId || !$accessToken) {
            return [];
        }

        $cacheKey = 'instagram_feed_' . $userId;
        $cachedPosts = Cache::get($cacheKey);

        if (is_array($cachedPosts)) {
            return $cachedPosts;
        }

        $version = config('services.instagram.graph_api_version');

        try {
            $response = Http::acceptJson()
                ->timeout(8)
                ->get("https://graph.instagram.com/{$version}/{$userId}/media", [
                    'fields' => 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp',
                    'limit' => 9,
                    'access_token' => $accessToken,
                ])
                ->throw();
        } catch (ConnectionException $exception) {
            Log::warning('Instagram feed connection failed.');

            return [];
        } catch (RequestException $exception) {
            Log::warning('Instagram feed request failed.', [
                'status' => $exception->response->status(),
            ]);

            return [];
        }

        $media = $response->json('data');

        if (!is_array($media)) {
            Log::warning('Instagram feed response did not contain a media list.');

            return [];
        }

        $posts = collect($media)
            ->filter(function ($post) {
                return is_array($post)
                    && !empty($post['permalink'])
                    && (!empty($post['media_url']) || !empty($post['thumbnail_url']));
            })
            ->map(function ($post) {
                return [
                    'caption' => $post['caption'] ?? 'Instagram post',
                    'image_url' => ($post['media_type'] ?? null) === 'VIDEO'
                        ? ($post['thumbnail_url'] ?? $post['media_url'])
                        : ($post['media_url'] ?? $post['thumbnail_url']),
                    'permalink' => $post['permalink'],
                ];
            })
            ->values()
            ->all();

        Cache::put($cacheKey, $posts, now()->addMinutes(30));

        return $posts;
    }
}
