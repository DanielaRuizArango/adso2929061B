@forelse($adopts as $adopt)
            <div class="avatar-group mt-2 -space-x-6">
                <div class="avatar">
                    <div class="w-36">
                    <img src="{{ asset('images/users/'.$adopt->user->photo) }}" />
                    </div>
                </div>
                <div class="avatar">
                    <div class="w-36">
                    <img src="{{ asset('images/pets/'.$adopt->pet->image) }}" />
                    </div>
                </div>
            </div>
            <h4 class="text-white">
                <span class="underline font-bold">{{ $adopt->pet->name}}</span>
                was adopted by
                <span class="underline font-bold">{{ $adopt->user->fullname}}</span>
                {{ $adopt->created_at->diffforhumans() }}
            </h4>
            <a href="{{ url('adoptions/'.$adopt->id) }}" class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M152,112a8,8,0,0,1-8,8H120v24a8,8,0,0,1-16,0V120H80a8,8,0,0,1,0-16h24V80a8,8,0,0,1,16,0v24h24A8,8,0,0,1,152,112Zm77.66,117.66a8,8,0,0,1-11.32,0l-50.06-50.07a88.11,88.11,0,1,1,11.31-11.31l50.07,50.06A8,8,0,0,1,229.66,229.66ZM112,184a72,72,0,1,0-72-72A72.08,72.08,0,0,0,112,184Z"></path>
                </svg>
                Show more
            </a>
            <span class="border-b-1 border-dashed mt-2 border-[#fff6] h-2 w-12/12"></span>
        @empty
            <div class="flex flex-col items-center justify-center gap-4 py-18">
                <span class="font-bold text-2xl text-center text-white">No Results:</span>
                <p class="text-center text-white/70"><small>Adoptions not found, try again!</small></p>
                <a href="{{ url('adoptions') }}" class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white">
                    Back to Adoptions
                </a>
            </div>
        @endforelse
    </div>

@endsection