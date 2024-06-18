<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            justify-content: center;
        }

        
        .container {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            padding: 0 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        
        h1 {
            text-transform: uppercase;
            color: darkgreen;
            text-align: left;
            margin-bottom: 20px;
            font-size: 24px;
            border-bottom: 2px solid darkgreen;
            padding-bottom: 10px;
        }

        
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        
        button {
            background-color: #008000;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Recipe</h1>
        <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $recipe->title }}" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ $recipe->description }}</textarea>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo">
            <label for="keywords">Keywords:</label>
            <input type="text" id="keywords" name="keywords" value="{{ $recipe->keywords->pluck('word')->implode(', ') }}">
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

