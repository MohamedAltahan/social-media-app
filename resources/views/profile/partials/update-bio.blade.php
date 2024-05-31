<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update profile Bio') }}
        </h2>

    </header>


    <form method="post" enctype="multipart/form-data" action="{{ route('profile-bio.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <x-form.input type="text" class="form-control" name="bio" label='Your bio here'
                value="{{ Auth::user()->bio }}" />
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
