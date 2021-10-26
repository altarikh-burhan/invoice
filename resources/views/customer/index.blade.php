<x-app-layout>
	 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer') }}
        </h2>
    </x-slot>

    <x-container>
		<div class="my-2 overflow-x-auto sm:mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
				<a href="{{ route('customer.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-xl font-semibold text-sm text-white capitalize tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mb-3"> Add Customers</a>
				<input class="inline-flex float-right px-4 py-2  border rounded-xl font-semibold text-sm tracking-widest active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mb-3" placeholder="Search"></input>

				<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
					@if (session('message'))
                            <div class="bg-green-500 px-4 py-4 font-medium text-green-100">
                                {{ session('message') }}
                            </div>
                     @endif
					<table class="min-w-full divide-y divide-gray-200 mt-3">
						<thead class="bg-gray-50">
							<tr>
								<x-th>#</x-th>
								<x-th>Nama Lengkap</x-th>
								<x-th>No Telepon</x-th>
								<x-th>Alamat</x-th>
								<x-th colspan="2">Aksi</x-th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($customers as $customer)
							<tr>
								<x-td>{{ $loop->iteration}}</x-td>
								<x-td>{{ $customer->name }}</x-td>
								<x-td>{{ $customer->phone }}</x-td>
								<x-td>{{ $customer->address }}</x-td>
								<td class="px-6 py-4 whitespace-nowrap">
									<div class="flex items-center">
										<div class="ml-4">
											<a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
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
									<button class="border border-blue-500 bg-blue-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">Buat Invoice</button>
									</form>
								</td>		
							</tr>
							@empty
							 <tr>
                                <td class="px-4 py-4 bg-gray-400 font-semibold text-center" colspan="6">Tidak ada data</td>
                            </tr>
							@endforelse
						</tbody>
					</table>
					{{ $customers->links()}}
				</div>
			</div>
		</div>
    </x-container>
</x-app-layout>			