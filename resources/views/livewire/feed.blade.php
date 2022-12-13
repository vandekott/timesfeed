<div>
    <div class="flex flex-col justify-center">
        <div class="mb-4 flex flex-col shadow-2xl">
            <div class="relative flex w-full items-center">
                <input wire:model.debounce.500ms="query" type="text" name="search"
                       id="search" placeholder="Поиск новостей"
                       class="block w-full border-8 border-black p-3 pr-12 text-lg font-bold shadow-md focus:ring-1 focus:ring-primary-600 border-primary-600 sm:text-2xl">
                <div wire:loading.class.remove="hidden" class="absolute top-0 right-0 mt-5 mr-4 hidden">
                    <svg class="h-8 w-8 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                    </svg>
                </div>
            </div>
            <div class="mt-1" x-data="{ 'sort': @entangle('sort') }">
                <select x-model="sort" id="location" name="location" class="block w-full border-8 border-black p-3 pr-12 text-lg font-bold shadow-md border-primary-600 sm:text-2xl">
                    <option value="newest">Сначала новые</option>
                    <option value="oldest">Сначала старые</option>
                    <option value="relevance">По релевантности</option>
                </select>
            </div>
        </div>
        <div class="max-h-fit w-full">
            @if(count($articles) > 0)
                <ul role="list" class="max-w-lg mx-auto grid gap-5 lg:grid-cols-3 lg:max-w-none">
                    @foreach($articles as $article)
                        <li class="group px-4 py-4 sm:px-0">
                            <div class="flex flex-col shadow-lg overflow-hidden">
                                <div class="flex-shrink-0">
                                    <img class="h-48 w-full object-cover" src="{!! (!empty($article['image'])) ? '//nytimes.com/' . $article['image'] : '//placekitten.com/g/500/300' !!}" alt="{{!empty($article['snippet']) ? $article['snippet'] : ''}}">
                                </div>
                                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                                    <div class="flex-1">
                                        <a href="{!! $article['url'] !!}" target="_blank" class="block mt-2">
                                            <p class="group-hover:underline inline-flex text-xl font-semibold text-gray-900">
                                                {{ str($article['title'])->limit(120) }}
                                            </p>
                                            @if(!empty($article['snippet']))
                                                <p class="mt-3 text-base text-gray-500">{{ $article['snippet'] }}</p>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="mt-6 flex items-center">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                <span class="hover:underline"> {{ $article['source'] ?? 'Источник неизвестен' }} </span>
                                            </p>
                                            <div class="flex space-x-1 text-sm text-gray-500">
                                                <time datetime="{{ \Illuminate\Support\Carbon::parse($article['date'])->toDateString() }}">
                                                    {{ \Illuminate\Support\Carbon::parse($article['date'])->translatedFormat('d F Y, H:i') }}
                                                </time>
                                                <span aria-hidden="true"> &middot; </span>
                                                <span> {{ str_replace('до', 'назад', \Illuminate\Support\Carbon::parse($article['date'])->longRelativeDiffForHumans(\Illuminate\Support\Carbon::now())) }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @elseif(empty($query))
                <div class="mt-16 flex justify-center">
                    <p class="text-2xl font-bold">Введите запрос для поиска...</p>
                </div>
            @else
                <div class="mt-16 flex justify-center">
                    <p class="text-2xl font-bold">Нет результатов</p>
                </div>
            @endif

        </div>
    </div>
    <div class="w-full flex justify-center items-center h-32">
        <div wire:loading.class.remove="hidden" class="hidden">
            <svg class="h-16 w-16 animate-spin text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
            </svg>
        </div>
    </div>
</div>
