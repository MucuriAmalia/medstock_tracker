<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stock Movements Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h2 { margin-bottom: 5px; }
        p { margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 7px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <h2>Stock Movements Report</h2>
    <p>Generated on {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Medicine</th>
                <th>Category</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Reference</th>
                <th>User</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movements as $movement)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($movement->movement_date)->format('d M Y') }}</td>
                    <td>{{ $movement->medicine?->name }}</td>
                    <td>{{ $movement->medicine?->category?->name ?? '-' }}</td>
                    <td>{{ $movement->type === 'in' ? 'Stock In' : 'Stock Out' }}</td>
                    <td>{{ $movement->quantity }}</td>
                    <td>{{ $movement->reference ?? '-' }}</td>
                    <td>{{ $movement->user?->name ?? '-' }}</td>
                    <td>{{ $movement->notes ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>