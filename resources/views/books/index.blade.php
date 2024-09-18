<!DOCTYPE html>
<html>
<head>
    <title>List of Books</title>
</head>
<body>
<h1>List of Books</h1>

@if($books->isEmpty())
    <p>No books available</p>
@else
    <ul>
        @foreach($books as $book)
            <li>
                <strong>Title:</strong> {{ $book->title }} <br>
                <strong>Author:</strong> {{ $book->author->name }} <br>
                <strong>Year:</strong> {{ $book->year }} <br>
                <strong>Genre:</strong> {{ $book->genre }} <br>
                <strong>Language:</strong> {{ $book->language }} <br>
                <strong>Description:</strong> {{ $book->description }}
            </li>
            <hr>
        @endforeach
    </ul>
@endif

</body>
</html>
