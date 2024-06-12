<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" id="header"> 
                {{ __('Orders') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 py-8 text-gray-900 dark:text-gray-100">
                    <div class="flex gap-4">
                        <form action="/shop" method="GET" class="w-full">
                            <input type="hidden" name="include" value="dashboard">
                            <x-toggle-button class="w-full justify-center" :active="$include == 'dashboard'">dashboard</x-toggle-button>
                        </form>
                        <form action="/shop" method="GET" class="w-full">
                            <input type="hidden" name="include" value="add">
                            <x-toggle-button class="w-full justify-center" :active="$include == 'add'">add</x-toggle-button>
                        </form>
                    </div>

                    @include('shop.partial.' . $include)
                </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>
</x-app-layout>
