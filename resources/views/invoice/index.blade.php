<x-app-layout>
	 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice') }}
        </h2>
    </x-slot>

    <x-container>
		<div class="my-2 overflow-x-auto sm:mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
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
								<x-th>Invoice ID</x-th>
								<x-th>Nama Lengkap</x-th>
								<x-th>No Telepon</x-th>
								<x-th>Total Item</x-th>
								<x-th>Total</x-th>
								<x-th>Aksi</x-th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($invoice as $row)
							<tr>
								<x-td>{{ $loop->iteration}}</x-td>
								<x-td>{{ $row->id }}</x-td>
								<x-td>{{ $row->customer->name }}</x-td>
								<x-td>{{ $row->customer->phone }}</x-td>
								<x-td><span class="px-1 py-1 text-blue-500">{{ $row->detail->count() }} </span>Item</x-td>
								<x-td>{{ number_format($row->total_price)}}</x-td>
								<td class="px-6 py-4 whitespace-nowrap">
									<div class="flex items-center">
										<div class="ml-4">
											<a class="inline-block border border-yellow-700 bg-yellow-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-yellow-800 focus:outline-none focus:shadow-outline" 
					                            href="{{ route('invoice.edit', $row->id )}}">
					                            Edit
					                        </a>
					                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
					                            href="{{ route('invoice.print', $row->id )}}">
					                            Print
					                        </a>
					                        <form class="inline-block" action="{{ route('invoice.destroy', $row->id) }}" method="POST">
					                        	@method('delete')
					                        	@csrf
					                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure')" >
					                            Hapus
					                        </button>
					                       </form>
										</div>
									</div>
								</td>	
							</tr>
							@empty
							 <tr>
                                <td class="px-4 py-4 bg-gray-400 font-semibold text-center" colspan="6">Tidak ada data</td>
                            </tr>
							@endforelse
						</tbody>
					</table>
					{{ $invoice->links()}}
				</div>
			</div>
		</div>
    </x-container>
</x-app-layout>			