<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1,h2 {
            margin:0;
        }
        .title {

        }
        .invoice-company {
            display: flex;
            flex-direction: column;
            margin-top: 16px;
            margin-bottom: 16px;
        }

        .invoice-client {
            display: flex;
            flex-direction: column;
        }

        .invoice_info {
            display: flex;
            flex-direction: row;
            gap:16px;
        }

        .invoice-data {
            display: flex;
            flex-direction: column;
            margin-top: auto;
        }

        .table {
            margin-top:16px;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table > thead {
            background-color: black;
            color: white;
            margin: 4px;
        }

        .table th, .table td {
            padding: 4px;
        }

        .invoice-footer {
            display: flex;
            flex-direction: row;
            margin-top: 40px;
            gap: 10px;
        }

        .invoice-notes {
            border: 1px solid #ccc;
            border-radius: 16px;
            width: 50%;
            padding: 10px;
        }

        .invoice-totals {
            display: flex;
            flex-direction: column;
            width: 50%;
        }
    </style>
</head>
<body>
    @php
        $client = $invoice->client;
        $company = $client->company;
    @endphp

    <div>
        <h1>Factura<h1>
    </div>

    <div class="invoice-company">

        <h2>{{ $company->name }}</h2>
        <span>{{ $company->address }}</span>
        <span>{{ $company->city }}, {{ $company->state }}</span>
        <span>{{ $company->country }}</span>
        <span>{{ $company->email }}</span>
        <span>{{ $company->phone }}</span>
    </div>

    <div class="invoice_info">
        <div class="invoice-client">
            <h2>Cliente</h2>
            <span>{{ $client->first_name }} {{ $client->last_name }}</span>
            <span>{{ $client->address }}</span>
            <span>{{ $client->city }}, {{ $client->state }}</span>
            <span>{{ $client->country }}</span>
            <span>{{ $client->email }}</span>
            <span>{{ $client->phone }}</span>
        </div>
        <div class="invoice-data">
            <span><b>Factura No.</b> {{ $invoice->id }}</span>
            <span><b>Fecha</b> {{ $invoice->created_at->format('d/m/Y') }}</span>
            <span><b>Fecha de expiración</b> {{ $invoice->due_date->format('d/m/Y') }}</span>
        </div>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descripción</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Tipo</th>
        </tr>
      </thead>
        <tbody>
            @foreach($invoice->invoice_items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->unit_price }}</td>
                <td>{{ $item->type == 1 ? 'Producto' : 'Servicio' }}</td>
            </tr>
            @endforeach
        </tbody>
      <tbody>

    </table>

    <div class="invoice-footer">
        <div class="invoice-notes">
            <b>Notas:</b>
            <p>{{ $invoice->notes }}</p>
        </div>
        <div class="invoice-totals">
            <table>
                <tbody>
                <tr>
                    <td>
                        <label >Subtotal:</label>
                    </td>
                    <td>
                        {{ $invoice->subtotal }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Impuesto (%):</label>
                    </td>
                    <td>
                        {{ $invoice->tax }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Descuento (%):</label>
                    </td>
                    <td>
                        {{ $invoice->discount }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> <hr></td>
                </tr>
                <tr>
                    <td>
                        <label>Total</label>
                    </td>
                    <td>
                        {{ $invoice->total }}
                    </td>
                </tr>
            </tbody>
        </table>
            </div>
        </div>

</body>
</html>
