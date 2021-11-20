<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer') }}
        </h2>
    </x-slot>
    <x-slot name="script">
    	<script>
	        $(document).ready(function() {
			var table = $('#example').DataTable( {
					responsive: true
				} )
				.columns.adjust()
				.responsive.recalc();
			});
	    </script>
    </x-slot>
    <x-container>
		 <!--Container-->
    	<div class="container w-full mx-auto px-2">	
    		<a href="{{ route('customer.create') }}" class="inline-flex items-center mt-5 px-4 py-2 bg-blue-700 border border-transparent rounded-xl font-semibold text-sm text-white capitalize tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mb-3"> Add Customers</a>

    		@if (session('message'))
            <div class="bg-green-500 px-4 py-4 font-medium text-green-100">
                {{ session('message') }}
            </div>
     		@endif
     		@if (session('error'))
            <div class="bg-red-500 px-4 py-4 font-medium text-red-100">
                {{ session('error') }}
            </div>
     		@endif
			<div id='recipients' class="p-8 mt-6 m-2 lg:mt-0 rounded shadow overflow-hidden border border-black-200">
				<table id="example" class="stripe hover min-w-full divide-y divide-gray-200 mt-3" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead class="bg-gray-50">
							<tr>
								<x-th>#</x-th>
								<x-th>Nama Lengkap</x-th>
								<x-th>No Telepon</x-th>
								<x-th>Alamat</x-th>
								<x-th>Aksi</x-th>
								<x-th>Invoice</x-th>
							</tr>
						</thead>
					<tbody>
						@foreach($customers as $customer)
						<tr>
							<td>{{ $loop->iteration}}</td>
							<td>{{ $customer->name}}</td>
							<td>{{ $customer->phone }}</td>
							<td class="text-center">{{ $customer->address }}</td>
							<td class="px-6 py-4 whitespace-nowrap">
								<div class="flex items-center">
									<div class="ml-4">
										<a class="inline-block border border-green-400 bg-green-400 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-green-500 focus:outline-none focus:shadow-outline" 
				                            href="{{ route('customer.edit', $customer) }}">
				                            View
				                        </a>
				                        <a class="inline-block border border-yellow-400 bg-yellow-400 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-yellow-500 focus:outline-none focus:shadow-outline" 
				                            href="{{ route('customer.edit', $customer) }}">
				                            Edit
				                        </a>
				                        <form class="inline-block" action="{{ route('customer.destroy', $customer) }}" method="POST">
				                        	@method('delete')
				                        	@csrf
				                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure')" >
				                            Hapus
				                        </button>
				                       </form>
									</div>
								</div>
							</td>
							<td>
								<form action="{{ route('invoice.store') }}" method="post">
										@csrf
										<x-input type="hidden" name="customer_id" value="{{ $customer->id }}"></x-input>
										<button class="border border-blue-500 bg-blue-500 text-white rounded-md px-1 py-1 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">Invoice</button>
										</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
      </div>
    </x-container>
</x-app-layout>
		