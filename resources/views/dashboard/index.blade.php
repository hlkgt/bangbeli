@extends('app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 lg:grid-rows-6 gap-4">
        @foreach ($categories as $categori)
            @php
                $bgColor = ['bg-red-300', 'bg-blue-300', 'bg-teal-300'];
            @endphp
            <div
                class="lg:row-start-1 col-span-1 lg:col-span-4 rounded-lg shadow-md {{ $bgColor[$categori->id - 1] }} py-6 flex justify-center items-center gap-2 text-xl font-semibold text-white">
                <i class="fa-solid {{ $categori->icon }}"></i>
                <p class="capitalize">{{ $categori->categori }}</p>
            </div>
        @endforeach
        <div class="row-start-1 lg:row-start-2 lg:row-end-7 lg:col-span-12 rounded-xl">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Data bulan dan nilai makanan, minuman, dan camilan
        const data = {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
                "November", "Desember"
            ],
            datasets: [{
                    label: "Makanan",
                    data: [10, 15, 8, 12, 6, 9, 13, 11, 7, 14, 10, 16],
                    backgroundColor: "#fca5a5"
                },
                {
                    label: "Minuman",
                    data: [8, 11, 9, 14, 7, 10, 12, 16, 9, 13, 11, 15],
                    backgroundColor: "#93c5fd"
                },
                {
                    label: "Camilan",
                    data: [5, 7, 10, 6, 9, 11, 8, 14, 10, 12, 7, 13],
                    backgroundColor: "#5eead4"
                }
            ]
        };

        // Konfigurasi chart
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah'
                        },
                        suggestedMin: 0
                    }
                }
            }
        };

        // Membuat chart baru
        const myChart = new Chart(document.getElementById("myChart"), config);
    </script>
@endsection
