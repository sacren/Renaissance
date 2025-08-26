<div class="py-12">
    <h2 class="text-2xl font-semibold mb-4">Create a New Post</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="savePost" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" wire:model="title"
                class="mt-1 block w-full border-gray-300 rounded-md
                    shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter post title">
            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" wire:model="content" rows="5"
                class="mt-1 block w-full border-gray-300 rounded-md
                    shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Write your post here..."></textarea>
            @error('content')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent
                    shadow-sm text-sm font-medium rounded-md text-white bg-blue-600
                    hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                    focus:ring-blue-500">
                Save Post
            </button>
        </div>
    </form>

    <hr class="my-6 border-gray-300">

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
