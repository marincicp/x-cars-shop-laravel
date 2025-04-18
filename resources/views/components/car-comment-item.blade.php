<div class="comment-box mb-large ">
    <div class="flex items-center justify-between">
        <h4 class="car-detail-owner">{{ $comment->user->name }} </h4>


        <div>
            <span class="text-muted">{{ $comment->created_at }}</span>
            @can('comment-delete', $comment)
                <x-form.form method="POST" extraMethod="DELETE" action="{{ route('comment.destroy', $comment) }}">
                    @csrf
                    <button class="btn btn-primary btn-submit">Delete</button>
                </x-form.form>
            @endcan
        </div>
    </div>

    <div class="text-muted italic">{{ $comment->comment }}</div>

</div>
