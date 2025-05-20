<div class="flex flex-col mb-4">
    <div class="text-2xl font-semibold text-gray-800">
        {{ $breadcrumb->list[count($breadcrumb->list) - 1] ?? 'Dashboard' }}
    </div>
    <div class="text-sm text-gray-500 font-medium">
        @foreach ($breadcrumb->list as $key => $value)
            @if ($key == count($breadcrumb->list) - 1)
                <span class="text-primary">{{ $value }}</span>
            @else
                {{ $value }}&nbsp;-&nbsp;
            @endif
        @endforeach
    </div>
</div>