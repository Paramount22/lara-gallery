<comment-component :comment-data="{{$comment}}" inline-template>

<article class="comment">

    <div class="content"
         ref="input"
         @input="textChanged"
         :contenteditable="editing"
         @keydown.enter="updateComment"
         @keydown.esc="resetText"
         @blur="resetText"
    >
        {{ $comment->text }}
    </div>
    <footer class="meta">
        <div class="meta-info">
            <a href="{{ route('user.posts', $comment->user->id) }}" class="author">
                @<span>{{ $comment->user->name }}</span>
            </a>
            <time datetime="{{ $comment->created_at->toW3cString() }}" class="text-muted">
                {{ $comment->created_at->diffForHumans() }}
            </time>
        </div>

        @can('update', $comment)
            <div class="edit-comment">
                <a href="" class="edit-comment"
                   title="Edit"
                   @click.prevent="startEditing"
                >
                    <i class="fa fa-pen mr-1" ></i>
                </a>

                <a href="{{ url('comment/' . $comment->id . '/delete') }}"
                   class="delete-comment"
                   title="Delete" ><i class="fas fa-trash-alt"></i>
                </a>
            </div>
        @endcan


    </footer>
</article>
</comment-component>
