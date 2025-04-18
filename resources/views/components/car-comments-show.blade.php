    <div class="card car-detailed-description">
        <h2 class="car-details-title mb-large">Comments</h2>

        @foreach ($comments as $comment)
            <x-car-comment-item :$comment />
        @endforeach

    </div>
