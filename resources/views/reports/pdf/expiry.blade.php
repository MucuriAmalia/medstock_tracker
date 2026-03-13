<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expiry Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin-bottom: 5px; }
        p { margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <h2>Expiry Report</h2>
    <p>Generated on {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Medicine</th>
                <th>Category</th>
                <th>Batch Number</th>
                <th>Quantity</th>
                <th>Expiry Date</th>
                <th>Supplier</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->category?->name }}</td>
                    <td>{{ $medicine->batch_number ?? '-' }}</td>
                    <td>{{ $medicine->quantity }}</td>
                    <td>{{ \Carbon\Carbon::parse($medicine->expiry_date)->format('d M Y') }}</td>
                    <td>{{ $medicine->supplier ?? '-' }}</td>
                    <td>
                        @if (\Carbon\Carbon::parse($medicine->expiry_date)->isPast())
                            Expired
                        @elseif (\Carbon\Carbon::parse($medicine->expiry_date)->lessThanOrEqualTo(now()->addDays(30)))
                            Expiring Soon
                        @else
                            Valid
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>