@foreach($list_comment as $comment)

    @if($comment->user['id'] != Auth::user()['id'])
        <!-- Message. Default to the left -->
        <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">{{ $comment->user->profile['name'] }}</span>
                <span class="direct-chat-timestamp float-right">{{ $comment['created_at']->diffForHumans($now) }}</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="{{ asset($comment->user->profile['image']).'?v='.time() }}" alt="message user image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                {{ $comment['message'] }}
            </div>
            <!-- /.direct-chat-text -->

        </div>
    @else
        <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">{{ $comment->user->profile['name'] }}</span>
                <span class="direct-chat-timestamp float-right">{{ $comment['created_at']->diffForHumans($now) }}</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="{{ asset($comment->user->profile['image']).'?v='.time() }}" alt="message user image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text bg-primary">
                {{ $comment['message'] }}
            </div>
            <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->
    @endif


    <hr>
@endforeach
