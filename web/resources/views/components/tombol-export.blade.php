@props(['modul'])

@php
    $konfig = config("laporan.modul.{$modul}");
    $boleh  = $konfig && in_array(auth()->user()->role, $konfig['roles'], true);
    $format = [
        'xlsx' => 'Excel (.xlsx)',
        'csv'  => 'CSV (.csv)',
        'pdf'  => 'PDF (.pdf)',
        'docx' => 'Word (.docx)',
    ];
@endphp

@if ($boleh)
    <div class="relative" x-data="{ buka: false }" @click.outside="buka = false">

        <button type="button" @click="buka = !buka"
                class="inline-flex items-center gap-2 px-5 py-3 bg-white text-[#164A3A]
                       text-sm font-medium border border-[#164A3A] rounded-lg
                       hover:bg-gray-50 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 3v12m0 0 4-4m-4 4-4-4M5 17v2a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-2" />
            </svg>
            Ekspor
        </button>

        <div x-show="buka" style="display: none;"
             class="absolute right-0 z-20 mt-2 w-48 bg-white border border-gray-200
                    rounded-xl shadow-lg py-1">
            @foreach ($format as $f => $label)
                <a href="{{ route('laporan.export', array_merge(request()->except(['page', 'modul', 'format']), ['modul' => $modul, 'format' => $f])) }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    {{ $label }}
                </a>
            @endforeach
        </div>

    </div>
@endif