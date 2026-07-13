<div class="bg-white rounded-lg overflow-hidden">

    <img src="{{asset($advertisement->image)}}" class="w-full rouded-lg">

    <a href="{{ route('advertisements.show', $advertisement->id) }}">{{$advertisement->title}}</a>
    

    <h3 class="text-lg font-bold">${{ $advertisement->price }}</h3>

</div>