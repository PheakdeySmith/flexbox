<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Analytics Report</title>
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
        <h1>Subscription Analytics Report</h1>
        <p>Period: {{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</p>
        <p>Generated on: {{ now()->format('M d, Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>Active Subscriptions</h3>
            <p>{{ $totalActiveSubscriptions }}</p>
        </div>
        <div class="summary-item">
            <h3>Canceled Subscriptions</h3>
            <p>{{ $totalCanceledSubscriptions }}</p>
        </div>
        <div class="summary-item">
            <h3>Total Revenue</h3>
            <p>${{ number_format($totalSubscriptionRevenue, 2) }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Plan Name</th>
                <th>Price</th>
                <th>Duration (days)</th>
                <th>Active Subscribers</th>
                <th>Canceled Subscribers</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptionPlans as $plan)
            <tr>
                <td>{{ $plan->name }}</td>
                <td>${{ number_format($plan->price, 2) }}</td>
                <td>{{ $plan->duration }}</td>
                <td>{{ $plan->active_count }}</td>
                <td>{{ $plan->canceled_count }}</td>
                <td>${{ number_format($plan->revenue, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>{{ $totalActiveSubscriptions }}</th>
                <th>{{ $totalCanceledSubscriptions }}</th>
                <th>${{ number_format($totalSubscriptionRevenue, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }} - Subscription Analytics Report</p>
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
