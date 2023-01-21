<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-3">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class='mx-auto w-full max-w-lg rounded-lg bg-white px-10 py-8 shadow-xl'>
            <div class='mx-auto max-w-md space-y-6'>

              <form action="{{ route('answers.store', ['application' => $application->id]) }}" method="POST">
                @csrf
                <h2 class="text-2xl font-bold">Answer application #{{ $application->id }}</h2>
                <hr class="my-6">

                <label class="text-sm font-bold uppercase opacity-70">ANSWER</label>
                <textarea
                  class="mt-2 mb-4 w-full rounded border-2 border-slate-200 bg-slate-200 p-3 focus:border-slate-600 focus:outline-none"
                  name="body" required cols="30" rows="5"></textarea>

                <input type="submit"
                  class="cursor-pointer rounded bg-emerald-500 py-2 px-6 font-medium text-white duration-300 ease-in-out hover:bg-green-600"
                  value="SUBMIT">
                <a href="{{ route('dashboard') }}" role="button"
                  class="cursor-pointer rounded bg-emerald-500 py-2 px-6 font-medium text-white duration-300 ease-in-out hover:bg-red-600">CANCEL</a>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>