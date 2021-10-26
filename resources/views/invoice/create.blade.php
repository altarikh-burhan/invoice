<x-app-layout>
	 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Invoice') }}
        </h2>
    </x-slot>
   	<div class="flex justify-center">
			<div class="w-full mt-3 lg:w-3/4">
				<x-card>
				 	@if (session('error'))
                        <div class="bg-red-500 px-4 py-4 font-medium text-red-100">
                            {{ session('error') }}
                        </div>
                    @endif
					<form action="{{ route('invoice.store') }}" method="post">
						@csrf
						<div class="mb-5">
							<x-label for="customer_id">Pilih Customer</x-label>
							<select name="customer_id" id="customer_id" class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200">
								<option value="" class="text-center">-- Pilih Customer --</option>
								@foreach($customers as $customer)
									<option value="{{ $customer->id }}" class="">{{$customer->name}}</option>
								@endforeach
							</select>
							@error('customer_id')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>
						<x-button>Buat</x-button>
					</form>
				</x-card>
			</div>
		</div>
</x-app-layout>