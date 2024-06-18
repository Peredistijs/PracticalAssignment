<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $recipe->title }}</title>
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
            border: 2px solid darkgreen;
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

        
        p {
            text-align: justify;
            font-size: 16px;
            margin: 20px 0;
        }

        
        img {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 20px auto;
            max-height: 400px;
            width: auto;
            border: 2px solid darkgreen;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $recipe->title }}</h1>
        <img src="{{ Storage::url($recipe->photo) }}" alt="{{ $recipe->title }}">
        <p>{{ $recipe->description }}</p>
    </div>
</body>
</html>
