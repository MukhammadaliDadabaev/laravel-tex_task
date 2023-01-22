<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('User Applications') }}
    </h2>
  </x-slot>

  <div class="py-3">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <span class="text-2xl font-bold text-blue-500">My Applications</span>


          <!-- User-post  -->
          @foreach ($applications as $application)
          <div class='flex items-center justify-center py-3'>
            <div class="w-9/12 rounded-xl border bg-white p-5 shadow-md">
              <div class="flex w-full items-center justify-between border-b pb-3">
                <div class="flex items-center space-x-3">
                  <div class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]">
                  </div>
                  <div class="text-lg font-bold text-slate-700">{{ $application->user->name }}
                  </div>
                </div>
                <div class="flex items-center space-x-8">
                  <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">ID:
                    {{ $application->id }}</button>
                  <div class="text-xs text-neutral-500">{{ $application->created_at }}</div>
                </div>
              </div>

              <div class="flex justify-between">

                <div class="flex-1">
                  <div class="mt-2 mb-3">
                    <div class="mb-3 text-xl font-bold">{{ $application->subject }}</div>
                    <div class="text-sm text-neutral-600">{{ $application->message }}</div>
                  </div>

                  <div>
                    <div class="flex items-center justify-between text-slate-500">
                      <div class="flex space-x-4 md:space-x-8">
                        {{ $application->user->email }}
                      </div>
                    </div>
                  </div>
                </div>

                <div>
                  <div
                    class="m-5 flex flex-col rounded-xl border p-5 text-center transition duration-300 hover:bg-gray-100">
                    @if (is_null($application->file_url))
                    <span class="text-red-900">Not file</span>
                    @else
                    <a class="" href="{{ asset('storage/' . $application->file_url) }}" target="_blank">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-12 w-10 cursor-pointer text-green-900">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                      </svg>
                    </a>
                    @endif
                  </div>

                  {{-- @if (! $application->answer()->exists()) --}}
                  @if (auth()->user()->role->name == 'manager')
                  <div class="mt-10">
                    <a href="{{ route('answers.create', ['application' => $application->id]) }}" type="button"
                      class="each-in-out mx-6 rounded bg-green-500 p-2 text-sm text-white transition duration-300 hover:bg-green-600">
                      ANSWER
                    </a>
                  </div>
                  @endif
                  {{-- @endif --}}

                </div>
              </div>

              @if ($application->answer()->exists())
              <div class="">
                <hr class="border-1 mt-2 border-blue-600">
                <h2 class="font-bold text-xl text-cyan-900 mt-1">Answer:</h2>
                <p>{{ $application->answer->body }}</p>
              </div>
              @endif

            </div>
          </div>
          @endforeach
          {{ $applications->links() }}
          <!-- USER-AUTH -->

        </div>
      </div>
    </div>
  </div>
</x-app-layout>