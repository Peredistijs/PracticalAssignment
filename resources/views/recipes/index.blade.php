<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipes</title>
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
            border-radius: 8px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid darkgreen;
            padding-bottom: 10px;
            margin-top: 20px;
        }

        h1 {
            text-transform: uppercase;
            color: darkgreen;
            margin: 0;
            font-size: 24px;
        }

        
        .btn {
            background-color: #008000;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
            width: 200px;
        }

        .btn:hover {
            background-color: darkgreen;
        }

        
        .recipe-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .recipe-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .recipe-title {
            flex: 1;
            margin-right: 15px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        
        .action-link {
            background-color: #f0f0f0;
            color: #333;
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-right: 10px;
            width: 60px;
            text-align: center;
        }

        .action-link:hover {
            background-color: darkgreen;
            color: white;
            border-color: darkgreen;
        }

        
        .inline-form {
            display: inline;
            margin: 0;
        }

        .inline-form button {
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            padding: 0;
            margin: 0;
            font-size: 16px;
            width: 60px;
            text-align: center;
        }

        .inline-form button:hover {
            background-color: red;
            color: white;
            border: 1px solid red;
            border-radius: 3px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Recipes</h1>
            <a href="{{ route('recipes.create') }}" class="btn">Create New Recipe</a>
        </div>
        <ul class="recipe-list">
            @foreach($recipes as $recipe)
                <li>
                    <a href="{{ route('recipes.show', $recipe) }}" class="recipe-title">{{ $recipe->title }}</a>
                    @can('edit-recipe', $recipe)
                        <a href="{{ route('recipes.edit', $recipe) }}" class="action-link">Edit</a>
                    @endcan
                    @can('delete-recipe', $recipe)
                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-link">Delete</button>
                        </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
