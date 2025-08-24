<div class="py-12">
    <div class="max-w-4xl mx-auto space-y-10">
        @if ($posts)
            @foreach ($posts as $post)
                <article wire:key="{{ $post->id }}"
                    class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                    <!-- Header -->
                    <header class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-5">
                        <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                        <div class="mt-1 text-blue-100">
                            By <span class="font-semibold">{{ $post->user->name }}</span>
                            on {{ $post->created_at }}
                        </div>
                    </header>

                    <!-- Body -->
                    <div class="p-6">
                        <div class="prose prose-lg max-w-none">
                            <p>{{ $post->content }}</p>
                        </div>

                        <!-- Footer -->
                        <footer class="mt-6 pt-4 border-t bg-gray-50 px-6 py-4">
                            <button type="button" wire:click="editPost"
                                class="text-blue-600 hover:underline font-medium mr-4">
                                Edit
                            </button>
                            <button type="button" wire:click="deletePost({{ $post->id }})"
                                class="text-red-600 hover:underline font-medium">
                                Delete
                            </button>
                        </footer>
                    </div>
                </article>
            @endforeach
        @else
            <p class="text-center text-gray-500">No posts available.</p>
        @endif
    </div>
</div>
