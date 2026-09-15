<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.delivery-areas.edit.title')
    </x-slot>

    <x-admin::form :action="route('admin.delivery_areas.update', $deliveryArea->id)" method="PUT">
        <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
            <p class="text-xl font-bold text-gray-800 dark:text-white">
                @lang('admin::app.delivery-areas.edit.title')
            </p>

            <div class="flex items-center gap-x-2.5">
                <a href="{{ route('admin.delivery_areas.index') }}" class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800">
                    @lang('admin::app.delivery-areas.edit.back-btn')
                </a>

                <button type="submit" class="primary-button">
                    @lang('admin::app.delivery-areas.edit.save-btn')
                </button>
            </div>
        </div>

        <div class="mt-3.5 max-w-3xl">
            <div class="box-shadow rounded bg-white p-4 dark:bg-gray-900">
                <p class="mb-4 text-base font-semibold text-gray-800 dark:text-white">
                    @lang('admin::app.delivery-areas.edit.general')
                </p>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label class="required">
                        @lang('admin::app.delivery-areas.edit.name')
                    </x-admin::form.control-group.label>
                    <x-admin::form.control-group.control
                        type="text"
                        id="name"
                        name="name"
                        rules="required"
                        :value="old('name', $deliveryArea->name)"
                        :label="trans('admin::app.delivery-areas.edit.name')"
                        :placeholder="trans('admin::app.delivery-areas.edit.name')"
                    />
                    <x-admin::form.control-group.error control-name="name" />
                </x-admin::form.control-group>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label class="required">
                        @lang('admin::app.delivery-areas.edit.postal-code')
                    </x-admin::form.control-group.label>
                    <x-admin::form.control-group.control
                        type="text"
                        id="postal_code"
                        name="postal_code"
                        rules="required"
                        :value="old('postal_code', $deliveryArea->postal_code)"
                        :label="trans('admin::app.delivery-areas.edit.postal-code')"
                        :placeholder="trans('admin::app.delivery-areas.edit.postal-code')"
                    />
                    <x-admin::form.control-group.error control-name="postal_code" />
                </x-admin::form.control-group>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label class="required">
                        @lang('admin::app.delivery-areas.edit.delivery-fee')
                    </x-admin::form.control-group.label>
                    <x-admin::form.control-group.control
                        type="text"
                        id="delivery_fee"
                        name="delivery_fee"
                        rules="required|numeric|min:0"
                        :value="old('delivery_fee', $deliveryArea->delivery_fee)"
                        :label="trans('admin::app.delivery-areas.edit.delivery-fee')"
                        :placeholder="trans('admin::app.delivery-areas.edit.delivery-fee')"
                    />
                    <x-admin::form.control-group.error control-name="delivery_fee" />
                </x-admin::form.control-group>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label class="required">
                        @lang('admin::app.delivery-areas.edit.sort-order')
                    </x-admin::form.control-group.label>
                    <x-admin::form.control-group.control
                        type="text"
                        id="sort_order"
                        name="sort_order"
                        rules="required|integer|min:0"
                        :value="old('sort_order', $deliveryArea->sort_order)"
                        :label="trans('admin::app.delivery-areas.edit.sort-order')"
                        :placeholder="trans('admin::app.delivery-areas.edit.sort-order')"
                    />
                    <x-admin::form.control-group.error control-name="sort_order" />
                </x-admin::form.control-group>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label>
                        @lang('admin::app.delivery-areas.edit.active')
                    </x-admin::form.control-group.label>
                    <x-admin::form.control-group.control
                        type="switch"
                        id="active"
                        name="active"
                        value="1"
                        :checked="old('active', $deliveryArea->active)"
                        :label="trans('admin::app.delivery-areas.edit.active')"
                    />
                    <x-admin::form.control-group.error control-name="active" />
                </x-admin::form.control-group>
            </div>
        </div>
    </x-admin::form>
</x-admin::layouts>
