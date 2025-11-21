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

    #[Layout('components.layouts.admin')]
    public $search = '';

    public bool $is_edit_mode = false;

    public $order_id;

    #[Rule('required|exists:users,id')]
    public $user_id;

    #[Rule('required|in:pending,paid,cancelled')]
    public $status;

    #[Rule('required|numeric')]
    public $grand_total;

    public function create()
    {
        $this->reset(['is_edit_mode', 'order_id', 'user_id', 'status', 'grand_total']);
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
                'grand_total' => $this->grand_total,
            ]);
            $this->dispatch('show-notification', [
                'type' => 'success',
                'message' => 'Order created successfully.',
            ]);
        }

        $this->reset(['is_edit_mode', 'order_id', 'user_id', 'status', 'grand_total']);
        $this->dispatch('hide-modal');
    }

    public function edit($id)
    {
        $order = Order::find($id);
        if ($order) {
            $this->order_id = $order->id;
            $this->user_id = $order->user_id;
            $this->status = $order->status;
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

    public function render()
    {
        $orders = Order::with('user')
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhere('id', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(3);

        $users = User::where('role', 'user')->get();

        return view('livewire.features.admin.orders.index', [
            'orders' => $orders,
            'users' => $users,
        ]);
    }
}
