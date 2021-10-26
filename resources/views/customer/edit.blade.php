<x-app-layout>
	<x-slot name="header">
		<h1 class="font-semibold text-xl">
			Update your customer
		</h1>
	</x-slot>
	<x-container>
		<div class="flex">
			<div class="w-full mt-3 lg:w-3/4">
				<x-card>
					<form action="{{ route('customer.update', $customer)}}" method="post">
						@method('put')
						@csrf
						<div class="mb-5">
							<x-label for="name">Nama Lengkap</x-label>
							<x-input  class="mt-1 w-full" type="text" name="name" id="name" value="{{ old('name', $customer->name )}}"  />
							@error('name')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="phone">No Telepon</x-label>
							<x-input  class="mt-1 w-full" type="text" name="phone" id="phone" value="{{old('phone', $customer->phone)}}"/>
							@error('phone')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="address">Alamat Lengkap</x-label>
							<textarea class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200" cols="5" rows="5" name="address" id="address">
								{{ $customer->address }}
							</textarea>
							@error('address')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<x-button>Update data</x-button>
					</form>
				</x-card>
			</div>
		</div>
	</x-container>
</x-app-layout>