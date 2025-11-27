@props([
    'name',
    'saveAddAnother' => null,
    'cancelRoute',
    'color' => 'btn-green',
])

<div class="flex justify-between items-center">
    <div class="">
        <button class="btn {{$color}} btn-md btn-rounded" type="submit" name="action" value="save">{{$name}}</button>
        @if($saveAddAnother)
            <button class="btn {{$color}} btn-md btn-outline" type="submit" name="action" value="save_add">{{$name}} &
                Add Another
            </button>
        @endif

    </div>
    <a class="text-red-600 hover:underline" href="{{ $cancelRoute }}">Cancel</a>
</div>

