<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .summary-item {
            text-align: center;
            flex: 1;
        }
        .summary-item h3 {
            margin: 0;
            color: #333;
        }
        .summary-item p {
            margin: 5px 0;
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        @media print {
            body {
                padding: 0;
                margin: 0;
            }
            @page {
                margin: 1cm;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>User Activity Report</h1>
        <p>Period: {{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</p>
        <p>Generated on: {{ now()->format('M d, Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>New Users</h3>
            <p>{{ $totalNewUsers }}</p>
        </div>
        <div class="summary-item">
            <h3>Watchlist Items</h3>
            <p>{{ $totalWatchlistItems }}</p>
        </div>
        <div class="summary-item">
            <h3>Favorites</h3>
            <p>{{ $totalFavorites }}</p>
        </div>
        <div class="summary-item">
            <h3>Reviews</h3>
            <p>{{ $totalReviews }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Joined</th>
                <th>Watchlist</th>
                <th>Favorites</th>
                <th>Reviews</th>
                <th>Orders</th>
                <th>Total Spent</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td>
                <td>{{ $user->watchlist_count }}</td>
                <td>{{ $user->favorite_count }}</td>
                <td>{{ $user->review_count }}</td>
                <td>{{ $user->order_count }}</td>
                <td>${{ number_format($user->total_spent, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }} - User Activity Report</p>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print();" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Print Report
        </button>
        <button onclick="window.close();" style="padding: 10px 20px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
            Close
        </button>
    </div>

    <script>
        window.onload = function() {
            // Auto print when the page loads
            setTimeout(function() {
                window.print();
            }, 1000);
        };
    </script>
</body>
</html>
