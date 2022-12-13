<?php

namespace App\Http\Livewire;

use App\Services\TimesApiService;
use Illuminate\Support\Collection;
use Livewire\Component;

class Feed extends Component
{
    public string $query = '';
    public string $sort = 'newest';
    public int $page = 1;
    public Collection $articles;

    protected $rules = [
        'query' => 'required|min:3',
        'sort' => 'required|in:newest,oldest,relevance',
        'page' => 'integer|min:1',
    ];

    protected $listeners = ['load-more' => 'loadMore'];

    public function mount()
    {
        $this->articles = collect([]);
    }

    public function loadMore(TimesApiService $service)
    {
        $this->page++;
        $pageArticles = $service->getArticles($this->query, $this->page, $this->sort);
        if (count($pageArticles) > 0) {
            $this->articles = $this->articles->merge($pageArticles);
        }
    }

    public function updatingQuery()
    {
        $this->page = 1;
        $this->articles = collect([]);
    }

    public  function updatingSort()
    {
        $this->articles = collect([]);
        $this->page = 1;
    }

    public function updatedQuery()
    {
        $this->validateOnly('query');
        $this->articles = collect(resolve(TimesApiService::class)
             ->getArticles($this->query, $this->page, $this->sort));
    }

    public function updatedSort()
    {
        $this->validate();
        $this->articles = collect(resolve(TimesApiService::class)
             ->getArticles($this->query, $this->page, $this->sort));
    }

    public function render()
    {
        //dd($this->articles);
        return view('livewire.feed', [
            'search' => htmlentities($this->query),
            'articles' => $this->articles
        ]);
    }
}
