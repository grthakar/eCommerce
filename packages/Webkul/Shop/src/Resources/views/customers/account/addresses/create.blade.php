<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.addresses.add-address')
    </x-slot>

    <!-- Breadcrumbs -->
    @section('breadcrumbs')
        <x-shop::breadcrumbs name="addresses.create" />
    @endSection

    <h2 class="mb-8 text-2xl font-medium">
        @lang('shop::app.customers.account.addresses.add-address')
    </h2>

    {!! view_render_event('bagisto.shop.customers.account.addresses.create.before') !!}

    <!-- Create Address Form -->
    <x-shop::form :action="route('shop.customers.account.addresses.store')">
        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.before') !!}

        <!--Company Name -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label>
                @lang('shop::app.customers.account.addresses.company-name')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="company_name"
                :value="old('company_name')"
                :label="trans('shop::app.customers.account.addresses.company-name')"
                :placeholder="trans('shop::app.customers.account.addresses.company-name')"
            />

            <x-shop::form.control-group.error control-name="company_name" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.company_name.after') !!}

        <!-- First Name -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label class="required">
                @lang('shop::app.customers.account.addresses.first-name')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="first_name"
                rules="required"
                :value="old('first_name')"
                :label="trans('shop::app.customers.account.addresses.first-name')"
                :placeholder="trans('shop::app.customers.account.addresses.first-name')"
            />

            <x-shop::form.control-group.error control-name="first_name" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.first_name.after') !!}

        <!-- Last Name  -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label class="required">
                @lang('shop::app.customers.account.addresses.last-name')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="last_name"
                rules="required"
                :value="old('last_name')"
                :label="trans('shop::app.customers.account.addresses.last-name')"
                :placeholder="trans('shop::app.customers.account.addresses.last-name')"
            />

            <x-shop::form.control-group.error control-name="last_name" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.last_name.after') !!}

        <!-- Vat Id -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label>
                @lang('shop::app.customers.account.addresses.vat-id')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="vat_id"
                :value="old('vat_id')"
                :label="trans('shop::app.customers.account.addresses.vat-id')"
                :placeholder="trans('shop::app.customers.account.addresses.vat-id')"
            />

            <x-shop::form.control-group.error control-name="vat_id" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.vat_id.after') !!}

        <!-- Street Address -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label class="required">
                @lang('shop::app.customers.account.addresses.street-address')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="address1[]"
                rules="required|address"
                :value="old('address1[]')"
                :label="trans('shop::app.customers.account.addresses.street-address')"
                :placeholder="trans('shop::app.customers.account.addresses.street-address')"
            />

            <x-shop::form.control-group.error control-name="address1[]" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.street_address.after') !!}

        @if (
            core()->getConfigData('customer.address.information.street_lines')
            && core()->getConfigData('customer.address.information.street_lines') > 1
        )
            @for ($i = 2; $i <= core()->getConfigData('customer.address.information.street_lines'); $i++)
                <x-shop::form.control-group.control
                    type="text"
                    name="address{{ $i }}[]"
                    :value="old('address{{ $i }}[]')"
                    :label="trans('shop::app.customers.account.addresses.street-address')"
                    :placeholder="trans('shop::app.customers.account.addresses.street-address')"
                />
            @endfor
        @endif

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.street_address.after') !!}

        <!-- Country -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label class="{{ core()->isCountryRequired() ? 'required' : '' }}">
                @lang('shop::app.customers.account.addresses.country')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="select"
                name="country"
                rules="{{ core()->isCountryRequired() ? 'required' : '' }}"
                :value="old('country')"
                aria-label="trans('shop::app.customers.account.addresses.country')"
                :label="trans('shop::app.customers.account.addresses.country')"
            >
                <option value="">@lang('Select Country')</option>

                @foreach (core()->countries() as $country)
                    <option 
                        {{ $country->code === config('app.default_country') ? 'selected' : '' }}  
                        value="{{ $country->code }}"
                    >
                        {{ $country->name }}
                    </option>
                @endforeach
            </x-shop::form.control-group.control>

            <x-shop::form.control-group.error control-name="country" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.country.after') !!}

        <!-- State -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label class="{{ core()->isStateRequired() ? 'required' : '' }}">
                @lang('shop::app.customers.account.addresses.state')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="state"
                rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                :value="old('state')"
                :label="trans('shop::app.customers.account.addresses.state')"
                :placeholder="trans('shop::app.customers.account.addresses.state')"
            />

            <x-shop::form.control-group.error control-name="state" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.state.after') !!}

        <!-- City -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label class="required">
                @lang('shop::app.customers.account.addresses.city')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="city"
                rules="required"
                :value="old('city')"
                :label="trans('shop::app.customers.account.addresses.city')"
                :placeholder="trans('shop::app.customers.account.addresses.city')"
            />

            <x-shop::form.control-group.error control-name="city" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.city.after') !!}

        <!-- Post Code -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label class="{{ core()->isPostCodeRequired() ? 'required' : '' }}">
                @lang('shop::app.customers.account.addresses.post-code')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="postcode"
                rules="{{ core()->isPostCodeRequired() ? 'required' : '' }}|numeric"
                :value="old('postcode')"
                :label="trans('shop::app.customers.account.addresses.post-code')"
                :placeholder="trans('shop::app.customers.account.addresses.post-code')"
            />

            <x-shop::form.control-group.error control-name="postcode" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.postcode.after') !!}

        <!-- Contact -->
        <x-shop::form.control-group>
            <x-shop::form.control-group.label class="required">
                @lang('shop::app.customers.account.addresses.phone')
            </x-shop::form.control-group.label>

            <x-shop::form.control-group.control
                type="text"
                name="phone"
                rules="required|integer"
                :value="old('phone')"
                :label="trans('shop::app.customers.account.addresses.phone')"
                :placeholder="trans('shop::app.customers.account.addresses.phone')"
            />

            <x-shop::form.control-group.error control-name="phone" />
        </x-shop::form.control-group>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.after') !!}

        <!-- Set As Default -->
        <div class="flex gap-x-1.5 items-center mb-4 text-md text-[#6E6E6E] select-none">
            <input
                type="checkbox"
                name="default_address"
                value="1"
                id="default_address"
                class="hidden peer cursor-pointer"
            >

            <label
                class="icon-uncheck text-2xl text-navyBlue peer-checked:icon-check-box peer-checked:text-navyBlue cursor-pointer"
                for="default_address"
            >
            </label>

            <label 
                class="block text-base cursor-pointer"
                for="default_address"
            >
                @lang('shop::app.customers.account.addresses.set-as-default')
            </label>
        </div>

        <button
            type="submit"
            class="primary-button m-0 block text-base w-max py-3 px-11 rounded-2xl text-center"
        >
            @lang('shop::app.customers.account.addresses.save')
        </button>

        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.after') !!}

    </x-shop::form>

    {!! view_render_event('bagisto.shop.customers.account.address.create.after') !!}

</x-shop::layouts.account>
