@props(['label' => '', 'models' => [], 'defaultValue' => null])
<x-form.select :$label id="modelSelect" name="model_id">
    <option value="" style="display: block">Model</option>

    <?php
    // dd($defaultValue);
    ?>
    {{-- @if ($models)
        @foreach ($models as $model)
            <option value="{{ $model['id'] }}" <?php
            $defaultValue == $model['id'] ? 'selected' : '';
            ?> style="display: block">{{ $model['name'] }}
            </option>
        @endforeach
    @endif --}}

</x-form.select>
