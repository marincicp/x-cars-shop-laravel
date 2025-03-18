@props(['label' => '', 'models' => [], 'defaultValue' => null, 'currentMakerModels' => []])
<x-form.select :$label id="modelSelect" name="model_id">
    <option value="" style="display: block">Model</option>

    @if ($currentMakerModels)
        @foreach ($currentMakerModels as $model)
            <option @if ($defaultValue == $model['id']) selected @endif value="{{ $model['id'] }}">
                {{ $model['name'] }}</option>
        @endforeach

    @endif

</x-form.select>
