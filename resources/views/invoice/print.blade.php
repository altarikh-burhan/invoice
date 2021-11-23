<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Invoice</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style>
		body {
			font-family: 'Fira Code SemiBold', 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
			color: #333;
			text-align: left;
			font-size: 18px;
			margin: 0;
		}
		.container {
			margin: 0 auto;
			margin-top: 35px;
			padding: 40px;
			width: 750px;
			height: auto;
			background-color: #fff;
		}
		caption {
			font-size: 28px;
			margin-bottom: 15px;
		}
		table {
			border: 1px solid #333;
			border-collapse: collapse;
			margin: 0 auto;
			width: 740px;
		}
		td, tr, th {
			padding: 12px;
			border: 1px solid #333;
			width: 185PX;
		}
		th {
			background-color: #f0f0f0;
		}
		h4, p {
			margin: 0px;
		}
	</style>
</head>
<body>
	<div class="container">
		<table>
			<caption>
				Kintanatureindo
			</caption>
			<thead>
				<tr>
					<th colspan="3">Invoice <strong> : {{ $invoice->invoice}}</strong></th>
					<th>{{ $invoice->created_at->format('D, d M Y')}}</th>
				</tr>
				<tr>
					<td colspan="2">
						<h4>Perusahaan : </h4>
						<p>Kintanatureindo. <br>
							085793882531
						</p>
					</td>
					<td colspan="2">
						<h4>Pelanggan : </h4>
						<p>{{ $invoice->customer->name }}<br>
							{{ $invoice->customer->phone }}<br>
							{{ $invoice->customer->address }}<br>
							{{ $invoice->customer->district->name }}, {{ $invoice->customer->district->city->name }},{{ $invoice->customer->district->city->province->name }},{{ $invoice->customer->district->city->postal_code }}
						</p>
					</td>
				</tr>		
			</thead>
			<tbody>
				<tr>
					<th>Produk</th>
					<th>Harga</th>	
					<th>Qty</th>
					<th>Subtotal</th>
				</tr>
				@foreach($invoice->detail as $row)
				<tr>
					<td>{{ $row->product->title}}</td>
					<td>Rp. {{$row->price }}</td>
					<td>{{ $row->qty }}</td>
					<td>{{ $row->subtotal }}</td>
				</tr>
				@endforeach
				<tr>
					<th colspan="3">Subtotal</th>
					<td>Rp {{ number_format($invoice->total) }}</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3">Total</th>
					<td>Rp {{ number_format($invoice->total_price)}}</td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>
