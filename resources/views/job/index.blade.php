<x-layout>
  <x-breadcrumbs class="mb-4"
    :links="['Jobs' => route('jobs.index')]" />

  <x-card class="mb-4 text-sm" x-data="">
    <form x-ref="filters" id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
      <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
          <div class="mb-1 font-semibold">Search</div>
          <x-text-input name="search" value="{{ request('search') }}"
            placeholder="Search for any text" form-ref="filters" />
        </div>
        <div>
          <div class="mb-1 font-semibold">Salary</div>

          <div class="flex space-x-2">
            <x-text-input name="min_salary" value="{{ request('min_salary') }}"
              placeholder="From" form-ref="filters" />
            <x-text-input name="max_salary" value="{{ request('max_salary') }}"
              placeholder="To" form-ref="filters" />
          </div>
        </div>
        <div>
          <div class="mb-1 font-semibold">Experience</div>

          <x-radio-group name="experience"
            :options="array_combine(
                array_map('ucfirst', \App\Models\Job::$experience),
                \App\Models\Job::$experience,
            )" />
        </div>
        <div>
          <div class="mb-1 font-semibold">Category</div>

          <x-radio-group name="category"
            :options="\App\Models\Job::$category" />
        </div>
      </div>

      <x-button class="w-full">Filter</x-button>
    </form>
  </x-card>

  @foreach ($jobs as $job)
    <x-job-card class="mb-4" :$job>
      <div>
        <x-link-button :href="route('jobs.show', $job)">
          Show
        </x-link-button>
      </div>
    </x-job-card>
  @endforeach
    <div class="flex justify-center">
        <nav class="relative z-0 inline-flex shadow-sm rounded-md">
            <a href="{{ $jobs->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                Previous
            </a>
            @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="{{ $page == $jobs->currentPage() ? 'bg-indigo-500 text-white' : 'bg-white text-gray-500 hover:bg-gray-50' }} relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium">
                    {{ $page }}
                </a>
            @endforeach
            <a href="{{ $jobs->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                Next
            </a>
        </nav>
    </div>



</x-layout>
