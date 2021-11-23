<x-app-layout>
	<x-slot name="header">
		<h1 class="font-semibold text-xl">
			Create your Invoice
		</h1>
	</x-slot>
	<div class="container mx-auto px-4 pt-16">
     	<h1 class="font-semibold text-xl mb-5">
			Nomor Invoice : {{ $invoice->invoice}}
		</h1>
		<div class="grid grid-cols-2 gap-8">
			<!-- Pelanggan -->
			<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
				<table class="min-w-full divide-y divide-gray-200 mt-3">
					<tbody class="bg-white divide-y divide-gray-200">
						<tr>
							<x-td>Nama</x-td>
							<x-td>:</x-td>
							<x-td>{{ $invoice->customer->name }}</x-td>
						</tr>
							<x-td>No Handphone</x-td>
							<x-td>:</x-td>
							<x-td>{{ $invoice->customer->phone }}</x-td>
						</tr>
						<tr>
							<x-td>Alamat</x-td>
							<x-td>:</x-td>
							<x-td>{{ $invoice->customer->address }},<br> {{$invoice->customer->district->name}}, {{$invoice->customer->district->city->name}}, {{$invoice->customer->district->city->province->name}}, {{$invoice->customer->district->city->postal_code}}</x-td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- End -->
			<!-- Data Diri -->
			<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
				<table class="min-w-full divide-y divide-gray-200 mt-3">
					<tbody class="bg-white divide-y divide-gray-200">
						<tr>
							<x-td>Perusahaan</x-td>
							<x-td>:</x-td>
							<x-td>Kintanatureindo</x-td>
						</tr>
						<tr>
							<x-td>Handphone</x-td>
							<x-td>:</x-td>
							<x-td>089520393873</x-td>
						</tr>
						<tr>
							<x-td>Email</x-td>
							<x-td>:</x-td>
							<x-td>milkycandyshop@gmail.com</x-td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- End -->
		</div>
		<!-- Data Barang -->
		<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
				<table class="min-w-full divide-y divide-gray-200 mt-3">
					<thead class="bg-gray-50">
						<tr>
							<x-th>#</x-th>
							<x-th>Nama Produk</x-th>
							<x-th>Harga</x-th>
							<x-th>Qty</x-th>
							<x-th>Sub Total</x-th>
							<x-th>Aksi</x-th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200">
						@forelse ($invoice->detail as $detail)
						<tr>
							<x-td>{{ $loop->iteration }}</x-td>
							<x-td>{{ $detail->product->title}}</x-td>
							<x-td>Rp {{ number_format($detail->product->price) }}</x-td>
							<x-td>{{ $detail->qty}}</x-td>
							<x-td>Rp {{ $detail->subtotal}}</x-td>
							<x-td>
								<form class="inline-block" action="{{ route('invoice.deleteProduct', ['id' => $detail->id ]) }}" method="POST">
		                        	@method('DELETE')
		                        	@csrf
			                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
			                            Hapus
			                        </button>
			                    </form>
							</x-td>
						</tr>
						@empty
						<tr>
                        	<td class="px-4 py-4 bg-gray-100 font-semibold text-center" colspan="6">Tidak ada data</td>
                        </tr>
						@endforelse
					</tbody>
					<form action="{{ route('invoice.update',  $invoice->id) }}" method="post">
					@method('put')
					@csrf
					<tfoot class="bg-gray-50">
						<tr>
							<td></td>
							<td class="px-2 py-2 whitespace-nowrap">
								<div class="mb-5">
									<input type="hidden" name="_method" value="PUT" class="border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200">
									<select name="product_id" id="product_id" class="w-full border border-gray-300 rounded-xl focus:ring focus: ring-blue-200 focus:border-blue-600 transition duration-200">
										<option value="" class="text-center">-- Pilih Produk --</option>
										@foreach($products as $product)
											<option value="{{ $product->id }}">{{ $product->title }}</option>		
										@endforeach
									</select>
								</div>
							</td>
							<td class="px-2 py-2 whitespace-nowrap">
								<div class="mb-5">
									<x-input class="mt-1 w-full" type="number" name="qty" id="qty"  min="0" placeholder="Masukan jumlah produk" required/>
								</div>
							</td>
							<td class="px-2 py-2 whitespace-nowrap" colspan="5">
								<div class="mb-5">
									<x-button>Tambahkan</x-button>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</form>
		</div>
		<!-- End -->
		<!-- Tax -->
		<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
				<table class="min-w-full divide-y divide-gray-200 mt-3">
					<tbody class="bg-white divide-y divide-gray-200">
						<tr>
							<x-td colspan="3">Total</x-td>
							<x-td>:</x-td>
							<x-td>Rp {{ number_format($invoice->totalPrice) }}</x-td>
						</tr>
					</tbody>
				</table>
			</div>
		<!-- End -->
	</div>				
</x-app-layout>