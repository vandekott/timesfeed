<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class TimesApiService
{
    /**
     * Возвращает массив результатов поиска по ключевой фразе
     * @param string $search Ключевая фраза
     * @param int $page (номер страницы)
     * @param string $sort (newest, oldest, relevance)
     * @return array
     */
    public function getArticles(string $search = '', int $page = 1, string $sort = 'newest'): array
    {
        $url = sprintf(
            'https://api.nytimes.com/svc/search/v2/articlesearch.json?api-key=%s&q=%s&sort=%s&page=%d',
            env('NYTIMES_API_KEY'),
            $search,
            $sort,
            $page
        );

        $response = Http::get($url)->json();

        return $this->parseArticles($response['response']['docs']);
    }

    /**
     * Исключает ненужные данные из ответа API
     * @param array $articles
     * @return array
     */
    private function parseArticles(array $articles): array
    {
        return collect($articles)->map(function ($article) {
            return [
                'title' => $article['headline']['main'] ?? null,
                'url' => $article['web_url'],
                'snippet' => $article['snippet'] ?? null,
                'date' => $article['pub_date'],
                'image' => $article['multimedia'][0]['url'] ?? null,
                'source' => $article['source'] ?? null,
            ];
        })->toArray();
    }
}