	<x-app-layout>
	<x-slot name="header">
		<h1 class="font-semibold text-xl">
			Create your product
		</h1>
	</x-slot>
	<x-container>
		<div class="flex">
			<div class="w-full mt-3 lg:w-3/4">
				<x-card>
				 	@if (session('error'))
                        <div class="bg-red-500 px-4 py-4 font-medium text-red-100">
                            {{ session('error') }}
                        </div>
                    @endif
					<form action="{{ route('product.store')}}" method="post">
						@csrf
						<div class="mb-5">
							<x-label for="title">Name Produk</x-label>
							<x-input  class="mt-1 w-full" type="text" name="title" id="title" />
							@error('title')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="price">Harga</x-label>
							<x-input  class="mt-1 w-full" type="text" name="price" id="price" />
							@error('price')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="stock">Stok</x-label>
							<x-input  class="mt-1 w-full" type="number" name="stock" id="stock" min="0"/>
							@error('stock')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-5">
							<x-label for="description">Deskripsi</x-label>
							<textarea class="mt-1 w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200" cols="5" rows="5" name="description" id="description">
							</textarea>
							@error('description')
								<div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
							@enderror
						</div>

						<x-button>Tambah</x-button>
					</form>
				</x-card>
			</div>
		</div>
	</x-container>
</x-app-layout>