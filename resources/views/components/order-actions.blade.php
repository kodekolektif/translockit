<div class="flex items-center justify-center gap-2">
    <form method="POST" action="{{ route('admin.order.decrement', $record->id) }}">
        @csrf
        <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">-</button>
    </form>

    <span class="font-medium text-gray-800">{{ $value }}</span>

    <form method="POST" action="{{ route('admin.order.increment', $record->id) }}">
        @csrf
        <button class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded">+</button>
    </form>
</div>
