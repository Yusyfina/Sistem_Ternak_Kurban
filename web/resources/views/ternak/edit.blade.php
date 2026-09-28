@extends('layouts.ternak')

@section('title', 'Edit Ternak')
@section('page-title', 'Edit Ternak')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Edit Data Ternak
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi ternak yang sudah terdaftar.
            </p>
        </div>

        <a href="{{ route('ternak.show', $ternak) }}"
           class="inline-flex items-center justify-center gap-2
                  rounded-lg border border-gray-300 bg-white
                  px-4 py-2.5 text-sm font-semibold text-gray-700
                  transition hover:bg-gray-50">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-4 w-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>

            Kembali ke Detail
        </a>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="flex gap-3">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 shrink-0 text-red-600"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 8v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20h15.6a2 2 0 001.73-2.64l-7.82-13.5a2 2 0 00-3.42 0z" />
                </svg>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Data belum dapat diperbarui.
                    </p>

                    <ul class="mt-1 list-disc pl-5 text-sm text-red-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- FORM --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 px-6 py-5">

            <h2 class="text-lg font-semibold text-gray-900">
                Informasi Ternak
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Kode ternak:
                <span class="font-semibold text-gray-700">
                    {{ $ternak->kode_ternak }}
                </span>
            </p>

        </div>


        <form
            action="{{ route('ternak.update', $ternak) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="space-y-6 p-6">

                {{-- KODE & RFID --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>

                        <label for="kode_ternak"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Kode Ternak
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="kode_ternak"
                            id="kode_ternak"
                            value="{{ old('kode_ternak', $ternak->kode_ternak) }}"
                            maxlength="10"
                            required
                            class="w-full rounded-lg border border-gray-300
                                   bg-white px-4 py-2.5 text-sm text-gray-900
                                   outline-none transition
                                   focus:border-[#164A3A]
                                   focus:ring-2 focus:ring-[#164A3A]/10"
                        >

                        @error('kode_ternak')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="kode_rfid"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Kode RFID
                            <span class="font-normal text-gray-400">(opsional)</span>
                        </label>

                        <input
                            type="text"
                            name="kode_rfid"
                            id="kode_rfid"
                            value="{{ old('kode_rfid', $ternak->kode_rfid) }}"
                            placeholder="Contoh: RFID-0001"
                            class="w-full rounded-lg border border-gray-300
                                   bg-white px-4 py-2.5 text-sm text-gray-900
                                   outline-none transition
                                   focus:border-[#164A3A]
                                   focus:ring-2 focus:ring-[#164A3A]/10"
                        >

                        @error('kode_rfid')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- JENIS & LOKASI --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>

                        <label for="jenis_ternak_id"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Jenis Ternak
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="jenis_ternak_id"
                            id="jenis_ternak_id"
                            required
                            class="w-full rounded-lg border border-gray-300
                                   bg-white px-4 py-2.5 text-sm text-gray-700
                                   outline-none transition
                                   focus:border-[#164A3A]
                                   focus:ring-2 focus:ring-[#164A3A]/10"
                        >

                            <option value="">
                                Pilih jenis ternak
                            </option>

                            @foreach($jenisTernak as $jenis)

                                <option
                                    value="{{ $jenis->id }}"
                                    {{ old('jenis_ternak_id', $ternak->jenis_ternak_id) == $jenis->id ? 'selected' : '' }}
                                >
                                    {{ $jenis->nama_jenis }}
                                    ({{ ucfirst($jenis->spesies) }})
                                </option>

                            @endforeach

                        </select>

                        @error('jenis_ternak_id')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="lokasi_id"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Lokasi Peternakan
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="lokasi_id"
                            id="lokasi_id"
                            required
                            class="w-full rounded-lg border border-gray-300
                                   bg-white px-4 py-2.5 text-sm text-gray-700
                                   outline-none transition
                                   focus:border-[#164A3A]
                                   focus:ring-2 focus:ring-[#164A3A]/10"
                        >

                            <option value="">
                                Pilih lokasi peternakan
                            </option>

                            @foreach($lokasi as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ old('lokasi_id', $ternak->lokasi_id) == $item->id ? 'selected' : '' }}
                                >
                                    {{ $item->nama }}
                                </option>

                            @endforeach

                        </select>

                        @error('lokasi_id')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- STATUS & BOBOT --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>

                        <label for="status"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Status
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="status"
                            id="status"
                            required
                            class="w-full rounded-lg border border-gray-300
                                   bg-white px-4 py-2.5 text-sm text-gray-700
                                   outline-none transition
                                   focus:border-[#164A3A]
                                   focus:ring-2 focus:ring-[#164A3A]/10"
                        >

                            <option value="tersedia"
                                {{ old('status', $ternak->status) === 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="dipesan"
                                {{ old('status', $ternak->status) === 'dipesan' ? 'selected' : '' }}>
                                Dipesan
                            </option>

                            <option value="terkirim"
                                {{ old('status', $ternak->status) === 'terkirim' ? 'selected' : '' }}>
                                Terkirim
                            </option>

                            <option value="disembelih"
                                {{ old('status', $ternak->status) === 'disembelih' ? 'selected' : '' }}>
                                Disembelih
                            </option>

                        </select>

                        @error('status')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="bobot_terakhir"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Bobot Terakhir
                            <span class="font-normal text-gray-400">(opsional)</span>
                        </label>

                        <div class="flex">

                            <input
                                type="number"
                                name="bobot_terakhir"
                                id="bobot_terakhir"
                                value="{{ old('bobot_terakhir', $ternak->bobot_terakhir) }}"
                                min="0"
                                step="0.1"
                                class="w-full rounded-l-lg border border-gray-300
                                       bg-white px-4 py-2.5 text-sm text-gray-900
                                       outline-none transition
                                       focus:border-[#164A3A]
                                       focus:ring-2 focus:ring-[#164A3A]/10"
                            >

                            <span class="inline-flex items-center rounded-r-lg
                                         border border-l-0 border-gray-300
                                         bg-gray-50 px-4 text-sm text-gray-500">
                                kg
                            </span>

                        </div>

                        @error('bobot_terakhir')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-200
                        bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

                <a href="{{ route('ternak.show', $ternak) }}"
                   class="inline-flex items-center justify-center rounded-lg
                          border border-gray-300 bg-white px-5 py-2.5
                          text-sm font-semibold text-gray-700
                          transition hover:bg-gray-50">
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg
                           bg-[#164A3A] px-5 py-2.5 text-sm font-semibold
                           text-white transition hover:bg-[#123d30]"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection