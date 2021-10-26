<x-app-layout>
	 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <x-container>
		<div class="my-2 overflow-x-auto sm:mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
				<a href="{{ route('product.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-xl font-semibold text-sm text-white capitalize tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mb-3"> Add Products</a>
				<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
					@if (session('message'))
                            <div class="bg-green-500 px-4 py-4 font-medium text-green-100">
                                {{ session('message') }}
                            </div>
                     @endif
					<table class="min-w-full divide-y divide-gray-200 mt-3">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									#
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Nama Produk
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Harga
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Stok
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Tanggal
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($products as $product)
							<tr>
								<td class="px-2 py-2 whitespace-nowrap">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm font-medium text-gray-900">{{ $loop->iteration}}</div>
										</div>
									</div>
								</td>

								<td class="px-6 py-4 whitespace-nowrap">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm font-medium text-gray-900">{{ $product->title }}</div>
										</div>
									</div>
								</td>

								<td class="px-6 py-4 whitespace-nowrap">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm font-medium text-gray-900">Rp. {{ number_format($product->price) }} </div>
										</div>
									</div>
								</td>

								<td class="px-6 py-4 whitespace-nowrap">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm font-medium text-gray-900">{{ $product->stock }} </div>
										</div>
									</div>
								</td>

								<td class="px-6 py-4 whitespace-nowrap">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm font-medium text-gray-900">
												{{ $product->created_at->format('d M Y') }}
											</div>
										</div>
									</div>
								</td>

								<td class="px-6 py-4 whitespace-nowrap">
									<div class="flex items-center">
										<div class="ml-4">
											<a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
					                            href="{{ route('product.edit', $product) }}">
					                            Edit
					                        </a>
					                        <form class="inline-block" action="{{ route('product.destroy', $product) }}" method="POST">
					                        	@method('delete')
					                        	@csrf
					                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
					                            Hapus
					                        </button>
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
					{{ $products->links()}}
				</div>
			</div>
		</div>
    </x-container>
</x-app-layout>			