<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create your own shop') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Sells books to others to share the stories') }}
        </p>
    </header>

    <form method="post" action="/shop" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="shop_name" :value="__('Shop name')" />
            <x-text-input id="shop_name" name="shop_name" type="text" class="mt-1 block w-full" autocomplete="off" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
</section>
