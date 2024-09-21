<?php
include 'Book.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = ['success' => false, 'errors' => [], 'book' => []];

    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    if (empty($title)) {
        $response['errors']['title'] = "Title is required.";
    }
    if (empty($author)) {
        $response['errors']['author'] = "Author is required.";
    }
    if (empty($year)) {
        $response['errors']['year'] = "Year is required.";
    }

    if (empty($response['errors'])) {
        try {
            $book = new Book($title, $author, $year);

            $response['success'] = true;
            $response['book'] = [
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'year' => $book->getYear(),
            ];

        } catch (Exception $e) {
            $response['errors']['general'] = $e->getMessage();
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 45px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 28px;
        }
        form input[type="text"], form input[type="number"], form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error {
            color: red;
            font-size: 12px;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            display: none;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        h1,h2{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Add a Book</h1>
    <form id="bookForm">
        <label>Title:</label>
        <input type="text" name="title" id="title" placeholder="Enter book title"><br>
        <span class="error" id="titleError"></span><br>

        <label>Author:</label> 
        <input type="text" name="author" id="author" placeholder="Enter author name"><br>
        <span class="error" id="authorError"></span><br>

        <label>Publication Year:</label> 
        <input type="number" name="year" id="year" placeholder="Enter publication year" min="1000" max="<?php echo date('Y'); ?>"><br>
        <span class="error" id="yearError"></span><br>

        <input type="submit" value="Add Book">
    </form>

    <h2 id="bookListHeading" style="display:none;">Book List</h2>
    <table id="bookTable">
        <thead id="bookTableHead" style="display:none;">
            <tr><th>Title</th><th>Author</th><th>Year</th></tr>
        </thead>
        <tbody id="bookTableBody">
        </tbody>
    </table>

    <script>
        document.getElementById('bookForm').addEventListener('submit', function (e) {
            e.preventDefault();

            document.getElementById('titleError').textContent = '';
            document.getElementById('authorError').textContent = '';
            document.getElementById('yearError').textContent = '';

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        document.getElementById('bookTable').style.display = 'table';
                        document.getElementById('bookListHeading').style.display = 'block';
                        document.getElementById('bookTableHead').style.display = 'table-header-group';

                        var bookTableBody = document.getElementById('bookTableBody');
                        var newRow = bookTableBody.insertRow();
                        newRow.innerHTML = '<td>' + response.book.title + '</td><td>' + response.book.author + '</td><td>' + response.book.year + '</td>';

                        document.getElementById('title').value = '';
                        document.getElementById('author').value = '';
                        document.getElementById('year').value = '';
                    } else {
                        if (response.errors.title) {
                            document.getElementById('titleError').textContent = response.errors.title;
                        }
                        if (response.errors.author) {
                            document.getElementById('authorError').textContent = response.errors.author;
                        }
                        if (response.errors.year) {
                            document.getElementById('yearError').textContent = response.errors.year;
                        }
                    }
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
