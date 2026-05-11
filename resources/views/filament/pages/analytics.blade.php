<x-filament-panels::page>

    @php
        $data = $this->getViewData();
        extract($data);
        $brand = '#5A95CF';
    @endphp

    {{-- Range Selector --}}
    <div class="flex items-center gap-3 mb-6">
        <span class="text-sm font-medium text-gray-600">Date Range:</span>
        @foreach(['7' => 'Last 7 Days', '30' => 'Last 30 Days', '90' => 'Last 90 Days'] as $val => $label)
            <button
                wire:click="$set('range', '{{ $val }}')"
                class="px-4 py-1.5 rounded-full text-sm font-medium border transition
                       {{ $range == $val ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-300 hover:border-blue-400' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @foreach([
            ['Today',        $today,      'heroicon-o-sun',            'bg-blue-50',   'text-blue-600'],
            ['Yesterday',    $yesterday,  'heroicon-o-calendar-days',  'bg-purple-50', 'text-purple-600'],
            ['This Week',    $thisWeek,   'heroicon-o-calendar',       'bg-green-50',  'text-green-600'],
            ['Last '.$days.' Days', $totalRange, 'heroicon-o-chart-bar', 'bg-orange-50', 'text-orange-600'],
        ] as [$label, $value, $icon, $bg, $color])
        <div class="rounded-xl border border-gray-200 {{ $bg }} p-5 flex items-center gap-4">
            <div class="p-3 rounded-full bg-white shadow-sm {{ $color }}">
                <x-dynamic-component :component="$icon" class="w-6 h-6" />
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($value) }}</p>
                <p class="text-xs text-gray-500 mt-0.5">{{ $label }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Daily Chart --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-6">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">Daily Visits — Last {{ $days }} Days</h3>
        <canvas id="dailyChart" height="90"></canvas>
    </div>

    {{-- Hourly + Weekday --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Visits by Hour of Day</h3>
            <canvas id="hourlyChart" height="160"></canvas>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Visits by Day of Week</h3>
            <canvas id="weekdayChart" height="160"></canvas>
        </div>
    </div>

    {{-- Continent + Devices --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Visits by Continent</h3>
            @if(count($continentLabels))
                <canvas id="continentChart" height="180"></canvas>
            @else
                <p class="text-sm text-gray-400">No data yet.</p>
            @endif
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Device Breakdown</h3>
            @if($devices->count())
                <canvas id="deviceChart" height="180"></canvas>
            @else
                <p class="text-sm text-gray-400">No data yet.</p>
            @endif
        </div>
    </div>

    {{-- Top Pages + Countries --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Top Pages</h3>
            <table class="w-full text-sm">
                <thead><tr class="text-left text-xs text-gray-400 border-b">
                    <th class="pb-2 font-medium">Page</th>
                    <th class="pb-2 font-medium text-right">Visits</th>
                </tr></thead>
                <tbody>
                @forelse($topPages as $row)
                    <tr class="border-b border-gray-50">
                        <td class="py-2 text-gray-600 truncate max-w-xs">{{ $row->page ?: '/' }}</td>
                        <td class="py-2 text-right font-semibold text-blue-600">{{ number_format($row->visits) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="py-4 text-center text-gray-400">No data yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Top Countries</h3>
            <table class="w-full text-sm">
                <thead><tr class="text-left text-xs text-gray-400 border-b">
                    <th class="pb-2 font-medium">Country</th>
                    <th class="pb-2 font-medium text-right">Visits</th>
                </tr></thead>
                <tbody>
                @forelse($countries as $row)
                    <tr class="border-b border-gray-50">
                        <td class="py-2 text-gray-600">{{ $row->country }}</td>
                        <td class="py-2 text-right font-semibold text-blue-600">{{ number_format($row->visits) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="py-4 text-center text-gray-400">No data yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
    function destroyChart(id) {
        const canvas = document.getElementById(id);
        if (!canvas) return;
        const existing = Chart.getChart(canvas);
        if (existing) existing.destroy();
    }

    function initAnalyticsCharts() {
        const blue   = '#5A95CF';
        const light  = 'rgba(90,149,207,0.15)';
        const colors = ['#5A95CF','#3D7AB8','#F98600','#18185E','#6EBB8A','#E06C75','#C678DD','#56B6C2'];

        ['dailyChart','hourlyChart','weekdayChart','continentChart','deviceChart'].forEach(destroyChart);

        // Daily
        destroyChart('dailyChart');
        new Chart(document.getElementById('dailyChart'), {
            type: 'line',
            data: {
                labels: @json($dailyLabels),
                datasets: [{ label: 'Visits', data: @json($dailyData),
                    borderColor: blue, backgroundColor: light,
                    fill: true, tension: 0.4, pointRadius: 3, pointBackgroundColor: blue }]
            },
            options: { responsive: true, plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
        });

        // Hourly
        new Chart(document.getElementById('hourlyChart'), {
            type: 'bar',
            data: {
                labels: @json($hourlyLabels),
                datasets: [{ label: 'Visits', data: @json($hourlyData),
                    backgroundColor: blue, borderRadius: 4 }]
            },
            options: { responsive: true, plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
        });

        // Weekday
        new Chart(document.getElementById('weekdayChart'), {
            type: 'bar',
            data: {
                labels: @json($weekdayLabels),
                datasets: [{ label: 'Visits', data: @json($weekdayData),
                    backgroundColor: colors.slice(0, 7), borderRadius: 4 }]
            },
            options: { responsive: true, plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
        });

        @if(count($continentLabels))
        if (document.getElementById('continentChart')) {
            new Chart(document.getElementById('continentChart'), {
                type: 'doughnut',
                data: {
                    labels: @json($continentLabels),
                    datasets: [{ data: @json($continentData), backgroundColor: colors, borderWidth: 2 }]
                },
                options: { responsive: true, plugins: { legend: { position: 'right' } } }
            });
        }
        @endif

        @if($devices->count())
        if (document.getElementById('deviceChart')) {
            new Chart(document.getElementById('deviceChart'), {
                type: 'doughnut',
                data: {
                    labels: @json($devices->pluck('device')),
                    datasets: [{ data: @json($devices->pluck('visits')), backgroundColor: colors, borderWidth: 2 }]
                },
                options: { responsive: true, plugins: { legend: { position: 'right' } } }
            });
        }
        @endif
    }

    document.addEventListener('DOMContentLoaded', initAnalyticsCharts);
    document.addEventListener('livewire:updated', initAnalyticsCharts);
    </script>

</x-filament-panels::page>
