<x-app-layout>
    <div class="py-12">
        <div class="w-3/4 mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('comments.store') }}" method="POST" class="px-5 mb-4 p-6">
                @csrf
                <textarea name="content" id="content" rows="2" class="w-full border-gray-200 rounded" required></textarea>
                <input type="submit" value="Comment" class="text-white bg-gray-800 p-2 rounded">
            </form>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($comments as $comment)
                        <div class="bg-gray-100 p-4 mb-4 rounded shadow">
                            <h3>
                                <strong>{{ $comment->user->name }}</strong>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </h3>
                            <p>{{ $comment->content }}</p>

                            <form action="{{ route('replies.store', $comment->id) }}" method="POST" class="px-5 mb-4">
                                @csrf
                                <input type="text" name="content" id="content"
                                    class="w-full text-xs text-gray-500 border-gray-200 p-2 bg-gray-100 rounded"
                                    placeholder="Answer something" required>
                            </form>
                        </div>
                        @foreach ($comment->replies as $reply)
                            <p class="ml-4 mb-4">
                                - {{ $reply->content }}
                                <strong>{{ $reply->user->name }}</strong>
                                <small>{{ $reply->created_at->diffForHumans() }}</small>
                            </p>
                        @endforeach
                    @endforeach

                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
