<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Keyword;


class RecipeController extends Controller
{
    public function index()
    {
        

        $recipes = Recipe::all();                            //fetchojam visas receptes no datu bāzes (recipe model)
        return view('recipes.index', compact('recipes'));       
    }

    public function create()
    {
        Gate::authorize('create-recipe');               // Autorizējam darbību, lai izveidotu recepti, izmantojot definētos gate

        return view('recipes.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create-recipe');

        $validated = $request->validate([               // ienākošie dati
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image',
            'keywords' => 'nullable|string',
        ]);


        $recipe = new Recipe();                                 // Izveidojam jaunu receptes gadījumu
        $recipe->user_id = auth()->id();                        //Iestatam user_id uz pašlaik autentificētā lietotāja ID   
        $recipe->title = $validated['title'];
        $recipe->description = $validated['description'];

        if ($request->hasFile('photo')){                        // Pārbaudam vai tika pievienots fotoattēls, ja bija saglabājam photos direktorijā
            $path = $request->file('photo')->store('photos', 'public');
            $recipe->photo = $path;                             // Saglabājiet fotoattēla uzglabāšanas ceļu receptes fotoattēla atribūtā
        }
        
        $recipe->save();

        if ($request->filled('keywords')){
            $keywords = explode(',', $request->input('keywords'));      // Sadalam atslēgvārdu virkni ar komatiem masīvā
            $keywordIds = [];                                           //Inicializējam masīvu, lai tajā būtu atslēgvārdu ID
            foreach ($keywords as $keyword) {                       //loops kas iet cauri katram keywordam
                $keyword = trim($keyword);                      // Izgriez atstarpi no atslēgvārda
                $keywordModel = Keyword::firstOrCreate(['word' => $keyword]);    // Atrod atslēgvārdu datu bāzē vai izveido to, ja tas neeksistē   
                $keywordIds[] = $keywordModel->id;                              // Pievieno atslēgvārda ID masīvam
            }
            $recipe->keywords()->sync($keywordIds);
        }

        return redirect()->route('recipes.index');
    }

    public function show(Recipe $recipe)
    {
        

        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        Gate::authorize('edit-recipe', $recipe);

        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        Gate::authorize('edit-recipe', $recipe);

        $validated = $request->validate([                       // ienākošie dati
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image',
            'keywords' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')){                                    // Pārbaudam vai tika pievienots fotoattēls, ja bija saglabājam photos direktorijā
            $path = $request->file('photo')->store('photos', 'public');
            $recipe->photo = $path;                                         // Saglabājiet fotoattēla uzglabāšanas ceļu receptes fotoattēla atribūtā
        }   

        $recipe->title = $validated['title'];
        $recipe->description = $validated['description'];
        $recipe->save();

        if ($request->filled('keywords')) {
            $keywords = explode(',', $request->input('keywords'));
            $keywordIds = [];

            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                $keywordModel = Keyword::firstOrCreate(['word' => $keyword]);
                $keywordIds[] = $keywordModel->id;
            }
            $recipe->keywords()->sync($keywordIds);
        }

        return redirect()->route('recipes.index');
    }

    public function destroy (Recipe $recipe)                // Dzēsh recepti no datu bāzes, ja ir atļauja
    {
        Gate::authorize('delete-recipe', $recipe);

        $recipe->delete();
        return redirect()->route('recipes.index');
    }
}
