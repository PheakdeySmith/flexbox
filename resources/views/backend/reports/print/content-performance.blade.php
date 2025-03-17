<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Performance Report</title>
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
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            margin-top: 0;
            padding: 10px;
            background-color: #f2f2f2;
            border-left: 4px solid #007bff;
            color: #333;
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
        .movie-poster {
            width: 40px;
            height: auto;
            border-radius: 4px;
        }
        .rating-stars {
            color: #ffc107;
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
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Content Performance Report</h1>
        <p>Period: {{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</p>
        <p>Generated on: {{ now()->format('M d, Y H:i:s') }}</p>
    </div>

    <div class="section">
        <h2 class="section-title">Top Rated Movies</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Rating</th>
                    <th>Reviews</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topRatedMovies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($movie->poster_path)
                            <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" width="50">
                        @else
                            No Poster
                        @endif
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->release_date->format('M d, Y') }}</td>
                    <td>{{ number_format($movie->avg_rating, 1) }} / 5</td>
                    <td>{{ $movie->review_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section page-break">
        <h2 class="section-title">Most Watched Movies</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Watchlist Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mostWatchedMovies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($movie->poster_path)
                            <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" width="50">
                        @else
                            No Poster
                        @endif
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->release_date->format('M d, Y') }}</td>
                    <td>{{ $movie->watchlist_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section page-break">
        <h2 class="section-title">Most Favorited Movies</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Favorite Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mostFavoritedMovies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($movie->poster_path)
                            <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" width="50">
                        @else
                            No Poster
                        @endif
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->release_date->format('M d, Y') }}</td>
                    <td>{{ $movie->favorite_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section page-break">
        <h2 class="section-title">Most Purchased Movies</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Purchases</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mostPurchasedMovies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($movie->poster_path)
                            <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" width="50">
                        @else
                            No Poster
                        @endif
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->release_date->format('M d, Y') }}</td>
                    <td>{{ $movie->purchase_count }}</td>
                    <td>${{ number_format($movie->revenue, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }} - Content Performance Report</p>
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
