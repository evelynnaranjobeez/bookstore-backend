<!DOCTYPE html>
<html>
<head>
    <title>List of Authors</title>
</head>
<body>
<h1>List of Authors</h1>
<ul>
    @foreach($authors as $author)
        <li>{{ $author->name }} (Born: {{ $author->birth_date }})</li>
    @endforeach
</ul>
</body>
</html>
