<x-app-layout>
	<x-slot name="header">
		<h1 class="font-semibold text-xl">
			Create your customer
		</h1>
	</x-slot>
	<x-container>
		<div class="flex">
			<div class="w-full mt-3 ">
				<x-card>
				 	@if (session('error'))
                        <div class="bg-red-500 px-4 py-4 font-medium text-red-100">
                            {{ session('error') }}
                        </div>
                    @endif
					<form action="{{ route('customer.store')}}" method="post">
					@csrf
					<div class="grid grid-cols-2 gap-8 ">
						<!-- Customer -->
						<div class="sm:rounded-lg px-2 py-2">
							<div class="mb-5">
								<x-label for="name">Nama Lengkap</x-label>
								<x-input  class="mt-1 w-full" type="text" name="name" id="name" required />
								@error('name')
									<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
								@enderror
							</div>

						<div class="mb-5">
							<x-label for="phone">No Telepon</x-label>
							<x-input  class="mt-1 w-full" type="text" name="phone" id="phone" required />
							@error('phone')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="address">Alamat Lengkap</x-label>
							<x-input  class="mt-1 w-full" type="text" name="address" id="address" required />
							@error('address')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<!-- End -->
					<div class="sm:rounded-lg px-2 py-2">
						<div class="mb-5">
							<x-label for="province_id">Pilih Provinsi</x-label>
								<select name="province_id" id="province_id" class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200" data-placeholder="Select">
								<option value="" class="text-center">-- Pilih Propinsi --</option>
                              	<!-- LOOPING DATA PROVINCE UNTUK DIPILIH OLEH CUSTOMER -->
                                @foreach ($provinces as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
								</select>
								@error('province_id')
									<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
								@enderror
						</div>

						<div class="mb-5">
							<x-label for="city_id">Kabupaten / Kota</x-label>
								<select name="city_id" id="city_id" class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200">
									
								</select>
								@error('city_id')
									<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
								@enderror
						</div>	

						<div class="mb-5">
							<x-label for="district_id">Pilih Kecamatan</x-label>
								<select name="district_id" id="district_id" class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200">
									
								</select>
								@error('district_id')
									<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
								@enderror
						</div>		
						</div>
						</div>
						<x-button>Tambah</x-button>
					</form>
				</x-card>
			</div>
		</div>
		</div>
	</x-container>
</x-app-layout>
@push('javascript')
	<script>
		 $('#province_id').on('click', function() {
            //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
            //DAN MENGIRIMKAN DATA PROVINCE_ID
            $.ajax({
                url: "{{ route('city') }}",
                type: "GET",
                data: { province_id: $(this).val() },
                success: function(html){
                    //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                    $('#city_id').empty()
                    //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                    //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                    $('#city_id').append('Pilih cok')
                    $.each(html.data, function(key, item) {
                        $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })

        //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
        $('#city_id').on('click', function() {
            $.ajax({
                url: "{{ route('district') }}",
                type: "GET",
                data: { city_id: $(this).val() },
                success: function(html){
                    $('#district_id').empty()
                    $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })
    </script>
@endpush