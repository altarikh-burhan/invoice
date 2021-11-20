<x-app-layout>
	<x-slot name="header">
		<h1 class="font-semibold text-xl">
			Edit your customer
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
					<form action="{{ route('customer.update', $customer)}}" method="post">
					@method('put')
					@csrf
					<div class="grid grid-cols-2 gap-8 ">
						<!-- Customer -->
						<div class="sm:rounded-lg px-2 py-2">
							<div class="mb-5">
								<x-label for="name">Nama Lengkap</x-label>
								<x-input  class="mt-1 w-full" type="text" name="name" id="name" value="{{ old('name', $customer->name) }}" required />
								@error('name')
									<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
								@enderror
							</div>

						<div class="mb-5">
							<x-label for="phone">No Telepon</x-label>
							<x-input  class="mt-1 w-full" type="text" name="phone" id="phone" value="{{ old('phone', $customer->phone) }}" required />
							@error('phone')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="address">Alamat Lengkap</x-label>
							<x-input  class="mt-1 w-full" type="text" name="address" id="address" required value="{{ old('address', $customer->address) }}" />
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
								<option value="{{$customer->district->city->province->id }}">{{$customer->district->city->province->name }} </option>
								<option disable>--------------</option>
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
								<option value="{{$customer->district->city->id }}">{{$customer->district->city->name }} </option>
								<option disable>--------------</option>
								</select>
								@error('city_id')
									<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
								@enderror
						</div>	

						<div class="mb-5">
							<x-label for="district">Pilih Kecamatan</x-label>
								<select name="district_id" id="district_id" class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200">
								<option value="{{$customer->district->id }}">{{$customer->district->name }} </option>
								<option disable>--------------</option>
								</select>
								@error('district')
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
	@push('js')
 <script>
            $(document).ready(function() {
            $('#province_id').on('change', function() {
               var provinceID = $(this).val();
               if(provinceID) {
                   $.ajax({
                       url: '/getCity/'+provinceID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#city_id').empty();
                            $('#city_id').append('<option value="" class="text-center">-- Pilih Kota/Kabupaten  --</option>'); 
                            $.each(data, function(key, item){
                                $('#city_id').append('<option value="'+ item.id +'">'+ item.name+'</option>');
                            });
                        }else{
                            $('#city_id').empty();
                        }
                     }
                   });
               }else{
                 $('#city_id').empty();
               }
            });

            $('#city_id').on('change', function() {
               var cityID = $(this).val();
               if(cityID) {
                   $.ajax({
                       url: '/getDistrict/'+cityID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#district_id').empty();
                            $('#district_id').append('<option value="" class="text-center">-- Pilih Kecamatan --</option>'); 
                            $.each(data, function(key, item){
                                $('#district_id').append('<option value="'+ item.id +'">' + item.name+ '</option>');
                            });
                        }else{
                            $('#district_id').empty();
                        }
                     }
                   });
               }else{
                 $('#district_id').empty();
               }
            });
            
            });
        </script>
@endpush
</x-app-layout>