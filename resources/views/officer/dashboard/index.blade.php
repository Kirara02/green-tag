<x-layout>
    <x-slot:page_title>
        @lang('system.officer_dashboard_title')
    </x-slot>

    <div>
        <!-- Header Sambutan -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">@lang('system.officer_dashboard_title')</h1>
            <p class="mt-1 text-sm text-gray-600">@lang('system.officer_dashboard_welcome', ['name' => Auth::user()->name])</p>
        </div>

        <!-- Grid Kartu Statistik -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-sm font-medium text-gray-500">@lang('system.stat_new_complaints_total')</p>
                <p class="mt-1 text-3xl font-semibold text-red-600">
                    {{ $stats['new_complaints_total'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-sm font-medium text-gray-500">@lang('system.stat_my_in_progress')</p>
                <p class="mt-1 text-3xl font-semibold text-yellow-600">{{ $stats['my_in_progress'] }}
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-sm font-medium text-gray-500">@lang('system.stat_today_schedules')</p>
                <p class="mt-1 text-3xl font-semibold text-green-600">
                    {{ $stats['today_schedules_count'] }}</p>
            </div>
        </div>

        <!-- Grid untuk Grafik dan Aktivitas -->
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-900">@lang('system.chart_active_tasks')</h3>
                <div class="mt-4 relative h-64"><canvas id="activeTasksChart"></canvas></div>
            </div>
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-900">@lang('system.chart_your_performance')</h3>
                <p class="text-sm text-gray-500">@lang('system.chart_resolved_complaints_per_day')</p>
                <div class="mt-4 relative h-64"><canvas id="performanceChart"></canvas></div>
            </div>
        </div>

        <!-- Daftar Tugas Hari Ini -->
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900">@lang('system.table_attention_needed')</h3>
                </div>
                <ul class="divide-y divide-gray-200">
                    @forelse($recent_complaints as $complaint)
                        <li class="p-4 hover:bg-gray-50 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">@lang('system.category_' . $complaint->category)</p>
                                <p class="text-sm text-gray-500">
                                    {{ $complaint->bin->location->name ?? 'N/A' }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                @if ($complaint->status == 'new')
                                    <span class="badge-red">@lang('system.status_new')</span>
                                @else<span class="badge-yellow">@lang('system.status_in_progress')</span>
                                @endif
                                <a href="{{ route('officer.complaints.edit', $complaint->id) }}"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-900">@lang('system.table_view_button')</a>
                            </div>
                        </li>
                    @empty
                        <li class="p-4 text-center text-sm text-gray-500">@lang('system.table_no_active_complaints')</li>
                    @endforelse
                </ul>
            </div>
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900">@lang('system.table_today_schedules')</h3>
                </div>
                <ul class="divide-y divide-gray-200">
                    @forelse($today_schedules as $schedule)
                        <li class="p-4">
                            <p class="text-sm font-semibold text-gray-800">{{ $schedule->name }}</p>
                            <p class="text-xs text-gray-500">
                                {{ date('H:i', strtotime($schedule->start_time)) }} -
                                {{ date('H:i', strtotime($schedule->end_time)) }}</p>
                        </li>
                    @empty
                        <li class="p-4 text-center text-sm text-gray-500">@lang('system.table_no_schedules_today')</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .badge-red {
                @apply px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800;
            }

            .badge-yellow {
                @apply px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const activeTasksData = {
                labels: ["@lang('system.chart_label_new_unassigned')", "@lang('system.chart_label_my_tasks')"],
                values: @json($active_tasks_chart['values'])
            };
            const performanceLabels = @json($performance_chart_labels);
            const performanceValues = @json($performance_chart_values);

            const ctxActive = document.getElementById('activeTasksChart')?.getContext('2d');
            if (ctxActive) {
                new Chart(ctxActive, {
                    type: 'doughnut',
                    data: {
                        labels: activeTasksData.labels,
                        datasets: [{
                            data: activeTasksData.values,
                            backgroundColor: ['rgba(239, 68, 68, 0.8)',
                                'rgba(234, 179, 8, 0.8)'
                            ],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
            const ctxPerf = document.getElementById('performanceChart')?.getContext('2d');
            if (ctxPerf) {
                new Chart(ctxPerf, {
                    type: 'bar',
                    data: {
                        labels: performanceLabels,
                        datasets: [{
                            label: "@lang('system.chart_resolved_complaints_label')",
                            data: performanceValues,
                            backgroundColor: 'rgba(22, 163, 74, 0.7)',
                            borderColor: 'rgb(22, 163, 74)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            }
        </script>
    @endpush
</x-layout>
