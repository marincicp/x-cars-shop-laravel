@props(['carFeatures'])
<div class="col">
    @foreach ($carFeatures as $featureKey => $featureLabel)
        @if ($loop->index % 2 == 0)
            <x-car-feature-checkbox name="car_features[{{ $featureKey }}]" label="{{ $featureLabel }}" />
        @endif
    @endforeach
</div>




<div class="col">
    @foreach ($carFeatures as $featureKey => $featureLabel)
        @if ($loop->index % 2 == 1)
            <x-car-feature-checkbox name="car_features[{{ $featureKey }}]" label="{{ $featureLabel }}" />
        @endif
    @endforeach


</div>
