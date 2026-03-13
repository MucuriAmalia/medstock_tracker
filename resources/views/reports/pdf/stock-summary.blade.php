<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stock Summary Report</title>
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
    <h2>Stock Summary Report</h2>
    <p>Generated on {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Medicine</th>
                <th>Category</th>
                <th>Dosage Form</th>
                <th>Strength</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Reorder Level</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->category?->name }}</td>
                    <td>{{ $medicine->dosage_form }}</td>
                    <td>{{ $medicine->strength ?? '-' }}</td>
                    <td>{{ $medicine->unit }}</td>
                    <td>{{ $medicine->quantity }}</td>
                    <td>{{ $medicine->reorder_level }}</td>
                    <td>
                        @if ($medicine->quantity == 0)
                            Out of Stock
                        @elseif ($medicine->quantity <= $medicine->reorder_level)
                            Low Stock
                        @else
                            In Stock
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>