<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laurisdan School - Books</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laurisdan Nursery & Primary School</h2>
        <p>Books Inventory</p>
        <p>Generated: {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Quantity</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $i => $book)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->quantity }}</td>
                <td>{{ $book->notes }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;">No books found</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
