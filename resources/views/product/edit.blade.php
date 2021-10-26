<x-app-layout>
	<x-slot name="header">
		<h1 class="font-semibold text-xl">
			Update your product
		</h1>
	</x-slot>
	<x-container>
		<div class="flex">
			<div class="w-full mt-3 lg:w-3/4">
				<x-card>
					<form action="{{ route('product.update', $products)}}" method="post">
						@method('put')
						@csrf
						<div class="mb-5">
							<x-label for="title">Name Produk</x-label>
							<x-input  class="mt-1 w-full" type="text" name="title" id="title" value="{{ old('title', $products->title) }}" />
							@error('title')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="price">Harga</x-label>
							<x-input  class="mt-1 w-full" type="text" name="price" id="price"  value="{{ old('price', $products->price) }} "/>
							@error('price')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="stock">Stok</x-label>
							<x-input  class="mt-1 w-full" type="number" name="stock" id="stock"  value="{{ old('stock', $products->stock) }}" />
							@error('stock')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="description">Deskripsi</x-label>
							<textarea class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200" cols="5" rows="5" name="description" id="description" 
							>
							@if($products->description == 'Tidak ada deskripsi yang dimasukan')

							@else
								{{ old('description', $products->description)}}
							@endif
							</textarea>
							@error('description')
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
