<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Repositories\DeliveryAreaRepository;
use Webkul\Admin\DataGrids\DeliveryAreaDataGrid;
use Webkul\Admin\Http\Requests\DeliveryAreaRequest;

class DeliveryAreaController extends Controller
{
    public function __construct(protected DeliveryAreaRepository $deliveryAreaRepository) {}

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(DeliveryAreaDataGrid::class)->process();
        }

        return view('admin::delivery-areas.index');
    }

    public function create()
    {
        return view('admin::delivery-areas.create');
    }

    public function store(DeliveryAreaRequest $request)
    {
        $data = $request->validated();
        $data['active'] = $request->boolean('active');

        $this->deliveryAreaRepository->create($data);

        session()->flash('success', trans('admin::app.delivery-areas.create-success'));

        return redirect()->route('admin.delivery_areas.index');
    }

    public function edit(int $id)
    {
        $deliveryArea = $this->deliveryAreaRepository->findOrFail($id);

        return view('admin::delivery-areas.edit', compact('deliveryArea'));
    }

    public function update(DeliveryAreaRequest $request, int $id)
    {
        $data = $request->validated();
        $data['active'] = $request->boolean('active');

        $this->deliveryAreaRepository->update($data, $id);

        session()->flash('success', trans('admin::app.delivery-areas.update-success'));

        return redirect()->route('admin.delivery_areas.index');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deliveryAreaRepository->delete($id);

        return new JsonResponse([
            'message' => trans('admin::app.delivery-areas.delete-success'),
        ]);
    }
}
