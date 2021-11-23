<x-app-layout>
	 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
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
		<div class="container w-full mx-auto px-2">	
    		<a href="{{ route('product.create') }}" class="inline-flex items-center mt-5 px-4 py-2 bg-blue-700 border border-transparent rounded-xl font-semibold text-sm text-white capitalize tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mb-3"> Add Product</a>
			<div id='recipients' class="p-8 mt-6 m-2 lg:mt-0 rounded shadow overflow-hidden border border-black-200">
				<table id="example" class="stripe hover min-w-full divide-y divide-gray-200 mt-3" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead class="bg-gray-50">
							<tr>
								<x-th>#</x-th>
								<x-th>Nama Produk</x-th>
								<x-th>Harga</x-th>
								<x-th>Stok</x-th>
								<x-th>Tanggal</x-th>
								<x-th>Aksi</x-th>
							</tr>
						</thead>
					<tbody>
						@foreach($products as $product)
						<tr>
							<td>{{ $loop->iteration}}</td>
							<td>{{ $product->title}}</td>
							<td>Rp. {{ number_format($product->price) }}</td>
							<td>{{ $product->stock }}</td>
							<td>{{ $product->created_at->format('d M Y')}}</td>
							<td class="px-6 py-4 whitespace-nowrap">
								<div class="flex items-center">
									<div class="ml-4">
				                        <a class="inline-block border border-yellow-400 bg-yellow-400 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-yellow-500 focus:outline-none focus:shadow-outline" 
				                            href="{{ route('product.edit', $product) }}">
				                            Edit
				                        </a>
				                        <form class="inline-block" action="{{ route('product.destroy', $product) }}" method="POST">
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
						@endforeach
					</tbody>
				</table>
			</div>
      </div>
    </x-container>
</x-app-layout>			