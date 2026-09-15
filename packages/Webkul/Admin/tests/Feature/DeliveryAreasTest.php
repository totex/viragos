<?php

use App\Models\DeliveryArea;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\get;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

it('shows the delivery areas index page', function () {
    $this->loginAsAdmin();

    get(route('admin.delivery_areas.index'))
        ->assertOk()
        ->assertSeeText(trans('admin::app.delivery-areas.index.title'))
        ->assertSeeText(trans('admin::app.delivery-areas.index.create-btn'));
});

it('returns delivery areas for the listing datagrid request', function () {
    DeliveryArea::create([
        'name' => 'Central Zone',
        'postal_code' => '1000-1999',
        'delivery_fee' => 12.50,
        'active' => true,
        'sort_order' => 1,
    ]);

    $this->loginAsAdmin();

    get(route('admin.delivery_areas.index'), [
        'X-Requested-With' => 'XMLHttpRequest',
    ])
        ->assertOk()
        ->assertJsonPath('records.0.name', 'Central Zone');
});

it('shows the delivery area create page', function () {
    $this->loginAsAdmin();

    get(route('admin.delivery_areas.create'))
        ->assertOk()
        ->assertSeeText(trans('admin::app.delivery-areas.create.title'));
});

it('validates required delivery area fields', function () {
    $this->loginAsAdmin();

    postJson(route('admin.delivery_areas.store'))
        ->assertJsonValidationErrorFor('name')
        ->assertJsonValidationErrorFor('postal_code')
        ->assertJsonValidationErrorFor('delivery_fee')
        ->assertJsonValidationErrorFor('sort_order')
        ->assertUnprocessable();
});

it('creates updates and deletes a delivery area', function () {
    $this->loginAsAdmin();

    postJson(route('admin.delivery_areas.store'), [
        'name' => 'Central Zone',
        'postal_code' => '1000-1999',
        'delivery_fee' => '12.50',
        'active' => 1,
        'sort_order' => 1,
    ])->assertRedirect(route('admin.delivery_areas.index'));

    $deliveryArea = DeliveryArea::query()->latest('id')->firstOrFail();

    expect($deliveryArea->name)->toBe('Central Zone')
        ->and($deliveryArea->active)->toBeTrue();

    get(route('admin.delivery_areas.edit', $deliveryArea->id))
        ->assertOk()
        ->assertSeeText(trans('admin::app.delivery-areas.edit.title'));

    putJson(route('admin.delivery_areas.update', $deliveryArea->id), [
        'name' => 'Updated Zone',
        'postal_code' => '2000-2999',
        'delivery_fee' => '15.00',
        'sort_order' => 2,
    ])->assertRedirect(route('admin.delivery_areas.index'));

    expect($deliveryArea->fresh()->name)->toBe('Updated Zone')
        ->and($deliveryArea->fresh()->active)->toBeFalse();

    deleteJson(route('admin.delivery_areas.delete', $deliveryArea->id))
        ->assertOk()
        ->assertSeeText(trans('admin::app.delivery-areas.delete-success'));

    expect(DeliveryArea::find($deliveryArea->id))->toBeNull();
});
