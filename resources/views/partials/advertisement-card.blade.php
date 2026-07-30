<div class="adv-card">
    <p>{{ $advertisement->category->name}}</p>
    
    <div class="adv-card-img-container">
    
        <img src="{{asset($advertisement->image)}}" class="adv-card-img">
    
    </div>
    
    <div class="adv-card-body">

        

        @if(request()->routeIs('advertisements.show'))
            <p class="adv-card-title">
                {{ $advertisement->title }}
            </p>

            <p class="adv-card-text">
                {{ $advertisement->content }}
            </p>
        @else
            <a href="{{ route('advertisements.show', $advertisement->id) }}" class="adv-card-title">
                {{ $advertisement->title }}
            </a>

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

            <form action="{{ route('advertisements.destroy', $advertisement) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit">
                    Delete
                </button>
            </form>
        @endif
    </div>
a