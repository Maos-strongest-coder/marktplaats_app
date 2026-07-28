<div class="bg-white rounded-lg overflow-hidden">
    <p>category: {{ $advertisement->category->name}}</p>
    @if($advertisement->is_promoted)
    <div class="inline-block bg-yellow-200 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full w-max">
                Promoted
            </div>
    @endif

    <img src="{{asset($advertisement->image_path)}}" class="w-full rouded-lg">

    <a href="{{ route('advertisements.show', $advertisement->id) }}" class="block mt-2 text-lg font-bold text-gray-900 hover:text-blue-500">{{ $advertisement->title }}</a>
    
    @if(request()->routeIs('advertisements.show'))
    <p class="mt-1 text-gray-600">{{ $advertisement->content }}</p>
    @else
    <p class="mt-1 text-gray-600">{{ Str::limit($advertisement->content, 100) }}</p>
    @endif

    <h3 class="text-lg font-bold">${{ $advertisement->price }}</h3>

    

    @if (request()->routeIs('advertisements.show', 'advertisements.my') && Auth()->id() === $advertisement->user_id)
        <div class="p-4 border-t bg-white shrink-0">
            <a href="{{ route('advertisements.edit', $advertisement->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit</a>

            <form action="{{ route('advertisements.destroy', $advertisement->id) }}" method="post" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"  onclick="return confirm('You are about to delete this Advertisement. Are you sure?')">
                    Delete</button>
            </form>
            
    @if (Auth()->id() === $advertisement->user_id && $advertisement->is_promoted == false)
        <a href="{{ route('advertisements.promote', $advertisement->id) }}" class="bg-green-500 text-white px-4 py-2 rounded inline">
            Promote</a>
    @endif
        </div> 
    @endif

    
</div>