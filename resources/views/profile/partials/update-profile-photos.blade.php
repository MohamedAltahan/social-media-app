<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update profile photos') }}
        </h2>

    </header>


    <form method="post" enctype="multipart/form-data" action="{{ route('profile-photo.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group mx-1 ">
            <img width='200px' src="{{ asset('uploads/' . Auth::guard('web')->user()->avatar) }}" alt="profile_image">
        </div>
        <div class="form-group">
            <x-form.input type="file" class="form-control" name="avatar" label='Select Profile photo' />
        </div>

        <div class="form-group mx-1 ">
            <img width='200px' src="{{ asset('uploads/' . Auth::guard('web')->user()->cover) }}" alt="cover_image">
        </div>
        <div class="form-group">
            <x-form.input type="file" class="form-control" name="cover" label='Select Cover photo' />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
