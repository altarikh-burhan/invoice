<x-app-layout>
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
					<div class="sm:rounded-lg px-2 py-2">
						<div class="mb-5">
							<x-label for="province_id">Pilih Provinsi</x-label>
								<select name="province" id="province" class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200" data-placeholder="Select">
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
								<select name="city" id="city" class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200">
								</select>
						</div>	

						<div class="mb-5">
							<x-label for="district_id">Pilih Kecamatan</x-label>
								<select name="district" id="district" class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200">
						</div>		
					</form>
				</x-card>
			</div>
		</div>
		</div>
	</x-container>

</x-app-layout>
