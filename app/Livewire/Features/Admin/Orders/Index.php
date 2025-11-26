<?php

namespace App\Livewire\Features\Admin\Orders;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Layout('components.layouts.admin')]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public bool $is_edit_mode = false;

    public $order_id;

    #[Rule('required|exists:users,id')]
    public $user_id;

    #[Rule('required|in:new,processing,shipped,delivered,cancelled')]
    public $status;

    #[Rule('required|in:pending,paid,failed,refunded')]
    public $payment_status;

    #[Rule('required|numeric')]
    public $grand_total;

    // Properties for viewing proofs
    public $viewingOrderId = null;
    public $viewingOrder = null;
    public bool $showProofModal = false;

    public function create()
    {
        $this->reset(['is_edit_mode', 'order_id', 'user_id', 'status', 'payment_status', 'grand_total']);
        $this->is_edit_mode = false;
        $this->dispatch('show-modal');
    }

    public function store()
    {
        $this->validate();

        if ($this->is_edit_mode) {
            $order = Order::find($this->order_id);
            $order->update([
                'user_id' => $this->user_id,
                'status' => $this->status,
                'payment_status' => $this->payment_status,
                'grand_total' => $this->grand_total,
            ]);
            $this->dispatch('show-notification', [
                'type' => 'success',
                'message' => 'Order updated successfully.',
            ]);
        } else {
            Order::create([
                'user_id' => $this->user_id,
                'status' => $this->status,
                'payment_status' => $this->payment_status,
                'grand_total' => $this->grand_total,
            ]);
            $this->dispatch('show-notification', [
                'type' => 'success',
                'message' => 'Order created successfully.',
            ]);
        }

        $this->reset(['is_edit_mode', 'order_id', 'user_id', 'status', 'payment_status', 'grand_total']);
        $this->dispatch('hide-modal');
    }

    public function edit($id)
    {
        $order = Order::find($id);
        if ($order) {
            $this->order_id = $order->id;
            $this->user_id = $order->user_id;
            $this->status = $order->status;
            $this->payment_status = $order->payment_status;
            $this->grand_total = $order->grand_total;
            $this->is_edit_mode = true;
            $this->dispatch('show-modal');
        }
    }

    public function delete($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            $this->dispatch('show-notification', [
                'type' => 'success',
                'message' => 'Order deleted successfully.',
            ]);
        } else {
            $this->dispatch('show-notification', [
                'type' => 'error',
                'message' => 'Order not found.',
            ]);
        }
    }

    public function viewOrderProofs($id)
    {
        $this->viewingOrder = Order::with(['user', 'address', 'items.product'])->find($id);
        if ($this->viewingOrder) {
            $this->viewingOrderId = $id;
            $this->showProofModal = true;
        }
    }

    public function closeProofModal()
    {
        $this->showProofModal = false;
        $this->viewingOrderId = null;
        $this->viewingOrder = null;
    }

    public function render()
    {
        $orders = Order::with('user')
            ->where(function ($query) {
                $query->whereHas('user', function ($userQuery) {
                    $userQuery->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhere('id', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(7);

        $users = User::where('role', 'user')->get();

        return view('livewire.features.admin.orders.index', [
            'orders' => $orders,
            'users' => $users,
        ]);
    }
}
