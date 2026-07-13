<div class="bg-white rounded-lg overflow-hidden">

    <img src="{{asset($advertisement->image)}}" class="w-full rouded-lg">

    <a href="{{ route('advertisements.show', $advertisement->id) }}" class="block mt-2 text-lg font-bold text-gray-900 hover:text-blue-500">{{ $advertisement->title }}</a>
    
    @if(route('advertisements.show', $advertisement->id) === request()->url())
    <p class="mt-1 text-gray-600">{{ $advertisement->content }}</p>
    @else
    <p class="mt-1 text-gray-600">{{ Str::limit($advertisement->content, 100) }}</p>
    @endif

    <h3 class="text-lg font-bold">${{ $advertisement->price }}</h3>

</div>