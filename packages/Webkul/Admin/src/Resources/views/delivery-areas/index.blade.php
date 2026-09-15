<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.delivery-areas.index.title')
    </x-slot>

    <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            @lang('admin::app.delivery-areas.index.title')
        </p>

        @if (bouncer()->hasPermission('delivery_areas.create'))
            <a href="{{ route('admin.delivery_areas.create') }}">
                <div class="primary-button">
                    @lang('admin::app.delivery-areas.index.create-btn')
                </div>
            </a>
        @endif
    </div>

    {!! view_render_event('bagisto.admin.delivery_areas.list.before') !!}

    <x-admin::datagrid :src="route('admin.delivery_areas.index')" />

    {!! view_render_event('bagisto.admin.delivery_areas.list.after') !!}
</x-admin::layouts>
