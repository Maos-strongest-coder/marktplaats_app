<div class="adv-card">
    <p>category: {{ $advertisement->category->name}}</p>
    
    <div class="adv-card-image-wrapper">
    
        <img src="{{asset($advertisement->image)}}" class="adv-card-img">
    
    </div>
    
    <div class="adv-card-body">

        <a href="{{ route('advertisements.show', $advertisement->id) }}" class="adv-card-title">
            {{ $advertisement->title }}
        </a>

        @if(request()->routeIs('advertisements.show'))
            <p class="adv-card-text">
                {{ $advertisement->content }}
            </p>
        @else
            <p class="adv-card-text">
                {{ Str::limit($advertisement->content, 100) }}
            </p>
        @endif
    </div>   
    
    <div class="adv-card-footer">

        <span class="adv-card-price">
            ${{ $advertisement->price }}
        </span>

        
        @if (request()->routeIs('advertisements.show', 'advertisements.my') && Auth()->id() === $advertisement->user_id)
            <a href="{{ route('advertisements.edit', $advertisement->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>

            <a>
                Delete
            </a>
        @endif
    </div>
    
        
    

    @if (request()->routeIs('advertisements.show', 'advertisements.my') && Auth()->id() === $advertisement->user_id)
        <div class="p-4 border-t bg-white shrink-0">
            <a href="{{ route('advertisements.edit', $advertisement->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit</a>

            <a href="{{ route('advertisements.destroy', $advertisement->id) }}">
                Delete
            </a>
        </div>
    @endif
</div>