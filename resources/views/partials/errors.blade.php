@if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif

@if(session('status'))
    <div class="bg-green-600 text-white p-3 mb-4">
        {{session('status')}}
    </div>
@endif

@if(session('message'))
    <div class="bg-green-600 text-white p-3 mb-4">
        {{session('message')}}
    </div>
@endif