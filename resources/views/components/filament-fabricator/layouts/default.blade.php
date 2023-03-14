@props(['page', 'menu'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite('resources/css/app.css')

</head>
<body class="antialiased p-10">


<ul class="prose p-4 mb-12">
    @foreach($mainMenu->items as $item)
        <li class="border-b border-primary-300 pb-4">
            <a href="{{ url($item['data']['url']) }}"
               @if($item['type'] === 'external-link')
                   target="{{ $item['data']['target']}}"
                @endif
            >
                @isset($item['data']['title'])
                    {{$item['data']['title']}}
                @else
                    {{ $item['label'] }}
                @endisset

                @isset($item['data']['description'])
                    <span class="block text-xs">{{$item['data']['description']}}</span>
                @endisset

                @if($item['type'] === 'external-link')
                    <x-heroicon-o-external-link class="inline-block w-4 h-4" />
                @endif
            </a>

            @if($item['children'])
                <ul>
                @foreach($item['children'] as $child)
                    <li>
                        <a href="{{ url($item['data']['url']. '/' . $child['data']['url']) }}">
                            @isset($child['data']['title'])
                                {{$child['data']['title']}}
                            @else
                                {{ $child['label'] }}
                            @endisset
                        </a>
                    </li>
                @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>

@isset($page->parent->title)
    <a href="/{{$page->parent->slug}}">{{$page->parent->title}}</a>
@endif
    <h1 class="text-7xl text-primary-500">{{$page->title}}</h1>

    <x-filament-fabricator::page-blocks :blocks="$page->blocks" />

</body>
</html>
